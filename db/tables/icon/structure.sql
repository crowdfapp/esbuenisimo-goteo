CREATE TABLE IF NOT EXISTS `icon` (
`id` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`name` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`description` TINYTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,
`group` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL COMMENT 'exclusivo para grupo',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT = 'Iconos para retorno/recompensa';


-- alters
ALTER TABLE `icon` ADD `order` INT NOT NULL DEFAULT '0' AFTER `id`; 