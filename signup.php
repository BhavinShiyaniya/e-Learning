<?php 

include 'config.php';

error_reporting(0);

if (isset($_SESSION["user_id"])) {
    header("Location: welcome");
}

if (isset($_POST["signup"])) {
    $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST["cpassword"]));
    $token = md5(rand());
    $is_tutor = mysqli_real_escape_string($conn, $_POST["is_tutor"]);

    $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email='$email'"));

    if ($password !== $cpassword) {
        echo "<script>alert('Password did not match.');</script>";
    } elseif($check_email > 0) {
        echo "<script>alert('Email already exists.');</script>";
    } 
    else {
        $sql = "INSERT INTO users (full_name, email, password, token, status, is_tutor) VALUES ('$full_name', '$email', '$password', '$token', '0', '$is_tutor')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_POST["full_name"] = "";
            $_POST["email"] = "";
            $_POST["password"] = "";
            $_POST["cpassword"] = "";
            $_POST["is_tutor"] = "";
            $to = $email;
            $subject = "Email verification - e-Learning";

            $message = "
            <html>
            <head>
            <title>{$subject}</title>
            </head>
            <body>
            <p><strong>Dear {$full_name},</strong></p>
            <p>Thanks for registration! Verify your email to access our website. Click below link to verify your email.</p>
            <p><a href='{$base_url}verify-email.php?token={$token}'>Verify Email</a></p>
            </body>
            </html>
            ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= "From: ". $my_email;

            if (mail($to,$subject,$message,$headers)) {
                echo "<script>alert('We have sent a verification link to your email - {$email}.');</script>";
            } else {
                echo "<script>alert('Mail not sent. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('User registration failed.');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
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
            <img src="./img/tutor.png">
        </div>

        <div class="contentBx">
            <div class="formBx" style="margin-top: auto;">
                <h2>signup</h2>
                <form action="" method="post">
                    <div class="inputBx">
                        <span>Name</span>
                        <input type="text" name="full_name" id="name" value="<?php echo $_POST["full_name"]; ?>" required="true">
                    </div>
                    <div class="inputBx">
                        <span>Email</span>
                        <input type="email" name="email" id="email" 
                        value="<?php echo $_POST["email"]; ?>"
                        required="true">
                    </div>
                    <div class="inputBx">
                        <span>Select User Type:</span>
                        <select name="is_tutor" value="<?php echo $_POST["is_tutor"]; ?>" id="is_tutor">
                            <option selected value="student">Student</option>
                            <option value="tutor">Tutor</option>
                        </select>
                    </div>
                    <div class="inputBx">
                        <span>Password</span>
                        <input type="password" name="password" id="password" value="<?php echo $_POST["password"]; ?>" required="true">
                    </div>
                    <div class="inputBx">
                        <span>Re-enter Password</span>
                        <input type="password" name="cpassword" id="repassword" value="<?php echo $_POST["cpassword"]; ?>" required="true">
                    </div>
                    <!-- <div class="remember">
                        <label><input type="checkbox" name="is_tutor" value="tutor" id="is_tutor"> Are you Tutor?</label>
                    </div> -->
                    <div class="remember">
                        <label><input type="checkbox" name="remember" id="remember" checked="true"> Remember me</label>
                    </div>
                    <div class="inputBx">
                        <input type="submit" name="signup" value="Register" onclick="">
                    </div>
                    <div class="inputBx">
                        <p>Already have an account? <a href="login">Login</a></p>
                    </div>
                </form>
            </div>
        </div>

    </section>
</body>
</html>