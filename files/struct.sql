-- phpMyAdmin SQL Dump
-- version 3.1.2deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Set 07, 2009 as 01:05 PM
-- Versão do Servidor: 5.0.75
-- Versão do PHP: 5.2.6-3ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Extraindo dados da tabela `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `codpermission` bigint(20) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `permission` text,
  PRIMARY KEY  (`codpermission`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


INSERT INTO `permission` (`codpermission`, `name`, `permission`) VALUES
(1, 'admin', '|user.php|user-view.php|user-edit.php|user-del.php|user-add.php|permission.php|permission-view.php|permission-edit.php|permission-del.php|permission-add.php|login.php|index.php|about.php'),
(2, 'operator', '|login.php|index.php|about.php');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `coduser` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `login` varchar(20) default NULL,
  `password` varchar(20) default NULL,
  `status` int(11) default NULL,
  `codpermission` bigint(20) NOT NULL,
  PRIMARY KEY  (`coduser`,`codpermission`),
  KEY `fk_user_permission1` (`codpermission`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`coduser`, `name`, `email`, `login`, `password`, `status`, `codpermission`) VALUES
(1, 'Administrator', 'admin@admin.com', 'admin', '123', 1, 1),
(2, 'Alexandre Cavedon', 'alexandre.cavedon@gmail.com', 'alexandre', '123', 1, 2);


-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE IF NOT EXISTS `log` (
	  `date` varchar(255) NOT NULL,
	  `user_coduser` varchar(255) NOT NULL,
	  `module` varchar(255) NOT NULL,
	  `userAction` varchar(255) NOT NULL,
	  `data` varchar(255) NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Restrições para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_permission1` FOREIGN KEY (`codpermission`) REFERENCES `permission` (`codpermission`) ON DELETE NO ACTION ON UPDATE NO ACTION;


--------------------------------------------
/*
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `navigation`;
CREATE TABLE `navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
*/
--------------------------------------------
