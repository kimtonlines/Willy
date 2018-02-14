<?php 

$reports = $connect->query("CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_index` varchar(20) DEFAULT NULL,
  `to_parents` int(2) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `report` mediumtext DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `read_report` int(2) DEFAULT NULL,
  `hide_report` int(2) DEFAULT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");



 ?>