<?php 

$students_users = $connect->query("CREATE TABLE `students_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(250) DEFAULT NULL,
  `registration_num` int(10) DEFAULT NULL,
  `parent_index` varchar(50) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `student_index` varchar(50) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `birthday` varchar(10) DEFAULT NULL,
  `student_class` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");



 ?>