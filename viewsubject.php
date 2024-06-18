<?php
session_start();
if (!isset($_SESSION['studentid'])) {
    header("Location: login.php");
    exit();
}

require_once '../db_connection.php';

// Get the student ID from the session
$studentid = $_SESSION['studentid'];

// Fetch student information
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

// Fetch course information based on course_id from URL parameter
$course_id = isset($_GET['course_id']) ? $_GET['course_id'] : 1; // Default to course ID 1 if not provided
$sql_course = "SELECT course_code, course_name, 
              IFNULL(announcement_head, '(no announcement)') AS announcement_head, 
              IFNULL(announcement_body, '') AS announcement_body 
              FROM course WHERE id = '$course_id'";
$result_course = $conn->query($sql_course);

if ($result_course->num_rows > 0) {
    $course = $result_course->fetch_assoc();
    $course_code = $course['course_code'];
    $course_name = $course['course_name'];
    $announcement_head = $course['announcement_head'];
    $announcement_body = $course['announcement_body'];
} else {
    // Handle case where course information is not found
    $course_code = "CS101"; // Default value if not found
    $course_name = "Introduction to Computer Science"; // Default value if not found
    $announcement_head = "(no announcement)"; // Default value if not found
    $announcement_body = ""; // Default value if not found
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course: <?php echo htmlspecialchars($course_code) . ' - ' . htmlspecialchars($course_name); ?></title>

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
                <h1 class="secTitle"><?php echo htmlspecialchars($course_code) . ' - ' . htmlspecialchars($course_name); ?></h1>
                <span class="secExtra"><a href="dashboard.php">Dashboard</a> > <?php echo htmlspecialchars($course_name); ?></span>
            </div>

            <div class="fluid">
                <div class="widget leftcontent grid12">
                    <div class="widget-content pad20f">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Lecturer Photo" class="img-responsive">
                            </div>
                            <div class="col-md-10">
                                <h4>Lecturer Biodata</h4>
                                <p>Name: Prof. Shamsul</p>
                                <p>Room: 1603</p>
                                <p>Email: shamsul@gmail.com</p>
                                <p>Phone No: 01234567810</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fluid">
                <div class="widget leftcontent grid12">
                    <div class="widget-header">
                        <h3 class="widget-title">Class Announcement</h3>
                    </div>
                    <div class="widget-content pad20f">
                        <div class="alert alert-info">
                            <strong>Announcement 📢:</strong> <?php echo htmlspecialchars($announcement_head); ?>
                        </div>
                        <p><?php echo htmlspecialchars($announcement_body); ?></p>
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
                                    <a href="#" class="fa fa-file-text"> Chapter 01</a> <input type="checkbox" class="progress-checkbox">
                                </li>
                                <p>Introduction to Software Design</p>
                                <br />
                                <li>
                                <a href="#" class="fa fa-upload"> Lab 0 : Revision (Fundamental Programming)</a> <input type="checkbox" class="progress-checkbox">
                                </li>
                                <p>A student's profile should be expressed using the Java programming language as part of the application. Ensure that the student completes the exercise to the best of his or her ability. Please provide a screenshot of your output and listing code to demonstrate that you have completed the exercise.</p>
                                <br />

                                <li>
                                    <a href="#" class="fa fa-file-text"> Tutorial 1</a> <input type="checkbox" class="progress-checkbox">
                                </li>
                                <p>The tutorial will be conducted in the form of a group discussion (2 or 3 participants per group). In the lab session, we will discuss this tutorial in more detail.</p>
                                <br />
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
                                    <a href="#" class="fa fa-file-text"> First Reference -E-Book : Java ProgrammingFile</a> <input type="checkbox" class="progress-checkbox">
                                </li>
                                <p>
                                Dear students,<br />
                                You can use this book as a reference. <br />
                                Good Luck, <br />
                                -Puan Robiah Hamzah-
                                </p>
                                <br />
                                <li>
                                <a href="#" class="fa fa-upload"> Lecture Notes Chapter 02</a> <input type="checkbox" class="progress-checkbox">
                                </li>
                                <p>Chapter 02: Towards Object Technology</p>
                                <br />

                                <li>
                                    <a href="#" class="fa fa-file-text"> Lab Exercise Topic 2: Object Oriented Technology File</a> <input type="checkbox" class="progress-checkbox">
                                </li>
                                <br />
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
                                    <a href="#" class="fa fa-file-text"> E-Book -Requirement</a> <input type="checkbox" class="progress-checkbox">
                                </li>
                                <p>
                                My dear students,<br />
                                I have provided you with a second free e-book that you can download for your reference.<br />
                                Good luck,<br />
                                Madam Robiah Hamzah
                                </p>
                                <br />
                                <li>
                                <a href="#" class="fa fa-upload"> Chapter 3</a> <input type="checkbox" class="progress-checkbox">
                                </li>
                                <p>Software Quality and Criteria of Object Orientation</p>
                                <br />

                                <li>
                                    <a href="#" class="fa fa-pencil"> March 2023 Online Quiz</a> <input type="checkbox" class="progress-checkbox">
                                </li>
                                <p><b>Online QUIZ <br></b></p><p><b>Exam Instructions</b></p>

<p><b>DATE: 4 APRIL&nbsp; 2024 (THURSDAY).</b></p>

<p id="yui_3_17_2_1_1718714011697_199"><b id="yui_3_17_2_1_1718714011697_198">TIME: 4.00 Pm-5.30pm (20 minutes)</b></p><p><b>Topic Cover: Chapters 1 and 2<br></b></p>

<p><b>Before beginning the
test:</b></p>

<ul type="disc">
 <li>Make sure you have a good internet connection</li>
 
 <li>Log in to UniKL VLE (Firefox recommended)</li>
</ul>

<p><b>During the test:</b></p>

<ul type="disc">
 <li>Students must complete the 30-mark questions within the&nbsp; 20 minutes time frame allotted for the test.</li>
 <li>The QUIZ must be completed in one sitting. You can only
     attempt it once.</li>
 <li>Click the "Submit all and finish" button to
     submit your test (when the time expires open attempts are submitted
     automatically)</li>
</ul>
                                <br />
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="widget leftcontent grid12">
                    <div class="widget-header">
                        <h3 class="widget-title">Week 4</h3>
                    </div>
                    <div class="widget-content pad20f">
                        <div class="progress-section">
                        <ul class="progress-list">
                                <li>
                                    <a href="#" class="fa fa-file-text"> Lecture notes Chapter 04</a> <input type="checkbox" class="progress-checkbox">
                                </li>
                                <p>Chapter 04: Concept of class : design principles</p>
                                <br />
                                <li>
                                <a href="#" class="fa fa-upload"> Lab chapter 04</a> <input type="checkbox" class="progress-checkbox">
                                </li>
                                <br />

                                <li>
                                    <a href="#" class="fa fa-file-text"> Lab activity- Chapter 4 Bonus question</a> <input type="checkbox" class="progress-checkbox">
                                </li>
                                <p dir="ltr" style="text-align: left;">&nbsp;your file&nbsp; :&nbsp; example: &nbsp; lab4_MuhammadAli_Abuzarif.pdf</p>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <                <div class="widget leftcontent grid12">
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
    <?php include 'includes/footer.html';?>

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
