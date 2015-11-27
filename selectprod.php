<html>
<head></head>
<body>
<?php
$connInfo = array('UID' =>'mark' ,'PWD'=>'Password1','Database'=>'Shift_Reports',);
$serverName = '(local)';
$conn = sqlsrv_connect($serverName,$connInfo);
if(conn === false){
	echo 'Could not connect.\n';
	die(print_r(sqlsrv_errors(),true));
}
// set up query
$sql = 'select * dbo.Tproduction_data';
// execute query
$stmt = sqlsrv_query($conn,$sql);
if ($stmt === false) {
	echo "Error in query prepartion/execution";
	die(print_r(sqlsrv_errors(),true));
}

?>

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
				<?php while ($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {
					echo '<tr><td>'.$row['id'].'</td><td>'.$row['userID'].'</td><td>'.$row['plantID'].'</td><td>'.
					$row['shiftID'].'</td><td>'.$row['prod_hours'].'</td><td>'.$row['actual_mix'].'</td><td>'.
					$row['crumb_waste'].'</td><td>'.$row['cmp_waste'].'</td><td>'.$row['manning'].'</td><td>'.
					$row['date'].'</td><td></tr>';
				}?>

			</tbody>
		</table>
		sqlsrv_free_stmt($stmt);
		sqlsrv_close($conn);
</body>
</html>