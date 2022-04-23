<?php

session_start();

include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Learning Platform</title>
    
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="master.css">
    <!-- <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="courses.css"> -->
</head>
<body>
<nav>
        <ul>
            <a href="index"><li class="brand"><img src="./img/logo3.png" alt="logo" id="#logo">e-Learning</li></a>
            <a href="index" class="active"><li>Home</li></a>
            <a href="courses"><li>Courses</li></a>
            <a href="about"><li>About</li></a>
            <a href="contact"><li>Contact</li></a>

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

            <div class="right">
                <a href="login"><button class="btnnav">Log In</button></a>
            </div>
        </ul>
    </nav>

<section class="products" style="padding-top: 0;">

   <div class="box-container" style="margin-top:2px;">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT * FROM `courses` WHERE title LIKE '%{$search_item}%'") or die('query failed');
         if(empty($search_item)){
             echo "<p></p>";
         }
         elseif(mysqli_num_rows($select_products) > 0){
         while($row = mysqli_fetch_assoc($select_products)){
   ?>
   <div class="box-container">

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
         }else{
            echo '<h1 class="message">no result found!</h1>';
         }
      }else{
         echo '<p></p>';
      }
   ?>
   </div>
  

</section>

<section class="home">

   <div class="content">
      <h3>Want to join our Course?</h3>
      <p>Here, World's best tutors are serving their content to the students for make it easy to learn difficult concept easily.</p>
      <a href="signup.php" class="white-btn">Join for Free</a>
   </div>

</section>



<div class="container">

    <h1 class="heading" style="text-decoration: underline; margin-top: 7px;">latest courses</h1>
<section class="products">


   <?php

        $select = mysqli_query($conn, "SELECT * FROM courses LIMIT 6");
        $select_tutor = mysqli_query($conn, "SELECT * FROM users");

    ?>

   <div class="box-container">

   <?php while($row = mysqli_fetch_assoc($select)){ ?>

         <div class="box">
            
             <video width="220" height="140" poster="uploaded_poster/<?php echo $row["photo"]; ?>">
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
<div class="load-more" style="text-align:center;">
  <a href="courses" class="option-btn">load more</a>
</div>

</div>

    <!-- <section>
        <div class="imgBx">
            <img src="./img/online_vision.jpg">
        </div>
    </section> -->

    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>


</body>
</html>