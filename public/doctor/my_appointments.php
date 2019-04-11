<?php  require_once('../../private/initialize.php');
    // session_start();
    require_doctor_login();  // this page will access only when doctor is logged in

    $doctor_id = loggedInDoctorId();
    // exit($doctor_id);
    $appointments = Appointment::findAppointmentsByDoctorId($doctor_id);
    if(!$appointments){
      exit("You have no appointments");
    }
    // print_array($appointments);
    require_once(getSharedFilePath('doctor/header.php'));

?>
    <section class="main_content  mb-4">
      <h1>My Appointments</h1>
      <table  class="mt-5 table table-responsive">
        <thead>
          <tr>
            <th>Problem</th>
            <th>Patient Name</th>
            <th>Patient Email</th>
            <th>Appointment Date/Time</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($appointments as $appointment): ?>
            <?php //                print_array($appointment); ?>
            <tr>
              <td><?php echo $appointment->getPatient_problem(); ?></td>
              <td><?php echo $appointment->getPatient()->getName(); ?></td>
              <td><?php echo $appointment->getPatient()->getEmail(); ?></td>
              <td><?php echo $appointment->getDate()."/".$appointment->getTime(); ?></td>
              <td><?php echo $appointment->getStatus(); ?></td>
              <td> <a href="<?php echo urlFor('doctor/confirm_appointment.php?appointment_id='.$appointment->getId()); ?>">Confirm</a> </td>
              <td> <a href="<?php echo urlFor('doctor/cancel_appointment.php?appointment_id='.$appointment->getId()); ?>">Cancel</a> </td>

            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </section>

<?php     require_once(getSharedFilePath('doctor/footer.php')); ?>
