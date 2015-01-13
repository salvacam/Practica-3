create database bdphp default character set utf8 collate utf8_unicode_ci;
grant all on bdphp.* to userphp@localhost identified by 'clavephp';
flush privileges;

use bdphp;

CREATE TABLE IF NOT EXISTS `user_usuario` (
    `id` int NOT NULL primary key auto_increment,
    `login` varchar(15) NOT NULL UNIQUE,
    `clave` varchar(40) NOT NULL,  
    `nombre` varchar(30) NOT NULL,  
    `apellidos` varchar(60) NOT NULL,  
    `email` varchar(40) NOT NULL UNIQUE,
    `fechaalta` date NOT NULL,
    `isactivo` tinyint(1) NOT NULL,
    `isroot` tinyint(1) NOT NULL DEFAULT 0,
    `rol` enum('administrador', 'usuario') NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `user_login` (
    `id` int NOT NULL auto_increment,
    `login` int NOT NULL,
    `fechaLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,  
    `ip` varchar(15) NOT NULL,
    `browser` varchar(150) NOT NULL,
    primary key(id, login, fechaLogin),
    FOREIGN KEY (login) REFERENCES user_usuario (id)    
) ENGINE=InnoDB;

insert into user_usuario 
values (null, "roott", sha1("roott"), "roott", "roott", "roott@rot.es", now(), 1, 1, "administrador");
