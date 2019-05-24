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
  
    class Commune extends \Goteo\Core\Model {
      
        public $Table = 'communes';

        public
            $id,
            $name,
            $province_id;
              
      /*
       *  Devuelve datos de una provincia
       */
      public static function get ($id) {

            $sql = static::query("
                SELECT
                    communes.id as id,
                    communes.name as name,
                    communes.province_id as province_id
                FROM communes
                WHERE communes.id = :id
                ", array(':id' => $id));

              $province = $sql->fetchObject(__CLASS__);

              return $province;
      }

        /*
         * Lista de regiones
         */      
        public static function getList($filters = array(), $offset = 0, $limit = 100, $count = false, $forSelect = false, $forSelectAttr = false) {
          
        $values = [];

        $communes = [];

        $sqlFilter = [];
        $sqlOrder = [];
          
        if(!empty($filters['provinceId'])) {
            if($forSelectAttr) $sqlFilter[] = "(communes.province_id NOT LIKE :provinceId)";
            else $sqlFilter[] = "(communes.province_id LIKE :provinceId)";
            $values[':provinceId'] = $filters['provinceId'];
        }
                              
        if (!empty($filters['query'])) {
            $sqlFilter[] = "(communes.name LIKE :query)";
            $values[':query'] = '%' . $filters['query'] . '%';
            $sqlOrder[] = " communes.name  DESC";
        }
        
        if($sqlFilter) $sqlFilter = 'WHERE '. implode(' AND ', $sqlFilter);
        else  $sqlFilter = '';
          
        if ($count) {
            // Return count
            $sql = "SELECT COUNT(id) as total FROM communes $sqlFilter";
            return (int) self::query($sql, $values)->fetchColumn();
        }

        if($sqlOrder) $sqlOrder = " ORDER BY " . implode(',', $sqlOrder);          
        else $sqlOrder = ' ORDER BY communes.name ASC ';
          
          $offset = (int) $offset;
          $limit = (int) $limit;
          
          $sql = "SELECT
                      communes.id as id,
                      communes.name as name,
                      communes.province_id as province_id
                  FROM communes
                  $sqlFilter
                  $sqlOrder
                  LIMIT $offset, $limit
                  ";
          
          $query = self::query($sql, $values);
          
          foreach ($query->fetchAll(\PDO::FETCH_CLASS, __CLASS__) as $key => $commune) {
              $communes[] = $commune;
          }
          
          if($forSelect) {
              $select = [];
              foreach($communes as $commune) {
                  $select[$commune->id] = $commune->name;
              }
              $communes = $select;
          }     
          
          if($forSelectAttr) {
              $select = [];
              foreach($communes as $commune) {
                  $select[$commune->id] = ['class' => 'hidden'];
              }
              $communes = $select;
          }             
          
          return $communes;          
        }      
      
        public function validate(&$errors = array()) {
            return true;
        }

        public function save(&$errors = array()) {
            return true;
        }        
    } 
}