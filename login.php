<?php
Session_start();
$_SESSION['login'] = $_POST['login'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['logged'] = false;
$_SESSION['type'] = 0;

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
$sqlselect = 'select username, password, email, utorid, studentnum, type from users';

$retval = mysqli_query($conn, $sqlselect);

if(!$retval)
{
	header("location:error.html");
}
while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
	if(($login == $row[0]) or ($login == $row[2]) or ($login == $row[3]) or ($studentnum == $row[4]))
  {
		// Check if entered password matches the hashed password
		if (password_verify($password, $row[2])) {
			$_SESSION['logged'] = true;
			$_SESSION['type'] = $row[5];
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
