<?php
include_once("dbconnect.php");


if (isset($_GET['subid'])) {
    $subid = $_GET['subid'];
    $sqlcourses = "SELECT * FROM tbl_subjects WHERE subject_id = '$subid'";
    $stmt = $conn->prepare($sqlcourses);
    $stmt->execute();
    $number_of_result = $stmt->rowCount();
    if ($number_of_result > 0) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();
    } else {
        echo "<script>alert('Product not found.');</script>";
        echo "<script> window.location.replace('index.php')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    
    <title>My tutor</title>
    
</head>

<script>
    
    function w3_open() {
    document.getElementById("mySidebar").style.width = "100%";
    document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}
</script>


</head>


<body >

<header >
        

      
<a href="#" class="logo">  <i > <img src="../images/profile/1.jpg" style="width: 15%"></i>logo</a>

<nav class="navbar" >

    <ul>
     
        <li><a href="index.php">Courses</a></li>
        <li><a href="tutors.php">Tutors</a></li>
        <li><a href="#course">Subscription</a></li>
        <li><a href="#review">Profile</a></li>
        <li> <a href="login.php">Log Out</a></li>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>

    </ul>
</nav>

<div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <a href="index.php" class="w3-bar-item w3-button">Courses</a>
        <a href="tutors.php" class="w3-bar-item w3-button">Tutors</a>
        <a href="#" class="w3-bar-item w3-button">Subscription</a>
        <a href="#" class="w3-bar-item w3-button">Profile</a>
        <a href="#" class="w3-bar-item w3-button">Logout</a>
    </div>

    <div class="w3-purple">
        <button class="w3-button w3-purple w3-xlarge" onclick="w3_open()">☰</button>
    </div>
            
<div class="fas fa-bars"></div>

</header>


<div class="content">
 
    <h1>Course Details</h1>


</div>


    <div class="w3-bar w3-pink">
        <a href="index.php" class="w3-bar-item w3-button w3-right">Back</a>
    </div>

   <div>
    <?php
        foreach ($rows as $subject) {
            $subid = $subject['subject_id'];
            $subname = $subject['subject_name'];
            $subss = $subject['subject_sessions'];
            $subprice = $subject['subject_price'];
            $subdes = $subject['subject_description'];
            $subrat = $subject['subject_rating'];
        }
        
        echo "<div class='w3-padding w3-center'>
        <img class='w3-image resimg' src=../assets/courses/$subid.png"." ></div><hr>
       
        <div class='w3-container w3-padding-large '>
       <h4> <b>$subname</b> </h4>


    <span class = 'price'>Price:RM $subprice</span>

<p>Session:  $subss</p>
<p>Rating: $subrat</p>
<p>Description:  $subdes</p>
</div>
        
        ";




    ?>
    </div>
</body>

</html>