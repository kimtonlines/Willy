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

$stmt_get_info = $connect->query("SELECT * FROM parents_users WHERE parent_index='$parent_index' ");

$row_get_info = $stmt_get_info->fetch();
$my_fullname = $row_get_info ['full_name'];

 ?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.png" />

    <title><?php echo $lang ['My_children']; ?></title>

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

    
     <link rel="stylesheet" href="../css/style.css" rel="stylesheet">
     <link rel="stylesheet" href="../css/Normalize.css" rel="stylesheet">
     <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
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
    <h1 class="h1_title"><?php echo $lang ['My_children']; ?></h1>

    <table class="table table-striped table-bordered">
      <tr class="tr-table">
        <th><?php echo $lang ['student']; ?></th>
        <th><?php echo $lang ['class']; ?></th>
        <th><?php echo $lang ['teachers']; ?></th>
        <th><?php echo $lang ['transport']; ?></th>
        <th><?php echo $lang ['marks']; ?></th>
        <th><?php echo $lang ['reports']; ?></th>
      </tr>
<?php 

  $stmt_get_students = $connect->prepare("SELECT * FROM students_users WHERE parent_index='$parent_index' ORDER BY id DESC");
  $stmt_get_students->execute();



  while ($stmt_students_row = $stmt_get_students->fetch()) {
      $fetch_students_name = $stmt_students_row ['full_name'];
      $fetch_students_class = $stmt_students_row ['student_class'];
      $fetch_students_index = $stmt_students_row ['student_index'];

      $stmt_reports = $connect->prepare("SELECT * FROM reports WHERE to_parents='1' AND student_index='$fetch_students_index'");
      $stmt_reports->execute();

      $count_reports = $stmt_reports->rowCount();
     
 ?>
        <tr>
          <td><?php echo $fetch_students_name; ?></td>
          <td><?php echo $fetch_students_class; ?></td>
          <td><a href="teachers.php?student=<?php echo $fetch_students_index; ?>"><i class="fa fa-users large"></i></a></td>
          <td><a href="transport.php?student=<?php echo $fetch_students_index; ?>"><i class="fa fa-bus large"></i></a></td>
          <td><a href="marks.php?student=<?php echo $fetch_students_index; ?>"><i class="glyphicon glyphicon-education large"></i></a></td>

          <td><a href="reports.php?student=<?php echo $fetch_students_index; ?>">
            <?php 
                if ($count_reports > 0) {
                echo '<span class="label label-danger">'.$count_reports.'</span>';
                }
                else {
                  echo '<span class="label label-success"> 0 </span>';
                } 
            ?>
            </a></td>

        </tr>

<?php } ?>
        
  </table>



<br>

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
