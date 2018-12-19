<?php
/*
 * This file is part of the Goteo Package.
 *
 * (c) Platoniq y Fundación Goteo <fundacion@goteo.org>
 *
 * For the full copyright and license information, please view the README.md
 * and LICENSE files that was distributed with this source code.
 */
namespace Goteo\Util\ModelNormalizer\Transformer;

use Goteo\Model\Projectrequest;
use Goteo\Model\ProjectrequestStatus;
use Goteo\Library\Text;
use Goteo\Application\Session;

/**
 * Transform a Model\ProjectRequest

// $item['amount'] = $ob->amount;
// // $item['num_owned'] = $ob->num_owned;
// // $item['num_invested'] = $ob->num_invested;
// $projects = $ob->getProjectNames();
// if($projects) {
//     $item['roles'][] = 'owner';
// }
// $item['info'] = $projects;


 */
class ProjectRequestTransformer extends AbstractTransformer {
  
    public function getDefaultKeys() {
        if(Session::isAdmin()) return ['position', 'eventType', 'event', 'ubication', 'status', 'vote', 'votes'];
        return ['position', 'eventType', 'event', 'ubication', 'vote', 'votes'];
    } 
  
    public function getId() {
      return $this->model->id;
    }
  
    public function getPosition() {
        return $this->model->position;
    }
  
    public function getEvent() {
        return $this->model->project_name;
    }
  
    public function getStatus() {
        return $this->model->status;
    }
  
    public function getVote() {

    }
  
    public function getVotes() {
        return $this->model->votes;
    }
  
    public function isRejected() {
        return $this->model->status == ProjectRequestStatus::STATUS_REJECTED;
    }
  
    public function getUserId() {
        return $this->model->user_id;
    }
  
    public function getUbication() {
        return $this->model->getUbication();
    }
  
    public function getEventType() {
        return $this->model->getEventType();
    }
}