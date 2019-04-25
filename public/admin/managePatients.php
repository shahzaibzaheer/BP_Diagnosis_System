<?php  require_once('../../private/initialize.php');
    require_admin_login();  // this page will access only when admin is logged in
    $patients = Patient::find_all_patients();
    if($patients===false){
      exit("No patient Found");
    }
    $page_title = "Manage Patients";
    require_once(getSharedFilePath('admin/header.php'));

?>

<section class="main_content mt-5 ">
  <?php echo output_message_if_any(); ?>
    <h1 class="mb-4 text-center">Manage Patients</h1>
  <table  class=" col-11 mx-auto col-sm-11 mt-5 table table-responsive" >
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Username</th>
          <th>Phone</th>
          <th>Gender</th>
          <th>City</th>
          <!-- <th>Created On</th> -->
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($patients  as $patient): ?>
          <tr>
            <td><?php echo $patient->getName(); ?></td>
            <td><?php echo $patient->getEmail(); ?></td>
            <td><?php echo $patient->getUserName(); ?></td>
            <td><?php echo $patient->getPhoneNumber(); ?></td>
            <td><?php echo $patient->getGender() == 'male' ?  "Male": "Female" ?></td>
            <td><?php echo $patient->getCity(); ?></td>
            <!-- <td><?php echo $patient->getCreatedOn(); ?></td> -->
            <td> <a href="<?php echo urlFor('admin/delete_patient.php')."?patient_id=".$patient->getId(); ?>">Remove</a> </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>



<?php     require_once(getSharedFilePath('admin/footer.php')); ?>
