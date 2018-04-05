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

$dbhost = 'mathlab.utsc.utoronto.ca';
$dbuser = 'sohanisa';
$dbpass = '2444666668888888';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(!$conn)
{
  header("location:/error.html");
}

$sqlselect = 'select username, email, utorid, studentnum from userdata';
mysql_select_db('cscb20w18_sohanisa');
$retval = mysql_query($sqlselect, $conn);

if(!$retval)
{
	header("location:/error.html");
}
while($row = mysql_fetch_array($retval, MYSQL_NUM))
{
	if(($username == $row[0]) or ($email == $row[1]) or ($utorid == $row[2]) or ($studentnum == $row[3]))
  {
		header("location:/index.php");
		die("One or more of (username, email, utorid, or studentnum) already exists.");
	}
}

$sql = "INSERT INTO users ". "(username, password, type, email, utorid, studentnum)". "VALUES($username, $password, $type, $email, $utorid, $studentnum)";
mysql_select_db('cscb20w18_sohanisa');
$retval = mysql_query($sql, $conn);
if(!$retval)
{
  header("location:/error.html");
}
header("location:/index.php#signin");
mysql_close($conn);
?>