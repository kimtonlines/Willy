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

    <title><?php echo $lang ['exams']; ?></title>

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

<br><a class="return" href="index.php" style="margin-left:20px;"><i class="glyphicon glyphicon-arrow-left"></i> <?php echo $lang ['return']; ?></a>

    <h1 class="h1_title"><?php echo $lang ['exams']; ?></h1>
    <hr>

    <table class="table table-striped table-bordered">
      <tr class="tr-table2">
        <th><?php echo $lang ['student']; ?></th>
        <th><?php echo $lang ['subject']; ?></th>
        <th><?php echo $lang ['date']; ?></th>  
        <th><?php echo $lang ['time']; ?></th>
      </tr>


<?php 

  $stmt_get_students = $connect->prepare("SELECT * FROM students_users WHERE parent_index='$parent_index'");
  $stmt_get_students->execute();

  while ($row_students = $stmt_get_students->fetch()) {
      $fetch_student_name = $row_students ['full_name'];
      $fetch_student_class = $row_students ['student_class'];

      $stmt_exams = $connect->prepare("SELECT * FROM exam WHERE class='$fetch_student_class' ORDER BY id DESC");
      $stmt_exams->execute();

      while ($stmt_exam_row = $stmt_exams->fetch()) {
        $fetch_exam_subject = $stmt_exam_row ['subject'];
        $fetch_exam_date = $stmt_exam_row ['date'];
        $fetch_exam_time = $stmt_exam_row ['time'];
  
?>
        <tr>
          <td><?php  echo $fetch_student_name; ?></td>
          <td><span class="label label-success" style="font-size: 14px;"><?php  echo $fetch_exam_subject; ?></span></td> 
          <td><span class="label label-danger" style="font-size: 14px;"><?php  echo $fetch_exam_date; ?></span></td>  
          <td><span class="label label-primary" style="font-size: 14px;"><?php  echo $fetch_exam_time; ?></span></td>
        </tr>

<?php } } ?>
      
  </table>


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
