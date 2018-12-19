<?php
/*
 * This file is part of the Es Buenisimo project.
 *
 * (c) Es Buenisimo <www.esbuenisimo.com>
 *
 * For the full copyright and license information, please view the README.md
 * and LICENSE files that was distributed with this source code.
 */

namespace Goteo\Controller;

use Goteo\Application\Message;
use Goteo\Application\AppEvents;
use Goteo\Application\Event\FilterProjectEvent;
use Goteo\Application\Config;
use Goteo\Application\Exception\ControllerAccessDeniedException;
use Goteo\Application\Exception\ControllerException;
use Goteo\Application\Exception\ModelException;
use Goteo\Application\Exception\ModelNotFoundException;
use Goteo\Application\Lang;
use Goteo\Application\Session;
use Goteo\Application\View;
use Goteo\Model\Page;
use Goteo\Library\Text;
use Goteo\Library\Worth;
use Goteo\Model\ProjectRequestStatus;
use Goteo\Model\ProjectRequest;
use Goteo\Model\Region;
use Goteo\Model\Province;
use Goteo\Model\Commune;
use Goteo\Model\ProjectRequestType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Goteo\Controller\Dashboard\ProjectDashboardController;

class RankingController extends \Goteo\Core\Controller {

    public function __construct() {
        //Set the responsive theme
        View::setTheme('responsive');
    }

	public function indexAction(Request $request) {
		    		
		if($request->isMethod('post')) {
			
			if (!Session::isLogged()) {
					Message::info(Text::get('user-login-required-ranking'));
					return $this->redirect('/user/login?return='.urldecode('/ranking'));
			}			
						
			// Add a new project request.
			if($request->request->has('project_name')) {
				
				$projectRequest = new ProjectRequest();			
				$projectRequest->request_type_id = $request->request->get('project_request_type_id');
				$projectRequest->project_name = $request->request->get('project_name');
				$projectRequest->region_id = $request->request->get('region_id');
				$projectRequest->province_id = $request->request->get('province_id');
				$projectRequest->commune_id = $request->request->get('commune_id');

				$errors = [];

				if($projectRequest->save($errors)) {
					Message::info(Text::get('project-request-save-sucess'));
				} 							
			}
			
			//Change request status
			if($request->request->has('form-action') && $request->request->get('form-action') == 'change-status') {

				$projectRequest = ProjectRequest::get($request->request->get('request-id'));

				if($projectRequest->updateStatus($request->request->get('status'))) {
					Message::info(sprintf("" . Text::get('project-request-change-status-success') . "",
															 $projectRequest->project_name, 	$projectRequest->getStatusText()));
				}
				else {
					Message::info(Text::get('project-request-change-status-error'));
				}
			}

			//Vote for request
			if($request->request->has('form-action') && $request->request->get('form-action') == 'vote-for-request') {
								
				$projectRequest = ProjectRequest::get($request->request->get('request-id'));
				
				if($projectRequest->addVote(Session::getUser()->id)) {
					Message::info(sprintf("" . Text::get('project-request-add-vote-success') . "",
															 $projectRequest->project_name));
				}
				else {
					Message::info(Text::get('project-request-add-vote-error'));
				}				
			}

			//Delete request
			if($request->request->has('form-action') && $request->request->get('form-action') == 'delete-request') {
				if(ProjectRequest::delete((int) $request->request->get('request-id'), $errors)) {
					Message::info(Text::get('project-request-delete-success'));
				} 
			}			
		}
    
    if(Session::isAdmin()) {
      $filters = [];
			$filters['userId'] = Session::getUser()->id;
			if(!empty($request->query->get('project_request_type_id'))) 
				$filters['request_type_id'] = $request->query->get('project_request_type_id');
      if(!empty($request->query->get('status'))) $filters['status'] = $request->query->get('status');
      if(!empty($request->query->get('query'))) $filters['query'] = $request->query->get('query');
      
    } else {
      
      $filters = [
        'userId' => Session::getUser()->id, 
        'status' => ProjectRequestStatus::STATUS_APPROVED
      ];            
    }
    
    $limit = 10;
    $page = $request->query->get('pag') ?: 0;
      
    $projectRequests = ProjectRequest::getList($filters, $page * $limit, $limit);
    $total = ProjectRequest::getList($filters, 0, 0, true);
              
    return $this->viewResponse('ranking/index',
        array(
            'list' => $projectRequests,
            'statuses'=> ProjectRequestStatus::getList(),
            'total' => $total,
            'limit' => $limit,
            'isAdmin' => Session::isAdmin(),
            'filter' => [
                '_action' => '/ranking',
                'q' => Text::get('admin-users-global-search')     
              ],
					'success' => $success ? : null,
					'errors' => !empty($errors) ? $errors : null,
					'regions' => Region::getList(),
					'projectRequestTypes' => ProjectRequestType::getList(),
        ) 
    );
	}
	
	public function getProvincesAction(Request $request) {
		return $this->jsonResponse(['provinces' => Province::getList([
        'regionId' => (int) $request->request->get('regionId')])]);
	}
	
	public function getCommunesAction(Request $request) {
		return $this->jsonResponse(['communes' => Commune::getList([
        'provinceId' => (int) $request->request->get('provinceId')])]);
	}
}