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


if (!isset($_SESSION ['student']) && !isset($_SESSION ['student_index']) ) {
  header("location: ../index.php");
  exit();
}

if (isset($_SESSION ['student_index'])) {
  $my_student_index = $_SESSION ['student_index'];
}

require '../includes/database_config.php';
include '../includes/display_errors.php';
include '../includes/make_lang.php';

$stmt_get_my_class = $connect->query("SELECT * FROM students_users WHERE student_index='$my_student_index' ");
$row_get_my_class = $stmt_get_my_class->fetch();
$my_class = $row_get_my_class ['student_class'];


 ?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.png" />

    <title><?php echo $lang ['lessons']; ?></title>

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


<div class="container content" style="margin-top:130px;">

<br><a class="return" href="index.php" style="margin-left:20px;"><i class="glyphicon glyphicon-arrow-left"></i> <?php echo $lang ['return']; ?></a>

<div class="clear"></div>

    <h1 class="h1_title"><?php echo $lang ['lessons']; ?> [ <?php echo $my_class; ?> ]</h1>
    <hr>

<?php  

if (!isset($_GET ['page'])) {
  $page = 1 ;
}

else 
  $page = (int)$_GET['page'];



$stmt_get = $connect->query("SELECT * FROM control");
$row = $stmt_get->fetch();

$records_at_page = $row ['pagination'];
$count_sql = $connect->query ("SELECT * FROM lessons WHERE class='$my_class'");
$records_count = $count_sql->rowCount();


$pages_count = (int)ceil($records_count / $records_at_page);

if (($page > $pages_count) || ($page <= 0 )) {
  die('<br><br><br><div class="alert alert-info center" style="width: 90%; margin: auto"><p>'.$lang ['No_lessons_found'].'</p></div><br><br><br>') ;
}

$start = ($page - 1) * $records_at_page ;
$end = $records_at_page ;




/*****************************************************************/

if ($records_count != 0) {


  $stmt_lessons = $connect->prepare("SELECT * FROM lessons WHERE class='$my_class' ORDER BY lesson_id DESC LIMIT $start, $end");
  $stmt_lessons->execute();

  while ($stmt_lessons_row = $stmt_lessons->fetch()) {
      $fetch_lesson_id = $stmt_lessons_row ['lesson_id'];
      $fetch_lesson_title = $stmt_lessons_row ['title'];
      $fetch_lesson_content = $stmt_lessons_row ['lesson'];
      $fetch_lesson_author = $stmt_lessons_row ['author'];
      $fetch_lesson_subject = $stmt_lessons_row ['subject'];
      $fetch_lesson_date = $stmt_lessons_row ['date'];
?>
         <div class="single">

                <div class="single_header">

                  <h2><a href="lesson.php?id=<?php echo $fetch_lesson_id; ?>"><?php echo $fetch_lesson_title; ?></a></h2>  

                  <span><i class="glyphicon glyphicon-book"></i> <?php echo $fetch_lesson_subject; ?></span>
                  <span><i class="glyphicon glyphicon-user"></i> <?php echo $fetch_lesson_author; ?></span>
                  <span><i class="glyphicon glyphicon-time"></i> <?php echo $fetch_lesson_date; ?></span>

                </div>

                <div class="clear"></div>
                 <br>
                <div class="row">

                  <div class="col-md-12">
                    <p class="p_substr" style="padding : 5px;"><?php echo substr(strip_tags($fetch_lesson_content), 0, 400); ?>  </p>
                  </div>
                </div>

                <div class="clear"></div> 

          </div>  

<?php } 

}?>

<br>
<div class="container">
<?php 
$next = $page + 1 ;
$prev = $page - 1 ;

if ($next <= $pages_count) {
  echo '<a href="lessons.php?page=' . $next . '" class="btn btn-default p_right">'.$lang ['next'].' <i class="glyphicon glyphicon-arrow-right"></i></a>' ;
}

if ($prev > 0) {
  echo '<a href="lessons.php?page=' . $prev . '" class="btn btn-default p_left"><i class="glyphicon glyphicon-arrow-left"></i> '.$lang ['prev'].'</a>' ;
}
 ?>
</div>
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
