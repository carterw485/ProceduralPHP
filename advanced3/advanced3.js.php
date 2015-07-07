<?php
header('Content-type: application/javascript');
$random1 = rand(1, 99); 
$random2 = rand(1, 99);
$answer = $random1*$random2;
?>
$('document').ready(function(){
	$('p').after('<p> <?php echo "$random1" . "x" . "$random2" . "=" .  "$answer"; ?> </p>');
})