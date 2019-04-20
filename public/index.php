<?php  require_once('../private/initialize.php');
  require_once(getSharedFilePath('main/header.php'));
?>



<!-- ../private/shared/assets/default_img.png -->
     <header>
        <div id="carouselControl" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
           <div class="carousel-item active">
             <img class="d-block w-100 " src="https://placehold.it/900x400" alt="First slide">
           </div>
           <div class="carousel-item">
             <img class="d-block w-100" src="https://placehold.it/900x400" alt="Second slide">
           </div>
           <div class="carousel-item">
             <img class="d-block w-100" src="https://placehold.it/900x400" alt="Third slide">
           </div>
         </div>
         <a class="carousel-control-prev" href="#carouselControl" role="button" data-slide="prev">
           <span class="carousel-control-prev-icon" aria-hidden="true"></span>
           <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carouselControl" role="button" data-slide="next">
           <span class="carousel-control-next-icon" aria-hidden="true"></span>
           <span class="sr-only">Next</span>
         </a>
        </div>
     </header>



       <!-- Page Content -->

       <div class="container mt-5 mb-5">
          <div class="row text-center d-flex justify-content-around">
            <div class="card h-100 col-lg-4 col-sm-5">
              <i class="main-card-icon fas fa-user-injured"></i>
              <div class="card-body">
                <h4 class="card-title">Patient</h4>
                <a href="<?php echo urlFor('patient/login.php'); ?>">Click Here</a>
              </div>
            </div>
            <div class="card h-100 col-lg-4 col-sm-5">
              <i class="main-card-icon fas fa-user-md"></i>
              <div class="card-body">
                <h4 class="card-title">Doctor</h4>
                <a href="<?php echo urlFor('doctor/login.php'); ?>">Click Here</a>
              </div>
            </div>
            <div class="card h-100 col-lg-4 col-sm-5">
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
