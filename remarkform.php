<?php
Session_start();
$dbhost = 'localhost';
$dbuser = 'sohanisa';
$dbpass = '2444666668888888';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, 'cscb20w18_sohanisa', 3306);
if(!$conn)
{
  header("location:error.html");
}
$tusername = array();
$tname = array();
$tid = array();
$assignmentid = array();
$assignmentname = array();
$assignmenttype = array();

$sqlselect = 'select id, username, firstname, lastname from users where type=2';

$retval = mysqli_query($conn, $sqlselect);
if(!$retval)
{
	header("location:error.html");
}

while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
	array_push($tid, $row[0]);
	array_push($tusername, $row[1]);
	array_push($tname, ($row[2]." ".$row[3]));
}

mysqli_free_result($retval);
$sqlselect = 'select id, name, assignment_type from assignments';
$retval = mysqli_query($conn, $sqlselect);
if(!$retval)
{
	header("location:error.html");
}

while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
	array_push($assignmentid, $row[0]);
	array_push($assignmentname, $row[1]);
	array_push($assignmenttype, $row[2]);
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
      <!--   Welcome   -->
      <div id="title-panel" class="fullwidth-panel lightpink" style="background-color: #606F72;">
        <div class="center" style="color: white;">
          <h1>CSCB20 - Course Remark
            <h1>
        </div>
      </div>
      <!--  Login Form  -->
      <?php
      if(!isset($_SESSION["logged"]) or !$_SESSION["logged"] or ($_SESSION["type"] == 2) or ($_SESSION["type"] == 3)){
				header("location:index.php");
      }
      else{
					print <<< END
				<div class="panel lightpink">
        <form action="requestremark.php" method="post">
          <div>
            <h1>Request Remark Form</h1>
            <br>
            <label for="ta"><b>Select Teaching Assistant</b></label>
            <br><br>
            <select id="ta" name="ta" required>
END;
				for ($x = 0; $x < count($tid); $x++) {
					print <<< END
					<option value="$tid[$x]">$tusername[$x] $tname[$x]</option>
END;
}
				print <<< END
				 </select>
            <br><br>
						<label for="assignment"><b>Select Assignment</b></label>
            <br><br>
            <select id="assignment" name="assignment">
END;
				for ($x = 0; $x < count($assignmentid); $x++) {
					print <<< END
					<option value="$assignmentid[$x]">$assignmentname[$x]</option>
END;
}
					 print <<< END
              </select>
            <br><br>
            <label for="request"><b>Remark Description</b></label>
            <br><br>
            <input id="request" type="text" placeholder="Brief Message for Remark" name="request" maxlength=255>
            <br><br>
            <div id="remark-buttons">
              <button id="remark-clear-button" type="button" onclick="javascript: clearRemarkField()" class="cancel-button">Clear Request</button>
              <button id="submit-remark" type="submit">Submit Remark Request</button>
            </div>
          </div>
        </form>
      </div>
END;
				// Signout Button
				print <<< END
				<div class="center">
				<button id="back-button" type="button" onClick="window.history.back();" class="back-button">Go Back</button>
				<button id="signout-button" type="button" onClick="location.href='signout.php'" class="signout-button">Sign Out</button>
				</div>
END;
			}
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
