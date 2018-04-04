function showMenu() {
  // Get the navbar object
  var navbar = document.getElementById("navbar");
  // Check if the class is just navbar if it is, switch it to navbar and responsive, otherwise
  if (navbar.className === "navbar") {
    navbar.className += " responsive";
  } else {
    navbar.className = "navbar";
  }
}
