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

if (!isset($_SESSION ['parent']) && !isset($_SESSION ['parent_index']) ) {
  header("location: ../index.php");
  exit();
}


if (isset($_SESSION ['parent_index'])) {
  $parent_index = $_SESSION ['parent_index'];
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

    <title><?php echo $lang ['reports']; ?></title>

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

<br><a class="return" href="students.php"><i class="glyphicon glyphicon-arrow-left"></i> <?php echo $lang ['return']; ?></a>

<?php 

if (!isset($_GET['student'])) {
    die("<br><br><div class='alert alert-danger center' style='width: 90%; margin: auto;'><p>".$lang ['non_autorise']."</p></div><br><br>");
}

if (isset($_GET['student'])) {
    $student_id = $_GET['student'];


    $stmt_reports = $connect->prepare("SELECT * FROM reports WHERE to_parents='1' AND student_index=:student_index");
    $stmt_reports->bindParam (':student_index' , $student_id , PDO::PARAM_STR );
    $stmt_reports->execute();

    if ($stmt_reports->rowCount() == 0) {
      die("<br><br><div class='alert alert-info center' style='width: 90%; margin: auto;'><p>".$lang ['no_reports']."</p></div><br><br>");
    }

?>

    <h1 class="h1_title"><?php echo $lang ['reports']; ?></h1>

<hr> 


    <table class="table table-striped table-bordered">
      <tr class="tr-table">
        <th><?php echo $lang ['student']; ?></th>
        <th><?php echo $lang ['from']; ?></th>
        <th><?php echo $lang ['title']; ?></th>
        <th><?php echo $lang ['report']; ?></th>
        <th><?php echo $lang ['date']; ?></th>
      </tr>

<?php 


  while ($stmt_reports_row = $stmt_reports->fetch()) {
      $fetch_reports_id = $stmt_reports_row ['report_id'];
      $fetch_reports_teacher = $stmt_reports_row ['author'];
      $fetch_reports_student = $stmt_reports_row ['student_index'];
      $fetch_reports_title = $stmt_reports_row ['title'];
      $fetch_reports_report = htmlspecialchars_decode ($stmt_reports_row ['report']);
      $fetch_reports_date = $stmt_reports_row ['date'];

      $stmt_student_name = $connect->query("SELECT * FROM students_users WHERE student_index='$fetch_reports_student'");
      $stmt_student_name_row = $stmt_student_name->fetch();
      $fetch_reports_student_name = $stmt_student_name_row ['full_name'];

?>

        <tr>
          <td><span class="label label-default"><?php echo $fetch_reports_student_name; ?></span></td>
          <td><span class="label label-success"><?php echo $fetch_reports_teacher; ?></span></td>
          <td><?php echo $fetch_reports_title; ?></td>
          <td><?php echo strip_tags($fetch_reports_report); ?></td>
          <td><?php echo $fetch_reports_date; ?></td>
        </tr>

 <?php } ?>     
  </table>

 <?php } ?> 

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
