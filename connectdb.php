<?php
/*
	Connect DB
	allows php to connect to Shift Reports database
	include('connectdb.php');
*/
$serverName = "(local)";
$connectionInfo = array('Database' =>'Shift_Reports' ,
						'UID'=>'Mark',
						'PWD'=>'Password1');
$conn = sqlsrv_connect($serverName,$connectionInfo);
or die(print_r(sqlsrv_errors(),true));
	

?>