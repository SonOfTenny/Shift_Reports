<html>
<head>
	<title>Shift Reports Production Entry Results</title>
</head>
<body>
	<h1>Shift Reports Production Entry Results</h1>
	<?php
	// Create short variable names
	$userid=$_POST['userid'];
	$plantid=$_POST['plantid'];
	$shiftid=$_POST['shiftid'];
	$prodhours=$_POST['prodhours'];
	$actualmix=$_POST['actualmix'];
	$crumbwaste=$_POST['crumbwaste'];
	$cmpwaste=$_POST['cmpwaste'];
	$manning=$_POST['manning'];
	$date=$_POST['date'];

	// check to see if all details are entered
	if(!$userid || !$plantid || !$shiftid || !$prodhours || !$actualmix || !$crumbwaste
		|| !$cmpwaste || !$manning || !$date){
		echo "You have not entered all the required details.<br />"
				."Please go back and try again.";
				exit();
	}
	// addslashes removes quotes
	if (!get_magic_quotes_gpc()) {
		$userid = addslashes($userid);
		$plantid = addslashes($plantid);
		$shiftid = addslashes($shiftid);
		$prodhours = addslashes($prodhours);
		$actualmix = addslashes($actualmix);
		$crumbwaste = addslashes($crumbwaste);
		$cmpwaste = addslashes($cmpwaste);
		$manning = addslashes($manning);
		$date = addslashes($date);

		// connect to Shift_Reports
		include('connectdb.php');

		$sql = "insert into dbo.Tproduction_data values(
				'".$userid."','".$plantid."','".$shiftid."',
				'".$prodhours."','".$actualmix."','".$crumbwaste."',
				'".$cmpwaste."','".$manning."','".$date."')";
		$stmt = sqlsrv_query($sql); 
		if($stmt === false){
			echo "Record added";
		} else{
			echo "An error has occured";
			die(print_r(sqlsrv_errors(),true));
		}
		sqlsrv_free_stmt($stmt);
		sqlsrv_close($conn);
	}


	?>
</body>