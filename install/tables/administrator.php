<?php 

$administrator = $connect->query("CREATE TABLE `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_index` varchar(30) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");



 ?>