<?php
header('Content-type: text/css');
function color(){
	
		$color = dechex(rand(0,16777215));
	
	return $color;
};
function opposite($color){
	$array = preg_split('//', trim($color));
	$switch = array('0' => 'f', '1' => 'e', '2' => 'd', '3' => 'c', '4' => 'b', '5' => 'a', '6' => '9', '7' => '8', '8' => '7', '9' => '6', 'a' => '5', 'b' => '4', 'c' => '3', 'd' => '2', 'e' => '1', 'f' => '0');
	foreach($array as $key => $value){
		if($value === '' || $value === '#'){

		}
		else{
			$array[$key] = $switch[$value];
		} 
	}

	$opposite = '';
	for($k=0 ; $k<count($array) ; $k++){
		$opposite .= $array[$k];
	}
	return $opposite;
}
?>
<?php $color = color()?>
h1{
	color: <?php echo $color; ?>;
	background: <?php echo opposite($color);?>
}
<?php $color = color()?>
h2{
	color: <?php echo $color; ?>;
	background: <?php echo opposite($color);?>
}
<?php $color = color()?>
p{
	color: <?php echo $color; ?>;
	background: <?php echo opposite($color);?>
}