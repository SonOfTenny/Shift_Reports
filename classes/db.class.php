<?php
//db.class.php

class DB {

	protected $db_name = 'Shift_Reports';
	protected $db_user = 'mark';
	protected $db_pass = 'Password1';
	protected $db_host = '(local)';
	protected $connInfo = array('UID' =>'mark','PWD'=>'Password1',
				'Database'=>'Shift_Reports' );
	protected $serverName = '(local)';

	//open a connection to the database. Make sure this is called
	//on every page that needs to use the database
	public function connect() {
		$connection = sqlsrv_connect($serverName,$connInfo);

		return true;
	}

	//takes a sqlsrv row set and returns an associative array, where the keys
    //in the array are the column names in the row set. If singleRow is set to
    //true, then it will return a single row instead of an array of rows
	public function processRowSet($rowSet, $singleRow=false)
	{
		$resultArray = array();
		while ($row = sqlsrv_fetch_array($rowSet,SQLSRV_FETCH_ASSOC)){
			
			array_push($resultArray, $row);
		}
		if ($singleRow === true) 
			return $resultArray[0];
		return $resultArray;
		
	}
	//Select rows from the database.
	//returns a full row or rows from $table using $where as the where clause
	//return value is an associative array with column names as keys.
	public function select($table,$where){
		$sql = 'SELECT * FROM $table WHERE $where';
		$result = sqlsrv_query($connection,$sql);
		$rows = sqlsrv_has_rows( $result );
		if ($rows === true)
			return processRowSet($result, true);
		
		return processRowSet($result);
	}

	// updates a current row in the database
	public function update($data, $table, $where){
		foreach($data as $column; $value){
			$sql = 'UPDATE $table SET $column = $value WHERE $where';
			sqlsrv_query($connection,$sql) or die(sqlsrv_errors(),true);
		}
		return true;
	}

	//Inserts a new row into the database.
	//takes an array of data, where the keys in the array are the column names
	//and the values are the data that will be inserted into those columns.
	//$table is the name of the table.
	public function insert($data, $table){
		$columns = "";
		$values = "";

		foreach ($data as $columns => $value) {
			$columns .= ($columns == "") ? "" : ', ';
			$columns .= $column;
			$values .= ($values == "") ? "" : ', ';
			$values .= $value;
		}

		$sql = "insert into $table ($columns) values ($values)";

		$result = sqlsrv_query($connection, $sql) or die(sqlsrv_errors(), true);

		//return the ID of the user in the database
		return sqlsrv_next_result($result);
	}

}

?>