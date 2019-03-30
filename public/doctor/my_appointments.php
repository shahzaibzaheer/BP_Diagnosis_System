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

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Appointmetns</title>
    <style media="screen">
      td,th{
        padding: 8px 16px;
      }
    </style>
  </head>
  <body>
    <h1>My Appointments</h1>
    <table>
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
  </body>
</html>
