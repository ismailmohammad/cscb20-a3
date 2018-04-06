<?php
Session_start();

if(!isset($_SESSION["logged"]) or !$_SESSION["logged"] or $_SESSION['type'] != 1)
	header("location:index.php");

$dbhost = 'localhost';
$dbuser = 'sohanisa';
$dbpass = '2444666668888888';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, 'cscb20w18_sohanisa', 3306);
if(!$conn)
{
  header("location:error.html");
}

$sqlselect = 'select b.name, b.assignment_type, a.grade from grades a join assignments b on a.assignment_id=b.id where a.student_id=' . $_SESSION['userid'];
$retval = mysqli_query($conn, $sqlselect);
if(!$retval)
{
	header("location:error.html");
}

$quizmarks = array();
$quiznames = array();
$assignmentmarks = array();
$assignmentnames = array();
$mtmark;
$mtname;
$finalmark;
$finalname;
$labmark;
$labname;
while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
  if($row[1] == 1){
    array_push($quizmarks, $row[2]);
    array_push($quiznames, $row[0]);
  }
  else if($row[1] == 2)
  {
    array_push($assignmentmarks, $row[2]);
    array_push($assignmentnames, $row[0]);
  }
  else if($row[1] == 3)
  {
    $mtmark = $row[2];
    $mtname = $row[0];
  }
  else if($row[1] == 4)
  {
    $finalmark = $row[2];
    $finalname = $row[0];
  }
  else if($row[1] == 5)
  {  
    $labmark = $row[2];
    $labname = $row[0];
  }
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
			<a href="lectures.html">Course Notes</a>
      <a href="assignments.html">Assignments</a>
      <a href="labs.html">Weekly Labs</a>
      <a href="https://markus.utsc.utoronto.ca/cscb20w18/">MarkUs</a>
      <a href="https://piazza.com/class/jcpjjp5l4bywd">Piazza</a>
      <a href="http://www.utsc.utoronto.ca/iits/computer-labs">UTSC Labs</a>
      <a href="http://www.utsc.utoronto.ca/ctl/course-evaluations">Course Evaluations</a>
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
				$fname = $_SESSION['fname'];
				$lname = $_SESSION['lname'];
				print <<< END
				<div id="title-panel" class="fullwidth-panel lightpink" style="background-color: #606F72;">
        <div class="center" style="color: white;">
          <h1>$fname $lname's Marks<h1>
        </div>
      	</div>
				<div class="panel lightpink">
END;
				$quiznum = count($quizmarks);
				if($quiznum > 0)
				{
					for($i = 0; $i<$quiznum; $i++)
					{
						print <<< END
						<p><b>$quiznames[$i]:</b> $quizmarks[$i]</p>
END;
					}
					echo '<br>';
				}

			$assignmentnum = count($assignmentmarks);
			if($assignmentnum > 0)
			{
				for($i=0; $i<$assignmentnum; $i++)
				{
					print <<< END
					<p><b>$assignmentnames[$i]:</b> $assignmentmarks[$i]</p>
END;
				}
				echo '<br>';
			}
			if(isset($mtmark))
			{
				print <<< END
				<p><b>$mtname:</b> $mtmark</p>
				<br>
END;
			}
			if(isset($finalmark))
			{
				print <<< END
				<p><b>$finalname:</b> $finalmark</p>
				<br>
END;
			}
			if(isset($labmark))
			{
				print <<< END
				<p><b>$labname:</b> $labmark</p>
				<br>
END;
			}
			// Signout Button
				print <<< END
				</div><br>
				<div class="center">
				<button id="back-button" type="button" onClick="window.history.back();" class="back-button">Go Back</button>
				<button id="signout-button" type="button" onClick="location.href='signout.php'" class="signout-button">Sign Out</button>
				</div>
END;
      ?>
    </div>
  </div>
  <br><br>
  <!--  Footer  -->
  <footer>
    <p><a href="https://www.utsc.utoronto.ca/cms/computer-science-mathematics-statistics">Department of Computer Science and Mathematical Sciences at UTSC</a></p>
    <p>Site designed by Sameed Sohani and Mohammad Ismail</p>
  </footer>
  </body>
</html>