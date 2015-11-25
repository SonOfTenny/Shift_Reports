<?php

$serverName = "(local)";
$connectionInfo = array('Database' =>'Shift_Reports' ,'UID'=>'Mark','PWD'=>'Password1');
$conn = sqlsrv_connect($serverName,$connectionInfo);

if($conn){
	echo 'Connection established.<br>';
}else{
	echo 'Connection failed.<br>';
	die(print_r(sqlsrv_errors(),true));
}

?>