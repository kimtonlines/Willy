<?php 

$lessons = $connect->query("CREATE TABLE `lessons` (
  `lesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `lesson` text DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `class` varchar(30) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `jointes` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`lesson_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");



 ?>