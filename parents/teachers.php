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

    <title><?php echo $lang ['teachers']; ?></title>

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


<?php 

if (!isset($_GET['student'])) {
  $stmt_get_student = $connect->query("SELECT * FROM students_users WHERE parent_index='$parent_index' ");

  
    echo '<h1 class="h1_title">'.$lang ['teachers'].'</h1>

    <table class="table table-striped table-bordered">
      <tr class="tr-table">
        <th>kids</th>
        <th>teachers</th>
      </tr>';

while ($stmt_students_row = $stmt_get_student->fetch()) {

      $fetch_students_name = $stmt_students_row ['full_name'];
      $fetch_students_index = $stmt_students_row ['student_index'];
        echo '<tr>
          <td>'.$fetch_students_name.'</td>
          <td><a href="teachers.php?student='.$fetch_students_index.'"><i class="fa fa-users large" style="font-size: 28px; color: #c55;"></i></a></td>
        </tr>';
  }

  echo '</table>';
}

if (isset($_GET['student'])) {

    $student_id = $_GET['student'];
 
    $stmt_get_students = $connect->prepare("SELECT * FROM students_users WHERE student_index=:student_id ");
    $stmt_get_students->bindParam (':student_id' , $student_id , PDO::PARAM_STR );
    $stmt_get_students->execute();

    $stmt_get_students_row = $stmt_get_students->fetch();
     $fetch_students_name = $stmt_get_students_row ['full_name'];
     $fetch_students_class = $stmt_get_students_row ['student_class'];


?>


    <h1 class="h1_title"><?php echo $lang ['teachers']; ?> (<?php echo $fetch_students_name; ?>)</h1>

    <table class="table table-striped table-bordered">
      <tr class="tr-table">
        <th><?php echo $lang ['teacher']; ?></th>
        <th><?php echo $lang ['contact']; ?></th>
      </tr>

<?php 

  $stmt_teachers = $connect->prepare("SELECT DISTINCT subject_teacher FROM subjects WHERE subject_class='$fetch_students_class'");
  $stmt_teachers->execute();

  while ($teachers_row = $stmt_teachers->fetch()) {
      $fetch_teacher_subject = $teachers_row ['subject_teacher'];

      $stmt_get_teacher = $connect->query("SELECT * FROM teachers_users WHERE full_name='$fetch_teacher_subject'");
       $get_teacher_row = $stmt_get_teacher->fetch();
       $fetch_teachers_index = $get_teacher_row ['teacher_index'];

?>

        <tr>
          <td><?php echo  $fetch_teacher_subject ; ?></td>
          <td><a href="contact.php?id=<?php echo  $fetch_teachers_index; ?>"><i class="glyphicon glyphicon-envelope large"></i></a></td>
        </tr>

<?php } ?>


  </table>

<?php } ?>

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
