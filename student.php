<?php

include 'config.php';

session_start();

error_reporting(0);

if (!isset($_SESSION["user_id"])) {
    header("Location: login");
} elseif (isset($_SESSION["user_id"]) && $_SESSION["role"]=="tutor") {
    header("Location: admin");
}

// echo $_SESSION["user_id"];
// echo $_SESSION["role"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link -->
    
    <link rel="stylesheet" href="master.css">
    <!-- <link rel="stylesheet" href="admindashboard.css"> -->
    <link rel="stylesheet" href="courses.css">
    <link rel="stylesheet" href="sidebar.css">
</head>
<body>
<?php include 'header_student.php' ?>

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

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<a href="index" class="btn" style="width: 20rem; margin-left: 10px;"><i class="fas fa-arrow-left" style="padding-right: 20px;"></i> go back</a>

<section class="products" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT * FROM `courses` WHERE title LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0 && !empty($search_item)){
         while($row = mysqli_fetch_assoc($select_products)){
   ?>
   <div class="box-container" id="searchresult">

      <div class="box">
         
          <video width="220" height="140" poster="uploaded_poster/<?php echo $row["photo"]; ?>">
             Your browser does not support the video tag.
         </video><br>
         <span style="font-weight: bold; font-size: 2rem;"><?php echo $row['title']; ?></span><br>
         <span style="font-size: 1.4rem;"><b>Prepared by : </b><?php echo $row['full_name']; ?></span><br>
         <!-- <span style="font-size: 1.2rem;"><?php echo $row['description']; ?></span> -->

         <a href="course_view?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-eye"></i> View </a>
      </div>

 </div>
   <?php
            }
         }elseif(empty($search_item)){
            echo '<p></p>';
         }else{
            echo '<h1 class="message">no result found!</h1>';
         }
      }else{
         echo '<p></p>';
      }
   ?>
   </div>
  

</section>

<div class="container">

<section class="products">

   <h1 class="heading">latest courses</h1>

   <?php

        $select = mysqli_query($conn, "SELECT * FROM courses");

    ?>

   <div class="box-container">

   <?php while($row = mysqli_fetch_assoc($select)){ ?>

         <div class="box">
            
             <video width="220" height="140" poster="uploaded_poster/<?php echo $row["photo"]; ?>">
                <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/mp4">
                <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/ogg">
                <source src="uploaded_video/<?php echo $row['video']; ?>" type="video/webM">
                Your browser does not support the video tag.
            </video><br>
            <span style="font-weight: bold; font-size: 2rem;"><?php echo $row['title']; ?></span><br>
            <span style="font-size: 1.4rem;"><b>Prepared by : </b><?php echo $row['full_name']; ?></span><br>
            <!-- <span style="font-size: 1.2rem;"><?php echo $row['description']; ?></span> -->
            <a href="course_view?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-eye"></i> View </a>
         </div>

      <?php } ?>

   </div>

</section>

</div>

<!-- custom js file link  -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script src="script.js"></script>
</body>
</html>