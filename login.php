<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION["user_id"]) && $_SESSION["role"]=="tutor") {
    header("Location: admin");
    // header("Location: welcome.php");
    // echo $_SESSION["user_id"];
    // echo $_SESSION["role"];
} elseif (isset($_SESSION["user_id"]) && $_SESSION["role"]=="student") {
    header("Location: student");
    // echo $_SESSION["user_id"];
    // echo $_SESSION["role"];
}

if (isset($_POST["signin"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
    $is_tutor = mysqli_real_escape_string($conn, $_POST["is_tutor"]);

    $check_email = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' AND password='$password' AND status='1' AND is_tutor='$is_tutor'");

    $check_role = mysqli_query($conn, "SELECT * FROM users WHERE is_tutor='$is_tutor'");
    $row1 = mysqli_fetch_assoc($check_role);
    $_SESSION["role"] = $row1['is_tutor'];

    if (mysqli_num_rows($check_email) > 0 && $is_tutor=="tutor") {
        $row = mysqli_fetch_assoc($check_email);
        $_SESSION["user_id"] = $row['id'];
        header("Location: admin");
        // header("Location: welcome.php");
    } elseif (mysqli_num_rows($check_email) > 0 && $is_tutor=="student") {
        $row = mysqli_fetch_assoc($check_email);
        $_SESSION["user_id"] = $row['id'];
        header("Location: student");
    } else {
        echo "<script>alert('Login details is incorrect. Please try again.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <nav>
        <ul>
            <a href="index"><li class="brand"><img src="./img/logo3.png" alt="logo" id="#logo">e-Learning</li></a>
            <a href="index"><li>Home</li></a>
            <a href="courses"><li>Courses</li></a>
            <a href="about"><li>About</li></a>
            <a href="contact"><li>Contact</li></a>
        </ul>
    </nav>

    <section>
        <div class="imgBx">
            <img src="./img/learning_boy.png">
        </div>

        <div class="contentBx">
            <div class="formBx">
                <h2>Login</h2>
                <form method="post" action="">
                    <div class="inputBx">
                        <span>Email</span>
                        <input type="email" name="email" id="email" value="<?php echo $_POST["email"]; ?>"    required="true">
                    </div>
                    <!-- <div class="inputBx">
                            <span>User Type:</span>
                            <input type="text" name="is_tutor" id="is_tutor" value="<?php echo $row['is_tutor']; ?>" disabled required>
                    </div> -->
                    <div class="inputBx">
                        <span>Select User Type:</span>
                        <select name="is_tutor" value="<?php echo $_POST["is_tutor"]; ?>" id="is_tutor" required="true">
                            <option selected value="student">Student</option>
                            <option value="tutor">Tutor</option>
                        </select>
                    </div>
                    <!-- <input type="hidden" value="<?php echo $row['is_tutor']; ?>" name="is_tutor"> -->
                    <div class="inputBx">
                        <span>Password</span>
                        <input type="password" name="password" id="password" value="<?php echo $_POST["password"]; ?>" required="true">
                    </div>
                    <div class="remember">
                        <label><input type="checkbox" name="remember" id="remember" checked="true"> Remember me</label>
                    </div>
                    <div class="inputBx">
                        <input type="submit" name="signin" value="Log in">
                    </div>
                    <p style="display: flex;justify-content: flex-end;align-items: center;margin-top: 20px;"><a href="forgot-password" style="color: #53679c;">Forgot Password?</a></p>
                    <div class="inputBx">
                        <p style="margin-top: 10px;">Don't have an account? <a href="signup">Sign up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>