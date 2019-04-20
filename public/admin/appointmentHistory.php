<?php  require_once('../../private/initialize.php');
    // session_start();
    require_admin_login();  // this page will access only when doctor is logged in

    // exit($doctor_id);
    $appointments = Appointment::find_all_appointments();
    if(!$appointments){
      exit("There are appointments");
    }
    // print_array($appointments);
    require_once(getSharedFilePath('admin/header.php'));

?>


<section class="main_content  mb-4 mr-5">
  <h1>All Appointments</h1>
  <table class="mt-5 w-100  table table-responsive">
      <thead>
        <tr>
          <th>Doctor Name</th>
          <th>Patient Name</th>
          <!-- <th>Specialization</th> -->
          <th>Consultancy Fee</th>
          <th>Appointment Date/Time</th>
          <th>Appointment Creation Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($appointments as $appointment): ?>
          <?php //print_array($appointment); ?>
          <tr>
            <td><?php echo $appointment->getDoctor()->getName(); ?></td>
            <td><?php echo $appointment->getPatient()->getName(); ?></td>
            <!-- <td><?php echo $appointment->getDoctor()->getSpecialization(); ?></td> -->
            <td><?php echo $appointment->getDoctor()->getFees(); ?></td>
            <td><?php echo $appointment->getDate()."/".$appointment->getTime(); ?></td>
            <td><?php echo $appointment->getCreated_on(); ?></td>
            <td><?php echo $appointment->getStatus(); ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </section>
<?php     require_once(getSharedFilePath('admin/footer.php')); ?>
