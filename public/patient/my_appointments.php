<?php  require_once('../../private/initialize.php');
    require_patient_login();  // this page will access only when patient is logged in
    $patientId = loggedInPatientId();
    // grab all patient's appointments
    $appointments = Appointment::findAppointmentsByPatientId($patientId);
    if(!$appointments){
      exit("You have no appointments");
    }
    $page_title = "My Appointments";
    require_once(getSharedFilePath('patient/header.php'));

?>
  <section class="main_content mt-5">
    <?php echo output_message_if_any(); ?>
    <h1 class="mb-5">My Appointments</h1>
    <table class="col-11 mx-auto mt-5 table table-responsive">
      <thead>
        <tr>
          <th>Problem</th>
          <th>Doctor Name</th>
          <th>Fees</th>
          <th>Appointment Time</th>
          <th>Status</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($appointments as $appointment): ?>
          <?php //                print_array($appointment); ?>
          <tr>
            <td><?php echo $appointment->getPatient_problem(); ?></td>
            <td><?php echo $appointment->getDoctor()->getName(); ?></td>
            <td><?php echo $appointment->getDoctor()->getFees(); ?></td>
            <td><?php echo $appointment->getDate()."/".$appointment->getTime(); ?></td>
            <td><?php echo $appointment->getStatus(); ?></td>
            <!-- <td> <a href="#">View</a> </td> -->
            <!-- <td> <a href="<?php echo urlFor('patient/cancel_appointment.php?appointment_id='.$appointment->getId()); ?>">Cancel</a> </td> -->

          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </section>
<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
