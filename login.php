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
	if(($login == $row[1]) or ($login == $row[4] && $row[4] != 'NULL') or ($login == $row[5] && $row[5] != 'NULL') or ($login == $row[6] && $row[6] != 'NULL'))
  {
		// Check if entered password matches the hashed password
		if(password_verify($password, $row[2])) {
			$_SESSION['logged'] = true;
			$_SESSION['type'] = $row[3];
			$_SESSION['fname'] = $row[7];
			$_SESSION['lname'] = $row[8];
			$_SESSION['userid'] = $row[0];
			break;
		}
		else
		{
			echo '<script type="text/javascript">alert("You have entered an incorrect login or password. Please correct and try again."); window.location.href="https://mathlab.utsc.utoronto.ca/cscb20/sohanisa/index.php#login"</script>';
		}
	}
}
mysqli_free_result($retval);
if(!isset($_SESSION['logged']) or !$_SESSION['logged'])
	echo '<script type="text/javascript">alert("You have entered an incorrect login. Please correct and try again."); window.location.href="https://mathlab.utsc.utoronto.ca/cscb20/sohanisa/index.php#login"</script>';
else
	header("location:index.php");
mysqli_close($conn);
?>