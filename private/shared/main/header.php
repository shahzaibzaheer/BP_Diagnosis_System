
<!DOCTYPE html>
<html >
  <head>

    <?php if(!isset($page_title)){$page_title = "";}?>
    <title><?php echo $page_title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo getStylePath("main.css"); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  </head>
  <body>


    <div class="super_container">

    	<!-- Header -->

    	<header class="header trans_200">



    		<!-- Header Content -->
    		<div class="header_container">
    			<div class="container">
    				<div class="row">
    					<div class="col">
    						<div class="header_content d-flex flex-row align-items-center justify-content-start">
    							<nav class="main_nav ml-auto">
    								<ul>
    									<li><a href="<?php echo urlFor('index.php'); ?>">Home</a></li>
    									<li><a href="<?php  echo urlFor('/about.php');  ?>">About Us</a></li>
                      <li><a href="<?php echo urlFor('patient/login.php');  ?>">Book Appointment</a></li>
    								</ul>
    							</nav>
    							<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>


    	</header>

    	<!-- Menu -->

    	<div class="menu_container menu_mm">

    		<!-- Menu Close Button -->
    		<div class="menu_close_container">
    			<div class="menu_close"></div>
    		</div>

    		<!-- Menu Items -->
    		<div class="menu_inner menu_mm">
    			<div class="menu menu_mm">
    				<ul class="menu_list menu_mm">
    					<li class="menu_item menu_mm"><a href="<?php echo urlFor('index.php'); ?>">Home</a></li>
    					<li class="menu_item menu_mm"><a href="<?php  echo urlFor('/about.php');  ?>">About us</a></li>
    					<li class="menu_item menu_mm"><a href="<?php echo urlFor('patient/login.php');  ?>">Book Appointment</a></li>
    				</ul>
    			</div>
    		</div>

    	</div>
