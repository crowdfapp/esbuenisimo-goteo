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
  
    class Region extends \Goteo\Core\Model {
      
        public $Table = 'regions';

        public
            $id,
            $name,
            $ordinal;
      
        public $user_id;
        
      /*
       *  Devuelve datos de una region
       */
      public static function get ($id) {

            $sql = static::query("
                SELECT
                    regions.id as id,
                    regions.name as name,
                    regions.ordinal as ordinal
                FROM regions
                WHERE regions.id = :id
                ", array(':id' => $id));

              $region = $sql->fetchObject(__CLASS__);

              return $region;
      }

        /*
         * Lista de regiones
         */      
        public static function getList($filters = array(), $offset = 0, $limit = 100, $count = false) {
          
        $values = [];

        $regions = [];

        $sqlFilter = [];
        $sqlOrder = [];
                              
        if (!empty($filters['query'])) {
            $sqlFilter[] = "(regions.name LIKE :query)";
            $values[':query'] = '%' . $filters['query'] . '%';
            $sqlOrder[] = " regions.name  DESC";
        }
        
        if($sqlFilter) $sqlFilter = 'WHERE '. implode(' AND ', $sqlFilter);
        else  $sqlFilter = '';
          
        if ($count) {
            // Return count
            $sql = "SELECT COUNT(id) as total FROM regions $sqlFilter";
            return (int) self::query($sql, $values)->fetchColumn();
        }

        if($sqlOrder) $sqlOrder = " ORDER BY " . implode(',', $sqlOrder);          
        else $sqlOrder = ' ORDER BY regions.name ASC ';
          
          $offset = (int) $offset;
          $limit = (int) $limit;

          $sql = "SELECT
                      regions.id as id,
                      regions.name as name,
                      regions.ordinal as ordinal
                  FROM regions
                  $sqlFilter
                  $sqlOrder
                  LIMIT $offset, $limit
                  ";
          
          $query = self::query($sql, $values);
          
          foreach ($query->fetchAll(\PDO::FETCH_CLASS, __CLASS__) as $key => $region) {
              $regions[] = $region;
          }
          
          return $regions;          
        }      
      
        public function validate(&$errors = array()) {
            return true;
        }

        public function save(&$errors = array()) {
            return true;
        }
    }
}