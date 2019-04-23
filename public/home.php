<?php  require_once('../private/initialize.php');
  $page_title =  "Home";
  require_once(getSharedFilePath('main/header.php'));
?>



<!-- ../private/shared/assets/default_img.png -->
     <header class="home_banner_area">

     </header>



       <!-- Page Content -->
       <div class="container mt-5 mb-5">
          <div class="users row text-center">
            <div class="card col-10 col-lg-4 mx-auto">
              <i class="main-card-icon fas fa-user-injured"></i>
              <div class="card-body">
                <h4 class="card-title">Patient</h4>
                <a href="<?php echo urlFor('patient/login.php'); ?>">Click Here</a>
              </div>
            </div>
            <div class="card col-10 col-lg-4 mx-auto">
              <i class="main-card-icon fas fa-user-md"></i>
              <div class="card-body">
                <h4 class="card-title">Doctor</h4>
                <a href="<?php echo urlFor('doctor/login.php'); ?>">Click Here</a>
              </div>
            </div>
            <div class="card col-10 col-lg-4 mx-auto">
              <i class="main-card-icon fas fa-users-cog"></i>
              <div class="card-body">
                <h4 class="card-title">Admin</h4>
                <a href="<?php echo urlFor('admin/login.php');  ?>">Click Here</a>
              </div>
            </div>
          </div>
          <!-- /.row -->
       </div>

<?php require_once(getSharedFilePath('main/footer.php'));  ?>
