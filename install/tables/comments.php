<?php 


$comments = $connect->query("CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text,
  `type` varchar(50) DEFAULT NULL,
  `author` varchar(200) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `comment_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");


$comments_lessons = $connect->query("CREATE TABLE `comments_lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text,
  `type` varchar(50) DEFAULT NULL,
  `author` varchar(250) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `comment_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");



 ?>