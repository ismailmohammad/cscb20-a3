<?php
Session_start();
// Feedback Variables
$instructor = $_POST['instructor'];
$improvement = $_POST['improvement'];
$labs = $_POST['labs'];
$labsimprove = $_POST['labs-improve'];
$additional = $_POST['additional'];
$target = $_POST['target'];

$dbhost = 'localhost';
$dbuser = 'sohanisa';
$dbpass = '2444666668888888';
$dbname = 'cscb20w18_sohanisa';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3306);
if(!$conn)
{
  header("location:error.html");
}

if($additional == '')
{
  $additional = "NULL";
}
$sql = "INSERT INTO feedback ". "(directed_id, answer1, answer2, answer3, answer4, additional) ".
"VALUES ('$target', '$instructor', '$improvement', '$labs', '$labsimprove', '$additional')";
$retval = mysqli_query($conn, $sql);
if(!$retval)
{
  header("location:error.html");
  die("SQL error");
}

echo mysqli_error($conn);
echo "<script type='text/javascript'>alert('Feedback Successfully Submitted!'); window.location.href='https://mathlab.utsc.utoronto.ca/cscb20/sohanisa/index.php'</script>";
mysqli_close($conn);
?>