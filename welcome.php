<?php

session_start();

// echo $_SESSION["user_id"];

if (!isset($_SESSION["user_id"])) {
    header("Location: index");
} 
//elseif (isset($_SESSION["user_id"]) && $_SESSION["role"]=="student") {
//     header("Location: student.php");
//     // echo $_SESSION["user_id"];
//     // echo $_SESSION["role"];
// }

include 'config.php';

if (isset($_POST["submit"])) {
    $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST["cpassword"]));

    // $check_role = mysqli_query($conn, "SELECT * FROM users WHERE is_tutor='$is_tutor'");
    // $row1 = mysqli_fetch_assoc($check_role);
    // $_SESSION["role"] = $row1['is_tutor'];

    if ($password === $cpassword) {
        $photo_name = $_FILES["photo"]["name"];
        $photo_tmp_name = $_FILES["photo"]["tmp_name"];
        $photo_size = $_FILES["photo"]["size"];
        $photo_new_name = rand() . $photo_name;

        if ($photo_size > 5242880) {
            echo "<script>alert('Photo is too big. Maximum photo uploading size is 5MB.');</script>";
        } else {
            $sql = "UPDATE users SET full_name='$full_name', password='$password', photo='$photo_new_name' WHERE id='{$_SESSION["user_id"]}'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
            echo "<script>alert('Profile updated successfully.');</script>";
            move_uploaded_file($photo_tmp_name, "uploads/" . $photo_new_name);
            } else {
            echo "<script>alert('Profile can not updated.');</script>";
            }
        }
    } else {
        echo "<script>alert('Password not matched. Please try again.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page - e-Learning</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <nav>
        <ul>
            <a href="index"><li class="brand"><img src="./img/logo3.png" alt="logo" id="#logo">e-Learning</li></a>
            <a href="index" class="active"><li>Home</li></a>
            <a href="courses"><li>Courses</li></a>
            <a href="about"><li>About</li></a>
            <a href="contact"><li>Contact</li></a>

            <div class="right">
                <!-- <a href="/login.html" class="btn"><li>Log In</li></a> -->
                <?php
                    $sql = "SELECT * FROM users WHERE id='{$_SESSION["user_id"]}'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div style="display: flex; flex-direction: row; align-items: center;">
                    <div style="padding-right: 12px; font-size: 20px">
                        <span>Welcome, <?php echo $row['full_name']; ?>   </span>
                    </div>
                        <a href="logout"><img style="border-radius: 50%;" src="uploads/<?php echo $row["photo"]; ?>" width="50px" height="auto" alt=""></a>
                    </div>
                </div>
                <?php
                        }
                    }

                ?>  
            </div>
        </ul>
    </nav>

    <section>
        <div class="imgBx">
            <img src="./img/contact1.jpg">
        </div>

        <div class="contentBx">
            <div class="formBx" style="margin-top: auto;">
                <h2>Profile</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <?php

                        $sql = "SELECT * FROM users WHERE id='{$_SESSION["user_id"]}'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="inputBx">
                        <span>Full Name</span>
                        <input type="text" name="full_name" id="full_name" value="<?php echo $row['full_name']; ?>" required>
                        </div>
                        <div class="inputBx">
                            <span>Email</span>
                            <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>" disabled required>
                        </div>
                        <div class="inputBx">
                            <span>User Type</span>
                            <input type="text" name="is_tutor" id="is_tutor" value="<?php echo $row['is_tutor']; ?>" disabled required>
                        </div>
                        <div class="inputBx">
                            <span>Password</span>
                            <input type="password" name="password" id="password" value="<?php echo $row['password']; ?>" required>
                        </div>
                        <div class="inputBx">
                            <span>Confirm Password</span>
                            <input type="password" name="cpassword" id="cpassword" value="<?php echo $row['password']; ?>" required>
                        </div>
                        <div class="inputBx">
                            <span>Photo</span>
                            <input type="file" accept="image/*" name="photo" id="photo" required>
                        </div>
                        <div class="inputBx">
                            <img src="uploads/<?php echo $row["photo"]; ?>" width="150px" height="auto" alt="">
                        </div>
                        <?php
                            }
                        }

                    ?>  
                    <div class="inputBx">
                        <input type="submit" name="submit" value="Update Profile">
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>