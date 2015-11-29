<html>
<body>
<table >
			<thead>
				<tr>
					<td>ID</td>
					<td>First Name</td>
					<td>Last Name</td>
					<td>Plant</td>
					<td>MRPH</td>
					<td>Shift</td>
					<td>Hours</td>
					<td>Actual Waste</td>
					<td>Crumb Waste</td>
					<td>Comp. Waste</td>
					<td>Manning</td>
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
						Tplant.mrph as 'mrph', Tshift.type as 'sType', Tproddata.prod_hours as 'prod_hours', 
						Tproddata.actual_mix as 'actual',
						Tproddata.crumb_waste as 'crumb', Tproddata.cmp_waste as 'cmp', 
						Tproddata.manning as 'manning' FROM Tuser
						INNER JOIN Tproddata
						ON Tproddata.userID = Tuser.id
						inner join Tplant
						on Tproddata.plantID = Tplant.id
						inner join Tshift
						on Tproddata.shiftID = Tshift.id";
				$stmt = sqlsrv_query($conn,$sql);
				// retrieve each row as an associative array
				// and display the results
				while ($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {
					echo '<tr><td>'.$row['firstName'].'</td>
								<td>'.$row['lastName'].
								'</td><td>'.$row['plant'].
								'</td><td>'.$row['mrph'].
								'</td><td>'.$row['sType'].
								'</td><td>'.$row['prod_hours'].
								'</td><td>'.$row['actual'].
								'</td><td>'.$row['crumb'].
								'</td><td>'.$row['cmp'].
								'</td><td>'.$row['manning'].
								'</td></tr>';
				}
				// free statement and connection resources
				sqlsrv_free_stmt($stmt);
				sqlsrv_close($conn);

				?>
			</tbody>
		</table>

</body>