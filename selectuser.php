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


</body>
</html>