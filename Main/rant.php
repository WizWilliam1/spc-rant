<?php
// Include the database connection file
include "database.php";

// Set the time zone to Asia/Manila
date_default_timezone_set('Asia/Manila');

// Start a new session if one doesn't exist
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to calculate the time elapsed since a given datetime
function time_elapsed_string($datetime, $full = false)
{
    // Current time
    $now = new DateTime();
    // The time in the past
    $ago = new DateTime($datetime);
    // The difference between the two times
    $diff = $now->diff($ago);

    // If the difference is less than a minute, return 'just now'
    if (
        $diff->y == 0 &&
        $diff->m == 0 &&
        $diff->d == 0 &&
        $diff->h == 0 &&
        $diff->i == 0 &&
        $diff->s < 60
    ) {
        return "Just Now";
    }

    // Calculate the number of weeks and adjust the number of days accordingly
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    // The string representations of each time unit
    $string = [
        "y" => "year",
        "m" => "month",
        "w" => "week",
        "d" => "day",
        "h" => "hour",
        "i" => "minute",
        "s" => "second",
    ];

    // Iterate over each time unit and format it for display
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . " " . ($diff->$k > 1 ? $v . "s" : $v);
        } else {
            unset($string[$k]);
        }
    }

    // If not displaying the full time difference, only use the largest unit
    if (!$full) {
        $string = array_slice($string, 0, 1);
    }

    // Return the formatted time difference
    return $string ? implode(", ", $string) . " ago" : "just now";
}

// Fetch posts with comments from the database
$sql = "SELECT posts.id, TITLE, CONTENT, posts.created_at as timestamp, comments.comment as comment, comments.timestamp as comment_timestamp
     FROM posts
     LEFT JOIN comments ON posts.id = comments.post_id
     ORDER BY posts.id DESC";
$result = $conn->query($sql);

// Initialize an array to store the posts
$posts = [];
// Initialize a counter for anonymous users
$anonymousCounter = isset($_SESSION["anonymousCounter"])
    ? $_SESSION["anonymousCounter"]
    : 0;

// If there are posts, fetch them into the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get the post ID
        $postId = $row["id"];
        // Add the time elapsed since the post was created
        $row["timeAgo"] = time_elapsed_string($row["timestamp"]);
        // Add the username or an anonymous identifier
        $row["user"] = isset($_SESSION["Username"])
            ? htmlspecialchars($_SESSION["Username"])
            : "Anonymous#" . str_pad($anonymousCounter, 3, "0", STR_PAD_LEFT);
        // Initialize an array to store the comments
        $row["comments"] = [];
        // Add the post to the posts array
        $posts[$postId] = $row;
        $anonymousCounter++;
    }
}

// Fetch comments for each post from the database
$sql = "SELECT comment_id, post_id, timestamp, user_id, comment FROM comments";
$result = $conn->query($sql);

// If there are comments, fetch them into the posts array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get the post ID
        $postId = $row["post_id"];
        // Add the username or an anonymous identifier
        $row["user"] = isset($_SESSION["Username"])
            ? htmlspecialchars($_SESSION["Username"])
            : "Anonymous#" . str_pad($anonymousCounter, 3, "0", STR_PAD_LEFT);
        // Add the comment to the post
        $posts[$postId]["comments"][] = $row;
        $anonymousCounter++;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="timeline.css">
    <script src="function.js"></script>
    <script>window.onload = applySavedTheme;</script>
</head>

<body>
    <div id="overlay" class="overlay"></div>
    <div class="rectangle">
        <div class="logo-container">
            <div class="logo"></div>
            <div class="spc_rant"> SPC RANT </div>
            <div class="home">
                <a href="index.php"><img width="30" height="30" src="https://img.icons8.com/fluency-systems-filled/96/home.png" alt="home" /></a>
            </div>
        </div>
    </div>
    <br>
    <br>
<!-- Button to Trigger Modal -->
<div class="rant-now-button">
  <button onclick="showModal()">Rant Now</button>
</div>

<!-- The Modal -->
<div id="createPostModal" class="modal">
 <!-- Modal content -->
 <div class="modal-content">
 <span class="close">&times;</span>
 <h2>Create Post</h2>
 <form id="rantForm">
  <label for="title">Title:</label><br>
  <input type="text" id="title" name="title" style="width: 100%; padding: 10px;"><br>
  <label for="content">Content:</label><br>
  <textarea id="content" name="content" style="width: 100%; padding: 10px;"></textarea><br>
  <input type="button" value="Submit" onclick="postRant()" style="background-color: #333; color: white; padding: 10px 20px;">
 </form>
 </div>
</div>

<!-- Create Post Section -->
<div id="createPostModal2" class="create-post" style="display: none;">

        <!-- Post Header -->
        <div class="post-header">
            <!-- User Info -->
            <div class="post-info">
                <h3 class="user-name"><?= isset($_SESSION["Username"])
                    ? $_SESSION["Username"]
                    : "Anonymous" ?></h3>
            </div>
        </div>
        <!-- Post CONTENT -->
        <div class="post-CONTENT" style="text-align: center;">
            <form action="post_rant.php" method="POST" onsubmit="return postRantIfFilled();">
                <input type="text" id="TITLE" name="TITLE" placeholder="Enter a TITLE" style="width: 95%; margin-bottom: 10px;">
                <textarea id="CONTENT" name="CONTENT" placeholder="What's on your mind?"></textarea>
                <!-- Post Button -->
                <div style="text-align: right;">
                    <button class="post-button" type="submit">Post</button>
                </div>
            </form>
        </div>
    </div>
    <hr>

