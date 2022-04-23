<header class="header">

<div class="wrapper">
       <div class="section">
    <div class="top_navbar">
      <div class="hamburger">
        <a href="#">
          <i class="fas fa-bars"></i>
        </a>
      </div>
    </div>

    <div class="sidebar">
    <?php

$sql = "SELECT * FROM users WHERE id='{$_SESSION["user_id"]}'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
            <div class="profile">
                <img src="uploads/<?php echo $row["photo"]; ?>" alt="profile_picture">
                <h3><?php echo $row['full_name']; ?></h3>
                <p><?php echo $row['email']; ?></p>
            </div>
            <?php
                            }
                        }

                    ?>  
            <ul>
                <li>
                    <a href="student" class="active">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="item">Home</span>
                    </a>
                </li>
                <li>
                    <a href="courses">
                        <span class="icon"><i class="fas fa-book"></i></span>
                        <span class="item">View Courses</span>
                    </a>
                </li>
                <li>
                    <a href="welcome">
                        <span class="icon"><i class="fas fa-user"></i></span>
                        <span class="item">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="logout">
                        <span class="icon"><i class="fas fa-sign-out"></i></span>
                        <span class="item">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

</header>