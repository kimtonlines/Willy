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

    <title><?php echo $lang ['marks']; ?></title>

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

<br><a class="return" href="students.php" style="margin-left:20px;"><i class="glyphicon glyphicon-arrow-left"></i> <?php echo $lang ['return']; ?></a>


<?php 

if (!isset($_GET['student'])) {
  die("<br><br><div class='alert alert-danger center' style='width: 90%; margin: auto;'><p>".$lang ['Nothing_found_404']."</p></div><br><br>");
}

if (isset($_GET['student'])) {
    $student_id = htmlspecialchars($_GET['student']);
}

    
    $stmt_get_students = $connect->prepare("SELECT * FROM students_users WHERE student_index=:student_id ");
    $stmt_get_students->bindParam (':student_id' , $student_id , PDO::PARAM_STR );
    $stmt_get_students->execute();

    $stmt_get_students_row = $stmt_get_students->fetch();
     $fetch_students_name = $stmt_get_students_row ['full_name'];



 ?>
    <h1 class="h1_title"><?php echo $lang ['marks']; ?> ( <?php echo $fetch_students_name; ?> )</h1>

    <table class="table table-striped table-bordered">
      <tr class="tr-table">
        <th><?php echo $lang ['date']; ?></th>
        <th><?php echo $lang ['subject']; ?></th>
        <th><?php echo $lang ['teacher']; ?></th>
        <th><?php echo $lang ['mark']; ?></th>
        <th><?php echo $lang ['note']; ?></th>
      </tr>

<?php 

if (!isset($_GET ['page'])) {
  $page = 1 ;
}

else 
  $page = htmlspecialchars((int)$_GET['page']);



$records_at_page = 15;
$count_sql = $connect->prepare("SELECT * FROM students_marks WHERE student_id=:student_id");
$count_sql->bindParam (':student_id' , $student_id , PDO::PARAM_STR );
$count_sql->execute();
$records_count = $count_sql->rowCount();


$pages_count = (int)ceil($records_count / $records_at_page);

if (($page > $pages_count) || ($page <= 0 )) {
  die();
}

$start = ($page - 1) * $records_at_page ;
$end = $records_at_page ;


/****************************************************************
****************************************************************/
if ($records_count != 0) {

      $stmt_marks = $connect->prepare("SELECT * FROM students_marks WHERE student_id=:student_id ORDER BY id DESC LIMIT $start, $end");
    $stmt_marks->bindParam (':student_id' , $student_id , PDO::PARAM_STR );
    $stmt_marks->execute();


  while ($stmt_marks_row = $stmt_marks->fetch()) {
      $fetch_mark_date = $stmt_marks_row ['date'];
      $fetch_mark_subject = $stmt_marks_row ['subject'];
      $fetch_mark_teacher = $stmt_marks_row ['teacher_name'];
      $fetch_mark_mark = $stmt_marks_row ['mark'];
      $fetch_mark_note = $stmt_marks_row ['note'];



?>

        <tr>
          <td><?php echo $fetch_mark_date; ?></td>
          <td><?php echo $fetch_mark_subject; ?></td>
          <td><?php echo $fetch_mark_teacher; ?></td>
          <td><span class="label label-warning" style="font-size: 14px;"><?php echo $fetch_mark_mark; ?></span></td>
          <td><span class="label label-default"><?php echo $fetch_mark_note; ?></span></td>
        </tr>

<?php }} ?>  
      
  </table>

<?php 
$next = $page + 1 ;
$prev = $page - 1 ;

if ($next <= $pages_count) {
  echo '<a href="marks.php?student='.$student_id.'&page=' . $next . '" class="btn btn-default p_right">'.$lang ['next'].' <i class="glyphicon glyphicon-arrow-right"></i></a>' ;
}

if ($prev > 0) {
  echo '<a href="marks.php?student='.$student_id.'&page=' . $prev . '" class="btn btn-default p_left"><i class="glyphicon glyphicon-arrow-left"></i> '.$lang ['prev'].'</a>' ;
}
 ?>

<br><br><br>

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
