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

$sid = $_SESSION['userid'];

$sqlselect = 'select assignment_id from remarks where submitted_id='.$sid;

$retval = mysqli_query($conn, $sqlselect);
if(!$retval)
{
	header("location:error.html");
}

while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
	if ($row[0] == $assignmentid) {
    echo "<script type='text/javascript'>alert('Remark Already Submitted for this assignment'); clearRemarkField(); window.location.href='https://mathlab.utsc.utoronto.ca/cscb20/sohanisa/remarkform.php'</script>";
  }
}

mysqli_free_result($retval);

$sql = "INSERT INTO remarks ". "(submitted_id, directed_id, status, request, assignment_id) ".
"VALUES ('$sid', '$tid', '0', '$request', '$assignmentid')";
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