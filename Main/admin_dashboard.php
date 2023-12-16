<?php
include 'database.php';

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT * FROM posts ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>Admin Dashboard</title>
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
               <h1 id="username">@<?php echo isset($_SESSION['Username']) ? $_SESSION['Username'] : 'Anonymous'; ?></h1>
               <h6 id="random-link"><a href="https://www.spc-rant.com/user/37K41VcAeHYa">https://www.spc-rant.com/user/37K41VcAeHYa</a></h6>
           </div>
       </div>
       <div class="logout"><a href="?logout=true"><img width="30" height="30" src="https://img.icons8.com/fluency-systems-regular/48/000000/logout-rounded-left.png" alt="logout"/></a></div>
   </div>
   <br><hr>

   <?php
while ($posts = $result->fetch_assoc()) :
?>
    <div id="post">
        <div class="post">
            <h3>
                <?php echo $posts['TITLE'] ?>
            </h3>
            <p>
                <?php echo $posts['CONTENT'] ?>
            </p>
            <form action="delete_post.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                <input type="hidden" name="post_id" value="<?php echo $posts['ID']; ?>">
                <button type="submit" class="btn btn-danger btn-sm" name="deletePost">Delete</button>
            </form>
        </div>
    </div>
<?php endwhile; ?>

</div>
</body>
</html>
