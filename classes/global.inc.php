&lt;?php
require_once 'classes/user.class.php';
require_once 'classes/usertools.class.php';
require_once 'classes/db.class.php';
 
//connect to the database
$db = new DB();
$db-&gt;connect();
 
//initialize UserTools object
$userTools = new UserTools();
 
//start the session
session_start();
 
//refresh session variables if logged in
if(isset($_SESSION['logged_in'])) {
    $user = unserialize($_SESSION['user']);
    $_SESSION['user'] = serialize($userTools-&gt;get($user-&gt;id));
}
?&gt;