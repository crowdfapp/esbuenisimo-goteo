<?php
/**
 * Migration Task class.
 */
class GoteoUserWeb
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
        DELETE FROM `user_web` WHERE USER NOT IN (SELECT `id` FROM `user`);
        ALTER TABLE `user_web` ADD FOREIGN KEY (`user`) REFERENCES `user`(`id`) ON UPDATE CASCADE ON DELETE CASCADE;
    ";
  }

  /**
   * Return the SQL statements for the Down migration
   *
   * @return string The SQL string to execute for the Down migration.
   */
  public function getDownSQL()
  {
     return "
     ALTER TABLE `user_web` DROP FOREIGN KEY `user_web_ibfk_1`;
     ";
  }

}
