<?php 
/*======================================================================*\
|| #################################################################### ||
|| #               											          # ||
|| #              EasySchool v1.1 - School management system          # ||
|| #               											          # ||
|| # ---------------------------------------------------------------- # ||
|| #         Copyright © 2016 EasySchool. All Rights Reserved.        # ||
|| # 				    	http://www.dabach.net		     		  # ||
|| #               											          # ||
|| # ---------------- ------------------------------- --------------- # ||
|| #               											          # ||
|| #################################################################### ||
\*======================================================================*/

session_start();

if ($_GET['token'] == $_SESSION['token']) {
	
	if (isset($_SESSION ["parent"])) {
		session_destroy();
		header("Location: ../index.php") ;
		echo "<meta http-equiv='refresh' content='0; url = ../index.php' />";
	}

	if (isset($_SESSION ["parent_index"])) {
		session_destroy();
	}

	if (!isset($_SESSION ["parent"])) {
		header("Location: ../index.php") ;
		echo "<meta http-equiv='refresh' content='0; url = ../index.php' />";
	}

}

else {
	header("Location: ../index.php") ;
	echo "<meta http-equiv='refresh' content='0; url = ../index.php' />";
}



 ?>