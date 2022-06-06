<?php

include_once("dbconnect.php");
// should only let us receive the data and not change its state. Hence it is only used to view something and not to change it.
// get method is appended to the URL. Get request is better for the data which does not need to be secure

     
    
$sqltutors = "SELECT * FROM tbl_tutors";

$results_per_page = 10; //maximum 20 product per page
 //determines the page number the user is currently visiting. In case if it is not present, by default it is set page number to 1.
if (isset($_GET['pageno'])) {  
     $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page; //Page1 - A to J (1-10)    Page 2 - K to T (11-20)

 
} else {
     $pageno = 1;
    $page_first_result = 0;
}

$stmt = $conn->prepare($sqltutors);
$stmt->execute(); //Select from 

$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqltutors = $sqltutors . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqltutors);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

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

<nav class="navbar">
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

<section class="home" id="home">
<div class="content">
    <h1>Tutor Page</h1>
    <p>"You can choose tutor you want" </p>
 
</div>
<div class = "display-style-btns">
                <button type = "button" id = "grid-active-btn">
                    <i class = "fas fa-th"></i>
                </button>
                <button type = "button" id = "details-active-btn">
                    <i class = "fas fa-list-ul"></i>
                </button>
            </div>

<div class="w3-grid-template">
        <?php
        $i = 0;
        foreach ($rows as $tutors) {
            $i++;
            $ttid = $tutors['tutor_id'];
            $ttname = $tutors['tutor_name'];
            $ttphone = $tutors['tutor_phone'];
            $ttmail = $tutors['tutor_email'];
            $ttdes = $tutors['tutor_description'];
            echo"
  <div class = 'item-list'>

  <div class = 'item'>
  <div class = 'item-img w3-border-right'>
  <img class='w3-image' src=../assets/tutors/$ttid.jpg" .
  " style='width:100%;height:250px'></a><hr>

    
      </div>
 

  <div class = 'item-detail'>
<div class = 'item-name'>$ttname</a> </div>

<div class = 'item-price'>
    <span class = 'price'>Phone:$ttphone</span>
  </div>

<p>Email:  $ttmail</p>

<p>Description:  $ttdes</p>
</div>
 </div>
  </div>";
            
        }
        ?>
    </div>
    <br>
    <?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + 10;
    } else {
        $num = $pageno * 10 - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "tutors.php?pageno=' . $page . '" style=
            "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
    <br>





<footer class="w3-footer w3-center w3-white w3-bottom">
        <p>created by <span>Loon 278884</span> </p>
    </footer>
    <script src = "../js/grid.js"></script>

    </body>


</html>