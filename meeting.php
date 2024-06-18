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
		<title>UniKL Hub - My Timetable</title>

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

		<link rel="stylesheet" type="text/css" href="css/vex/vex.css">
		<link rel="stylesheet" type="text/css" href="css/vex/vex-theme-default.css">
		<link rel="stylesheet" type="text/css" href="css/vex/vex-theme-flat-attack.css">
		<link rel="stylesheet" type="text/css" href="css/vex/vex-theme-os.css">
		<link rel="stylesheet" type="text/css" href="css/vex/vex-theme-plain.css">
		<link rel="stylesheet" type="text/css" href="css/vex/vex-theme-top.css">
		<link rel="stylesheet" type="text/css" href="css/vex/vex-theme-wireframe.css">

		<link rel="stylesheet" type="text/css" href="css/messenger/messenger.css">
		<link rel="stylesheet" type="text/css" href="css/messenger/messenger-theme-future.css">
		<link rel="stylesheet" type="text/css" href="css/messenger/messenger-theme-air.css">
		<link rel="stylesheet" type="text/css" href="css/messenger/messenger-theme-block.css">
		<link rel="stylesheet" type="text/css" href="css/messenger/messenger-theme-flat.css">
		<link rel="stylesheet" type="text/css" href="css/messenger/messenger-theme-ice.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">

		<link href="css/style.css" rel="stylesheet" type="text/css"/>

		<style type="text/css">
			body{margin-top:20px;}
	.idance .classes-details ul.timetable {
		margin: 0 0 22px;
		padding: 0;
	}
	.idance .classes-details ul.timetable li {
		list-style: none;
		font-size: 15px;
		color: #7f7f7f;
	}
	idance .timetable {
		max-width: 900px;
		margin: 0 auto;
	}
	.idance .timetable-item {
		border: 1px solid #d8e3eb;
		padding: 15px;
		margin-top: 20px;
		position: relative;
		display: block;
	}
	@media (min-width: 768px) {
		.idance .timetable-item {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
		}
	}
	
	.container{
		margin-top: 20px;
	}
	.idance .timetable-item-img {
		overflow: hidden;
		height: 100px;
		width: 100px;
		display: none;
	}
	.idance .timetable-item-img img {
		height: 100%;
	}
	@media (min-width: 768px) {
		.idance .timetable-item-img {
			display: block;
		}
	}
	.idance .timetable-item-main {
		-webkit-box-flex: 1;
		-ms-flex: 1;
		flex: 1;
		position: relative;
		margin-top: 12px;
	}
	@media (min-width: 768px) {
		.idance .timetable-item-main {
			margin-top: 0;
			padding-left: 15px;
		}
	}
	.idance .timetable-item-time {
		font-weight: 500;
		font-size: 16px;
		margin-bottom: 4px;
	}
	.idance .timetable-item-name {
		font-size: 14px;
		margin-bottom: 19px;
	}
	.idance .btn-book {
		padding: 6px 30px;
		width: 100%;
	}
	.idance .timetable-item-like {
		position: absolute;
		top: 3px;
		right: 3px;
		font-size: 20px;
		cursor: pointer;
	}
	.idance .timetable-item-like .fa-heart-o {
		display: block;
		color: #b7b7b7;
	}
	.idance .timetable-item-like .fa-heart {
		display: none;
		color: #f15465;
	}
	.idance .timetable-item-like:hover .fa-heart {
		display: block;
	}
	.idance .timetable-item-like:hover .fa-heart-o {
		display: none;
	}
	.idance .timetable-item-like-count {
		font-size: 12px;
		text-align: center;
		padding-top: 5px;
		color: #7f7f7f;
	}
	.idance .timetable-item-book {
		width: 200px;
	}
	.idance .timetable-item-book .btn {
		width: 100%;
	}
	.idance .schedule .nav-tabs {
		border-bottom: 2px solid #104455;
	}
	.idance .schedule .nav-link {
		-webkit-box-flex: 1;
		-ms-flex: 1;
		flex: 1;
		font-size: 12px;
		text-align: center;
		text-transform: uppercase;
		color: #3d3d3d;
		font-weight: 500;
		-webkit-transition: none;
		-o-transition: none;
		transition: none;
		border-radius: 2px 2px 0 0;
		padding-left: 0;
		padding-right: 0;
		cursor: pointer;
	}
	@media (min-width: 768px) {
		.idance .schedule .nav-link {
			font-size: 16px;
		}
	}
	.idance .schedule .nav-link.active {
		background: #104455;
		border-color: #104455;
		color: #fff;
	}
	.idance .schedule .nav-link.active:focus {
		border-color: #104455;
	}
	.idance .schedule .nav-link:hover:not(.active) {
		background: #46c1be;
		border-color: #46c1be;
		color: #fff;
	}
	.idance .schedule .tab-pane {
		padding-top: 10px;
	}
		
		</style>

	</head>
	<body>
		<div id="loading">
			<div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
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
                <!-- /userInfo -->

                <i class="fa fa-bars icon-nav-mobile"></i>
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
					<li >
						<a href="mycourse.php">
							<i class="fa fa-book"></i><br>My Course</a>
					</li>
					<li class="active">
						<a href="#">
							<i class="fa fa-calendar"></i><br>Timetable</a>
						
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
					<h1 class="secTitle">Your Timetable</h1>
					<span class="secExtra">Subject &amp; class schedule</span>
				</div>
				<!-- /SecInfo -->

				<div class="fluid">

					<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
					<div class="idance">
					<div class="schedule content-block">
					<div class="container">
					<h2 data-aos="zoom-in-up" class="aos-init aos-animate">Schedule</h2>
					<div class="timetable">
					
					<nav class="nav nav-tabs">
					<a class="nav-link active">Mon</a>
					<a class="nav-link">Tue</a>
					<a class="nav-link">Wed</a>
					<a class="nav-link">Thu</a>
					<a class="nav-link">Fri</a>
					<a class="nav-link">Sat</a>
					<a class="nav-link">Sun</a>
					</nav>
					<div class="tab-content">
					<div class="tab-pane show active">
					<div class="row">
					
					<div class="col-md-6">
					<div class="timetable-item">
					<div class="timetable-item-img">
					<img src="https://www.bootdey.com/image/100x80/FFB6C1/000000" alt="Contemporary Dance">
					</div>
					<div class="timetable-item-main">
					<div class="timetable-item-time">8:00am - 10:00am</div>
					<div class="timetable-item-name">Mobile Development</div>
					<a href="#" id="onlineMeetButton1" class="btn btn-primary btn-book">Online Meet</a>
					<div class="timetable-item-like">
					<i class="fa fa-heart-o" aria-hidden="true"></i>
					<i class="fa fa-heart" aria-hidden="true"></i>
					<div class="timetable-item-like-count">11</div>
					</div>
					</div>
					</div>
					</div>
					
					<div class="col-md-6">
					<div class="timetable-item">
					<div class="timetable-item-img">
					<img src="https://www.bootdey.com/image/100x80/00FFFF/000000" alt="Break Dance">
					</div>
					<div class="timetable-item-main">
					<div class="timetable-item-time">12:00pm - 2:00pm</div>
					<div class="timetable-item-name">Software Design and Integration </div>
					<div class="timetable-item-room" style="font-size: 18px;">Room 2107</div>
					<div class="timetable-item-like">
					<i class="fa fa-heart-o" aria-hidden="true"></i>
					<i class="fa fa-heart" aria-hidden="true"></i>
					<div class="timetable-item-like-count">28</div>
					</div>
					</div>
					</div>
					</div>
					
					<div class="col-md-6">
					<div class="timetable-item">
					<div class="timetable-item-img">
					<img src="https://www.bootdey.com/image/100x80/8A2BE2/000000" alt="Street Dance">
					</div>
					<div class="timetable-item-main">
					<div class="timetable-item-time">3:00pm - 4:00pm</div>
					<div class="timetable-item-name">Web Application Development</div>
					<div class="timetable-item-room" style="font-size: 18px;">Room 2105</div>
					<div class="timetable-item-like">
					<i class="fa fa-heart-o" aria-hidden="true"></i>
					<i class="fa fa-heart" aria-hidden="true"></i>
					<div class="timetable-item-like-count">28</div>
					</div>
					</div>
					</div>
					</div>
					
					<div class="col-md-6">
					<div class="timetable-item">
					<div class="timetable-item-img">
					<img src="https://www.bootdey.com/image/100x80/6495ED/000000" alt="Yoga">
					</div>
					<div class="timetable-item-main">
					<div class="timetable-item-time">4:30pm - 5:30pm</div>
					<div class="timetable-item-name">Advanced Programming</div>
					<div class="popup"></div>
					<a href="#" id="onlineMeetButton2" class="btn btn-primary btn-book">Online Meet</a>

					<div class="timetable-item-like">
					<i class="fa fa-heart-o" aria-hidden="true"></i>
					<i class="fa fa-heart" aria-hidden="true"></i>
					<div class="timetable-item-like-count">23</div>
					</div>
					</div>
					</div>
					</div>
					
					<div class="col-md-6">
					<div class="timetable-item">
					<div class="timetable-item-img">
					<img src="https://www.bootdey.com/image/100x80/00FFFF/000000" alt="Stretching">
					</div>
					<div class="timetable-item-main">
					<div class="timetable-item-time">6:00pm - 7:00pm</div>
					<div class="timetable-item-name">Innovation Management</div>
					<a href="#" id="onlineMeetButton" class="btn btn-primary btn-book">Online Meet</a>
					<div class="timetable-item-like">
					<i class="fa fa-heart-o" aria-hidden="true"></i>
					<i class="fa fa-heart" aria-hidden="true"></i>
					<div class="timetable-item-like-count">14</div>
					</div>
					</div>
					</div>
					</div>
					
					<div class="col-md-6">
					<div class="timetable-item">
					<div class="timetable-item-img">
					<img src="https://www.bootdey.com/image/100x80/008B8B/000000" alt="Street Dance">
					</div>
					<div class="timetable-item-main">
					<div class="timetable-item-time">8:00pm - 9:00pm</div>
					<div class="timetable-item-name">Selected Topics in Software Engineering</div>
					<div class="timetable-item-room" style="font-size: 18px;">Room 1905</div>
					<div class="timetable-item-like">
					<i class="fa fa-heart-o" aria-hidden="true"></i>
					<i class="fa fa-heart" aria-hidden="true"></i>
					<div class="timetable-item-like-count">9</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
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
		<script type="text/javascript" src="js/toastr.min.js"></script>
		<script type="text/javascript" src="js/vex.combined.min.js"></script>
		<script type="text/javascript" src="js/messenger.min.js"></script>
		<script type="text/javascript" src="js/messenger-theme-future.js"></script>

		<script type="text/javascript" src="js/main.js"></script>
		<script>
			// JavaScript Code
			document.getElementById('onlineMeetButton').addEventListener('click', function(event) {
				event.preventDefault(); // Prevent the default anchor action
				var userInput = window.prompt("Would you like to join the Teams online meeting? Enter 'yes' to join.");
				if (userInput.toLowerCase() === 'yes') {
					// Logic to join the Teams meeting
					console.log("Joining the Teams meeting...");
					// You can redirect the user to the meeting URL or perform other actions here
				}
			});
			</script>
			<script>
				// JavaScript Code
				document.getElementById('onlineMeetButton2').addEventListener('click', function(event) {
					event.preventDefault(); // Prevent the default anchor action
					var userInput = window.prompt("Would you like to join the Teams online meeting? Enter 'yes' to join.");
					if (userInput.toLowerCase() === 'yes') {
						// Logic to join the Teams meeting
						console.log("Joining the Teams meeting...");
						// You can redirect the user to the meeting URL or perform other actions here
					}
				});
				</script>
				<script>
					// JavaScript Code
					document.getElementById('onlineMeetButton1').addEventListener('click', function(event) {
						event.preventDefault(); // Prevent the default anchor action
						var userInput = window.prompt("Would you like to join the Teams online meeting? Enter 'yes' to join.");
						if (userInput.toLowerCase() === 'yes') {
							// Logic to join the Teams meeting
							console.log("Joining the Teams meeting...");
							// You can redirect the user to the meeting URL or perform other actions here
						}
					});
					</script>
		<script>
			vex.defaultOptions.className = 'vex-theme-default';
		</script>
		<script type="text/javascript">
			$(document).ready(function () {
				toastr.options = {
					"closeButton": true,
					"debug": false,
					"positionClass": "toast-bottom-right",
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

				$('#toastr-success').click(function () {
					toastr.success('Awesome! Could Lorem ipsum more...');

				})
				$('#toastr-info').click(function () {
					toastr.info('Awesome! Could Lorem ipsum more...')
				})
				$('#toastr-error').click(function () {
					toastr.error('Awesome! Could Lorem ipsum more...')
				})
				$('#toastr-warning').click(function () {
					toastr.warning('Awesome! Could Lorem ipsum more...')
				})
				$('#toastr-clear').click(function () {
					toastr.clear();
				})

				$('#vex-modal-alert').click(function () {
					vex
						.dialog
						.alert('This is a modal fired with Vex!')
				})
				$('#vex-modal-confirm').click(function () {
					vex
						.dialog
						.confirm({message: 'Are you absolutely sure you want to destroy the alien planet?'})
				})
				$('#vex-modal-theme-flat-attack').click(function () {
					vex
						.dialog
						.alert({message: 'Another modal fired with Vex! <br> This time with "Flat Attack" Theme', className: 'vex-theme-flat-attack'})
				})
				$('#vex-modal-theme-os').click(function () {
					vex
						.dialog
						.alert({message: 'Another modal fired with Vex! <br> This time with "OS" Theme', className: 'vex-theme-os'})
				})
				$('#vex-modal-theme-plain').click(function () {
					vex
						.dialog
						.alert({message: 'Another modal fired with Vex! <br> This time with "Plain" Theme', className: 'vex-theme-plain'})
				})
				$('#vex-modal-theme-top').click(function () {
					vex
						.dialog
						.alert({message: 'Another modal fired with Vex! <br> This time with "Top" Theme', className: 'vex-theme-top'})
				})
				$('#vex-modal-theme-wireframe').click(function () {
					vex
						.dialog
						.alert({message: 'Another modal fired with Vex! <br> This time with "Wireframe" Theme', className: 'vex-theme-wireframe'})
				})

				Messenger.options = {
					extraClasses: 'messenger-fixed messenger-on-bottom messenger-on-right',
					theme: 'flat'
				}

				Messenger().post("Welcome to the Messages page");

				setTimeout(function () {
					var i;

					i = 0;

					Messenger().run({
						errorMessage: 'Error connecting to the server... <br>What server!??',
						successMessage: 'Solved!',
						action: function (opts) {
							if (++i < 3) {
								return opts.error({status: 500, readyState: 0, responseText: 0});
							} else {
								return opts.success();
							}
						}
					});
				}, 3000)

				$('#msgr-simple').click(function () {
					Messenger().post("Welcome to Messages page");
				})

				$('#msgr-error').click(function () {
					Messenger().post({message: 'There was an explosion while processing your request.', type: 'error', showCloseButton: true});
				})

				$('#msgr-clear').click(function () {
					Messenger().hideAll();
				})

			})
		</script>
	</body>
</html>