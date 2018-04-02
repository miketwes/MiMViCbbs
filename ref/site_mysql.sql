SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `ico` int(11) NOT NULL DEFAULT '0',
  `top` int(11) NOT NULL DEFAULT '0',
  `good` int(11) NOT NULL DEFAULT '0',
  `vg` int(11) NOT NULL DEFAULT '0',
  `vb` int(11) NOT NULL DEFAULT '0',
  `view` int(11) DEFAULT NULL,
  `reply` int(11) DEFAULT NULL,
  `topic` text,
  `name` text,
  `lasttime` text,
  `lastname` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `name` text,
  `content` text,
  `time` text,
  `img` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` text,
  `password` text,
  `email` text,
  `time` int(11) DEFAULT NULL,
  `avatar` text,
  `ip` text,
  `act` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `pageview`;
CREATE TABLE IF NOT EXISTS `pageview` (
  `ip` text,
  `page` text,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `visitors`;
CREATE TABLE IF NOT EXISTS `visitors` (
  `ip_address` text,
  `browsername` text,
  `urlfrom` text,
  `date_and_time` int(11) DEFAULT NULL,
  `page` text,
  `link` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
