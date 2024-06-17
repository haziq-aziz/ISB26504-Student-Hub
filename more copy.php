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
    <style>
        #main{
            width: 100%;
        }

        .card img{
            border: 1px solid black; /* Added border style */
            border-radius: 50%;
            width: 150px;
            height: auto;
            margin: 20px auto;
            display: block;
        }

        .profile-sections {
            margin-top: 20px;
        }
        .profile-sections .card {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: center; /* Center align the title */
        }
        .profile-sections .card h2 {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .back-button {
            margin-right: 15px;
        }

        .details table {
            width: 100%;
        }
        .details td {
            padding: 8px 10px;
            vertical-align: top;
            text-align: left;
        }

        /* back button styke*/
        .logo i{
            margin-right: 15px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div id="wrapper" class="container">
        <div id="top">
            <div id="topBar">
                <div class="wrapper20">
                    <a class="logo" href="profile.html">
                        <i class="fa fa-chevron-left"></i>
                        <img src="images/logo.png" rel="logo">
                    </a>
                    <div class="topNav clearfix">
                        <ul class="tNav clearfix">
                            <li>
                                <a href="login.html">
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

        <div id="main" class="clearfix">
            <div class="container profile-sections">
                <div class="card">
                    <h2>Father Info</h2>
                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Profile Picture">
                    <div class="details">
                        <table>
                            <tr><td><b>Name:</b></td><td>John Doe</td></tr>
                            <tr><td><b>Phone No:</b></td><td>123456</td></tr>
                            <tr><td><b>Status:</b></td><td>Father</td></tr>
                            <tr><td><b>Marital Status:</b></td><td>Married</td></tr>
                            <tr><td><b>Occupation:</b></td><td>Teacher</td></tr>
                            <tr><td><b>Age:</b></td><td>50</td></tr>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <h2>Personal Info</h2>
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Profile Picture">
                    <div class="details">
                        <table>
                            <tr><td><b>Home No:</b></td><td>014-7258366</td></tr>
                            <tr><td><b>Mobile No:</b></td><td>019-33225599</td></tr>
                            <tr><td><b>Address:</b></td><td>No.4, LORONG TAMAN AMAN, 25150 KUANTAN, PAHANG</td></tr>
                            <tr><td><b>Gender:</b></td><td>Male</td></tr>
                            <tr><td><b>Citizen:</b></td><td>Malaysian</td></tr>
                            <tr><td><b>Race:</b></td><td>Malay</td></tr>
                            <tr><td><b>Religion:</b></td><td>Islam</td></tr>
                            <tr><td><b>Marital Status:</b></td><td>Single</td></tr>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <h2>Mother Info</h2>
                    <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="Profile Picture">
                    <div class="details">
                        <table>
                            <tr><td><b>Name:</b></td><td>Rose Doe</td></tr>
                            <tr><td><b>Phone No:</b></td><td>123456</td></tr>
                            <tr><td><b>Status:</b></td><td>Mother</td></tr>
                            <tr><td><b>Marital Status:</b></td><td>Married</td></tr>
                            <tr><td><b>Occupation:</b></td><td>Lecturer</td></tr>
                            <tr><td><b>Age:</b></td><td>49</td></tr>
                        </table>
                    </div>
                </div>

                <!-- Repeat similar structure for other cards -->
            </div>
        </div>
        <!-- /main -->
    </div>
    <!-- /wrapper -->

    <div id="footer">
        <!-- Footer content -->
    </div>
    <!-- /footer -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>
</html>
