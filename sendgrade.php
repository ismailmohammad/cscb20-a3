<?php
Session_start();
// Grade Variables
$sid = $_POST['student'];
$assignmentid = $_POST['assignment'];
$grade = $_POST['grade'];

$dbhost = 'localhost';
$dbuser = 'sohanisa';
$dbpass = '2444666668888888';
$dbname = 'cscb20w18_sohanisa';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3306);
if(!$conn)
{
  header("location:error.html");
}

$sql = "INSERT INTO grades ". "(student_id, grade, assignment_id) ".
"VALUES ('$sid', '$grade', '$assignmentid') ON DUPLICATE KEY UPDATE grade='$grade'";
$retval = mysqli_query($conn, $sql);
if(!$retval)
{
  header("location:error.html");
  die("SQL error");
}

echo mysqli_error($conn);
echo "<script type='text/javascript'>alert('Grade Updated Successfully!'); window.location.href='https://mathlab.utsc.utoronto.ca/cscb20/sohanisa/index.php'</script>";
mysqli_close($conn);
?>