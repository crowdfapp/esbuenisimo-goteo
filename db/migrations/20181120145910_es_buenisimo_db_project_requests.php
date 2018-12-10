<?php
/**
 * Migration Task class.
 */
class EsBuenisimoDbProjectRequests
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
     return "
        CREATE TABLE `project_requests` (
          `id` INT(11) NOT NULL AUTO_INCREMENT,
          `project_name` TEXT CHARACTER SET utf8 NOT NULL,
          `status` tinyint(1) NOT NULL DEFAULT '0',
          `votes` smallint(6) unsigned NOT NULL DEFAULT '0',
          `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        
        CREATE TABLE `user_votes` (
          `project_request_id` INT(11) NOT NULL,
          `user_id` varchar(255) CHARACTER SET utf8 NOT NULL,
          `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
     ";

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