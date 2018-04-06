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

$sqlselect = 'select answer1, answer2, answer3, answer4, additional from feedback where directed_id='.$_SESSION['userid'];
$retval = mysqli_query($conn, $sqlselect);
if(!$retval)
  header("location:error.html");

$answers1 = array();
$answers2 = array();
$answers3 = array();
$answers4 = array();
$additionals = array();
while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
  array_push($answers1, $row[0]);
	array_push($answers2, $row[1]);
	array_push($answers3, $row[2]);
	array_push($answers4, $row[3]);
  array_push($additionals, $row[4]);
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
      print <<< END
				<div id="title-panel" class="fullwidth-panel lightpink" style="background-color: #606F72;">
        <div class="center" style="color: white;">
          <h1>Submitted Feedback<h1>
        </div>
      	</div>
				<div class="panel">
				<p><b>The questions on the form were:</b></p>
        <p>What do you like about the intructor teaching?</p>
        <p>What do you recommend the instructor to do to improve their teaching?</p>
        <p>What do you like about the labs?</p>
        <p>What do you recommend the lab instructors to do to improve their lab teaching?</p>
				</div><br>
END;
        $feedbacknum = count($answers1);
        for($i = 0; $i < $feedbacknum; $i++)
        {
          print <<< END
					<div class="panel lightpink">
          <p><b>Feedback:</b></p>
          <p>$answers1[$i]</p>
					<p>$answers2[$i]</p>
					<p>$answers3[$i]</p>
					<p>$answers4[$i]</p>
					</div><br>
END;
          if($additionals[$i] != "NULL")
          {
						echo '<p>'.$additionals[$i].'</p><br>';
          }
       }
			// Signout Button
				print <<< END
				<button id="signout-button" type="button" onClick="location.href='signout.php'" class="signout-button">Sign Out</button>
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