<?php 

$subjects = $connect->query("CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(50) DEFAULT NULL,
  `subject_teacher` varchar(50) DEFAULT NULL,
  `subject_class` varchar(50) DEFAULT NULL,
  `subject_note` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");



 ?>