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
</div>
<!-- View Simple Production table-->
<div class="container">
	<div>
		<h3>View Production table</h3>
		<table class="table table-striped">
			<thead>
				<tr>
					<td>ID</td>
					<td>User ID</td>
					<td>Plant ID</td>
					<td>Shift ID</td>
					<td>Production Hours</td>
					<td>Actual Mix</td>
					<td>Crumb Waste</td>
					<td>Compactor Waste</td>
					<td>Manning</td>
					<td>Date</td>
				</tr>
			</thead>
			<tbody>
				<?php
					$serverName = "(local)";
					$connectionInfo = array('Database' =>'Shift_Reports' ,'UID'=>'Mark','PWD'=>'Password1');
					$conn = sqlsrv_connect($serverName,$connectionInfo);
					if ($conn===false) {
						die(print_r(sqlsrv_errors(),true));
					}
					$sql = "select * from dbo.Tproduction_data";
					$stmt = sqlsrv_query($conn,$sql);
					{
						if($stmt===false){
							die(print_r(sqlsrv_errors(),true));
						}
					}
					while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
					?>
						<td><?php echo $row['id'];?></td>
			</tbody>
	</div>
</div>
<!-- View Production data -->
<div class="container">
	<div>
		<h3>View Production data</h3>
		<table class="table table-striped">
			<thead>
				<tr>
					<td>ID</td>
					<td>First Name</td>
					<td>Last Name</td>
					<td>Plant Name</td>
					<td>Shift Type</td>
					<td>Production Hours</td>
					<td>Actual Mix</td>
					<td>Crumb Waste</td>
					<td>Compactor Waste</td>
					<td>Manning</td>
					<td>Date</td>
				</tr>	
			</thead>
			<tbody>
				<?php
					$serverName = "(local)";
					$connectionInfo = array('Database' =>'Shift_Reports' ,'UID'=>'Mark','PWD'=>'Password1');
					$conn = sqlsrv_connect($serverName,$connectionInfo);
					if ($conn===false) {
						die(print_r(sqlsrv_errors(),true));
					}
					$sql = "select Tuser.firstName, Tuser.lastName, 
							Tplant.name, Tplant.mrph,
							Tshift.type,
							Tproduction_data.prod_hours, Tproduction_data.actual_mix,
							Tproduction_data.crumb_waste, Tproduction_data.cmp_waste,
							Tproduction_data.manning, Tproduction_data.date
							from Tuser
							INNER JOIN Tproduction_data
							ON Tproduction_data.userID = Tuser.id
							INNER JOIN Tplant
							ON Tproduction_data.plantID = Tplant.id
							INNER JOIN Tshift
							ON Tproduction_data.shiftID = Tshift.id
							";
					$stmt = sqlsrv_query($conn,$sql);
					{
						if($stmt===false){
							die(print_r(sqlsrv_errors(),true));
						}
					}
					while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
					?>
						<td><?php echo $row['Tuser.firstName']?>;</td>
						<td><?php echo $row['Tuser.lastName']?>;</td>
						<td><?php echo $row['Tplant.name']?>;</td>
						<td><?php echo $row['Tshift.type']?>;</td>
						<td><?php echo $row['Tproduction_data.prod_hours']?>;</td>
						<td><?php echo $row['Tproduction_data.actual_mix']?>;</td>
						<td><?php echo $row['Tproduction_data.crumb_waste']?>;</td>
						<td><?php echo $row['Tproduction_data.cmp_waste']?>;</td>
						<td><?php echo $row['Tproduction_data.manning']?>;</td>
						<td><?php echo $row['Tproduction_data.date']?>;</td>
					<?php
					}
				?>
			</tbody>		
		</table>
	</div>

</div>
</body>
</html>