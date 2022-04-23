<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

include 'config.php';

$id = $_GET['edit'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course View</title>

<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
    <!-- custom css file link -->
    <link rel="stylesheet" href="courses.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="admindashboard.css">
</head>
<body>
<?php include 'header.php'; ?>

<div>
<a href="courses" class="btn" style="width: 20rem; margin-left: 10px;"><i class="fas fa-arrow-left" style="padding-right: 20px;"></i> go back</a>
<?php 
    $select = mysqli_query($conn, "SELECT * FROM courses WHERE id='$id'");
    while($row = mysqli_fetch_assoc($select)){ 
?>
<div class="container">
    <video width="100%" height="450" poster="uploaded_poster/<?php echo $row["photo"]; ?>" autoplay controls>
    <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/mp4">
    <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/ogg">
    <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/webM">
    Your browser does not support the video tag.
    </video>
    <div>
    <span style="font-size: 2.5rem; font-weight: bold;"><?php echo $row['title']; ?></span><br>
    </div>
    <div>
    <span style="font-size: 1.4rem;"><b>Prepared by : </b><?php echo $row['full_name']; ?></span><br>
    </div><br>
    <div>
    <span style="font-size: 1.3rem;"><b>Details : </b><br><?php echo $row['description']; ?></span>
    </div>

</div>
<?php } ?>
</div>

<!-- custom js file link  -->
<script src="script.js"></script>
</body>
</html>