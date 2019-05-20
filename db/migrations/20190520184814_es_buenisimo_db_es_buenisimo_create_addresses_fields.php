<?php
/**
 * Migration Task class.
 */
class EsBuenisimoDbEsBuenisimoCreateAddressesFields
{
  public function preUp()
  {
      // add the pre-migration code here
  }

  public function postUp()
  {
      // add the post-migration code here
  }

  public function preDown()
  {
      // add the pre-migration code here
  }

  public function postDown()
  {
      // add the post-migration code here
  }

  /**
   * Return the SQL statements for the Up migration
   *
   * @return string The SQL string to execute for the Up migration.
   */
  public function getUpSQL()
  {
     return "ALTER TABLE user ADD COLUMN region_id INT(11) NULL AFTER `location`;
            ALTER TABLE user ADD COLUMN province_id INT(11) NULL AFTER `region_id`;
            ALTER TABLE user ADD COLUMN commune_id INT(11) NULL AFTER `province_id`;"; 
  }

  /**
   * Return the SQL statements for the Down migration
   *
   * @return string The SQL string to execute for the Down migration.
   */
  public function getDownSQL()
  {
     return "";
  }

}