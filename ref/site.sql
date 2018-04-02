BEGIN TRANSACTION;
DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id` INTEGER PRIMARY KEY   AUTOINCREMENT,
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
  `lastname` text
);
DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `name` text,
  `content` text,
  `time` text,
  `img` text
);
DROP TABLE IF EXISTS `pageview`;
CREATE TABLE IF NOT EXISTS `pageview` (
  `ip` text,
  `page` text,
  `time` int(11) DEFAULT NULL
);
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` text,
  `password` text,
  `email` text,
  `time` int(11) DEFAULT NULL,
  `avatar` text,
  `ip` text,
  `act` text
); 
DROP TABLE IF EXISTS `visitors`;
CREATE TABLE IF NOT EXISTS `visitors` (
  `ip_address` text,
  `browsername` text,
  `urlfrom` text,
  `date_and_time` int(11) DEFAULT NULL,
  `page` text,
  `link` text
);
COMMIT; 
