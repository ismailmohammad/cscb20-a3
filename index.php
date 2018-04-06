<?php
Session_start();
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
          <h1>Introduction to Databases and Web Applications
            <h1>
        </div>
      </div>
      <!--  Login Form  -->
      <?php
      if(!isset($_SESSION["logged"]) or !$_SESSION["logged"]){
	  print <<< END
      <div id="login-form-container" class="panel lightpink">
        <form action="login.php" method="post">
          <div>
            <h1>Log in to your CSCB20 account</h1>
            <br>
            <label for="login"><b>Login</b></label>
            <br>
            <input id="login" type="text" placeholder="Enter Login" name="login" required>
            <br>
            <label for="password-l"><b>Password</b></label>
            <br>
            <input id="password-l" type="password" placeholder="Enter Password" name="password" minLength=8 required>
            <br>
            <div id="login-buttons">
              <button id="login-clear-button" type="button" onclick="javascript: clearLoginFields()" class="cancel-button">Clear</button>
              <button id="login-button" type="submit">Log In</button>
            </div>
          </div>
        </form>
      </div>
      <br>
      <!--   Signup Form   -->
      <div id="signup-form-container" class="panel lightpink">
        <form action="signup.php" method="post">
          <div>
            <h1>Sign Up</h1>
            <p>Please fill in this form to create an account for CSCB20</p>
            <br>
            <label for="username"><b>Username</b></label>
            <br>
            <input id="username" type="text" placeholder="Enter Username" name="username" required>
            <br>
            <label for="password"><b>Password</b></label>
            <br>
            <input id="password" type="password" placeholder="Enter Password" name="password" minLength=8 required>
            <br>
            <label for="password-repeat"><b>Confirm Password</b></label>
            <br>
            <input id="password-repeat" type="password" placeholder="Confirm Password" name="password-repeat" minLength=8 onchange='checkConfirmPass();'required>
            <br>
	    <label for="firstname"><b>First Name</b></label>
	    <br>
	    <input id="firstname" type="text" placeholder="Enter First Name" name="firstname" required>
	    <br>
	    <label for="lastname"><b>Last Name</b></label>
	    <br>
	    <input id="lastname" type="text" placeholder="Enter Last Name" name="lastname" required>
	    <br>
            <label for="email"><b>Email</b></label>
            <br>
            <input id="email" type="email" placeholder="Enter Email (optional)" name="email">
            <br>
            <label for="utorid"><b>UTORid</b></label>
            <br>
            <input id="utorid" type="text" placeholder="Enter UTORid (optional)" name="utorid" minlength=8 maxlength=8>
            <br>
            <label for="studentnum"><b>Student #</b></label>
            <br>
            <input id="studentnum" type="number" placeholder="Enter student # (optional)" name="studentnum" minlength=10 maxlength=10>
            <br>
            <label for="type"><b>Select Account Type</b></label>
            <br>
            <select id="type" name="type"> 
              <option value=1>Student</option>
              <option value=2>Teaching Assistant</option> 
              <option value=3>Instructor</option>
            </select>
            <br><br>
            <div id="signup-buttons">
              <button id="signup-clear-button" type="button" onclick="javascript: clearSignupFields()" class="cancel-button">Clear</button>
              <button id="submit-button" type="submit" class="submit-button" disabled>Sign Up</button>
            </div>
          </div>
        </form>
      </div>
END;
      }
      else{
				if ($_SESSION['type'] == 1) {
					// If Student:
				} else if ($_SESSION['type'] == 2) {
					// If TA:
					
				} else if ($_SESSION['type'] == 3) {
					// If Instructor:
					
				}
				// Signout Button
				print <div class="center"><button id="signout-button" type="button" onClick='location.href="signout.php"' class="signout-button">Sign Out</button></div>
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
