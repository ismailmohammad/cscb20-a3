<?php
Session_start();

if(!isset($_SESSION["logged"]) or !$_SESSION["logged"] or $_SESSION['type'] != 3)
	header("location:index.php");

$dbhost = 'localhost';
$dbuser = 'sohanisa';
$dbpass = '2444666668888888';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, 'cscb20w18_sohanisa', 3306);
if(!$conn)
{
  header("location:error.html");
}

$sqlselect = 'select c.firstname, c.lastname, c.id from grades a join users c where a.student_id=c.id order by a.student_id desc';
$retval = mysqli_query($conn, $sqlselect);
if(!$retval)
{
	header("location:error.html");
}
$studentnames = array();
$studentids = array();

while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
	array_push($studentnames, $row[0] . " " . $row [1]);
	array_push($studentnames, $row[2]);
}

$sqlselect = 'select b.name, a.grade, a.student_id from grades a join assignments b on a.assignment_id=b.id order by a.student_id desc';
$retval = mysqli_query($conn, $sqlselect);
if(!$retval)
{
	header("location:error.html");
}

$marks = array();
$assignmentnames = array();
$ids = array();

while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
	array_push($assignmentnames, $row[0]);
	array_push($marks, $row[1]);
	array_push($ids, $row[2])
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>CSCB20 - Introduction to Databases and Web Applications</title>
  <meta name="description" content="CSCB20 Course Website">
  <meta name="author" content="Designed by Sameed Sohani and Mohammad Ismail">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Add loginsignup.css -->
  <link rel="stylesheet" href="css/loginsignup.css">
  <!--  Roboto Font from Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:40s0,900" rel="stylesheet">
  <!--  Material Icons  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--  Scripts  -->
  <script src="js/main.js"></script>
</head>

<body>
  <!--  Navigation Bar  -->
  <div id="navbar" class="navbar">
    <div id="navbar-links">
      <a href="javascript:void(0);" onclick="showMenu()" class="navbar-icon"><i class="material-icons">menu</i></a>
      <a href="index.php">Home</a>
      <a href="announcements.html">Announcements and Calendar</a>
      <a href="courseteam.html">Course Team</a>
      <a href="syllabus.html">Syllabus</a>
      <a href="assignments.html">Assignments</a>
      <a href="labs.html">Weekly Labs</a>
      <a href="https://markus.utsc.utoronto.ca/cscb20w18/">MarkUs</a>
      <a href="https://piazza.com/class/jcpjjp5l4bywd">Piazza</a>
      <a href="http://www.utsc.utoronto.ca/iits/computer-labs">UTSC Labs</a>
      <a href="http://www.utsc.utoronto.ca/ctl/course-evaluations">Feedback</a>
    </div>
  </div>
  <!--  Content  -->
  <div id="content">
    <!--  Button to Scroll to top  -->
    <div class="align-right">
      <div id="scroll-to-top" class="panel align-right" onclick="scrollToTop();">Scroll up</div>
    </div>
    <div class="center">
      <?php
				print <<< END
				<h1>All Marks</h1>
END;
				$students = count($studentnames)
				$marksnum = count($marks);
				for($i = 0; $i < $students; $i++)
				{
					print <<< END
					<h2>$studentnames[$i]'s Marks</h2>
END;
					for($j = 0; $j < $marksnum; $j++)
					{
						if($ids($j) == $studentids($i))
						{
							print <<< END
							<p>$assignmentnames[$j]: $marks[$j]</p>
END;
						}
					}
				}
      ?>
    </div>
  </div>
  </body>
</html>