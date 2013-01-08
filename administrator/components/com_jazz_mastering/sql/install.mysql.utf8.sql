CREATE TABLE IF NOT EXISTS `#__jazz_mastering_tema` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`titulo` VARCHAR(255)  NOT NULL ,
`compositor` TINYINT(255)  NOT NULL ,
`tempo` INT(11)  NOT NULL ,
`estilo` INT(11)  NOT NULL ,
`tonalidad` INT(11)  NOT NULL ,
`modo` INT(11)  NOT NULL ,
`chords` VARCHAR(255)  NOT NULL ,
`compases` INT(11)  NOT NULL ,
`user` INT(11)  NOT NULL ,
`fecha_de_creacion` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jazz_mastering_lick` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`user` INT(11)  NOT NULL ,
`time_created` DATETIME NOT NULL ,
`cadencia` INT(11)  NOT NULL ,
`modo` INT(11)  NOT NULL ,
`num_de_compases` INT(11)  NOT NULL ,
`image_id` INT(11)  NOT NULL ,
`autor` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jazz_mastering_comping_lick` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`created_by` INT(11)  NOT NULL ,
`time_created` DATETIME NOT NULL ,
`cadencia` INT(11)  NOT NULL ,
`modo` INT(11)  NOT NULL ,
`num_de_compases` INT(11)  NOT NULL ,
`image_id` INT(11)  NOT NULL ,
`autor` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jazz_mastering_modo` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`modo` VARCHAR(255)  NOT NULL ,
`values_modo_creado_por` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jazz_mastering_cadencia` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`cadencia` VARCHAR(255)  NOT NULL ,
`values_cadencia_creado_por` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jazz_mastering_tempo` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`value_tempo` VARCHAR(255)  NOT NULL ,
`values_tempo_creado_por` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jazz_mastering_estilo` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`value_estilo` VARCHAR(255)  NOT NULL ,
`value_estilo_creado_por` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jazz_mastering_value_num_de_compases_lick` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`num_de_compases` VARCHAR(255)  NOT NULL ,
`user_id` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jazz_mastering_value_tonalidad` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`value_tonalidad` VARCHAR(255)  NOT NULL ,
`value_tonalidad_creado_por` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jazz_mastering_img_lick` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`img_name` VARCHAR(255)  NOT NULL ,
`type` INT(11)  NOT NULL ,
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jazz_mastering_lick_autor` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`autorname` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jazz_mastering_lick_type` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`created_by` INT(11)  NOT NULL ,
`type_name` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

