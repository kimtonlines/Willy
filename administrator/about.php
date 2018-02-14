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

if (!isset($_SESSION ['administrator']) && !isset($_SESSION ['admin_index'])) {
  header("location: login.php") ;
}

if (isset($_SESSION ['admin_index'])) {
  $admin_index = $_SESSION ['admin_index'];
}

require '../includes/database_config.php';
include '../includes/display_errors.php';
include '../includes/make_lang.php';

 ?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.png" />

    <title><?php echo $lang ['about_us']; ?></title>

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

    
     <link href="../css/style.css" rel="stylesheet">
      <link href="../css/Normalize.css" rel="stylesheet">
     <?php 
     if (isset($_SESSION['arabic'])) {
      echo '<link rel="stylesheet" href="../css/rtl_fix.css" rel="stylesheet">
      <link href="../css/bootstrap-rtl.min.css" rel="stylesheet">
      <link rel="stylesheet" href="../fonts/ar/droid.css">';
      }

      if (isset($_SESSION['francais']) OR isset($_SESSION['english'])) {
      echo '<link rel="stylesheet" href="../fonts/fr/fonts_css.css">';
      }

      ?>

      <script src="../js/jquery-1.11.3.min.js"></script>
        
  </head>
<body>

<?php include 'nav.php'; ?> 

<div class="container mainbg">

<br><a class="return" href="index.php"><i class="glyphicon glyphicon-arrow-left"></i> <?php echo $lang ['return']; ?></a>

    <h1 class="h1_title"><?php echo $lang ['about_us']; ?></h1>

<hr> 

<div class="easyschool">
  <img src="../images/school-management-system.png" />
</div>


<div class="clear"></div>

<?php if (isset($_SESSION['arabic'])) { ?>

<p class="about_p">EasySchool هو نظام لادارة المؤسسات التعليمية يتميز بعدة خصائص وبساطة وسهولة استعماله، يتيح للمدرسة أن تتحول من الشكل التقليدي الورقي إلى الشكل الإلكتروني عبر شبكة الإنترنت و إمكانية التواصل بين العناصر الأربعة "الادارة-الاستاذة-التلاميذ-وأولياء الأمور" من أي مكان وفي أي وقت.. </p>
<br>
<?php } ?>


<?php if (isset($_SESSION['francais'])) { ?>

<p class="about_p">EasySchool est un système pour la gestion des établissements scolaire, caractérise par la simplicité et la facilité d'utilisation, Il permet à l'école de passer de la forme de papier traditionnel à la forme électronique via Internet et la possibilité de communication entre les quatre éléments "administration-professeurs-étudiants-parents" de partout, à tout moment.. </p>
<br>
<?php } ?>

<?php if (isset($_SESSION['english'])) { ?>

<p class="about_p">EasySchool Is a system for the management of Schools, characterized by a number of properties and the simplicity and ease of use, it allows the school to move from the traditional paper form to electronic form via the Internet and the possibility of communication between the four "administration-professor-elements pupils-and parents" from anywhere and at any time.. </p>
<br>
<?php } ?>


<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

    <!-- Identify your business so that you can collect the payments. -->
    <input type="hidden" name="business"
        value="pyosc.service@gmail.com">

    <!-- Specify a Donate button. -->
    <input type="hidden" name="cmd" value="_donations">

    <!-- Specify details about the contribution -->
    <input type="hidden" name="item_name" value="Donations make a real difference">
    <input type="hidden" name="item_number" value="DABACH NET">
    <input type="hidden" name="currency_code" value="USD">

    <!-- Display the payment button. -->
    <input type="image" name="submit"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
    alt="Donate">
    <img alt="" width="1" height="1"
    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>

<br>

<?php if (isset($_SESSION['arabic'])) { ?>
<p>استعمل في برمجة هذا النظام : <br>
<?php } ?>

<?php if (isset($_SESSION['francais']) OR isset($_SESSION['english'])) { ?>
<p>This script uses : <br>
<?php } ?>



- Bootstrap v3  <br>
- jQuery <br>
- Font Awesome <br>
- jQuery.validationEngine <br>
- CLEditor WYSIWYG HTML Editor<br>
- datePicker <br>
- phpMailer <br>
</p>


<?php if (isset($_SESSION['arabic'])) { ?>
<p>و الأيقونات من : <br>
<?php } ?>


<?php if (isset($_SESSION['francais']) OR isset($_SESSION['english'])) { ?>
<p>icons selected by : <br>
<?php } ?>

- <a href="http://www.pixelmixer.ru">http://www.pixelmixer.ru</a><br>
- <a href="http://www.iconfinder.net">http://www.iconfinder.net</a><br>
- <a href="http://www.freepik.com">http://www.freepik.com</a><br>
- <a href="http://www.dz-soft.net">http://www.dz-soft.net</a><br>
</p>



<hr>

<p class="center ltr">Copyright &copy; <?php echo date("Y"); ?> | EasySchool v1.1 - School management system <br> <a href="http://www.dabach.net"><img src="../images/dabach.png" width="120px" /></a></p>

</div>		
                           
 <?php include 'footer.php'; ?>             

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>



  </body>
</html>
