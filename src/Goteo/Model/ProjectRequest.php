<?php
/*
 * This file is part of the Goteo Package.
 *
 * (c) Platoniq y Fundación Goteo <fundacion@goteo.org>
 *
 * For the full copyright and license information, please view the README.md
 * and LICENSE files that was distributed with this source code.
 */

namespace Goteo\Model {
  
    use Goteo\Model\ProjectRequestStatus;
    use Goteo\Model\UserVote;
    use Goteo\Library\Text;  

    class ProjectRequest extends \Goteo\Core\Model {
      
        public $Table = 'project_requests';

        public
            $id,
            $project_name,
            $status,
            $votes,
            $publish;
      
        public $user_id;
      
        public $labels = [
          'position' => 'ranking-table-position-field',
          'event' => 'ranking-table-project-name-field',
          'status' => 'ranking-table-status-field',
          'vote' => 'ranking-table-vote-action-field',
          'votes' => 'ranking-table-votes-field',
        ];
  
      /*
       *  Devuelve datos de un destacado
       */
      public static function get ($id) {

            $sql = static::query("
                SELECT
                    project_requests.id as id,
                    project_requests.project_name as project_name,
                    project_requests.status as status,
                    project_requests.votes as votes,
                    project_requests.modified as request_last_update
                FROM project_requests
                WHERE project_requests.id = :id
                ", array(':id' => $id));

              $request = $sql->fetchObject(__CLASS__);

              return $request;
      }

        /*
         * Lista de solicitudes de proyectos para admin
         */      
        public static function getList($filters = array(), $offset = 0, $limit = 100, $count = false) {
          
        $values = [];

        $requests = [];

        $sqlExtraFields = [];
        $sqlJoin = [];
        $sqlFilter = [];
        $sqlOrder = [];

        if (!empty($filters['status'])) {
            $sqlFilter[] = "status = :status";
            $values[':status'] = $filters['status'];
        }
                    
        if(!empty($filters['userId'])) {
          
          $sqlExtraFields[] = 'user_votes.user_id AS user_id';
          $sqlJoin[] = " LEFT JOIN user_votes ON user_votes.project_request_id = project_requests.id AND user_id = :userId ";
          $values[':userId'] = $filters['userId'];
        }            
          
        if (!empty($filters['query'])) {
            $sqlFilter[] = "(project_name LIKE :query)";
            $values[':query'] = '%' . $filters['query'] . '%';
            $sqlOrder[] = " project_name  DESC";
        }
          
          if($sqlExtraFields) $sqlExtraFields = ', ' . implode(' , ', $sqlExtraFields);
          else $sqlExtraFields = '';
          
          if($sqlJoin) $sqlJoin = implode(' ', $sqlJoin);
          else $sqlJoin = '';

          if($sqlFilter) $sqlFilter = 'WHERE '. implode(' AND ', $sqlFilter);
          else  $sqlFilter = '';
          
          if ($count) {
              // Return count
              $sql = "SELECT COUNT(id) as total FROM project_requests $sqlJoin $sqlFilter";
              return (int) self::query($sql, $values)->fetchColumn();
          }

          if($sqlOrder) $sqlOrder = " ORDER BY " . implode(',', $sqlOrder);          
          else $sqlOrder = ' ORDER BY project_requests.votes DESC ';
          
          $offset = (int) $offset;
          $limit = (int) $limit;

          $sql = "SELECT
                      project_requests.id as id,
                      project_requests.project_name as project_name,
                      project_requests.status as status,
                      project_requests.votes as votes,
                      project_requests.modified as request_last_update                    
                      $sqlExtraFields
                  FROM project_requests
                  $sqlJoin
                  $sqlFilter
                  $sqlOrder
                  LIMIT $offset, $limit
                  ";
          
          $query = self::query($sql, $values);
          
          foreach ($query->fetchAll(\PDO::FETCH_CLASS, __CLASS__) as $key => &$request) {
              $request->position = $offset + $key + 1;
              $requests[] = $request;
          }
          
          return $requests;          
        }
      
        public function validate (&$errors = array()) {
            if (empty($this->project_name))
                $errors[] = Text::get('mandatory-project-request-name');

            if (empty($errors))
                return true;
            else
                return false;
        }

        public function save (&$errors = array()) {
            if (!$this->validate($errors)) return false;
          
            $fields = array(
                'id',
                'project_name',
                'status',
                'votes',
                );
          
            $this->status = ProjectRequestStatus::STATUS_PENDING;
            $this->votes = 0;
          
            try {
              $this->dbInsert($fields);
            return true;
            } catch(\PDOException $e) { 
              
              if(strpos(strtolower($e->getMessage()), 'duplicate')) 
                $errors[] = Text::get('project-request-save-duplicate-error');
              else $errors[] = $e->getMessage();
              
            }
        }
      
      public function addVote($voterId = null) {
        
          $status = true;
                  
          $sql = "UPDATE project_requests SET votes = votes + 1 WHERE id = :id";
          if (self::query($sql, array(':id'=> $this->id))) {
              $status = true;
          } else {
              $status = false;
          }      
                
          if($voterId) {
            
            $userVote = new UserVote();
            $userVote->project_request_id = $this->id;
            $userVote->user_id = $voterId;
            
            $status = $status + $userVote->dbReplace(['project_request_id', 'user_id']);
            
          }
            
          return $status;
      }
      
      public function updateStatus($status) {
                
        $values = [];
        $set = [];
        $sqlFilter = [];
        
        $set[] = "status = :status";
        $values[':status'] = $status;        
        
        if(in_array($status, [ProjectRequestStatus::STATUS_PENDING, ProjectRequestStatus::STATUS_REJECTED])) {
          $set[] = "votes = 0";
        }        
        
        $sqlFilter[] = "id = :id";
        $values[':id'] = $this->id;        
        
        if($set) $set = 'SET '. implode(' , ', $set);
        else $set = '';

        if($sqlFilter) $sqlFilter = 'WHERE '. implode(' AND ', $sqlFilter);
        else  $sqlFilter = '';        
     
        $sql = "UPDATE project_requests $set $sqlFilter";
        if (self::query($sql, $values)) {
            return true;
        } else {
            return false;
        }  
      }
      
      public function getStatusText() {
        return Text::get(ProjectRequestStatus::$statuses[$this->status]);
      }
    }
}