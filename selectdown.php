<html>
<body>
<table >
			<thead>
				<tr>
					<td>ID</td>
					<td>User ID</td>
					<td>Plant ID</td>
					<td>Dtype ID</td>
					<td>Shift ID</td>
					<td>Down Hours</td>
					<td>Reason</td>
					<td>Action</td>
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
				$sql = "SELECT * FROM dbo.Tdowntdata";
				$stmt = sqlsrv_query($conn,$sql);
				// retrieve each row as an associative array
				// and display the results
				while ($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {
					echo '<tr><td>'.$row['ID'].'</td>
								<td>'.$row['userID'].'</td>
								<td>'.$row['plantID'].
								'</td><td>'.$row['dtypeID'].'</td>
										<td>'.$row['shiftID'].'</td>
											<td>'.$row['down_hours'].'</td>
												<td>'.$row['reason'].'</td>
													<td>'.$row['action'].'</td>
														<td>'.$row['date'].'</td></tr>';
				}
				// free statement and connection resources
				sqlsrv_free_stmt($stmt);
				sqlsrv_close($conn);
				?>
</body>
</html>