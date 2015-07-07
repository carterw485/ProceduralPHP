<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>group checkers</title>
	<meta name="description" content="group checkseres"/>
	<link rel="stylesheet" type="text/css" href="groupcheckers.css">
</head>
<body>
	<div class='container'>
		<?php
			for($i=0 ; $i<8 ; $i++){
				echo "<div class='row'>";
				for($k=0 ; $k<8 ; $k++){
					echo "<div class='spot'></div>";
				}
				echo "</div>";
			}	
		?>
	</div>
</body>
</html>