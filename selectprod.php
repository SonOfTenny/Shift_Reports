<html>
<head></head>
<body>
<table>
<thead>
				<tr>
					<td>ID</td>
					<td>User ID</td>
					<td>Plant ID</td>
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
								<td>'.$row['userID'].'</td>
								<td>'.$row['plantID'].'</td><td>'
									.$row['shiftID'].'</td>
								<td>'.$row['prod_hours'].'</td>
								<td>'.$row['actual_mix'].'</td>
								<td>'.$row['crumb_waste'].'</td>
								<td>'.$row['cmp_waste'].'</td>
								<td>'.$row['manning'].'</td>
								<td>'.$row['date'].'</td></tr>';

				// free statement and connection resources
				sqlsrv_free_stmt($stmt);
				sqlsrv_close($conn);
				?>

			</tbody>
		</table>

</body>
</html>