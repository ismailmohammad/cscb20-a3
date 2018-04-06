<?php
Session_start();

if(!isset($_SESSION["logged"]) or !$_SESSION["logged"] or $_SESSION['type'] == 1)
	header("location:index.php");

$dbhost = 'localhost';
$dbuser = 'sohanisa';
$dbpass = '2444666668888888';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, 'cscb20w18_sohanisa', 3306);
if(!$conn)
{
  header("location:error.html");
}
$sqlselect = 'select a.status, a.request b.firstname, b.lastname, b.username, c.name, a.request_id from remarks a join users b on a.submitted_id=b.id join assignments c on c.id=a.assignment_id' ? $_SESSION['type'] == 3 : 'select a.status, a.request, b.firstname, b.lastname, b.username, c.name, a.request_id from remarks a join users b on a.submitted_id=b.id where directed_id='.$_SESSION['userid'].' join assignments c on c.id=a.assignment_id';

$retval = mysqli_query($conn, $sqlselect);
//if(!$retval)
  //header("location:error.html");

$statuses = array();
$requests = array();
$studentnames = array();
$usernames = array();
$assignments = array();
$rids = array();

while($row = mysqli_fetch_array($retval, MYSQLI_NUM))
{
  array_push($statuses, $row[0]);
	array_push($requests, $row[1]);
	array_push($studentnames, ($row[2] . " " . $row[3]));
  array_push($usernames, $row[4]);
  array_push($assignments, $row[5]);
  array_push($rids, $row[6]);
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
				<h1>Remark Requests</h1>
END;
        $requestnum = count($requests);
        for($i = 0; $i < $requestnum; $i++)
        {
          print <<< END
          <p>Request submitted by: $studentnames[$i] ($usernames[$i])</p>
          <p>Course Component: $assignments[$i]</p>
          <p>Request: $requests[$i]</p>
END;
          if($status[$i])
					{
            print <<< END
						'<p>Status: Open </p><a href=closerequest.php?rid=$rids[$i]>Click here to close request</a>'
END;
					} else
						echo '<p>Status: Closed</p>';
				}
        // Signout Button
				print <<< END
				<div class="center">
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