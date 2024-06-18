<?php
session_start();
if (!isset($_SESSION['studentid'])) {
    header("Location: login.php");
    exit();
}

require_once '../db_connection.php';

$studentid = $_SESSION['studentid'];

// Fetch student information
$sql_student = "SELECT fullname, studentid FROM student WHERE studentid = '$studentid'";
$result_student = $conn->query($sql_student);

if ($result_student->num_rows > 0) {
    $student = $result_student->fetch_assoc();
    $fullname = $student['fullname'] ?? 'Student Name';
    $studentid_display = $student['studentid'] ?? '@studentid';
} else {
    // Handle case where student information is not found
    $fullname = "Student Name"; // Default value if not found
    $studentid_display = "@studentid"; // Default value if not found
}

// Initialize courses array
$courses = array();

try {
    // Fetch courses enrolled by the student, including progress
    $sql_courses = "SELECT c.course_code, c.course_name, sc.progress, c.id as course_id
                    FROM course c
                    JOIN student_course sc ON c.id = sc.course_id
                    WHERE sc.studentid = '$studentid'";

    $result_courses = $conn->query($sql_courses);

    if ($result_courses && $result_courses->num_rows > 0) {
        while ($row = $result_courses->fetch_assoc()) {
            $courses[] = $row;
        }
    } else {
        $_SESSION['error_messages'] = "You have not registered for any courses yet.";
    }
} catch (Exception $e) {
    $_SESSION['error_messages'] = "Failed to fetch courses: " . $e->getMessage();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniKL Hub - Dashboard</title>

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<?php include 'includes/header.html';?>

<div id="profile">
    <div class="wrapper20">
        <div class="userInfo">
            <div class="userImg">
                <img src="images/user/<?php echo htmlspecialchars($studentid ?? 'default'); ?>.jpg" rel="user">
            </div>
            <div class="userTxt">
                <span class="fullname"><?php echo htmlspecialchars($fullname ?? 'Student Name'); ?></span>
                <i class="fa fa-chevron-right"></i><br>
                <span class="username"><?php echo htmlspecialchars($studentid_display ?? '@studentid'); ?></span>
            </div>
        </div>
        <!-- /userInfo -->

        <i class="fa fa-bars icon-nav-mobile"></i>
    </div>
</div>
<!-- /profile -->
</div>
<!-- /top -->

<div id="sidebar">
    <ul class="mainNav">
        <li class="active">
            <a href="#">
                <i class="fa fa-home"></i><br>Dashboard</a>
        </li>
        <li>
            <a href="profile.php">
                <i class="fa fa-user"></i><br>My Profile</a>
        </li>
        <li>
            <a href="mycourse.php">
                <i class="fa fa-book"></i><br>My Course</a>
        </li>
        <li>
            <a href="meeting.php">
                <i class="fa fa-calendar"></i><br>Timetable</a>
                <span class="badge badge-mNav">4</span>
        </li>
        <li>
            <a href="ghocs.php">
                <i class="fa fa-trophy"></i><br>GHOCS</a>
        </li>
    </ul>
</div>
<!-- /sidebar -->

<div id="main" class="clearfix">
    <div class="secInfo">
        <h1 class="secTitle">Dashboard</h1>
        <span class="secExtra">Course Overview</span>
    </div>
    <!-- /SecInfo -->

    <div class="fluid">
        <div class="widget leftcontent grid12">
            <div class="widget-content pad20f">
                <?php if (isset($_SESSION['error_messages'])): ?>
                    <div class="alert alert-danger">
                        <strong>Uh Oh!</strong> <?php echo htmlspecialchars($_SESSION['error_messages'] ?? ''); ?>
                    </div>
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                <?php endif; ?>
                <?php foreach ($courses as $course): ?>
    <div class="card mb-3">
        <a href="viewsubject.php?course_id=<?php echo htmlspecialchars($course['course_id']); ?>">
            <img class="card-img-top" src="images/subject/<?php echo htmlspecialchars($course['course_code']); ?>.png" alt="Card image cap">
        </a>
        <div class="card-body">
            <a href="viewsubject.php?course_id=<?php echo htmlspecialchars($course['course_id']); ?>">
                <h5 class="card-title"><?php echo htmlspecialchars($course['course_code']) . ' - ' . htmlspecialchars($course['course_name']); ?></h5>
            </a>
            <p>
                <div class="progress progress-striped active">
                    <div class="progress-bar bar-aqua" style="width: <?php echo htmlspecialchars($course['progress']); ?>%;"></div>
                </div>
            </p>
            <p class="card-text"><?php echo htmlspecialchars($course['progress']); ?>% complete</p>
        </div>
    </div>
<?php endforeach; ?>
            </div>
            <!-- /widget-content -->
        </div>
        <!-- /widget -->
    </div>
    <!-- /fluid -->
</div>
<!-- /main -->
</div>
<!-- /wrapper -->

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

</body>
</html>
