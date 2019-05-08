<?php
/**
 * Migration Task class.
 */
class EsBuenisimoDbEsBuenisimoDbUserAddititonalFields
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
     return "ALTER TABLE user ADD COLUMN rut VARCHAR(18) NULL AFTER `legal_entity`;
            ALTER TABLE user ADD COLUMN business_name VARCHAR(300) NULL AFTER `rut`;
            ALTER TABLE user ADD COLUMN address VARCHAR(300) NULL AFTER `business_name`;
            ALTER TABLE user ADD COLUMN telephone VARCHAR(30) NULL AFTER `address`;
            ALTER TABLE user ADD COLUMN business_objective VARCHAR(300) NULL AFTER `telephone`;"; 
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