<?php
Session_start();
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
$_SESSION['email'] = $_POST['email'];
$_SESSION['utorid'] = $_POST['utorid'];
$_SESSION['studentnum'] = $_POST['studentnum'];
$_SESSION['type'] = $_POST['type'];

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$email = $_SESSION['email'];
$utorid = $_SESSION['utorid'];
$studentnum = $_SESSION['studentnum'];
$type = $_SESSION['type'];

$dbhost = 'localhost';
$dbuser = 'sohanisa';
$dbpass = '2444666668888888';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, 'cscb20w18_sohanisa', 3306);
if(!$conn)
{
  //header("location:/error.html");
}

$sqlselect = 'select username, email, utorid, studentnum from userdata';

$retval = mysqli_query($conn, $sqlselect);

if(!$retval)
{
	//header("location:/error.html");
}
while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
	if(($username == $row[0]) or ($email == $row[1]) or ($utorid == $row[2]) or ($studentnum == $row[3]))
  {
		//header("location:/index.php");
		//die("One or more of (username, email, utorid, or studentnum) already exists.");
	}
}

$sql = "INSERT INTO users ". "(username, password, type, email, utorid, studentnum) ".
"VALUES($username, $password, $type, $email, $utorid, $studentnum)";

$retval = mysqli_query($conn, $sql);
if(!$retval)
{
  //header("location:/error.html");
}
//header("location:/index.php#signin");
mysqli_close($conn);
?>