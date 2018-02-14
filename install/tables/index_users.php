<?php 

$index_users = $connect->query("CREATE TABLE `index_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `index_num` varchar(30) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ");


 ?>