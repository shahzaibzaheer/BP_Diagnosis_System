<?php  require_once('../../private/initialize.php');
    // session_start();
    require_admin_login();  // this page will access only when doctor is logged in

    // exit($doctor_id);
    $appointments = Appointment::find_all_scheduled_appointments();
    if(!$appointments){
      exit("There are appointments");
    }
    // print_array($appointments);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Appointment History</title>
    <style media="screen">
      td,th{
        padding: 2px 8px;
      }
    </style>
  </head>
  <body>
    <h1>All Appointments</h1>
    <table>
      <thead>
        <tr>
          <th>Doctor Name</th>
          <th>Patient Name</th>
          <th>Specialization</th>
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
            <td><?php echo $appointment->getDoctor()->getSpecialization(); ?></td>
            <td><?php echo $appointment->getDoctor()->getFees(); ?></td>
            <td><?php echo $appointment->getDate()."/".$appointment->getTime(); ?></td>
            <td><?php echo $appointment->getCreated_on(); ?></td>
            <td><?php echo $appointment->getStatus(); ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </body>
</html>
