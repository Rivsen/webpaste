--
-- Table structure for table `paste`
--

DROP TABLE IF EXISTS `paste`;
CREATE TABLE `paste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` varchar(200) NOT NULL DEFAULT 'text',
  `code` longtext NOT NULL,
  `publish` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
