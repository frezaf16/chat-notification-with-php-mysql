-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 24 Des 2016 pada 15.30
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `al_blog_demo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `al_chat`
--

CREATE TABLE IF NOT EXISTS `al_chat` (
  `chat_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_nama` varchar(50) NOT NULL,
  `chat_pesan` text NOT NULL,
  `chat_waktu` datetime NOT NULL,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `al_chat` (`chat_id`, `chat_nama`, `chat_pesan`, `chat_waktu`) VALUES
(1, 'Faisal Reza Fahlevi', 'Ini tutorial sederhana cara membuat chat sederhana', '2016-12-27 16:23'),
(2, 'Coding-Arena.id', 'Silahkan dicoba aja dulu', '2016-12-27 16:23');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
