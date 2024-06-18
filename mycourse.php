<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['studentid'])) {
    header("Location: ../login.php");
    exit();
}

// Database connection
require '../db_connection.php'; // Adjust the path as per your file structure

// Fetch student details
$studentid = $_SESSION['studentid'];
$stmt = $conn->prepare("SELECT studentid, fullname, level_of_study, institute, programme, semester FROM student WHERE studentid = ?");
$stmt->bind_param("s", $studentid);
$stmt->execute();
$stmt->bind_result($student_id, $fullname, $level_of_study, $institute, $programme, $semester);
$stmt->fetch();
$stmt->close();

// Fetch registered courses for the student
$sql = "SELECT c.course_code, c.course_name, c.credit_hour, sc.group, sc.lab_group
        FROM student_course sc
        INNER JOIN course c ON sc.course_id = c.id
        WHERE sc.studentid = ?";
$stmt_courses = $conn->prepare($sql);
$stmt_courses->bind_param("s", $studentid);
$stmt_courses->execute();
$stmt_courses->bind_result($course_code, $course_name, $credit_hour, $group, $lab_group);

$registered_courses = [];
$total_credit_hours = 0;

// Fetching all registered courses
while ($stmt_courses->fetch()) {
    $registered_courses[] = [$course_code, $course_name, $credit_hour, $group, $lab_group];
    $total_credit_hours += $credit_hour;
}

$stmt_courses->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniKL Hub - My Course</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/font-awesome-4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>

    <style>
        .student-details {
            width: 50%;
            float: left;
            font-weight: 900;
        }

        .table-registered-subject {
            width: 90%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .th-registered-subject, .td-registered-subject {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .th-registered-subject {
            background-color: #f2f2f2;
        }

        .td-registered-subject:nth-child(even) {
            background-color: #F1F2F7;
        }

        .td-registered-subject:nth-child(odd) {
            background-color: #fff;
        }

        tr:nth-child(even) .td-registered-subject {
            background-color: #F1F2F7;
        }

        tr:nth-child(odd) .td-registered-subject {
            background-color: #fff;
        }

        .total-cr {
            float: left;
            padding-right: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php include 'includes/header.html';?>

        <div id="profile">
            <div class="wrapper20">
                <div class="userInfo">
                    <div class="userImg">
                        <img src="images/user/<?php echo htmlspecialchars($student_id); ?>.jpg" rel="user">
                    </div>
                    <div class="userTxt">
                        <span class="fullname"><?php echo htmlspecialchars($fullname); ?></span>
                        <i class="fa fa-chevron-right"></i><br>
                        <span class="username"><?php echo htmlspecialchars($student_id); ?></span>
                    </div>
                </div>
                <!-- /userInfo -->
            </div>
        </div>
        <!-- /profile -->
    </div>
    <!-- /top -->

    <div id="sidebar">
        <ul class="mainNav">
            <li>
                <a href="dashboard.php">
                    <i class="fa fa-home"></i><br>Dashboard</a>
            </li>
            <li>
                <a href="profile.php">
                    <i class="fa fa-user"></i><br>My Profile</a>
            </li>
            <li class="active">
                <a href="#">
                    <i class="fa fa-book"></i><br>My Course</a>
            </li>
            <li>
                <a href="Meeting.php">
                    <i class="fa fa-calendar"></i><br>Meetings</a>
                <span class="badge badge-mNav">4</span>
            </li>
            <li>
                <a href="ghocs.php">
                    <i class="fa fa-trophy"></i><br>GHOCs</a>
            </li>
        </ul>
    </div>
    <!-- /sidebar -->

    <div id="main" class="clearfix">
        <div class="secInfo">
            <h1 class="secTitle">My Course</h1>
            <span class="secExtra">View taken subjects</span>
        </div>

        <div class="fluid">
            <div class="widget leftcontent grid12">
                <div class="widget-header">
                    <h3 class="widget-title">Student Details</h3>
                </div>
                <div class="widget-content pad20f">
                    <p>
                        <label class="student-details">Student ID:</label>
                        <p><?php echo htmlspecialchars($student_id); ?></p>
                        <label class="student-details">Name:</label>
                        <p><?php echo htmlspecialchars($fullname); ?></p>
                        <label class="student-details">Level of Study:</label>
                        <p><?php echo htmlspecialchars($level_of_study); ?></p>
                        <label class="student-details">Institute:</label>
                        <p><?php echo htmlspecialchars($institute); ?></p>
                        <label class="student-details">Programme:</label>
                        <p><?php echo htmlspecialchars($programme); ?></p>
                        <label class="student-details">Semester:</label>
                        <p><?php echo htmlspecialchars($semester); ?></p>
                    </p>
                </div>
                <!-- /widget-content -->
            </div>
            <!-- /widget -->
        </div>
        <!-- /fluid -->

        <div class="fluid">
            <div class="widget leftcontent grid12">
                <div class="widget-header">
                    <h3 class="widget-title">Registered Courses</h3>
                </div>
                <div class="widget-content">
                    <table class="table-registered-subject">
                        <tr>
                            <th class="th-registered-subject">Course Code</th>
                            <th class="th-registered-subject">Name</th>
                            <th class="th-registered-subject">Credit Hours</th>
                            <th class="th-registered-subject">Group</th>
                            <th class="th-registered-subject">Lab Group</th>
                        </tr>
                        <?php foreach ($registered_courses as $course): ?>
                            <tr>
                                <td class='td-registered-subject'><?php echo htmlspecialchars($course[0]); ?></td>
                                <td class='td-registered-subject'><?php echo htmlspecialchars($course[1]); ?></td>
                                <td class='td-registered-subject'><?php echo htmlspecialchars($course[2]); ?></td>
                                <td class='td-registered-subject'><?php echo htmlspecialchars($course[3]); ?></td>
                                <td class='td-registered-subject'><?php echo htmlspecialchars($course[4]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <p class="total-cr">Total Credit Hours: <?php echo $total_credit_hours; ?></p>
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

<!-- Scripts -->
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
