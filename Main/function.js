function logFunc() {
  window.location.href = "login.php";
}

function showModal() {
  var modal = document.getElementById('createPostModal');
  var overlay = document.getElementById('overlay');

  modal.style.display = 'block';
  modal.querySelector('textarea').focus(); // Auto-focus on textarea
  overlay.style.display = 'block'; // Show the overlay
}

function closeModal() {
  var modal = document.getElementById('createPostModal');
  var overlay = document.getElementById('overlay');

  modal.style.display = 'none';
  overlay.style.display = 'none'; // Hide the overlay
}
function myFunction() {
  var element = document.body;
  element.classList.toggle("dark-mode");

  // Save the theme preference in a cookie
  var expires = new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toUTCString(); // 30 days
  document.cookie = "darkMode=" + element.classList.contains("dark-mode") + "; expires=" + expires + "; path=/";

  // Call a function to update the text color based on dark mode
  updateTextColor(element.classList.contains("dark-mode"));
}

// Function to apply saved theme on page load
function applySavedTheme() {
 var isDarkMode = document.cookie.includes("darkMode=true");
 var element = document.body;

 if (isDarkMode) {
     element.classList.add("dark-mode");
 } else {
     element.classList.remove("dark-mode");
 }

 // Call a function to update the text color based on dark mode
 updateTextColor(isDarkMode);

 // Call a function to update the post background color based on dark mode
 updatePostBackgroundColor(isDarkMode);
}

/// Function to update text color based on dark mode
function updateTextColor(isDarkMode) {
  var spcRantElement = document.querySelector(".spc_rant");
  var rantPostsElements = document.querySelectorAll(".comment, .comment-content, .time-posted, .heart-count, .user-info, .comment-box, .post h2, .post p");

  if (isDarkMode) {
      // Set the text color to white when dark mode is active
      spcRantElement.style.color = "white";

      // Set text color for all elements with classes "comment," "comment-content," "post h2," and "post p"
      rantPostsElements.forEach(function (element) {
          element.style.color = "white";
      });
  } else {
      // Set the text color to black when dark mode is not active
      spcRantElement.style.color = "black";

      // Set text color for all elements with classes "comment," "comment-content," "post h2," and "post p"
      rantPostsElements.forEach(function (element) {
          element.style.color = "black";
      });
  }
}
 
 // Function to update post background color based on dark mode
 function updatePostBackgroundColor(isDarkMode) {
  var postElements = document.querySelectorAll(".post");
 
  if (isDarkMode) {
      // Set the background color to #414141 when dark mode is active
      postElements.forEach(function (post) {
          post.style.backgroundColor = "#414141";
      });
  } else {
      // Set the background color to the default color when dark mode is not active
      postElements.forEach(function (post) {
          post.style.backgroundColor = ""; // or set it to your default color
      });
  }
 }
 
 // Call applySavedTheme function on page load
 document.addEventListener("DOMContentLoaded", applySavedTheme);
 