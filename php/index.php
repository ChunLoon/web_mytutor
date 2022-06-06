<?php
include_once("dbconnect.php");
// should only let us receive the data and not change its state. Hence it is only used to view something and not to change it.
// get method is appended to the URL. Get request is better for the data which does not need to be secure

     
    
$sqlcourses = "SELECT * FROM tbl_subjects";

$results_per_page = 10; //maximum 20 product per page
 //determines the page number the user is currently visiting. In case if it is not present, by default it is set page number to 1.
if (isset($_GET['pageno'])) {  
     $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page; //Page1 - A to J (1-10)    Page 2 - K to T (11-20)

 
} else {
     $pageno = 1;
    $page_first_result = 0;
}

$stmt = $conn->prepare($sqlcourses);
$stmt->execute(); //Select from 

$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlcourses= $sqlcourses . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlcourses);
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
    <script src="../js/nav.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    
    <title>My tutor</title>
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

    </ul>
</nav>


<div class="fas fa-bars"></div>

</header>



<div class="content">
 
    <h1>My Course Page</h1>
    <p>"You can choose the course you want" </p>

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
        foreach ($rows as $subject) {
            
            $i++;
            $subid = $subject['subject_id'];
            $subname = $subject['subject_name'];
            $subss = $subject['subject_sessions'];
            $subprice = $subject['subject_price'];
            $subdes = $subject['subject_description'];
            $subrat = $subject['subject_rating'];

            
  echo"
  <div class = 'item-list'>

  <div class = 'item'>

  <div class = 'item-img w3-border-right'>
  <img class='w3-image' src=../assets/courses/$subid.png" .
  " style='width:100%;height:250px'></a><hr>

     <div class = 'icon-list'>
          <button type = 'button'>
           <i class = 'fas fa-sync-alt'></i>
          </button>

          <button type = 'button'>
              <i class = 'fas fa-shopping-cart'></i>
          </button>

          <button type = 'button'>
              <i class = 'far fa-heart'></i>
          </button>
      </div>
      </div>

 

<div class = 'item-detail'>
<div class = 'item-name'>$subname</a> </div>

<div class = 'item-price'>
    <span class = 'price'>Price:$subprice</span>
  </div>

<p>Session:  $subss</p>
<p>Rating: $subrat</p>
<p>Description:  $subdes</p>

<button type = 'button' class = 'add-btn'>add to cart</button>
</div>



 </div>
</div>
  ";


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
        echo '<a href = "index.php?pageno=' . $page . '" style=
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