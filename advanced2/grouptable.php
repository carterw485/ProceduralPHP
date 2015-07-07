<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Group table</title>
	<meta name="description" content="group table"/>
	<link rel="stylesheet" type="text/css" href="grouptable.css">
</head>
<body>
	<?php
	$users = array( 
	   array('first_name' => 'Michael', 'last_name' => 'Choi'),
	   array('first_name' => 'John', 'last_name' => 'Supsupin'),
	   array('first_name' => 'Mark', 'last_name' => 'Guillen'),
	   array('first_name' => 'KB', 'last_name' => 'Tonel'),
	   array('first_name' => 'Clark', 'last_name' => 'Kent'),
	   array('first_name' => 'Tony', 'last_name' => 'Stark'),
	   array('first_name' => 'Peter', 'last_name' => 'Parker'),
	   array('first_name' => 'Bruce', 'last_name' => 'Banner'),
	   array('first_name' => 'Star', 'last_name' => 'Lord'),
	   array('first_name' => 'Black', 'last_name' => 'Widow'),
	   array('first_name' => 'I am', 'last_name' => 'Groot!'),
	   array('first_name' => 'Bruce', 'last_name' => 'Wayne'),
	   array('first_name' => 'Linda', 'last_name' => 'Carter'),
	   array('first_name' => 'Reed', 'last_name' => 'Richards') 
	);
	?>
	<table>
		<thead>
			<tr>
				<th>User #</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Full Name</th>
				<th>Full Name in uppercase</th>
				<th>Length of full name (without spaces)</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$userindex = 1;
				foreach($users as $index => $user){
					echo "<tr>";
					echo "<td>$userindex</td>";
					echo "<td>$user[first_name]</td>";
					echo "<td>$user[last_name]</td>";
					echo "<td>$user[first_name] $user[last_name]</td>";
					echo "<td>" . strtoupper($user['first_name'] . ' ' . $user['last_name']) . "</td>";
					echo "<td>" . strlen(str_replace(' ', '', $user['first_name'] . $user['last_name'])) . "</td>";
					echo "</tr>";
					$userindex++;
				}
			?>
		</tbody>
	</table>
</body>
</html>