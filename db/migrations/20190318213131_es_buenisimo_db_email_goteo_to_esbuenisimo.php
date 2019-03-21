<?php
/**
 * Migration Task class.
 */
class EsBuenisimoDbEmailGoteoToEsbuenisimo
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
     UPDATE template SET title = REPLACE(title, 'Goteo', 'EsBuenisimo'); 
     UPDATE template SET title = REPLACE(title, 'goteo', 'EsBuenisimo'); 
     UPDATE template SET title = REPLACE(title, 'goteo.org', 'esbuenisimo.com');
     UPDATE template SET text = REPLACE(text, 'Goteo', 'EsBuenisimo'); 
     UPDATE template SET text = REPLACE(text, 'goteo', 'EsBuenisimo'); 
     UPDATE template SET text = REPLACE(text, 'goteo.org', 'esbuenisimo.com');
     UPDATE template SET text = REPLACE(text, 'The Goteo Mailer', 'El Equipo de EsBuenisimo');
     UPDATE template SET text = REPLACE(text, 'twitter/identica: @goteofunding', '');";
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