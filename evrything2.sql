-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Juin 2014 à 12:14
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `evrything2`
--
CREATE DATABASE IF NOT EXISTS `evrything2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `evrything2`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taille` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auteur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `publication` tinyint(1) NOT NULL,
  `nbCommentaire` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `blog` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tags` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `blog`
--

INSERT INTO `blog` (`id`, `title`, `author`, `blog`, `image`, `tags`, `created`, `updated`) VALUES
(1, 'test', 'theo', 'What about this blog', 'xxx/yyy/zzz.jpg', 'Info', '0000-00-00 00:00:00', '2014-05-29 14:59:47'),
(3, 'Encore un test!', 'moi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tellus mauris, ullamcorper ac turpis ac, tempor congue lorem. Suspendisse odio erat, hendrerit et auctor in, pharetra sit amet erat. Praesent imperdiet leo in odio sagittis, rutrum sollicitudin tortor porttitor. Quisque ac metus sodales, sagittis diam eget, bibendum ante. Praesent volutpat nisl nisi, eu ullamcorper neque eleifend vel. Pellentesque eleifend iaculis lacus sed malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque ullamcorper faucibus aliquet. Nam id elit mollis, ullamcorper nunc sed, porttitor augue. Sed non vestibulum mauris, non consectetur est. Aliquam faucibus porttitor urna at commodo. Vestibulum pulvinar, dolor non sodales dignissim, quam risus scelerisque libero, sed ultrices erat odio et neque. Proin eu tincidunt dolor, id dictum ante. Yee Ha !!!', 'bundles/yop', 'Event', '2014-05-26 22:12:51', '2014-05-26 22:12:51'),
(4, 'Test 4', 'theo', 'Encore un n-ième test sur l''ajout de d''article', 'Nevermind', 'Event', '2014-05-29 11:22:26', '2014-05-29 13:21:40'),
(5, 'Test 5', 'theo', 'Encore un n-ième test sur l''ajout de d''article', 'Nevermind', 'Event', '2014-05-29 11:31:59', '2014-05-29 11:31:59'),
(7, 'Youhou', 'damien', 'aqzsedrftg', 'qwerty', 'Event', '2014-05-30 12:48:41', '2014-05-30 12:48:41'),
(8, 'Test', 'theo', 'ceci est un test', '', '1', '2014-06-05 11:46:12', '2014-06-05 11:46:12'),
(9, 'Test2', 'theo', 'ceci est un test', '', 'evenement', '2014-06-05 11:47:28', '2014-06-05 11:47:28'),
(10, 'Test2', 'theo', 'ceci est un test', '', 'article', '2014-06-05 12:00:32', '2014-06-05 12:00:32');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `auteur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E16CE76B7294869C` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1, 'theo', 'theo', 'theodore.corbeaux@gmail.com', 'theodore.corbeaux@gmail.com', 1, 'qf7utulfxbkss4cokgcko00o04wwc4o', 'QGHSN4YzrynwAZiR0ej7+BK4XTnzOBxnjOSFZeNw+3V6y8h7HdvShXkmsGaKF73pc4MzDh/bZKIs6s1CzevcbA==', '2014-06-05 11:45:43', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL),
(2, 'damien', 'damien', 'damien.bodilis@gmail.com', 'damien.bodilis@gmail.com', 1, 'iz3pjslg9lc8gkkwwcc0wowsgwokok', 'O+ZKVz7Ruuo4SyiSUlp+S+kooLbSSZ12JTl6t4hFJKL+SHFB0LkvdNerXWYDNiOF2lLLU+iXvzJ4p4VmEVmeCg==', '2014-05-30 12:47:44', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_E16CE76B7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
