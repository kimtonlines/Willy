<?php 

$messages = $connect->query("CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_from` varchar(30) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");


 ?>