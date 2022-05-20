<?php

include_once("dbconnect.php");

    if (isset($_POST['submit'])) {
        if (!(isset($_POST["name"]) || isset($_POST["address"]) || isset($_POST["citizenship"]) || isset($_POST["email"]) || isset($_POST["phone"]))) {
            echo "<script> alert('Please fill in all required information')</script>";
            echo "<script> window.location.replace('newpatient.php')</script>";
        } else {
            if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
                $icno = $_POST["icno"];
                $name = $_POST["name"];
                $address = $_POST["address"];
                $citizenship = $_POST["citizenship"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $sqlregister = "INSERT INTO `tbl_patients`(`icno`, `name`, `address`, `citizenship`, `email`, `phone`) VALUES('$icno', '$name', '$address', '$citizenship', '$email', '$phone')";
                try {
                    $conn->exec($sqlregister);
                    uploadImage($icno);
                    echo "<script>alert('Registration successful')</script>";
                    echo "<script>window.location.replace('mainpage.php')</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('Registration failed')</script>";
                    echo "<script>window.location.replace('newpatient.php')</script>";
                }
            } else {
                $icno = $_POST["icno"];
                $name = $_POST["name"];
                $address = $_POST["address"];
                $citizenship = $_POST["citizenship"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $sqlregister = "INSERT INTO `tbl_patients`(`icno`, `name`, `address`, `citizenship`, `email`, `phone`) VALUES('$icno', '$name', '$address', '$citizenship', '$email', '$phone')";
                try {
                    $conn->exec($sqlregister);
                    echo "<script>alert('Registration successful')</script>";
                    echo "<script>window.location.replace('mainpage.php')</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('Registration failed')</script>";
                    echo "<script>window.location.replace('newpatient.php')</script>";
                }
               
            }
        }
    }


function uploadImage($email)
{
    $target_dir = "../images/patients/";
    $target_file = $target_dir . $email . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Tutor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/myscript.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<header class="w3-header w3-blue w3-center w3-padding-32">
        <h3>My Tutor </h3>
        <p>Register Page</p>
    </header>
    <div class="topnavbar" id="myTopnav">
        <a href="../login.php?status=logout" onclick="logout()" class="right">Logout</a>
    </div>

    <center>
        <h2>Register New Patient</h2>

        <div class="main-landing">
            <div class="container-patient">
                <form name="registerForm" action="newpatient.php" onsubmit="return validateRegForm()" method="post" enctype="multipart/form-data">
                    <center>


                    
                        <div class="row-single">
                            <img class="imgselection" src="../images/patients/profile.png"><br>
                            <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="fname">Name</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="idname" name="name" placeholder="Patient name.." required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lic">IC No/ID/Passport</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="idic" name="icno" placeholder="IC/ID number" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lname">Email</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="idemail" name="email" placeholder="Patient email if available/ Write 'NA' if not available" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="lphone">Phone</label>
                            </div>
                            <div class="col-75">
                                <input type="tel" id="idphone" name="phone" placeholder="Your phone number.." required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="citizen">Citizenship</label>
                            </div>
                            <div class="col-75">
                                <select name="citizenship" id="citizenid">
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="bangladesh">Bangladesh</option>
                                    <option value="China">China</option>
                                    <option value="India">India</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="faddress">Address</label>
                            </div>
                            <div class="col-75">
                                <textarea type="text" cols="110%" rows="5" id="idaddress" name="address" resize="none" placeholder="Patient Address" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" name="submit" value="Submit">
                        </div>
                    </center>
                </form>

            </div>
            <a href="mainpage.php" class="float">
                <i class="fa fa-close my-float"></i>
            </a>
        </div>

        <div class="bottomnavbar">
            <a href="mainpage.php">Home</a>
            <a href="news.php">News</a>
            <a href="contactus.php">Contact us</a>
        </div>

</body>

</html>




<div style="display:flex; justify-content: center;">
    

    <div class="w3-container w3-border " style="width:600px;margin:auto;text-align:left;">

        <form name="loginForm" action="login.html" method="post">

        <div class="row-single w3-center">
                        <img class="imgselection" src="../images/profile/2.jpg" style="width:50%"><br>
                        <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
                    </div>

            <p>
                <label><b>Email</b></label>
                <input class="w3-input w3-round w3-border" type="email" name="email" id="idemail" placeholder="Your email" required>
            </p>
            <p>
                <label><b>Password</b></label>
                <input class="w3-input w3-round w3-border" type="password" name="password" id="idpass" placeholder="Your password" required>
            </p>
            <p>
                <input class="w3-check" name="rememberme" type="checkbox" id="idremember" onclick="rememberMe()">
                <label>Remember Me</label>
            </p>
            <p>
                <input class="w3-button w3-round w3-border w3-blue-gray" type="submit" name="submit" id="idsumit">
            </p>

          

        </form>
    </div>
</div>



