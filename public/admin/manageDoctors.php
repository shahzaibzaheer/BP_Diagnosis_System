<?php  require_once('../../private/initialize.php');
    require_admin_login();  // this page will access only when admin is logged in
    $doctors = Doctor::find_all_doctors();
    if($doctors===false){
      exit("No doctor Found");
    }

    require_once(getSharedFilePath('admin/header.php'));

?>


<section class="main_content mt-5 ">
  <h1 class="mb-4 text-center">Manage Doctors</h1>
  <table  class=" col-11 mx-auto col-sm-12 mt-5 table table-responsive" >
      <thead>
        <tr>
          <th>Name</th>
          <th>Specialization</th>
          <th>Qualification</th>
          <th>Email</th>
          <!-- <th>Username</th> -->
          <th>Phone</th>
          <th>Gender</th>
          <th>City</th>
          <!-- <th>DOB</th> -->
          <!-- <th>Created On</th> -->
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($doctors  as $doctor): ?>
          <tr>
            <td><?php echo $doctor->getName(); ?></td>
            <td><?php echo $doctor->getSpecialization(); ?></td>
            <td><?php echo $doctor->getQualification(); ?></td>
            <td><?php echo $doctor->getEmail(); ?></td>
            <!-- <td><?php echo $doctor->getUserName(); ?></td> -->
            <td><?php echo $doctor->getPhone(); ?></td>
            <td><?php echo $doctor->getGender(); ?></td>
            <td><?php echo $doctor->getCity(); ?></td>
            <!-- <td><?php echo $doctor->getDob(); ?></td> -->
            <!-- <td><?php echo $doctor->getCreated_on(); ?></td> -->
            <td> <a href="<?php echo urlFor('admin/delete_doctor.php')."?doctor_id=".$doctor->getId(); ?>">Remove</a> </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
</section>

<?php     require_once(getSharedFilePath('admin/footer.php')); ?>
