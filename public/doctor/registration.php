<?php  require_once('../../private/initialize.php');

  $doctor = new Doctor([]);// for preventing error , when get request
  $errors = [];
  if(isDoctorLoggedIn()){
    redirectTo(urlFor('doctor/doctor_dashboard.php'));
  }
  if(isPostRequest()){


    // // exit();
    // $file = new UploadFile(getSharedFilePath("assets"));
    // if($file->upload()){
    //   exit("file uploaded successfully"." File name: ".$file->getUploadedFileName());
    // }else {
    //   print_array($file->getErrorMessages());
    // }


      $doctor = new Doctor($_POST);

      // print_array($doctor);
      // exit;
      if($doctor->save()){
        //login successfull
        setMessage("Registration Successful :-)");
        redirectTo(urlFor('doctor/login.php'));
      }else {
        // login failed, get errors array
        $errors = $doctor->getErrors();
        // print_array($errors);
      }
  }










    require_once(getSharedFilePath('main/login_registration_header.php'));
?>

        <div class="login_registration_container mt-5">
          <div class="login-form col-8 col-sm-6 col-md-5 col-lg-4 col-xl-3 mx-auto">
              <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" enctype="multipart/form-data">
                  <h2 class="text-center mb-4">Doctor Registration</h2>
                  <!-- <div class="form-group" >
                          <input class="form-control-file"  placeholder="Profile Picture" type="file" name="profile_picture" value="" >
                  </div> -->
                  <div class="form-group" >
                          <p class="text-danger m-0"><?php if(isset($errors[DoctorTable::COLUMN_NAME])) echo "*".$errors[DoctorTable::COLUMN_NAME]; ?></p>
                          <input onfocus="this.classList.remove('is-invalid');"
                          class="form-control <?php if(isset($errors[DoctorTable::COLUMN_NAME])) echo "is-invalid" ?>"
                             placeholder="Name" type="text" name="<?php echo DoctorTable::COLUMN_NAME ?>" value="<?php echo $doctor->getName(); ?>" >
                  </div>
                  <div class="form-group" >
                          <p class="text-danger m-0"><?php if(isset($errors[DoctorTable::COLUMN_EMAIL])) echo "*".$errors[DoctorTable::COLUMN_EMAIL]; ?></p>
                          <input onfocus="this.classList.remove('is-invalid');"
                          class="form-control <?php if(isset($errors[DoctorTable::COLUMN_EMAIL])) echo "is-invalid" ?>"
                             placeholder="Email" type="email" name="<?php echo DoctorTable::COLUMN_EMAIL ?>" value="<?php echo $doctor->getEmail(); ?>" >
                  </div>
                  <div class="form-group" >
                          <p class="text-danger m-0"><?php if(isset($errors[DoctorTable::COLUMN_USERNAME])) echo "*".$errors[DoctorTable::COLUMN_USERNAME]; ?></p>
                          <input onfocus="this.classList.remove('is-invalid');"
                          class="form-control <?php if(isset($errors[DoctorTable::COLUMN_USERNAME])) echo "is-invalid" ?>"
                             placeholder="Username" type="text" name="<?php echo DoctorTable::COLUMN_USERNAME ?>" value="<?php echo $doctor->getUserName(); ?>" >
                  </div>
                  <div class="form-group" >
                          <p class="text-danger m-0"><?php if(isset($errors[DoctorTable::COLUMN_PHONE])) echo "*".$errors[DoctorTable::COLUMN_PHONE]; ?></p>
                          <input onfocus="this.classList.remove('is-invalid');"
                          class="form-control <?php if(isset($errors[DoctorTable::COLUMN_PHONE])) echo "is-invalid" ?>"
                             placeholder="Phone Number" type="text" name="<?php echo DoctorTable::COLUMN_PHONE ?>" value="<?php echo $doctor->getPhone(); ?>" >
                  </div>
                  <div class="form-group" >
                          <p class="text-danger m-0"><?php if(isset($errors[DoctorTable::COLUMN_ADDRESS])) echo "*".$errors[DoctorTable::COLUMN_ADDRESS]; ?></p>
                          <input onfocus="this.classList.remove('is-invalid');"
                          class="form-control <?php if(isset($errors[DoctorTable::COLUMN_ADDRESS])) echo "is-invalid" ?>"
                             placeholder="Address" type="text" name="<?php echo DoctorTable::COLUMN_ADDRESS ?>" value="<?php echo $doctor->getAddress(); ?>" >
                  </div>
                  <div class="form-group" >
                          <p class="text-danger m-0"><?php if(isset($errors[DoctorTable::COLUMN_CITY])) echo "*".$errors[DoctorTable::COLUMN_CITY]; ?></p>
                            <input onfocus="this.classList.remove('is-invalid');"
                            class="form-control <?php if(isset($errors[DoctorTable::COLUMN_CITY])) echo "is-invalid" ?>"
                               placeholder="City" type="text" name="<?php echo DoctorTable::COLUMN_CITY ?>" value="<?php echo $doctor->getCity(); ?>" >
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="<?php echo DoctorTable::COLUMN_GENDER; ?>">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
                  <div class="form-group" >
                    <p class="text-danger m-0"><?php if(isset($errors[DoctorTable::COLUMN_DATE_OF_BITRH])) echo "*".$errors[DoctorTable::COLUMN_DATE_OF_BITRH]; ?></p>
                      <input onfocus="this.classList.remove('is-invalid');"
                      class="form-control <?php if(isset($errors[DoctorTable::COLUMN_DATE_OF_BITRH])) echo "is-invalid" ?>"
                         type="date" name="<?php echo DoctorTable::COLUMN_DATE_OF_BITRH ?>" value="<?php echo $doctor->getDob(); ?>" >
                  </div>
                  <div class="form-group" >
                          <p class="text-danger m-0"><?php if(isset($errors[DoctorTable::COLUMN_SPECIALIZATION])) echo "*".$errors[DoctorTable::COLUMN_SPECIALIZATION]; ?></p>
                            <input onfocus="this.classList.remove('is-invalid');"
                            class="form-control <?php if(isset($errors[DoctorTable::COLUMN_SPECIALIZATION])) echo "is-invalid" ?>"
                               placeholder="Specialization" type="text" name="<?php echo DoctorTable::COLUMN_SPECIALIZATION ?>" value="<?php echo $doctor->getSpecialization(); ?>" >
                  </div>
                  <div class="form-group" >
                          <p class="text-danger m-0"><?php if(isset($errors[DoctorTable::COLUMN_QUALIFICATION])) echo "*".$errors[DoctorTable::COLUMN_QUALIFICATION]; ?></p>
                            <input onfocus="this.classList.remove('is-invalid');"
                            class="form-control <?php if(isset($errors[DoctorTable::COLUMN_QUALIFICATION])) echo "is-invalid" ?>"
                               placeholder="Qualification" type="text" name="<?php echo DoctorTable::COLUMN_QUALIFICATION ?>" value="<?php echo $doctor->getQualification(); ?>" >
                  </div>
                  <div class="form-group" >
                          <p class="text-danger m-0"><?php if(isset($errors[DoctorTable::COLUMN_ABOUT])) echo "*".$errors[DoctorTable::COLUMN_ABOUT]; ?></p>
                            <input onfocus="this.classList.remove('is-invalid');"
                            class="form-control <?php if(isset($errors[DoctorTable::COLUMN_ABOUT])) echo "is-invalid" ?>"
                               placeholder="About" type="text" name="<?php echo DoctorTable::COLUMN_ABOUT ?>" value="<?php echo $doctor->getAbout(); ?>" >
                  </div>
                  <div class="form-group" >
                          <p class="text-danger m-0"><?php if(isset($errors[DoctorTable::COLUMN_FEES])) echo "*".$errors[DoctorTable::COLUMN_FEES]; ?></p>
                            <input onfocus="this.classList.remove('is-invalid');"
                            class="form-control <?php if(isset($errors[DoctorTable::COLUMN_FEES])) echo "is-invalid" ?>"
                               placeholder="Fees" type="number" name="<?php echo DoctorTable::COLUMN_FEES ?>" value="<?php echo $doctor->getFees(); ?>" >
                  </div>
                  <div class="form-group" >
                    <p class="text-danger m-0"><?php if(isset($errors['password'])) echo "*".$errors['password']; ?></p>
                      <input onfocus="this.classList.remove('is-invalid');"
                      class="form-control <?php if(isset($errors['password'])) echo "is-invalid" ?>"
                         placeholder="Password" type="password" name="password" value="" >
                  </div>
                  <div class="form-group" >
                    <p class="text-danger m-0"><?php if(isset($errors['confirmPassword'])) echo "*".$errors['confirmPassword']; ?></p>
                      <input onfocus="this.classList.remove('is-invalid');"
                      class="form-control <?php if(isset($errors['confirmPassword'])) echo "is-invalid" ?>"
                         placeholder="Confirm Password" type="password" name="confirmPassword" value="" >
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Register</button>
                  </div>
                <a href="#" class=" pull-right">Forgot Password?</a>
              </form>
              <p class="text-center">Already Registered ?<a href="<?php echo urlFor('doctor/login.php'); ?>"> Log In</a></p>
          </div>
        </div>


    </body>
  </html>
