<?php
Session_start();
// Grade Variables
$tid = $_POST['ta'];
$assignmentid = $_POST['assignment'];
$request = $_POST['request'];

$dbhost = 'localhost';
$dbuser = 'sohanisa';
$dbpass = '2444666668888888';
$dbname = 'cscb20w18_sohanisa';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3306);
if(!$conn)
{
  header("location:error.html");
}

$sql = "INSERT INTO remarks ". "(submitted_id, directed_id, status, request, assignment_id) ".
"VALUES ('$_SESSION['userid']', '$tid', 0, '$request', '$assignmentid')";
$retval = mysqli_query($conn, $sql);
if(!$retval)
{
  header("location:error.html");
  die("SQL error");
}

echo mysqli_error($conn);
echo "<script type='text/javascript'>alert('Remark Requested Successfully!'); window.location.href='https://mathlab.utsc.utoronto.ca/cscb20/sohanisa/index.php'</script>";
mysqli_close($conn);
?>