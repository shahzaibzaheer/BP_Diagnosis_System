<?php  require_once('../private/initialize.php');
  $page_title =  "Home";
  require_once(getSharedFilePath('main/header.php'));
?>


	<!-- Home -->

	<div class="home">
		<div class="home_slider_container">
			<div class="home_content">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_content_inner">
								<div class="home_title"><h1>We care for your health</h1></div>
								<div class="home_text">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestibulum mauris quis aliquam. Integer accumsan sodales odio, id tempus velit ullamcorper id. Quisque at erat eu.</p>
								</div>
								<div class="button home_button">
									<a href="<?php  echo urlFor('patient/login.php');  ?>">Book an Appointment</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>

	<!-- 3 Boxes -->

<!--
      <div class="box working_hours">
						<div class="box_icon d-flex flex-column align-items-start justify-content-center"><div style="width:29px; height:29px;"><img src="images/alarm-clock.svg" alt=""></div></div>
						<div class="box_title">Working Hours</div>
						<div class="working_hours_list">
							<ul>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div>Monday – Friday</div>
									<div class="ml-auto">8.00 – 19.00</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div>Saturday</div>
									<div class="ml-auto">9.30 – 17.00</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div>Sunday</div>
									<div class="ml-auto">9.30 – 15.00</div>
								</li>
							</ul>
						</div>
					</div>

-->

	<div class="boxes">
		<div class="container">
			<div class="row">
				<!-- Box -->
				<div class="box   box_col text-center">
          <i class="main-card-icon fas fa-user-injured "></i>
          <div class="card-body">
            <h4 class="card-title">Patient</h4>
            <a href="<?php echo urlFor('patient/login.php');  ?>">Click Here</a>
          </div>
				</div>
				<div class="box  box_col text-center">
          <i class="main-card-icon fas fa-user-md"></i>
          <div class="card-body">
            <h4 class="card-title">Doctor</h4>
            <a href="<?php echo urlFor('doctor/login.php');  ?>">Click Here</a>
          </div>
				</div>
				<div class="box  box_col text-center">
          <i class="main-card-icon fas fa-users-cog "></i>
          <div class="card-body">
            <h4 class="card-title">Admin</h4>
            <a href="<?php echo urlFor('admin/login.php');  ?>">Click Here</a>
          </div>
				</div>

				<!-- Box -->



			</div>
		</div>
	</div>

	<!-- About -->

	<div class="about">
		<div class="container">
			<div class="row row-lg-eq-height">

				<!-- About Content -->
				<div class="col-lg-7">
					<div class="about_content">
						<div ><h2>A great medical team to help your needs</h2></div>
						<div class="about_text">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ante leo, finibus quis est ut, tempor tincidunt ipsum. Nam consequat semper sollicitudin. Aliquam nec dapibus massa. Pellen tesque in luctus ex. Praesent luctus erat sit amet tortor aliquam bibendum. Nulla ut molestie augue, scelerisque consectetur quam. Dolor sit amet, consectetur adipiscing elit. Cura bitur ante leo, finibus quis est ut, tempor tincidunt ipsum. Nam consequat semper sollicitudin. Aliquam nec dapibus massa. Pellentesque in luctus ex.</p>
						</div>
					</div>
				</div>

				<!-- About Image -->
				<div class="col-lg-5">
					<div class="about_image"><img src="images/about.png" alt=""></div>
				</div>
			</div>
		</div>
	</div>


	<!-- Services -->

	<div class="services">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class=" text-center"><h2>Our  Services</h2></div>
				</div>
			</div>
			<div class="row services_row">
				<!-- Service -->
				<div class="col-lg-5 col-md-6 mx-auto service_col">
						<div class="service text-center ">
							<div class="service_title ">Ask For Prescriptions</div>
							<div class="service_text">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ante leo, finibus quis est ut, tempor tincidunt ipsum. Nam consequat semper sollicitudin.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ante leo, finibus quis est ut, tempor tincidunt ipsum. Nam consequat semper sollicitudin.</p>
							</div>
						</div>
				</div>

				<!-- Service -->
        <div class="col-lg-5 col-md-6 mx-auto service_col">
            <div class="service text-center ">
              <div class="service_title ">Book Appointment</div>
              <div class="service_text">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ante leo, finibus quis est ut, tempor tincidunt ipsum. Nam consequat semper sollicitudin.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ante leo, finibus quis est ut, tempor tincidunt ipsum. Nam consequat semper sollicitudin.</p>
              </div>
            </div>
        </div>
      </div>
    </div>
</div>
<?php require_once(getSharedFilePath('main/footer.php'));  ?>
