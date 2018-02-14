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


if (version_compare(PHP_VERSION, "5.0.0", "<")) {
  print "EasySchool requires PHP 5.0.0 or newer.\n";
  exit;
}

session_start(); 

function make_lang() {

		
		if (isset($_POST['fr'])) {
			$_SESSION['francais'] = true;
			unset($_SESSION['english']);
			echo "<meta http-equiv='refresh' content='0' />";
		}

		if (isset($_POST['en'])) {
			$_SESSION['english'] = true;
			unset($_SESSION['francais']);
			echo "<meta http-equiv='refresh' content='0' />";
		}
} 

function lang_path () {

	if (!isset($_SESSION['francais'])) {
		$_SESSION['english'] = true;
	}
	if (isset($_SESSION['english'])) {
		$lang = "english";
	}

	if (isset($_SESSION['francais'])) {
		$lang = "francais";
	}

	$path = "languages/".$lang.".php";

	return $path;
}

make_lang();
$language_file = lang_path();

include ($language_file);

 ?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.png" />

    <title>Easy School v1.1 install</title> 

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    
     <link rel="stylesheet" href="install.css" rel="stylesheet">
     <link rel="stylesheet" href="../fonts/fr/fonts_css.css">

     <script src="../js/jquery-1.11.3.min.js"></script>
      <link rel="stylesheet" href="../libs/validationEngine/validationEngine.jquery.css" type="text/css"/>
<script src="../libs/validationEngine/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
      </script>
      <script src="../libs/validationEngine/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
      </script>
      <script>
        jQuery(document).ready(function(){
          // binds form submission and fields to the validation engine
          jQuery("#formID").validationEngine();
        });
 
      </script>

        
  </head>
<body>

<form id="language" action="" method="post">
	<input type="submit" name="en" class="english" value="english" />
	<input type="submit" name="fr" class="francais" value="francais" />
</form>
<div class="clear"></div>

<div class="content col-md-12">

<div class="panel panel-default">
    <div class="panel-heading center">

     <h2>Easy School <span>v1.1</span> <?php echo $lang ['p0']; ?> ..</h2> 
     <img src="../images/school-management-system.png">


    </div>
    <div class="panel-body ">


<?php 


$step = htmlspecialchars(@$_GET['step']);

if ($step == "one" OR !$step) {

	include 'template/welcome.php';

}

/*---------------------------------------------------------------------------------------*/

 ?>



<?php



if ($step == "check") { ?>

<div class="clear"></div><br /><br />
<div class="col-md-10 col-md-offset-1">

	<div class="col-md-6 center">
      <a class="btn btn-default" href="index.php?step=tables"><?php echo $lang ['p3'] ?></a>
    </div>

    <div class="col-md-6 center">
      <a class="btn btn-default" href="index.php?step=config"><?php echo $lang ['p4'] ?></a>
    </div>

</div><br /><br /><br />



<?php

}

/*---------------------------------------------------------------------------------------*/

elseif ($step == "config") {

if (!function_exists('fopen') OR !function_exists('fwrite') ) {
	 $error = 1;
}

if (function_exists('chmod') ) {
	@chmod('../uploads/topics', 0777);
	@chmod('../uploads/lessons', 0777);
	@chmod('../uploads/students', 0777);
	@chmod('../uploads/teachers', 0777);
}

if (@$error == 1)  {
  echo $lang ['m1'];

	echo $lang ['m2'];
	 die();
} 


	if (isset($_POST['submit'])) {
   
	  $DB_SERVER =  htmlspecialchars($_POST['db_host']);
	  $DB_USER =  htmlspecialchars($_POST['db_user']);
	  $DB_PASS = htmlspecialchars($_POST['db_pass']);
	  $DB_DATABASE = htmlspecialchars($_POST['db_name']);


		$fh = fopen('../includes/database_config.php', 'w');


		if ($fh) {
			$s = "<?php \n" 
				  . "\t/** \n" 
				  . "\tConfiguration\n"
				  . "\tfill those varaibles with your data\n"
				  . "\t*/\n"

				  . " \n" 
				  . "\t \$DB_SERVER = \"$DB_SERVER\"; \n"
				  . "\t \$DB_USER = \"$DB_USER\"; \n"
				  . "\t \$DB_PASS = \"$DB_PASS\"; \n"
				  . "\t \$DB_DATABASE = \"$DB_DATABASE\"; \n"
				  . " \n"

				  . "\t try { \n"
				  . "\t \$connect =  new PDO(\"mysql:host=\$DB_SERVER; dbname=\$DB_DATABASE\", \$DB_USER,\$DB_PASS); \n"
				  . "\t } \n"
				  . " \n"

				  . "\t catch (PDOException \$e) { \n"
				  . "\t die(\"Database Error..!\") ; \n"
				  . "\t } \n"
				  . " \n"

				  . "\t \$connect->query(\"set charcter_set_server = 'utf8'\"); \n"
				  . "\t \$connect->query(\"set names'utf8' \"); \n"
				  . " \n"
				  
				  . "?>";
			fwrite($fh, $s);
			fclose($fh);
			
		}
		
		die('<br /><div class="col-md-6 col-md-offset-3"><a href="index.php?step=tables" class="btn btn-default btn-block">'.$lang ['p23'].' &gt;&gt; </a></div><br /><br /><br />');
	
	}

	?>


	<h3 class="h3"><?php echo $lang ['p5'] ?> :</h3>
	<span class="help-block"><?php echo $lang ['p6'] ?></span> 
	<hr>
<div class="col-md-6 col-md-offset-3">

	<form id="formID" method="post" action="">

        
        <label><?php echo $lang ['p7'] ?> :</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
            <input name="db_host" type="text" placeholder="" class="form-control" value="localhost"/>
        </div><br>

        <label><?php echo $lang ['p8'] ?> :</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="db_user" type="text" placeholder="" class="form-control" value=""/>
        </div><br>

        <label><?php echo $lang ['p9'] ?> :</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input name="db_pass" type="text" placeholder="" class="form-control" value=""/>
        </div><br>

        <label><?php echo $lang ['p10'] ?> :</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></span>
            <input name="db_name" type="text" placeholder="" class="form-control" value=""/>
        </div><br>


        <div class="clear"></div>
              
        <button type="submit" name="submit" class="btn btn-info btn-block"><?php echo $lang ['p11'] ?></button> 

        <br><br>

    </form>
</div>

<?php

}

