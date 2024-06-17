<?php
session_start();
if (!isset($_SESSION['studentid'])) {
    header("Location: login.php");
    exit();
}

require_once '../db_connection.php';

// Retrieve student information from the database
$studentid = $_SESSION['studentid'];
$stmt = $conn->prepare("SELECT fullname, phone, email, programme FROM student WHERE studentid = ?");
$stmt->bind_param("i", $studentid);
$stmt->execute();
$stmt->bind_result($fullname, $phone, $email, $programme);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>

    <link rel="apple-touch-icon" sizes="144x144" href="apple-touch-icon-ipad-retina.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-iphone-retina.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-ipad.png"/>
    <link rel="apple-touch-icon" sizes="57x57" href="apple-touch-icon-iphone.png"/>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet"/>

    <link rel="stylesheet" href="css/font-awesome-4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css"/>

    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/profile.css">

    <!-- additional css -->

</head>
<body>
<div id="wrapper" class="container">
    <div id="top">
        <div id="topBar">
            <div class="wrapper20">
                <a class="logo" href="index.html">
                    <img src="images/logo.png" rel="logo">
                </a>
                <div class="topNav clearfix">
                    <ul class="tNav clearfix">
                        <li>
                            <a href="logout.php">
                                <i class="fa fa-sign-out icon-white"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /topNav -->
            </div>
        </div>
        <!-- /topBar -->
    </div>
    <!-- /top -->

    <div id="sidebar">
        <ul class="mainNav">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i><br>Dashboard</a>
            </li>
            <li class="active">
                <a href="profile.html">
                    <i class="fa fa-user"></i><br>My Profile</a>
            </li>
            <li>
                <a href="mycourse.html">
                    <i class="fa fa-book"></i><br>My Course</a>
            </li>
            <li>
                <a href="meeting.html">
                    <i class="fa fa-calendar"></i><br>Meetings</a>
                <span class="badge badge-mNav">4</span>
            </li>
            <li>
                <a href="ghocs.html">
                    <i class="fa fa-trophy"></i><br>GHOCs</a>
            </li>
        </ul>
    </div>
    <!-- /sidebar -->

    <div id="main" class="clearfix">
        <div class="secInfo">
            <h1 class="secTitle">My Profile</h1>
            <span class="secExtra">Student</span>
        </div>
        <!-- /SecInfo -->

        <div class="container profile-sections">
            <div class="student-info card">
                <div class="image-and-button">
                    <div class="image-placeholder large">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Profile Picture">
                    </div>
                    <button class="btn btn-primary">Edit</button>
                </div>
                <div class="details-student">
                    <p><?php echo htmlspecialchars($fullname); ?></p>
                    <p><?php echo htmlspecialchars($phone); ?></p>
                    <p><?php echo htmlspecialchars($email); ?></p>
                    <p><?php echo htmlspecialchars($programme); ?></p>
                </div>
            </div>

            <div class="advisor card">
                    <h2>Advisor</h2>
                    <div class="advisor-info">
                        <div class="image-placeholder large">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Profile Picture">
                        </div>
                        <div class="details-advisor">
                            <p>Name: <b>Prof. Shamsul</b></p>
                            <p>Phone Number: <b>012-345566987</b></p>
                            <p>Email: <b>shamsul@gmail.com</b></p>
                            <p>Room: <b>1603</b></p>
                        </div>
                    </div>
                </div>
                <div class="contact-info card">
                    <h2>Contact Info</h2>
                    <div class="details">
                        <p>Home Phone: 09-12365488</p>
                        <p>Mobile No: 012-33557784</p>
                        <p>Address: No.4, LORONG TAMAN AMAN, 25150 KUANTAN, PAHANG</p>
                    </div>
                    <button class="btn btn-primary">More...</button>
                </div>
            </div>
        </div>
        <!-- /main -->
    </div>
    <!-- /wrapper -->

    <div id="footer">
        <div class="wrapper20">
            <span>&copy; Copyright 2024. All rights reserved.</span>
        </div>
    </div>
    <!-- /footer -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>

</body>
</html>