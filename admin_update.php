<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index");
} elseif (isset($_SESSION["user_id"]) && $_SESSION["role"]=="student") {
    header("Location: student");
    // echo $_SESSION["user_id"];
    // echo $_SESSION["role"];
}

include 'config.php';

$id = $_GET['edit'];

if (isset($_POST['update_course'])) {
    $full_name = $_POST['full_name'];
    $course_title = $_POST['course_title'];
    $course_description = $_POST['course_description'];
    $course_video = $_FILES['course_video']['name'];
    $course_video_tmp_name = $_FILES['course_video']['tmp_name'];
    $course_video_folder = 'uploaded_video/'.$course_video;

    $couse_poster = $_FILES['couse_poster']['name'];
    $couse_poster_tmp_name = $_FILES['couse_poster']['tmp_name'];
    $couse_poster_size = $_FILES['couse_poster']['size'];
    $couse_poster_new_name = rand() . $couse_poster;

    if(empty($course_title) || empty($course_description) || empty($course_video) || empty($couse_poster)){
        $message[] = 'please fill out all!';
    } elseif ($couse_poster_size < 5242880) {
        $update_data = "UPDATE courses SET title='$course_title', description='$course_description', full_name='$full_name', video='$course_video', photo='$couse_poster_new_name' WHERE id = '$id'"; 
        $upload = mysqli_query($conn, $update_data);
        if($upload) {
            move_uploaded_file($course_video_tmp_name, $course_video_folder);
            move_uploaded_file($couse_poster_tmp_name, "uploaded_poster/" . $couse_poster_new_name);
            $message[] = 'new course updated successfully';
            header('Location: admin');
        } else {
            // $message[] = 'please fill out all!';
            $message[] = 'could not update the course';
        }
    }
    else {
        echo "<script>alert('Photo is too big. Maximum photo uploading size is 5MB.');</script>";
    }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update</title>
    <link rel="stylesheet" href="admindashboard.css">
</head>
<body>
    
<?php
    if(isset($message)){
        foreach($message as $message){
            echo '<span class="message">'.$message.'</span>';
        }
    }
?>

<div class="container">
<div class="admin-product-form-container centered">

    <?php
        $select = mysqli_query($conn, "SELECT * FROM courses WHERE id = '$id'");
        while($row = mysqli_fetch_assoc($select)){
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <h3>update the course</h3>
        <input type="text" placeholder="Enter Course Title" value="<?php echo $row['title']; ?>" name="course_title" class="box">
        <input type="text" placeholder="Enter Course Description" value="<?php echo $row['description']; ?>" name="course_description" class="box">
        <label for="course_video" style="font-size: 1.5rem;">Select a video:</label>
        <input type="file" accept="video/*" name="course_video" value="<?php echo $row['video']; ?>" class="box">
        <div class="inputBx">
            <video width="220" height="140" controls muted>
                <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/mp4">
                <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/ogg">
                <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/webM">
                Your browser does not support the video tag.
            </video>
        </div>
        <label for="couse_poster" style="font-size: 1.5rem;">Select a cover image:</label>
        <input type="file" accept="image/*" name="couse_poster" class="box" >
        <div class="inputBx">
            <img src="uploaded_poster/<?php echo $row["photo"]; ?>" width="150px" height="auto" alt="">
        </div>

        <?php
            $sql = "SELECT * FROM users WHERE id='{$_SESSION["user_id"]}'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row1 = mysqli_fetch_assoc($result)) {
        ?>
        <input type="hidden" name="full_name" id="full_name" value="<?php echo $row1['full_name']; ?>" required>
    
        <input type="submit" class="btn" name="update_course" value="update course">
        <a href="admin.php" class="btn"><i class="fas fa-arrow-left" style="padding-right: 20px;"></i> go back</a>
    </form>

    <?php
            }
        }
    ?> 


    <?php }; ?>

</div>
</div>

</body>
</html>