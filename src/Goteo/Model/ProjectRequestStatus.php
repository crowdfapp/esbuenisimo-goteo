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
  
    use Goteo\Library\Text;  

    class ProjectRequestStatus {
      
        const STATUS_PENDING = 1;
        const STATUS_APPROVED = 2;
        const STATUS_REJECTED = 3;
      
        public static $statuses = [
          self::STATUS_PENDING => 'project_request_status_pending',
          self::STATUS_APPROVED => 'project_request_status_approved',
          self::STATUS_REJECTED => 'project_request_status_rejected',
        ];
      
        public static function getList() {
          $list = [];
          
          foreach(self::$statuses as $index => $value) {
            $list[$index] = Text::get($value);
          }
          
          return $list;
        } 
    }
}