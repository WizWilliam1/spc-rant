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
 }

// Function to update text color based on dark mode
function updateTextColor(isDarkMode) {
   var spcRantElement = document.querySelector(".spc_rant");
   var postTitles = document.querySelectorAll(".post h2");
   var postContents = document.querySelectorAll(".post p");

   if (isDarkMode) {
       // Set the text color to white when dark mode is active
       spcRantElement.style.color = "white";

       // Set post title and content text color to white
       postTitles.forEach(function (title) {
           title.style.color = "white";
       });

       postContents.forEach(function (content) {
           content.style.color = "white";
       });
   } else {
       // Set the text color to black when dark mode is not active
       spcRantElement.style.color = "black";

       // Set post title and content text color to black
       postTitles.forEach(function (title) {
           title.style.color = "black";
       });

       postContents.forEach(function (content) {
           content.style.color = "black";
       });
   }
}

// Call applySavedTheme function on page load
document.addEventListener("DOMContentLoaded", applySavedTheme);