/*--------------------------------------------------------------------------------------------------------------*/


elseif ($step == "tables") {

$filename = '../includes/database_config.php';

if (!file_exists($filename)) {
   die('install error.. database_config.php not exists!');
} 

else {
    require '../includes/database_config.php';
}



echo '<h3 class="h3">'. $lang ['p12'] .' :</h3>

<hr>

<div class="alert alert-success col-md-10 col-md-offset-1">';

	include 'tables/students_users.php';
	include 'tables/teachers_users.php';
	include 'tables/parents_users.php';
	include 'tables/classes.php';
	include 'tables/subjects.php';
	include 'tables/transport.php';
	include 'tables/absences.php';
	include 'tables/administrator.php';
	include 'tables/control.php';
	include 'tables/exam.php';
	include 'tables/index_users.php';
	include 'tables/lessons.php';
	include 'tables/messages.php';
	include 'tables/reports.php';
	include 'tables/reset_pass.php';
	include 'tables/students_marks.php';
	include 'tables/topics.php';
	include 'tables/users_messages.php';
  include 'tables/comments.php';
  
	echo '<p>&gt; tables des étudiants.. </p>';
	echo '<p>&gt; tables des professeurs.. </p>';
	echo '<p>&gt; tables des parents.. </p>';
	echo '<p>&gt; tables des classes.. </p>';
	echo '<p>&gt; tables des matières.. </p>';
	echo '<p> ... </p>';
	echo '<p> ... </p>';
	echo '<p><i class="glyphicon glyphicon-ok"></i> '.$lang ['p13'].'.</p>';

echo '</div>
<div class="clear"></div>
<hr>
<a class="btn btn-info right" href="index.php?step=three"><i class="glyphicon glyphicon-user"></i> '.$lang ['p14'].'</a>';

}

elseif ($step == "three") { 

$filename = '../includes/database_config.php';

if (!file_exists($filename)) {
   die('install error.. database_config.php not exists!');
} 
else {
    require '../includes/database_config.php';
}



	$stmt = $connect->query("SELECT * FROM administrator");
	if ($stmt->rowCount() == 1 ) {
  		die("<div class='alert alert-danger center' style='width: 90%; margin: auto;'><br><p>install error</p><br></div>");

	}


$random = mt_rand(1,1000000); 
$random2 = $random * 88888;
$admin_index = substr(($random2 ),0,16 );

?>

	<h3 class="h3"><?php echo $lang ['p15'] ?> :</h3> <hr>


<div class="col-md-12">
	<form id="formID" method="post" action="">

<?php


if (isset($_POST['submit'])) {
   
  $username = htmlspecialchars($_POST['username']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars(md5($_POST['password']));


	$stmt = $connect->prepare("INSERT INTO `administrator` (`admin_index`, `username`, `password`, `email`) VALUES ('$admin_index', :username, :password, :email)");
  	$stmt->bindParam (':username' , $username , PDO::PARAM_STR );
  	$stmt->bindParam (':email' , $email , PDO::PARAM_STR );
  	$stmt->bindParam (':password' , $password , PDO::PARAM_STR );
 	 $stmt->execute();

 	$stmt = $connect->query("INSERT INTO `index_users` (`index_num`, `full_name`, `type`) VALUES ('$admin_index', 'administrator', 'administrator')");

    if (isset($stmt)) {
	    die($lang ['m3']);
	  }

$connect = null;

}


?>
		

        <label><?php echo $lang ['p19'] ?> :</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="username" type="text" placeholder="" class="form-control validate[required]" value=""/>
        </div><br>

        <label><?php echo $lang ['p20'] ?> :</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input name="password" type="password" id="password" class="form-control validate[required]" value=""/>
        </div><br>

        <label><?php echo $lang ['p21'] ?> :</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input name="password2" type="password" placeholder="" class="form-control validate[required,equals[password]]" value=""/>
        </div><br>

        <label><?php echo $lang ['p22'] ?> :</label>
              <div class="input-group">
                 <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input name="email" type="text" placeholder="" class="form-control validate[required,custom[email]]" value=""/>
        </div><br>

        <div class="clear"></div>
              
        <button type="submit" name="submit" class="btn btn-info btn-block"><?php echo $lang ['p11'] ?></button> 

        <br><br>

    </form>
</div>
<?php

}

?>    	

 
    </div>

</div>





</div>		
                           
<p class="center ltr">Copyright &copy; <?php date_default_timezone_set('UTC');
 echo date("Y"); ?> | EasySchool v1.1 - School management system <br> <a href="http://www.dabach.net"><img src="../images/dabach.png" width="120px" /></a></p>
<br>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>



  </body>
</html>

