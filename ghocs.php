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

// Query to fetch all clubs and check membership status for the student
$studentid = $_SESSION['studentid']; // Replace with dynamic student ID if needed
$sql = "SELECT c.clubid, c.club_name, c.club_description, cs.role, cs.join_date 
        FROM clubs c 
        LEFT JOIN club_student cs ON c.clubid = cs.clubid AND cs.studentid = '$studentid'";

$result = $conn->query($sql);

$clubs = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row['join_date']) {
            $join_date = DateTime::createFromFormat('Y-m-d', $row['join_date'])->format('d M Y');
            $row['formatted_join_date'] = $join_date;
        }
        $clubs[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniKL Hub</title>

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

    <style>
        .activities-table {
            width: 99%;
            border-collapse: collapse;
        }
        .activities-table th, .activities-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .activities-table th {
            background-color: #f2f2f2;
        }
        .join-btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .join-btn:hover {
            background-color: #45a049;
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
            <li>
                <a href="mycourse.php">
                    <i class="fa fa-book"></i><br>My Course</a>
            </li>
            <li>
                <a href="Meeting.php">
                    <i class="fa fa-calendar"></i><br>Meetings</a>
                <span class="badge badge-mNav">4</span>
            </li>
            <li class="active">
                <a href="#">
                    <i class="fa fa-trophy"></i><br>GHOCS</a>
            </li>
        </ul>
    </div>
    <!-- /sidebar -->

    <div id="main" class="clearfix">

        <div class="topTabs">

            <div id="topTabs-container-home">
                <div class="topTabs-header clearfix">

                    <div class="secInfo sec-dashboard">
                        <h1 class="secTitle">GHOCS</h1>
                        <span class="secExtra">Graduate High Order Critical Skills</span>
                    </div>
                    <!-- /SecInfo -->

                    <ul class="etabs tabs">
                        <li class="tab">
                            <a href="#tab1">
                                <span class="to-hide">
                                    <i class="fa fa-bolt"></i><br>Clubs
                                </span>
                                <i class="fa icon-hidden fa-bolt ttip" data-ttip="Clubs"></i>
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#tab2">
                                <span class="to-hide">
                                    <i class="fa fa-list"></i><br>Club Activities
                                </span>
                                <i class="fa icon-hidden fa-list ttip" data-ttip="Club Activities"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /tabs -->
                </div>
                <!-- /topTabs-header -->

                <div class="topTabsContent">
                <?php if (isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])) : ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Error!</strong> <?php echo $_SESSION['error_message']; ?>
                    </div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) : ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Success!</strong> <?php echo $_SESSION['success_message']; ?>
                    </div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>
                    <div id="tab1">
					<?php
                        foreach ($clubs as $club) {
                            echo '<div class="comment">
                                    <div class="comment-header">
                                        <div class="comment-person">
                                            <div class="comment-img">
                                                <img src="images/clubs/' . htmlspecialchars($club['clubid']) . '.png" rel="comment-1">
                                            </div>
                                        </div>
                                        <div class="comment-info">
                                            <div class="c-name">' . htmlspecialchars($club['club_name']) . '</div>
                                            <div class="c-time">' . htmlspecialchars($club['role'] ? $club['role'] : 'Not a member') . '</div>
                                        </div>
                                    </div>';
									if ($club['role']) {
										echo '<div class="c-ip">
												Date Joined: <span class="ip">' . htmlspecialchars($club['formatted_join_date']) . '</span><br /> 
												<form action="includes/leave_club.php" method="post" style="display: inline;">
													<input type="hidden" name="clubid" value="' . htmlspecialchars($club['clubid']) . '">
													<a href="#" class="leave-link" onclick="this.closest(\'form\').submit(); return false;">Leave Club <i class="fa fa-minus"></i></a>
												</form>
											  </div>';
                            } else {
                                echo '<div class="c-ip">
                                        <form action="includes/join_club.php" method="post" style="display: inline;">
                                            <input type="hidden" name="clubid" value="' . htmlspecialchars($club['clubid']) . '">
                                            <a href="#" class="join-link" onclick="this.closest(\'form\').submit(); return false;">Join Club <i class="fa fa fa-plus"></i></a>
                                        </form>
                                      </div>';
                            }
                            echo '<div class="comment-text">' . htmlspecialchars($club['club_description']) . '</div>
                                  </div>';
                        }
                        ?>
                    </div>
                    <div id="tab2">
                        <h2>Club Activities</h2>
                        <table class="activities-table">
                            <thead>
                                <tr>
                                    <th>Activity</th>
                                    <th>Activity Level</th>
                                    <th>Membership</th>
                                    <th>Position</th>
                                    <th>Mark</th>
                                    <th>From</th>
                                    <th>Until</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>DEVFEST GEORGETOWN 2022</td>
                                    <td>National</td>
                                    <td>Member</td>
                                    <td>Participant</td>
                                    <td>15</td>
                                    <td>16/12/2022</td>
                                    <td>17/12/2022</td>
                                </tr>
                                <tr>
                                    <td>LEARNING THE LARAVEL FRAMEWORK</td>
                                    <td>Campus</td>
                                    <td>Member</td>
                                    <td>Participant</td>
                                    <td>5</td>
                                    <td>03/06/2023</td>
                                    <td>03/06/2023</td>
                                </tr>
                                <tr>
                                    <td>VISITING THE MALAYSIA HOUSE OF PARLIAMENT</td>
                                    <td>Campus</td>
                                    <td>Member</td>
                                    <td>Participant</td>
                                    <td>5</td>
                                    <td>22/11/2023</td>
                                    <td>22/11/2023</td>
                                </tr>
                            </tbody>
                        </table>
                        <br />
                        <p>Showing 1 to 3 of 3 entries</p>
                        <br /><br />
                    </div>
						</div>
						<!-- /topTabContent -->

					</div>
					<!-- /tab-container -->
					 </div>
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