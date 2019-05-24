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
  
    class Province extends \Goteo\Core\Model {
      
        public $Table = 'provinces';

        public
            $id,
            $name,
            $region_id;
              
      /*
       *  Devuelve datos de una provincia
       */
      public static function get ($id) {

            $sql = static::query("
                SELECT
                    provinces.id as id,
                    provinces.name as name,
                    provinces.region_id as region_id
                FROM provinces
                WHERE provinces.id = :id
                ", array(':id' => $id));

              $province = $sql->fetchObject(__CLASS__);

              return $province;
      }

        /*
         * Lista de provincias
         */      
        public static function getList($filters = array(), $offset = 0, $limit = 100, $count = false, $forSelect = false, $forSelectAttr = false) {
          
        $values = [];

        $provinces = [];

        $sqlFilter = [];
        $sqlOrder = [];
          
        if(!empty($filters['regionId'])) {
            if($forSelectAttr) $sqlFilter[] = "(provinces.region_id NOT LIKE :regionId)";
            else $sqlFilter[] = "(provinces.region_id LIKE :regionId)";
            $values[':regionId'] = $filters['regionId'];
        }
                              
        if (!empty($filters['query'])) {
            $sqlFilter[] = "(provinces.name LIKE :query)";
            $values[':query'] = '%' . $filters['query'] . '%';
            $sqlOrder[] = " provinces.name  DESC";
        }
        
        if($sqlFilter) $sqlFilter = 'WHERE '. implode(' AND ', $sqlFilter);
        else  $sqlFilter = '';
          
        if ($count) {
            // Return count
            $sql = "SELECT COUNT(id) as total FROM provinces $sqlFilter";
            return (int) self::query($sql, $values)->fetchColumn();
        }

        if($sqlOrder) $sqlOrder = " ORDER BY " . implode(',', $sqlOrder);          
        else $sqlOrder = ' ORDER BY provinces.name ASC ';
          
          $offset = (int) $offset;
          $limit = (int) $limit;
          
          $sql = "SELECT
                      provinces.id as id,
                      provinces.name as name,
                      provinces.region_id as region_id
                  FROM provinces
                  $sqlFilter
                  $sqlOrder
                  LIMIT $offset, $limit
                  ";
          
          $query = self::query($sql, $values);
          
          foreach ($query->fetchAll(\PDO::FETCH_CLASS, __CLASS__) as $key => $province) {
              $provinces[] = $province;
          }
          
          if($forSelect) {
              $select = [];
              foreach($provinces as $province) {
                  $select[$province->id] = $province->name;
              }
              $provinces = $select;
          }          
          
          if($forSelectAttr) {
            
              $select = [];
              foreach($provinces as $province) {
                  $select[$province->id] = ['class' => 'hidden'];
              }
              $provinces = $select;
          }            
          
          return $provinces;          
        }   
      
        public function validate(&$errors = array()) {
            return true;
        }

        public function save(&$errors = array()) {
            return true;
        }      
    }
}