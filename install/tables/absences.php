<?php 

$absences = $connect->query("CREATE TABLE `absences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `reason` varchar(50) DEFAULT NULL,
  `note` mediumtext DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");



 ?>