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

require_once 'includes/database_config.php';
include 'includes/display_errors.php';
/*------------------------------------ MODE SITE -----------------------------------*/

$stmt = $connect->query("SELECT close_site from control");

$row = $stmt->fetch();
$mode = $row ['close_site'];


if ($mode == 0) {
   header("location: index.php") ;
   die();
}

/*------------------------------------------------------------------------------------*/

function make_lang() {

    if (isset($_POST['ar'])) {
      $_SESSION['arabic'] = true;
      unset($_SESSION['francais']);
    }
    if (isset($_POST['fr'])) {
      $_SESSION['francais'] = true;
      unset($_SESSION['arabic']);
    }
} 

function lang_path () {

  if (!isset($_SESSION['francais'])) {
    $_SESSION['arabic'] = true;
  }

  if (isset($_SESSION['arabic'])) {
    $lang = "arabic";
  }
  if (isset($_SESSION['francais'])) {
    $lang = "francais";
  }

  $path = "includes/languages/".$lang.".php";

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

    <title><?php echo $lang ['Site_Closed']; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    
     <link href="css/style.css" rel="stylesheet">
      <link href="css/Normalize.css" rel="stylesheet">

     <?php 
     if (isset($_SESSION['arabic'])) {
      echo '<link rel="stylesheet" href="css/rtl_fix.css" rel="stylesheet">
      <link href="css/bootstrap-rtl.min.css" rel="stylesheet">
      <link rel="stylesheet" href="fonts/ar/droid.css">';
      }

      if (isset($_SESSION['francais']) OR isset($_SESSION['english'])) {
      echo '<link rel="stylesheet" href="fonts/fr/fonts_css.css">';
      }

      ?>
        
      <script src="js/jquery-1.11.3.min.js"></script>

  </head>

  <body>

<div class="navbar navbar-default">
<div class="container">  
  <form id="language" action="" method="post">
    <input type="submit" name="fr" class="francais" value="francais" />
    <input type="submit" name="ar" class="arabic" value="arabic" />
  </form> 
</div>
</div>

<div class="container col-md-8 col-md-offset-2" style="margin-top: 100px;">

<?php 
$stmt_get = $connect->query("SELECT * FROM control");
$row = $stmt_get->fetch();
 ?>
  <div class='alert alert-info center'>
    <br><i class="glyphicon glyphicon-hourglass" style="font-size: 32px;"></i>
    <h2><?php echo $lang ['Site_Closed']; ?></h2>
    <p><?php echo $row ['close_message'] ?></p>
  </div>


</div>
	
                           

<?php 
// close connection
$connect = null;
 ?>

 

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>



  </body>
</html>