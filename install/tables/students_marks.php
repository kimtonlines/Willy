<?php 

$students_marks = $connect->query("CREATE TABLE `students_marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `teacher_name` varchar(50) DEFAULT NULL,
  `mark` varchar(50) DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");



 ?>