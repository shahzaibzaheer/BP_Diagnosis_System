<?php  require_once('../../private/initialize.php');
    // session_start();
    require_admin_login();  // this page will access only when doctor is logged in

    $doctors = Doctor::find_all_doctors();
    if(!$doctors){ exit("There is no doctor available");}

    $page_title = "User's Feedbacks";
    require_once(getSharedFilePath('admin/header.php'));

?>


<section class="main_content mt-5 ">
  <h1  class="mb-4 text-center">User's Feedback for Doctors</h1>
  <table  class=" col-11 mx-auto col-sm-8 mt-5 table table-responsive" >
      <thead>
        <tr>
          <th>Doctor Name</th>
          <th>Email</th>
          <th>Rating</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($doctors as $doctor): ?>
          <tr>
            <td><?php echo  $doctor->getName();?></td>
            <td><?php echo  $doctor->getEmail();?></td>
            <td ><?php echo Review::get_average_doctor_rating($doctor->getId()); ?></td>
            <td> <a href="<?php echo urlFor('admin/doctor_detail.php')."?doctor_id=".$doctor->getId(); ?>">View Feedbacks</a> </td>
            <td> <a href="<?php echo urlFor('admin/delete_doctor.php')."?doctor_id=".$doctor->getId(); ?>">Remove Doctor</a></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>

</section>
<?php     require_once(getSharedFilePath('admin/footer.php')); ?>
