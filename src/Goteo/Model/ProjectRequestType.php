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

    class ProjectRequestType {
      
        const TYPE_ENTERTAINMENT = 1;
        const TYPE_CORPORATIVE = 2;
        const TYPE_SPORTS = 3;
      
        public static $types = [
          self::TYPE_ENTERTAINMENT => 'project-request-type-entertainment',
          self::TYPE_CORPORATIVE => 'project-request-type-corporative',
          self::TYPE_SPORTS => 'project-request-type-sports',
        ];
      
        public static function getList() {
          $list = [];
          
          foreach(self::$types as $index => $value) {
            $list[$index] = Text::get($value);
          }
          
          return $list;
        } 
    }
}