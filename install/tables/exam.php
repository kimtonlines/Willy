<?php 

$exam = $connect->query("CREATE TABLE `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(50) DEFAULT NULL,
  `teacher_name` varchar(50) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");


 ?>