
<h3 class="h3"><?php echo $lang ['p1'] ?> :</h3>

<hr>

<?php 


$content_of_license = @file_get_contents('license.txt');
if (strlen($content_of_license) < 3)
	{
		$content_of_license = "license.txt is empty or not found, got to http://www.dabach.net and read it from there ...";
	}
?>

<textarea class="form-control" rows="8"><?php echo $content_of_license; ?></textarea>


<div class="clear"></div>
<hr>
<a class="btn btn-info right" href="index.php?step=check"><?php echo $lang ['p2'] ?></a>
