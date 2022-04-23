<?php 

include 'config.php';

error_reporting(0);

if (isset($_POST["send"])) {
    $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    $sql = "INSERT INTO contact (full_name, email, phone, message) VALUES ('$full_name', '$email', '$phone', '$message')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_POST["full_name"] = "";
        $_POST["email"] = "";
        $_POST["phone"] = "";
        $_POST["message"] = "";
    } else {
        echo "<script>alert('Message not sent, try again.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="contact.css">
</head>

<body>
    <nav>
        <ul>
            <a href="index"><li class="brand"><img src="./img/logo3.png" alt="logo" id="#logo">e-Learning</li></a>
            <a href="index"><li>Home</li></a>
            <a href="courses"><li>Courses</li></a>
            <a href="about"><li>About</li></a>
            <a href="contact" class="active"><li>Contact</li></a>

            <div class="right">
                <a href="login"><button class="btn">Log In</button></a>
            </div>
        </ul>
    </nav>

    <section>
        <div class="imgBx">
            <img src="./img/contact4.jpg">
        </div>

        <div class="contentBx">
            <div class="formBx">
                <h2>Contact</h2>
                <form method="post" action="">
                    <div class="inputBx">
                        <span>Full Name</span>
                        <input type="text" name="full_name" id="name" value="<?php echo $_POST["full_name"]; ?>" required="true">
                    </div>
                    <div class="inputBx">
                        <span>Email</span>
                        <input type="email" name="email" id="email" value="<?php echo $_POST["email"]; ?>" required="true">
                    </div>
                    <div class="inputBx">
                        <span>Phone</span>
                        <input type="tel" name="phone" id="phone" minlength="10" maxlength="10" value="<?php echo $_POST["phone"]; ?>" required="true">
                    </div>
                    <div class="inputBx">
                        <span>Details</span>
                        <textarea id="message" name="message" value="<?php echo $_POST["message"]; ?>" rows="5" cols="75" required="true"></textarea>
                    </div>
                    <div class="inputBx">
                        <input type="submit" name="send" value="Send Message" onclick="">
                    </div>
                    
            </div>

            </form>
        </div>
        </div>

    </section>
</body>

</html>