-- phpMyAdmin SQL Dump
-- https://www.phpmyadmin.net

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Criar base dados siresp
CREATE DATABASE IF NOT EXISTS siresp;


-- --------------------------------------------------------

-- Tabela `novidades`
CREATE TABLE IF NOT EXISTS `novidades` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text(100) NOT NULL,
  `body` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
-- Inserir Novidade
INSERT INTO `novidades` (`id`, `user_id`, `title`, `body`, `link`, `create_date`) VALUES
(11, '1', 'The Beginning', 'A primeira novidade é isto funcionar ao contrario do outro siresp....', 'jfaria.org/siresp', '2019-12-14 16:00:00');


-- Tabela `Contactos`
CREATE TABLE IF NOT EXISTS `piquetes` (
  `id` int(11) NOT NULL,
  `zona` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `mail` text(250) NOT NULL,
  `numero` varchar(30) NOT NULL,
  `texto` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
-- Inserir dados iniciais
INSERT INTO `piquetes` (`id`, `zona`, `nome`, `mail`, `numero`, `texto`) VALUES
(11, 'Beja', 'Joao', 'joao.faria.telemovel@gmail.com', '961234567', 'Programador'),
(12, 'Mertola', 'Ricky', 'judas@sapo.pt', '961234567', 'Programador'),
(13, 'Alcoutim', 'Morty', 'apoio_tecnico@sapo.pt', '961234567', 'Programador');


-- Tabela `ocorrencias`
CREATE TABLE IF NOT EXISTS `ocorrencias` (
	`id` int(11) NOT NULL,
    `board_id` text NOT NULL,
    `zona` text NOT NULL,
    `lat` float(20) NOT NULL,
    `lng` float(20) NOT NULL,
    `geo` text,
    `sensor1` text,
    `sensor2` text,
    `sensor3` float(10),
    `estado` int(1),
    `contacto`text,
    `reg_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
-- Inserir ocorrencias
INSERT INTO `ocorrencias` (`id`, `zona`, `board_id`, `lat`, `lng`, `geo`, `sensor1`, `sensor2`, `sensor3`, `estado`, `contacto`, `reg_time`) VALUES
(11, 'Beja', '1', '37.2223333', '-7.4612443', 'GPS', 'Botão pressionado', 'Sem queda', '4.22', '1', '111111, Ricky; 222222, Morty', '2019-12-14 16:00:00'),
(12, 'Mertola', '2', '37.2223333', '-7.4612443', 'GPS', 'Botão não pressionado', 'Queda', '4.17', '1', '444444, Darth; 333333, Vader', '2019-12-14 17:00:00');


-- Tabela `users`
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
-- Password "123"
INSERT INTO `users` (`id`, `name`, `email`, `password`, `register_date`) VALUES
(11, 'Testing', 'test@test.com', '202cb962ac59075b964b07152d234b70', '2018-02-17 18:59:42');
INSERT INTO `users` (`id`, `name`, `email`, `password`, `register_date`) VALUES
(12, 'joao', 'joao.faria@jfaria.org', '202cb962ac59075b964b07152d234b70', '2018-02-17 18:59:42');


-- Tabela `situacao`
CREATE TABLE IF NOT EXISTS `situacao` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
);
-- Inserir situacao
INSERT INTO `situacao` (`id`, `estado`) VALUES (1, 'Não Resolvido');
INSERT INTO `situacao` (`id`, `estado`) VALUES (2, 'Em Resolução');
INSERT INTO `situacao` (`id`, `estado`) VALUES (3, 'Resolvido');


-- Index `Novidades`
ALTER TABLE `novidades`
  ADD PRIMARY KEY (`id`);

-- Index `ocorrencias`
ALTER TABLE `ocorrencias`
  ADD PRIMARY KEY (`id`);

-- Index `piquetes`
ALTER TABLE `piquetes`
  ADD PRIMARY KEY (`id`);

-- Index `users`
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


-- AUTO_INCREMENT chave primaria tabela `Novidades`
ALTER TABLE `novidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;

-- AUTO_INCREMENT chave primaria tabela `ocorrencias`
ALTER TABLE `ocorrencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;

-- AUTO_INCREMENT chave primaria tabela `piquetes`
ALTER TABLE `piquetes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;

-- AUTO_INCREMENT chave primaria tabela `users`
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
