CREATE TABLE `promote_lang` (
`id` bigint(20) unsigned NOT NULL,
`lang` varchar(2) NOT NULL,
`title` TINYTEXT NULL ,
`description` TEXT NULL ,
 UNIQUE KEY `id_lang` (`id`,`lang`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

-- pendiente de traducir
ALTER TABLE `promote_lang` ADD `pending` INT( 1 ) NULL DEFAULT '0' COMMENT 'Debe revisarse la traducción';


-- constrains
DELETE FROM promote_lang WHERE id NOT IN (SELECT id FROM promote);
ALTER TABLE `promote_lang`
    ADD CONSTRAINT `promote_lang_ibfk_1`
    FOREIGN KEY (`id`) REFERENCES `promote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE ;
