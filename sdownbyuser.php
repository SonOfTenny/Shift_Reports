<html>
<body>
	<h1>All Downtime Records by User</h1>
<table >
			<thead>
				<tr>
					<td>First Name</td>
					<td>Last Name</td>
					<td>Plant</td>
					<td>Shift</td>
					<td>Hours</td>
					<td>Reason</td>
					<td>Action</td>
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
				$sql = "select Tuser.firstName as 'firstName', Tuser.lastName as 'lastName', Tplant.name as 'plant',
					  Tshift.type as 'sType',
						Tdowntdata.down_hours as 'down_hours', Tdowntdata.reason as 'reason', Tdowntdata.action as 'action', 
						Tdowntdata.dDate from Tuser
						inner join Tdowntdata
						on Tdowntdata.userID = tuser.ID
						inner join Tplant
						on Tdowntdata.plantID = Tplant.id
						inner join Tshift
						on Tdowntdata.shiftID = Tshift.ID";
				$stmt = sqlsrv_query($conn,$sql);
				// retrieve each row as an associative array
				// and display the results
				while ($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {
					echo '<tr><td>'.$row['firstName'].'</td>
								<td>'.$row['lastName'].
								'</td><td>'.$row['plant'].
								'</td><td>'.$row['mrph'].
								'</td><td>'.$row['sType'].
								'</td><td>'.$row['down_hours'].
								'</td><td>'.$row['reason'].
								'</td><td>'.$row['action'].
								'</td></tr>';
				}
				// free statement and connection resources
				sqlsrv_free_stmt($stmt);
				sqlsrv_close($conn);

				?>


			</tbody>


</body>