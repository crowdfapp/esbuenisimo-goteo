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
 
    class UserVote extends \Goteo\Core\Model {
      
        public $Table = 'user_votes';

        public
            $project_request_id,
            $user_id;
      
        public function validate (&$errors = array()) {
            return true;
        }      

        public function save (&$errors = array()) {
          
            $fields = array(
                'project_request_id',
                'user_id',
                );
                    
            try {
              $this->dbInsert($fields);
            return true;
            } catch(\PDOException $e) { 
              $errors[] = $e->getMessage();
            }
        }
    }
}