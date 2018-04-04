// Scrolling functionality
// Call the scroll to top function when the user scrolls the width of the navbar
window.onscroll = function() {
  showScrollButton("scroll-to-top")
};
// Function to check whether to show scroll button
function showScrollButton(buttonID) {
  // Get the navbar height
  var navbarHeight = document.getElementById('navbar').clientHeight;
  // Check if the user scrolled the height of the navbar
  if (window.pageYOffset > navbarHeight) {
    // Show the button if they did indeed scroll past it
    document.getElementById(buttonID).style.display = "block";
  } else {
    // otherwise hide the button again, ie. scrolling back to top manually
    document.getElementById(buttonID).style.display = "none";
  }
}
// Scroll to the top function
function scrollToTop(){
  window.scrollTo(0, 0);
}



