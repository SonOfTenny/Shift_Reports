<html>
<body>
<table >
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
				$sql = "SELECT * FROM dbo.Tproduction_data";
				$stmt = sqlsrv_query($conn,$sql);
				// retrieve each row as an associative array
				// and display the results
				while ($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {
					echo '<tr><td>'.$row['ID'].'</td>
<<<<<<< HEAD:selectuser.php
								<td>'.$row['username'].'</td>
								<td>'.$row['firstName'].
								'</td><td>'.$row['lastName'].'</td></tr>';
=======
								<td>'.$row['userID'].'</td>
								<td>'.$row['plantID'].'</td><td>'
									.$row['shiftID'].'</td>
								<td>'.$row['prod_hours'].'</td>
								<td>'.$row['actual_mix'].'</td>
								<td>'.$row['crumb_waste'].'</td>
								<td>'.$row['cmp_waste'].'</td>
								<td>'.$row['manning'].'</td>
								<td>'.$row['date'].'</td></tr>';
>>>>>>> 02c31d5c784a089922f45d9d45d00cfc6dcebcc4:selectprod.php
				}
				// free statement and connection resources
				sqlsrv_free_stmt($stmt);
				sqlsrv_close($conn);

				?>


</body>
</html>
