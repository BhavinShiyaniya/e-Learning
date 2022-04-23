<?php 

include 'config.php';

error_reporting(0);

if (isset($_SESSION["user_id"])) {
    header("Location: welcome");
}

if (isset($_POST["resetPassword"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($check_email) > 0) {
        $data = mysqli_fetch_assoc($check_email);
        
        $to = $email;
        $subject = "Reset Password - e-Learning";

        $message = "
        <html>
        <head>
        <title>{$subject}</title>
        </head>
        <body>
        <p><strong>Dear {$data['full_name']},</strong></p>
        <p>Forgot Password? Not a problem. Click below link to reset your password.</p>
        <p><a href='{$base_url}reset-password.php?token={$data['token']}'>Reset Password</a></p>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= "From: ". $my_email;

        if (mail($to,$subject,$message,$headers)) {
            echo "<script>alert('We have sent a reset password link to your email - {$email}.');</script>";
        } else {
            echo "<script>alert('Mail not sent. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Email not found.');</script>";
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
                        <span>Email</span>
                        <input type="email" name="email" id="email" value="<?php echo $_POST["email"]; ?>"    required="true">
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