<!-- Display the posts -->
<div class="post-container">
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <div class="post-info">
                <div class="user-info">
                    <?= $post["user"] ?>
                </div>
                <div class="time-posted">
                    <?= $post["timeAgo"] ?> <!-- Display time elapsed -->
                </div>
            </div>

            <h2><?= htmlspecialchars($post["TITLE"]) ?></h2>
            <p><?= nl2br(htmlspecialchars($post["CONTENT"])) ?></p>
            <hr>

            <!-- Display the comments section -->
            <div class="comments-section">
                <?php foreach ($post["comments"] as $comment): ?>
                    <div class="comment">
                        <strong><?= htmlspecialchars($comment["user"]) ?>:</strong>
                        <div class="comment-content"><?= htmlspecialchars($comment["comment"]) ?></div>
                    </div>
                <?php endforeach; ?>
                <!-- New code: Comment text box -->
                <div class="comment-box" onclick="showCommentBox(<?= $post["id"] ?>)">
                    Write a comment...
                </div>
                <hr>
                <!-- Like and Comment Icons -->
                <div class="post-actions">
                    <div class="heart-container">
                        <button class="heart-button" onclick="heartPost(this, <?= $post["id"] ?>)">&#10084;</button>
                    </div>
                    <div class="heart-count-container">
                        <span class="heart-count">0</span>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
   function showModal() {
       var modal = document.getElementById('createPostModal');
       modal.style.display = (modal.style.display === 'block') ? 'none' : 'block';
       if (modal.style.display === 'block') {
           modal.querySelector('textarea').focus(); // Auto-focus on textarea
       }
   }

   document.addEventListener("DOMContentLoaded", function () {
       if (typeof applySavedTheme === 'function') {
           applySavedTheme();
       }

       if (typeof updateTextColor === 'function') {
           updateTextColor(document.body.classList.contains("dark-mode"));
       }
   });

 // Get the modal
var modal = document.getElementById("createPostModal");

// Get the button that opens the modal
var btn = document.getElementById("rant-now-button");

// Get the <span> element that closes the modal
var span = document.getElementById("createPostModal").getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
 modal.style.display = "none";
}

// When the user clicks on the button, open the modal 
btn.onclick = function() {
 modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
 modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
 if (event.target == modal) {
   modal.style.display = "none";
 }
}

function postRant() {
 var TITLE = document.getElementById('title').value;
 var CONTENT = document.getElementById('content').value;
 if (TITLE.trim() !== '' && CONTENT.trim() !== '') {
   var xhr = new XMLHttpRequest();
   xhr.open("POST", "post_rant.php", true);
   xhr.setRequestHeader("CONTENT-Type", "application/x-www-form-urlencoded");
   xhr.onreadystatechange = function () {
     if (xhr.readyState == 4 && xhr.status == 200) {
        window.location.href = 'rant.php';
     }
   }
   xhr.send("TITLE=" + encodeURIComponent(TITLE) + "&CONTENT=" + encodeURIComponent(CONTENT));
 }
}

   // Function to handle like button click
function heartPost(heartButton, postId) {
    // Assuming you have a separate element for displaying the like count
    var likeCountElement = heartButton.closest('.post-actions').querySelector('.heart-count');

    if (!likeCountElement) {
        console.error("Like count element not found");
        return;
    }

    // Get the current like count
    var currentLikes = parseInt(likeCountElement.textContent);

    // Increment the like count
    currentLikes++;

    // Update the like count text
    likeCountElement.textContent = currentLikes;

    // Send an AJAX request to update the server about the like action
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "like_post.php", true);
    xhr.setRequestHeader("CONTENT-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response if needed
            alert(xhr.responseText);
        }
    }

    // Prepare the data to be sent
    var data = "post_id=" + encodeURIComponent(postId);

    // Send the request
    xhr.send(data);
}

   // Function to handle comment button click
   function commentPost(postId) {
       // Display a popup/modal for commenting
       var comment = prompt('Enter your comment:');

       // Check if the user entered a comment
       if (comment !== null) {
           // Send an AJAX request to post_comment.php
           var xhr = new XMLHttpRequest();
           xhr.open("POST", "post_comment.php", true);
           xhr.setRequestHeader("CONTENT-Type", "application/x-www-form-urlencoded");
           xhr.onreadystatechange = function () {
               if (xhr.readyState == 4 && xhr.status == 200) {
                  // Handle the response if needed
                  alert(xhr.responseText);
               }
           }

           // Prepare the data to be sent
           var data = "post_id=" + encodeURIComponent(postId) + "&comment=" + encodeURIComponent(comment);
           
           // Send the request
           xhr.send(data);
       }
   }

   function showComments(postId) {
       // Get the comments for the post
       var comments = posts[postId]['comments'];

       // Create a new div element for the comments
       var commentsDiv = document.createElement('div');

       // Add each comment to the div
       comments.forEach(function(comment) {
           var commentElement = document.createElement('p');
           commentElement.textContent = comment['user'] + ': ' + comment['comment'];
           commentsDiv.appendChild(commentElement);
       });

       // Add the comments div to the modal
       var modal = document.getElementById('commentsModal');
       modal.appendChild(commentsDiv);

       // Show the modal
       modal.style.display = 'block';
   }
</script>

<script>
    // Function to show the comment text box
    function showCommentBox(postId) {
        var commentBox = prompt('Write a comment:');
        if (commentBox !== null && commentBox.trim() !== '') {
            // Send an AJAX request to post_comment.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "post_comment.php", true);
            xhr.setRequestHeader("CONTENT-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response if needed
                    window.location.href = 'rant.php';
                }
            }

            // Prepare the data to be sent
            var data = "post_id=" + encodeURIComponent(postId) + "&comment=" + encodeURIComponent(commentBox);
            
            // Send the request
            xhr.send(data);
        }
    }
</script>
</body>

</html>