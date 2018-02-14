<?php 

$control = $connect->query("CREATE TABLE `control` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `close_message` tinytext DEFAULT NULL,
  `close_site` int(2) DEFAULT NULL,
  `pagination` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

$control = $connect->query("INSERT INTO `control` (
`id` ,
`close_message` ,
`close_site` , 
`pagination`
) VALUES ( NULL , '', '0', '15');");


 ?>