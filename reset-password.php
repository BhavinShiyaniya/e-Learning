<?php 

include 'config.php';

error_reporting(0);

if (isset($_SESSION["user_id"])) {
    header("Location: welcome");
}

if (isset($_POST["resetPassword"])) {
    $password = mysqli_real_escape_string($conn, md5($_POST["new_password"]));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST["cnew_password"]));
    
    if ($password === $cpassword) {
        $sql = "UPDATE users SET password='$password' WHERE token='{$_GET["token"]}'";
        mysqli_query($conn, $sql);
        header("Location: login");
    } else {
        echo "<script>alert('Password not matched.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <nav>
        <ul>
            <a href="index"><li class="brand"><img src="img/logo3.png" alt="logo" id="#logo">e-Learning</li></a>
            <a href="index"><li>Home</li></a>
            <a href="courses"><li>Courses</li></a>
            <a href="about"><li>About</li></a>
            <a href="contact"><li>Contact</li></a>
        </ul>
    </nav>

    <section>
        <div class="imgBx">
            <img src="img/learning_boy.png">
        </div>

        <div class="contentBx">
            <div class="formBx">
                <h2>Reset Password</h2>
                <form method="post" action="">
                    <div class="inputBx">
                        <span>New Password</span>
                        <input type="password" name="new_password" id="new_password" value="<?php echo $_POST["new_password"]; ?>" required="true">
                    </div>
                    <div class="inputBx">
                        <span>Confirm New Password</span>
                        <input type="password" name="cnew_password" id="cnew_password" value="<?php echo $_POST["cnew_password"]; ?>" required="true">
                    </div>
                    <div class="inputBx">
                        <input type="submit" name="resetPassword" value="Reset Password">
                    </div>
                    <div class="inputBx">
                        <p>Go back to <a href="login">Login </a></p>
                    </div>
                </form>
            </div>
        </div>

    </section>
</body>
</html>