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
$iusername = array();
$iname = array();
$sqlselect = 'select username, firstname, lastname from users where type=3';

$retval = mysqli_query($conn, $sqlselect);
if(!$retval)
{
	header("location:error.html");
}

while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
	array_push($iusername, $row[0]);
	array_push($iname, ($row[1]." ".$row[2]));
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
      <!--   Welcome   -->
      <div id="title-panel" class="fullwidth-panel lightpink" style="background-color: #606F72;">
        <div class="center" style="color: white;">
          <h1>Feedback Form - CSCB20
            <h1>
        </div>
      </div>
      <!--  Login Form  -->
      <?php
      if(!isset($_SESSION["logged"]) or !$_SESSION["logged"] or ($_SESSION["type"] == 2) or ($_SESSION["type"] == 3) ){
				header("location:index.php");
      }
      else{
					print <<< END
				<div class="panel lightpink">
        <form action="submitfeedback.php" method="post">
          <div>
            <h1>Submit your feedback for CSCB20</h1>
            <br>
            <label for="instructor"><b>What do you like about the intructor teaching?</b></label>
            <br><br>
            <textarea id="instructor" type="text" placeholder="Your Feedback" name="instructor" required></textarea>
            <br><br>
            <label for="improvement"><b>What do you recommend the instructor to do to improve their teaching?</b></label>
            <br><br>
            <textarea id="improvement" type="text" placeholder="Your Feedback" name="improvement" required></textarea>
            <br><br>
            <label for="labs"><b>What do you like about the labs?</b></label>
            <br><br>
            <textarea id="labs" type="text" placeholder="Your Feedback" name="labs" required></textarea>
            <br><br>
            <label for="labs-improve"><b>What do you recommend the lab instructors to do to improve their lab teaching?</b></label>
            <br><br>
            <textarea id="labs-improve" type="text" placeholder="Your Feedback" name="labs-improve" required></textarea>
            <br><br>
            <label for="additional"><b>Any Additional Feedback (Optional)</b></label>
            <br><br>
            <textarea id="additional" type="text" placeholder="Your Feedback" name="additional"></textarea>
            <br><br>
            <label for="target"><b>Select an instructor</b></label>
            <select id="target" name="type">
END;
				for ($x = 0; $x < count($iusername); $x++) {
					print <<< END
					<option value="$iusername[$x]">$iname[$x]</option>
END;
}
					 print <<< END
            </select>
            <br><br>
            <div id="feedback-buttons">
              <button id="feedback-clear-button" type="button" onclick="javascript: clearFeedbackFields()" class="cancel-button">Clear Fields</button>
              <button id="submit-feedback" type="submit">Submit Feedback</button>
            </div>
          </div>
        </form>
      </div>
END;
				// Signout Button
				print <<< END
				<div class="center">
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
