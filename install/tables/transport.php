<?php 

$transport = $connect->query("CREATE TABLE `transport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(20) DEFAULT NULL,
  `time_start_e` varchar(30) DEFAULT NULL,
  `time_return_e` varchar(30) DEFAULT NULL,
  `class_name` varchar(50) DEFAULT NULL,
  `time_start_m` varchar(20) DEFAULT NULL,
  `time_return_m` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");



 ?>