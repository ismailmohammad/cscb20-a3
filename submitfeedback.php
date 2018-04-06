<?php
Session_start();
// Feedback Variables
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
$feedback = $improvement." ".$labs." ".$labsimprove;
$sql = "INSERT INTO feedback ". "(directed_id, feedback, additional) ".
"VALUES ('$target', '$feedback', '$additional')";
mysqli_free_result($retval);
$retval = mysqli_query($conn, $sql);
// if(!$retval)
// {
//   header("location:error.html");
//   die("SQL error");
// }

echo mysqli_error($conn);
echo "<script type='text/javascript'>alert('Feedback Successfully Submitted!'); window.location.href='https://mathlab.utsc.utoronto.ca/cscb20/sohanisa/index.php'</script>";
mysqli_close($conn);
?>