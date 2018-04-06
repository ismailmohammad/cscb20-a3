<?php
Session_start();
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
$_SESSION['firstname'] = $_POST['firstname'];
$_SESSION['lastname'] = $_POST['lastname'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['utorid'] = $_POST['utorid'];
$_SESSION['studentnum'] = $_POST['studentnum'];
$_SESSION['type'] = $_POST['type'];

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
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
  header("location:error.html");
}

$sqlselect = 'select username, email, utorid, studentnum from users';
$retval = mysqli_query($conn, $sqlselect);

if(!$retval)
{
	header("location:error.html");
}
while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
	if(($username == $row[0]) or ($email == $row[1] && $email != '') or ($utorid == $row[2] && $utorid != '') or ($studentnum == $row[3] && $studentnum != ''))
  {
		header("location:index.php");
		echo "<script type='text/javascript'>alert('Account already exists');</script>";
		die("One or more of (username, email, utorid, or studentnum) already exists.");
	}
}
if($utorid == '')
{
  $utorid = "NULL";
}
if($email == '')
{
  $email = "NULL";
}
if($studentnum == '')
{
  $studentnum = "NULL";
}
$sql = "INSERT INTO users ". "(username, password, type, email, utorid, studentnum, firstname, lastname) ".
"VALUES ('$username', '$password', '$type', '$email', '$utorid', $studentnum, '$firstname', '$lastname')";
mysqli_free_result($retval);
$retval = mysqli_query($conn, $sql);
if(!$retval)
{
  header("location:error.html");
  die("SQL error");
}
echo "<script type='text/javascript'>alert('Account created!'); window.location.href='https://mathlab.utsc.utoronto.ca/cscb20/sohanisa/index.php#login'</script>";
mysqli_close($conn);
?>
