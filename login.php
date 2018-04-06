<?php
Session_start();
$_SESSION['login'] = $_POST['login'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['logged'] = false;

$login = $_SESSION['login'];
$password = $_SESSION['password'];

$dbhost = 'localhost';
$dbuser = 'sohanisa';
$dbpass = '2444666668888888';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, 'cscb20w18_sohanisa', 3306);
if(!$conn)
{
  header("location:error.html");
}

// Base Selection Query
$sqlselect = 'select * from users';

$retval = mysqli_query($conn, $sqlselect);

if(!$retval)
{
	header("location:error.html");
}
while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
	if(($login == $row[1]) or ($login == $row[4]) or ($login == $row[5]) or ($studentnum == $row[6]))
  {
		// Check if entered password matches the hashed password
		if (password_verify($password, $row[2])) {
			$_SESSION['logged'] = true;
			$_SESSION['type'] = $row[5];
			$_SESSION['fname'] = $row[7];
			$_SESSION['lname'] = $row[8];
			$_SESSION['userid'] = $row[0];
			break;
		}
		else
		{
			echo 'alert("You have entered an incorrect password. Please correct and try again.");';
		}
	}
}
mysqli_free_result($retval);
header("location:index.php");
mysqli_close($conn);
?>
