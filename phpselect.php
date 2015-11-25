<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<!-- Main heading -->
<div class="container">
	<div class="jumbotron">
		<h1>Shift Reports</h1>
		<p>View, Add, Edit and Delete Records</p>
	</div>
<!-- View User table -->
<div class="container">
	<div>
		<h2>View all Users</h2>
		<table class="table table-striped">
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
								'</td><td>'.$row['lastName'].'</td>'.
								'<td><button type="button" class="btn btn-info btn-sm"
								data-toggle="modal" data-target="#editModal">Edit</button></td>'.
								'<td><button type="button" class="btn btn-warning btn-sm"
								data-toggle="modal" data-target="#deleteModal">Delete</button></td>'.'</tr>';
				}

				// free statement and connection resources
				sqlsrv_free_stmt($stmt);
				sqlsrv_close($conn);
				?>
			</tbody>
		</table>

	</div>
</div>

<!-- editModal -->
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Record</h4>
      </div>
      <div class="modal-body">
        <form role="form">
        	<div class="form-group">
        		<label for="username">Username:</label>
        		<input type="text" name="username" class="form-control" id="username" value="<?php echo $username; ?>">
        	</div>
        	<div class="form-group">
        		<label for="fname">First Name:</label>
        		<input type="text" name="firstName" class="form-control" id="fname" value="<?php echo $firstName; ?>">
        	</div>
        	<div class="form-group">
        		<label for="lname">Last Name:</label>
        		<input type="text" name="lastName" class="form-control" id="lname" value="<?php echo $lastName; ?>">
        	</div>
        	<div class="form-group">
        		<label for="password">Password:</label>
        		<input type="password" name="password" class="form-control" id="password" value="<?php echo $password; ?>">
        	</div>
        	<!-- Submit button for editing-->
        	<input type="submit" onclick="return confirm('Are you sure you want to save?')"name="submit" value="Submit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</body>
</html>

<!-- PHP Magic down here -->
<?php
// connect to Shift_Reports
include('connectdb.php');
// Check to see if form was submitted, start to process the
// form and save it to the database
if (isset($_POST['submit'])) {
	// get form data, making sure it is valid
	$firstName = htmlspecialchars($_POST['firstName']);
	$lastName = htmlspecialchars($_POST['lastName']);
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);

	// check to make sure fields are complete
	//if ($firstName == '' || $lastName == '') {
	//	$error = 'Error: Please fill in all required fields';
	//}
	// save to the database
	sqlsrv_query("INSERT INTO dbo.Tuser(username,password,firstName,LastName)
					VALUES($username,$password,$firstName,$lastName)");
	or die(print_r(sqlsrv_errors(),true));

}

?>