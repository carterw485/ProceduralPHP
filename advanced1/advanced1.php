
<link rel="stylesheet" type="text/css" href="advanced1.css">
<table>
<?php
function table($array){
	echo "<tr>";
	echo "<td class='bold'>User #</td>";
	echo "<td class='bold'>First Name</td>";
	echo "<td class='bold'>Last Name</td>";
	echo "<td class='bold'>Full Name</td>";
	echo "<td class='bold'>Full Name in upper case</td>";
	echo "<td class='bold'>Length of full name (without spaces)</td>";
	echo "</tr>";
	$counter = 0;
	foreach($array as $inner => $index){
		$counter++;
		if($counter%5===0){
			echo "<tr class='highlight'>";
		}
		else{
			echo "<tr>";
		}
		echo "<td>$inner</td>";
		$full_name = '';
		foreach($index as $key => $value){
			$full_name .= "$value ";
			echo "<td>$value</td>";
		}
		echo "<td>$full_name</td>";
		echo "<td>" . strtoupper($full_name) . "</td>";
		echo "<td>" . strlen(str_replace(' ', '', $full_name)) . "</td>";
		echo "</tr>";
	}
}

$users = array( 
   array('first_name' => 'Michael', 'last_name' => 'Choi'),
   array('first_name' => 'John', 'last_name' => 'Supsupin'),
   array('first_name' => 'Mark', 'last_name' => 'Guillen'),
   array('first_name' => 'Lukas', 'last_name' => 'Van Heise'),
   array('first_name' => 'Walker', 'last_name' => 'Lindsey'),
   array('first_name' => 'Josh', 'last_name' => 'Svik'),
   array('first_name' => 'Jensen', 'last_name' => 'Frye'),
   array('first_name' => 'Taylor', 'last_name' => 'Schindler'),
   array('first_name' => 'Bryce', 'last_name' => 'Wikman'),
   array('first_name' => 'Connor', 'last_name' => 'Olson'),
   array('first_name' => 'RJ', 'last_name' => 'Ellingsworth'),
   array('first_name' => 'Chris', 'last_name' => 'Garton'),
   array('first_name' => 'Steve', 'last_name' => 'Williams'),
   array('first_name' => 'KB', 'last_name' => 'Tonel') 
);
table($users);


?>
</table>






