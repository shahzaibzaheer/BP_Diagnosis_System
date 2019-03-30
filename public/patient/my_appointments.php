<?php  require_once('../../private/initialize.php');
    require_patient_login();  // this page will access only when patient is logged in
    $patientId = loggedInPatientId();
    // grab all patient's appointments
    $appointments = Appointment::findAppointmentsByPatientId($patientId);
    if(!$appointments){
      exit("You have no appointments");
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Appointments</title>
    <style media="screen">
      td,th{
        padding: 8px 16px;
      }
    </style>
  </head>
  <body>
    <h1>My all appointments</h1>
    <table>
      <thead>
        <tr>
          <th>Problem</th>
          <th>Doctor Name</th>
          <th>Fees</th>
          <th>Appointment Date/Time</th>
          <th>Status</th>
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
              <td> <a href="#">View</a> </td>
              <td> <a href="<?php echo urlFor('patient/cancel_appointment.php?appointment_id='.$appointment->getId()); ?>">Cancel</a> </td>

          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </body>
</html>
