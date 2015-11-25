<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<!-- Main heading -->
<div class="container">
	<div class="jumbotron">
		<h1>Shift Reports</h1>
		<p>Production data</p>
		<p>View, Add, Edit and Delete Records</p>
	</div>
<!-- View User table -->
<div class="container">
	<div>
		<table class="table table-striped">
			<thead>
				<tr>
					<td>ID</td>
					<td>Username</td>
					<td>First Name</td>
					<td>Last Name</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				// Connect to Shift_Reports
				$connInfo = array('UID' =>'mark','PWD'=>'Password1',
				'Database'=>'Shift_Reports' );
				$serverName = '(local)';
				$conn = sqlsrv_connect($serverName,$connInfo);
				if($conn===false){
					die(print_r(sqlsrv_errors(),true));
				}
				// setup and execute the query
				$sql = "SELECT * FROM dbo.Tuser";
				$stmt = sqlsrv_query($conn,$sql);
				// retrieve each row as an associative array
				// and display the results
				while ($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {
					echo '<tr><td>'.$row['ID'].'</td>
								<td>'.$row['username'].'</td>
								<td>'.$row['firstName'].
								'</td><td>'.$row['lastName'].'</td></tr>';
				}

				// free statement and connection resources
				sqlsrv_free_stmt($stmt);
				sqlsrv_close($conn);
				?>
			</tbody>
		</table>

	</div>
</div>

</body>
</html>