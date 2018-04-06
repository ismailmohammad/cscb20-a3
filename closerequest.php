<?php
Session_start();
// GET rid variable
if(!isset($_SESSION["logged"]) or !$_SESSION["logged"] or $_SESSION['type'] == 1)
	header("location:index.php");

$rid = $_GET['rid'];

$dbhost = 'localhost';
$dbuser = 'sohanisa';
$dbpass = '2444666668888888';
$dbname = 'cscb20w18_sohanisa';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3306);
if(!$conn)
{
	header("location:error.html");
}

$sqlselect = 'update remarks set status=1 where request_id='.$rid;

$retval = mysqli_query($conn, $sqlselect);
if(!$retval)
{
  header("location:error.html");
	echo mysqli_error($conn);
}
echo "<script type='text/javascript'>alert('Remark Request Closed Successfully!'); window.location.href='https://mathlab.utsc.utoronto.ca/cscb20/sohanisa/viewremarks.php'</script>";
mysqli_close($conn);
?>