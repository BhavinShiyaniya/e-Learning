<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login");
} elseif (isset($_SESSION["user_id"]) && $_SESSION["role"]=="student") {
    header("Location: student");
    // echo $_SESSION["user_id"];
    // echo $_SESSION["role"];
}

include 'config.php';

if (isset($_POST['add_course'])) {
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
        $insert = "INSERT INTO courses(title, description, full_name, video, photo) VALUES('$course_title', '$course_description', '$full_name', '$course_video', '$couse_poster_new_name')";
        $upload = mysqli_query($conn, $insert);
        if($upload) {
            move_uploaded_file($course_video_tmp_name, $course_video_folder);
            move_uploaded_file($couse_poster_tmp_name, "uploaded_poster/" . $couse_poster_new_name);
            $message[] = 'new course added successfully';
        } else {
            $message[] = 'could not add the course';
        }
    }
    else {
        echo "<script>alert('Photo is too big. Maximum photo uploading size is 5MB.');</script>";
    }
};

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM courses WHERE id = $id");
    if($delete_query){
        header("Location: admin");
        $message[] = 'product has been deleted';
    }else{
        header('location:admin');
        $message[] = 'product could not be deleted';
   };
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="master.css">
    <link rel="stylesheet" href="admindashboard.css">
    <link rel="stylesheet" href="sidebar.css">
</head>
<body>
    <?php include 'header.php' ?>
    <div class="search">
            <form action="" method="post">
                <input type="text"
                    placeholder=" Search Courses"
                    name="search">
                <button type="submit" name="submit" value="search">
                    <i class="fa fa-search"
                        style="font-size: 18px;">
                    </i>
                </button>
            </form>
        </div>
 
    <?php
    if(isset($message)){
    foreach($message as $message){
        echo '<span class="message">'.$message.'</span>';
    }
}
?>

<div class="container">
    <div class="admin-product-form-container">

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>add a new course</h3>
            <input type="text" placeholder="Enter Course Title" name="course_title" class="box" required>
            <input type="text" placeholder="Enter Course Description" name="course_description" class="box" required>
            <label for="course_video" style="font-size: 1.5rem;">Select a video:</label>
            <input type="file" accept="video/*" name="course_video" class="box" placeholder="Upload a video file here" required>
            <label for="couse_poster" style="font-size: 1.5rem;">Select a cover image:</label>
            <input type="file" accept="image/*" name="couse_poster" class="box" placeholder="Upload a video file here" required>
            <?php
                $sql = "SELECT * FROM users WHERE id='{$_SESSION["user_id"]}'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result)) {
            ?>
            <input type="hidden" name="full_name" id="full_name" value="<?php echo $row1['full_name']; ?>" required>
            <input type="submit" class="btn" name="add_course" value="add course">
        </form>

        <?php
                }
            }
        ?> 

    </div>

    <div class="product-display">
        <table class="product-display-table">
        
            
            <?php
      if(isset($_POST['submit'])){ 
        $search_item = $_POST['search'];
        if(!empty($search_item)) { ?>
        <thead>
            <tr>
                <th>course video</th>
                <th>course title</th>
                <th>course description</th>
                <th>action</th>
            </tr>
        </thead>

      <?php
      }
          $select_products = mysqli_query($conn, "SELECT * FROM `courses` WHERE title LIKE '%{$search_item}%'") or die('query failed');
          if(empty($search_item)){
              echo "<p></p>"; 
            }
            elseif(mysqli_num_rows($select_products) > 0){
                while($row = mysqli_fetch_assoc($select_products)){
                    ?>
                    

            <tr>
                <td><video width="220" height="140" controls muted poster="uploaded_poster/<?php echo $row["photo"]; ?>">
                    <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/mp4">
                    <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/ogg">
                    <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/webM">
                    Your browser does not support the video tag.
                    </video></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
                    <a href="admin.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
                </td>
            </tr>

            <?php
            }
         }else{
            echo '<h1 class="message">no result found!</h1>';
         }
      }else{
         echo '<p></p>';
      }
   ?>

        </table>
    </div>



    <?php

        $select = mysqli_query($conn, "SELECT * FROM courses");

    ?>

    <div class="product-display">
        <table class="product-display-table">
            <thead>
                <tr>
                    <th>course video</th>
                    <th>course title</th>
                    <th>course description</th>
                    <th>action</th>
                </tr>
            </thead>

            <?php while($row = mysqli_fetch_assoc($select)){ ?>

            <tr>
                <td><video width="220" height="140" controls muted poster="uploaded_poster/<?php echo $row["photo"]; ?>">
                    <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/mp4">
                    <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/ogg">
                    <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/webM">
                    Your browser does not support the video tag.
                    </video></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <a href="admin_update?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
                    <a href="admin?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
                </td>
            </tr>

            <?php } ?>

        </table>
    </div>

</div>

</div>
</div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<!-- custom js file link  -->
<script src="script.js"></script>
</body>
</html>