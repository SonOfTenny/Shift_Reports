<?php
//usertools.class.php

require_once 'user.class.php';
require_once 'db.class.php';

class UserTools {

	//Log the user in. First checks to see if the
	//username and password match a row in the database
	//If it is successful, set the session variables
	//and store the user object within.
	public function login($username,$password){

		$hashedPassword = md5($password);
		$result = sqlsrv_query("SELECT * FROM dbo.Tuser WHERE username = '$username' AND password = '$hashedPassword'");

		$rows = sqlsrv_has_rows( $result );
		if ($rows === true){
			$_SESSION['user'] = serialize(new User(sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)));
			$_SESSION['login_time'] = time();
			$_SESSION['logged_in'] = 1;
			return true;
		} else {
			return false;
		}
	}

	//Log the user out. Destroy the session variables
	public function logout() {
		unset($_SESSION['user']);
		unset($_SESSION['login_time']);
		unset($_SESSION['logged_in']);
		session_destroy();
	}

	//Check to see if a username exists.
	//This is called during registration to make sure all user names are unique
	public function checkUsernameExists($username) {
		$result = sqlsrv_query("SELECT ID from dbo.Tuser where username= '$username'");

		$rows = sqlsrv_has_rows( $result );
		if($rows === false){
			return false;
		} else {
			return true;
		}
	}

	//get a user
	//return a User Object. Takes the users id as an input
	public function get($id){

		$db = new DB();
		$result = $db-&gt;select('users',"id = $id");

		return new User($result);
	}
}
?&gt;

?>