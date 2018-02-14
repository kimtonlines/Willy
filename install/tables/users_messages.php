<?php 

$users_messages = $connect->query("CREATE TABLE `users_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_index` varchar(30) DEFAULT NULL,
  `author_name` varchar(50) DEFAULT NULL,
  `to_index` varchar(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `msg_read` int(2) DEFAULT NULL,
  `hide_msg` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

 ?>