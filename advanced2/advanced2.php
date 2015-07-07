<link rel="stylesheet" type="text/css" href="advanced2.css">
<?php
function color(){
	$color = '#';
	for($i=0 ; $i<6 ; $i++){
		$color .= dechex(rand(0,15));
	}
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
function checkers($color1, $color2){
	echo "<table>";
	for($k=0 ; $k<8 ; $k++){
		echo "<tr>";
		if($k%2===0){
			for($i=0 ; $i<4 ; $i++){
				echo "<td style='background: $color1'></td>";
				echo "<td style='background: $color2'></td>";
			}
		}
		else{
			for($i=0 ; $i<4 ; $i++){
				echo "<td style='background: $color2'></td>";
				echo "<td style='background: $color1'></td>";
			}
		}
		echo "</tr>";
	}
	echo "</table>";
}
$color = color();
$opp = opposite($color);
checkers($color, $opp);
$color = color();
$opp = opposite($color);
checkers($color, $opp);
$color = color();
$opp = opposite($color);
checkers($color, $opp);
?>

		