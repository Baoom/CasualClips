<?php
include_once "php/db_connect.php";
include_once "php/register.inc.php";
include_once "php/functions.php";

sec_session_start();

if (login_check($pdo) == "success") $logged = "in";
else $logged = "out";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta Tags -->
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SecureLogin | <?php echo $title; ?></title>
	</head>
	<body>

		<nav class="navbar navbar-inverse navbar-fixed-top navbar-shadow">
			<div class="container">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">SecureLogin</a>
				</div><!-- .navbar-header -->

				<div id="navbar" class="navbar-collapse collapse">

					<ul class="nav navbar-nav navbar-left">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="#">About</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Links <strong class="caret"></strong></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Link1</a></li>
                                <li><a href="#">Link2</a></li>
                                <li><a href="#">Link3</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Link4</a></li>
                            </ul>
                        </li>
					</ul><!-- .navbar-left -->

                    <div class="navbar-right">

                        <?php if($logged == "in"):?>

                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="fa fa-user"></span>
                                        <?php echo htmlentities($_SESSION['username']); ?>
                                        <strong class="caret"></strong>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#"><span class="fa fa-wrench"></span> Settings</a></li>
                                        <li><a href="#"><span class="fa fa-refresh"></span> Update Profile</a></li>
                                        <li><a href="#"><span class="fa fa-briefcase"></span> Billing</a></li>
                                        <li class="divider"></li>
                                        <li><a href="/php/logout.php"><span class="fa fa-power-off"></span> Sign out</a></li>
                                    </ul>
                                </li><!-- .dropdown -->
                            </ul><!-- .my-account -->

                        <?php else : ?>

                        <div class="navbar-form">
                            <a class="btn btn-info" data-toggle="modal" data-target=".bs-modal">Sign In/Register</a>
                        </div><!-- .sign-in -->

                        <?php endif; ?>

                    </div><!-- .navbar-right -->
                </div><!-- .navbar -->
            </div><!-- .container -->
        </nav><!-- .nav -->

	<div class="container" style="padding: 75px 0 0">