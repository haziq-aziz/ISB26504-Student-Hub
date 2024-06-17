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
								<img src="images/user.jpg" rel="user">
							</div>
							<div class="userTxt">
								<span class="fullname">Ahmad Haziq Bin Abdul Aziz</span>
								<i class="fa fa-chevron-right"></i><br>
								<span class="username">52213122387</span>
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
							<div id="tab1">
								<div class="comment">
									<div class="comment-header">
										<div class="comment-person">
											<div class="comment-img">
												<img src="images/ghocs_sepc.png" rel="comment-1">
											</div>
										</div>
										<div class="comment-info">
											<div class="c-name">Software Engineering & Programming Club</div>
											<div class="c-time">Member</div>
										</div>
									<!-- /comment-header -->
									<div class="c-ip">Date Joined: <span class="ip">01 Jan 2024</span></div>
									<div class="comment-text">
										Dive into the dynamic world of coding and innovation with UniKL MIIT's Software Engineering & Programming Club! We are a vibrant community of tech enthusiasts, coders, and future software engineers dedicated to pushing the boundaries of technology. Whether you're a seasoned programmer or just starting, our club offers a platform to enhance your skills, collaborate on exciting projects, and connect with industry experts. Join us to explore cutting-edge technologies, participate in hackathons, and turn your ideas into reality. Elevate your university experience and shape the future of tech with us!
									</div>
									</div></div>
									<div class="comment">
										<div class="comment-header">
											<div class="comment-person">
												<div class="comment-img">
													<img src="images/ghocs_futsal.png" rel="comment-1">
												</div>
											</div>
											<div class="comment-info">
												<div class="c-name">UniKL MIIT's Futsal (Male) Club</div>
												<div class="c-time">Member</div>
											</div>
										<!-- /comment-header -->
										<div class="c-ip">Date Joined: <span class="ip">01 Jan 2024</span></div>
										<div class="comment-text">
											Join the UniKL MIIT Futsal (Male) Club and immerse yourself in the thrill of the game! Our club is dedicated to fostering sportsmanship, teamwork, and athleticism among students. Whether you're a seasoned player or just starting out, our inclusive environment welcomes all skill levels. Expect exhilarating matches, rigorous training sessions, and opportunities to compete in intervarsity tournaments. Beyond the field, we prioritize camaraderie and personal growth, creating lasting friendships and unforgettable experiences. Discover your potential with UniKL MIIT's Futsal (Male) Club and become part of our winning team today!
										</div>
									</div></div>
									<div class="comment">
										<div class="comment-header">
											<div class="comment-person">
												<div class="comment-img">
													<img src="images/ghocs_gdsc.png" rel="comment-1">
												</div>
											</div>
											<div class="comment-info">
												<div class="c-name">Developer Studenet Clubs by Google Developers</div>
												<div class="c-time">Vice President</div>
											</div>
										<!-- /comment-header -->
										<div class="c-ip">Date Joined: <span class="ip">02 Jan 2024</span></div>
										<div class="comment-text">
											Developer Student Clubs (DSC) UniKL by Google Developers are developers and leaders community group supported by Google via the Google Developers. It is the first step and part of the developers' ecosystem, bridging the gap between theoretical knowledge and real-world application.
										</div></div></div>
										<div class="comment">
											<div class="comment-header">
												<div class="comment-person">
													<div class="comment-img">
														<img src="images/ghocs_srn.png" rel="comment-1">
													</div>
												</div>
												<div class="comment-info">
													<div class="c-name">Sekretariat Rukun Negara Club</div>
													<div class="c-time">Member</div>
												</div>
											<!-- /comment-header -->
											<div class="c-ip">Date Joined: <span class="ip">02 Jan 2024</span></div>
												<div class="comment-text">
													The Sekretariat Rukun Negara (SRN) is one of the co-curricular activities carried out in Higher Education Institutions. In line with its name, most of the activities carried out through this secretariat aim to instill and promote the values and principles outlined in the Rukun Negara, Malaysia's national philosophy. These activities include community service projects, cultural events, educational seminars, and discussions on national unity and patriotism. By participating in SRN, students not only enhance their understanding of the Rukun Negara but also develop a sense of civic responsibility, leadership skills, and a deeper appreciation for Malaysia's diverse cultural heritage.
												</div></div></div>
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