<?php
session_start();
if (!isset($_SESSION['studentid'])) {
    header("Location: login.php");
    exit();
}

require_once '../db_connection.php';

// Example studentid (replace with actual logic to get studentid dynamically)
$studentid = $_SESSION['studentid'];

// Fetch student information (full name and student ID)
$sql_student = "SELECT fullname, studentid FROM student WHERE studentid = '$studentid'";
$result_student = $conn->query($sql_student);

if ($result_student->num_rows > 0) {
    $student = $result_student->fetch_assoc();
    $fullname = $student['fullname'];
    $studentid_display = $student['studentid'];
} else {
    // Handle case where student information is not found
    $fullname = "Student Name"; // Default value if not found
    $studentid_display = "@studentid"; // Default value if not found
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Information</title>

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
    <style>
        #mains {
            float: left;
            width: 960px;
            background: #f6f6f6;
            padding-bottom: 20px;
        }

        .progress-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .progress-list {
            list-style: none;
            padding: 0;
            width: 80%;
        }

        .progress-list li {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .progress-list li input[type="checkbox"] {
            margin-left: auto;
            flex-shrink: 0;
        }

        .progress-label {
            display: flex;
            align-items: center;
        }

        .progress-label input[type="checkbox"] {
            margin-left: 10px;
        }

        .progress {
            height: 25px;
            background-color: #e0e0e0;
            border-radius: 12.5px;
            overflow: hidden;
            margin-top: 20px;
        }

        .progress-bar {
            height: 100%;
            background-color: #4caf50;
            width: 0;
            pad
        }
    </style>
	
</head>
<body>
	
    <div id="wrapper" class="container">
        <div id="top">
            <div id="topBar">
                <div class="wrapper20">
                    <a class="logo" href="dashboard.php">
						<i class="fa fa-chevron-left"></i>
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
                </div>
            </div>
        </div>
		<div id="profile">
			<div class="wrapper20">
				<div class="userInfo">
					<div class="userImg">
                    <img src="images/user/<?php echo htmlspecialchars($studentid); ?>.jpg" rel="user">
                    </div>
                    <div class="userTxt">
                        <span class="fullname"><?php echo htmlspecialchars($fullname); ?></span>
                        <i class="fa fa-chevron-right"></i><br>
                        <span class="username"><?php echo htmlspecialchars($studentid); ?></span>
					</div>
				</div>
				<i class="fa fa-bars icon-nav-mobile"></i>
		
			</div>
		</div>
        <div id="mains" class="clearfix">
            <div class="secInfo">
                <h1 class="secTitle">ISB26504  - SOFTWARE DESIGN AND INTEGRATION</h1>
                <span class="secExtra"><a href="dashboard.php">Dashboard</a> > Subject Name</span>
            </div>

            <div class="fluid">
                <div class="widget leftcontent grid12">
                    <div class="widget-content pad20f">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="images/user.jpg" alt="Lecturer Photo" class="img-responsive">
                            </div>
                            <div class="col-md-10">
                                <h4>Lecturer Biodata</h4>
                                <p>Name: Ahmad Haziq</p>
                                <p>Room: 18-07</p>
                                <p>Email: haziq@unikl.com</p>
                                <p>Phone No: 1234567810</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fluid">
                <div class="widget leftcontent grid12">
                    <div class="widget-header">
                        <h3 class="widget-title">Announcement</h3>
                    </div>
                    <div class="widget-content pad20f">
                        <p>This is the Subject Detail Page</p>
                    </div>
                </div>
            </div>

            <div class="fluid">
                <div class="widget leftcontent grid12">
                    <div class="widget-header">
                        <h3 class="widget-title">Week 1</h3>
                    </div>
                    <div class="widget-content pad20f">
                        <div class="progress-section">
                            <ul class="progress-list">
                                <li>
                                    <span class="icon"></span> Assignment 1 <input type="checkbox" class="progress-checkbox">
                                </li>
                                <li>
                                    <span class="icon"></span> Test 1 <input type="checkbox" class="progress-checkbox">
                                </li>
                                <li>
                                    <span class="icon"></span> Test 2 <input type="checkbox" class="progress-checkbox">
                                </li>
                                <li>
                                    <span class="icon"></span> Test 3 <input type="checkbox" class="progress-checkbox">
                                </li>
                            </ul>
  
                        </div>
                    </div>
                </div>

                <div class="widget leftcontent grid12">
                    <div class="widget-header">
                        <h3 class="widget-title">Week 2</h3>
                    </div>
                    <div class="widget-content pad20f">
                        <div class="progress-section">
                            <ul class="progress-list">
                                <li>
                                    <span class="icon"></span> Assignment 1 <input type="checkbox" class="progress-checkbox">
                                </li>
                                <li>
                                    <span class="icon"></span> Test 1 <input type="checkbox" class="progress-checkbox">
                                </li>
                                <li>
                                    <span class="icon"></span> Test 2 <input type="checkbox" class="progress-checkbox">
                                </li>
                                <li>
                                    <span class="icon"></span> Test 3 <input type="checkbox" class="progress-checkbox">
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="widget leftcontent grid12">
                    <div class="widget-header">
                        <h3 class="widget-title">Week 3</h3>
                    </div>
                    <div class="widget-content pad20f">
                        <div class="progress-section">
                            <ul class="progress-list">
                                <li>
                                    <span class="icon"></span> Assignment 1 <input type="checkbox" class="progress-checkbox">
                                </li>
                                <li>
                                    <span class="icon"></span> Test 1 <input type="checkbox" class="progress-checkbox">
                                </li>
                                <li>
                                    <span class="icon"></span> Test 2 <input type="checkbox" class="progress-checkbox">
                                </li>
                                <li>
                                    <span class="icon"></span> Test 3 <input type="checkbox" class="progress-checkbox">
                                </li>
                            </ul>
 
                        </div>
                    </div>
                </div>

                <div class="widget leftcontent grid12">
                    <div class="widget-header">
                        <h3 class="widget-title">Subject Progress</h3>
                    </div>
                    <div class="widget-content pad20f">
                        <p>Progress Topic</p>
                        <div class="progress">
                            <div class="progress-bar" id="progress-bar">
                                <span id="progress-text">0%</span> <!-- Percentage display inside the progress bar -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div id="footer">
        2023 &copy; Subject Information. Powered by <a href="https://www.pixeden.com" target="_blank">Pixeden</a>
    </div>

    <script type="text/javascript" src="js/prefixfree.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.easytabs.min.js"></script>
    <script type="text/javascript" src="js/excanvas.min.js"></script>
    <script type="text/javascript" src="js/jquery.flot.js"></script>
    <script type="text/javascript" src="js/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <script>
        $(document).ready(function() {
            // Function to update progress bar
            // Function to update progress bar and percentage display
            // Function to update progress bar and percentage display
            function updateProgressBar() {
                var totalBoxes = $('.progress-checkbox').length;
                var checkedBoxes = $('.progress-checkbox:checked').length;
                var percentage = (checkedBoxes / totalBoxes) * 100;

                // Round percentage to 0 decimal places
                percentage = Math.round(percentage);

                // Update progress bar width
                var progressBar = $('#progress-bar');
                progressBar.width(percentage + '%');

                // Update progress text display and position
                var progressText = $('#progress-text');
                progressText.text(percentage + '%');

                // Adjust position of progress text in the center of the progress bar
                var progressBarWidth = progressBar.width();
                var progressTextWidth = progressText.width();
                var leftPosition = (progressBarWidth - progressTextWidth) / 2;
                progressText.css('left', leftPosition + 'px');
            }

            // Update progress bar on checkbox change
            $('.progress-checkbox').change(function() {
                updateProgressBar();
            });

            // Initial call to update progress bar on page load
            updateProgressBar();
        });
    </script>

</body>
</html>

   
