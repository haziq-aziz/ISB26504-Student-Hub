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
		<title>UniKL Student Portal</title>

		<link rel="apple-touch-icon" sizes="144x144" href="apple-touch-icon-ipad-retina.png"/>
		<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-iphone-retina.png"/>
		<link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-ipad.png"/>
		<link rel="apple-touch-icon" sizes="57x57" href="apple-touch-icon-iphone.png"/>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	


		<!-- bootstrap -->
		<link href="css/bootstrap/bootstrap.css" rel="stylesheet"/>

		<link rel="stylesheet" href="css/font-awesome-4.0.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/jquery-ui.css"/>
		<link rel="stylesheet" type="text/css" href="css/toastr.css">

		<link href="css/style.css" rel="stylesheet" type="text/css"/>

	</head>
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
							<i class="fa fa-calendar"></i><br>Meeting</a>
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
				<div class="topTabs">

					<div id="topTabs-container-home">
						<div class="topTabs-header clearfix">

							<div class="secInfo sec-dashboard">
								<h1 class="secTitle">Dashboard</h1>
								<span class="secExtra">Welcome</span>
							</div>
							<!-- /SecInfo -->

							<ul class="etabs tabs">
								<li class="tab">
									<a href="#tab3">
										<span class="to-hide">
											<i class="fa fa-calendar"></i><br>Calendar
									</span>
										<i class="fa icon-hidden fa-calendar ttip" data-ttip="Calendar"></i>
									</a>
								</li>
							</ul>
							<!-- /tabs -->
						</div>
						<!-- /topTabs-header -->

						<div class="topTabsContent">
							<div id="tab3">
								<div class="small-calendar cal-tab"></div>
							</div>
						</div>
						<!-- /topTabContent -->

					</div>
					<!-- /tab-container -->

					<!-- </div> -->
				</div>
				<!-- /topTabs -->

				<div class="divider"></div>

				<div class="fluid">

					<div class="widget leftcontent grid12">
						<div class="widget-header">
							<div class="widget-controls">
								
							</div>
						</div>
						<div id="statsTabs-container">
							<ul class="etabs stats-tabs">
								<li class="tab">
									<a href="#stat-tab3">Course Overview</a>
								</li>
							</ul>
							<div class="statsTabsContent">
								<div id="stat-tab3">
								</div>
							</div>

							<div id="myCarousel" class="carousel slide" data-ride="carousel">
								<!-- Indicators -->
								<ol class="carousel-indicators">
								  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
								  <li data-target="#myCarousel" data-slide-to="1"></li>
								  <li data-target="#myCarousel" data-slide-to="2"></li>
								</ol>
							  
								<!-- Wrapper for slides -->
								<div class="carousel-inner">
								  <div class="item active">
									<img src="images/softwaredesignbanner.png" alt="SDI">
								  </div>
							  
								  <div class="item">
									<img src="images/artificial intelligence banner.png" alt="AI">
								  </div>
								  </div>
								</div>
							  
								<!-- Left and right controls -->
								<a class="left carousel-control" href="#myCarousel" data-slide="prev">
								  <span class="glyphicon glyphicon-chevron-left"></span>
								  <span class="sr-only">Previous</span>
								</a>
								<a class="right carousel-control" href="#myCarousel" data-slide="next">
								  <span class="glyphicon glyphicon-chevron-right"></span>
								  <span class="sr-only">Next</span>
								</a>
							  </div>

							<div class="recentCourse">
								<div class="courseContent">
									<p>Recently Accessed Course</p>
								</div>
								<div class="imageContainer">
									<img src="images/artificial intelligence.png" alt="">
								</div>
								<div class="textBelowImage">
									<p>Artificial Intelligence</p>
									<p>ISB332233</p>
								</div>
							</div>
							

						<div class="divider"></div>

					</div>
					<!-- /widget -->

				</div>

			</div>
			<!-- /main -->

		</div>
		<!-- /wrapper -->

		<div class="clearfix"></div>
		<div id="footer">
		UniKL 2013 &copy; Made by Haziq Aziz</a>
		</div>

		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/jquery.sparkline.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.easytabs.min.js"></script>
		<script type="text/javascript" src="js/excanvas.min.js"></script>
		<script type="text/javascript" src="js/jquery.flot.js"></script>
		<script type="text/javascript" src="js/jquery.flot.resize.js"></script>
		<script type="text/javascript" src="js/toastr.min.js"></script>

		<script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript" src="js/charts.js"></script>
		<script type="text/javascript">
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"positionClass": "toast-top-right",
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			}
			setTimeout(function () {
				toastr.info('<span style="color:#333;">Welcome to UniKL! The new student portal look.</span>');
			}, 2000);

			setTimeout(function () {
				toastr.warning('<span style="color:#333;">You could navigate the different sections to discover it...</span>');
			}, 4500);
		</script>

	</body>
</html>