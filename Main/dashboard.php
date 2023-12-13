<?php
include 'database.php';

if (isset($_SESSION['Username'])) {
  $username = $_SESSION['Username'];
  $userId = $db->getUserID(); // Use the method from the Database class

  // Fetch user-specific posts, ordered by ID (or any other column you prefer)
  $sql = "SELECT * FROM `posts` WHERE user_id = '$userId' ORDER BY id DESC";
  $result = $conn->query($sql);
} else {
  header("Location: login.php");
  exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title> <!-- Changed TITLE to title -->
    <link rel="stylesheet" href="dashboard.css">
    <script src="function.js"></script>
</head>
<body>
<div class="rectangle">
    <div class="logo-container">
        <div class="logo"></div>
        <div class="spc_rant">
            SPC RANT
        </div>
        <div class="home"><a href="rant.php"><img width="30" height="30" src="https://img.icons8.com/fluency-systems-filled/96/home.png" alt="home"/></a></div>
    </div>
</div>
<div id="dashboard-container">
    <div class="sidebar">
        <div id="user-profile">
            <img id="profile-icon" src="https://add.pics/images/2023/10/12/image565b9e57a03c8462.png" alt="Profile Icon">
            <div id="profile-details">
                <h1 id="username">@<?php echo $username; ?></h1>
                <!-- <h5 id="join-date">Joined October 2023</h5> -->
                <h6 id="random-link"><a href="https://www.spc-rant.com/user/37K41VcAeHYa">https://www.spc-rant.com/user/37K41VcAeHYa</a></h6>
            </div>
        </div>
        <div class="logout"><a href="?logout=true"><img width="30" height="30" src="https://img.icons8.com/fluency-systems-regular/48/000000/logout-rounded-left.png" alt="logout"/></a></div>
    </div>
    <br><hr>

    <?php while ($posts = $result->fetch_assoc()) : ?>
        <div id="post">
            <div class="post">
                <h3>
                    <?php echo $posts['TITLE'] ?>
                </h3>
                <p>
                    <?php echo $posts['CONTENT'] ?>
                </p>
            </div>
        </div>
    <?php endwhile; ?>

</div>
</body>
</html>
