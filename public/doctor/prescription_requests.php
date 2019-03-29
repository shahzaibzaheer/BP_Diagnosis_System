<?php require_once('../../private/initialize.php');
  require_doctor_login();  // this page will access only when patient is logged in
  $prescriptons = Prescription::find_all_prescriptions();
  if(!$prescriptons){
    exit("No prescription found");
  }


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Prescription Requests</title>
    <style media="screen">
      *{
        font-family: sans-serif;
      }
      th,td{
        padding: 8px 16px;
      }
    </style>
  </head>
  <body>
    <h1>Patient's Prescriptions Requests</h1>
    <table>
        <tr>
          <th>Patient Name</th>
          <th>Patient Email</th>
          <th>Prescription Subject</th>
          <th>BP Reading</th>
        </tr>
        <?php foreach ($prescriptons as $prescription): ?>
          <tr>
            <td><?php echo $prescription->getPatientName(); ?></td>
            <td><?php echo $prescription->getPatientEmail(); ?></td>
            <td><?php echo $prescription->getSubject(); ?></td>
            <td><?php echo $prescription->getBpLow()." Low, ".$prescription->getBpHigh()." High"; ?></td>
            <td> <a href="<?php echo urlFor("doctor/prescription_detail.php?prescription_id=").$prescription->getPrescriptionId(); ?>">View</a> </td>
            <td> <a href="<?php echo urlFor("doctor/prescription_detail.php?prescription_id=").$prescription->getPrescriptionId(); ?>">Replay</a> </td>
          </tr>
        <?php endforeach; ?>
        <!-- <tr>
          <td>salman</td>
          <td>salman@gmail.com</td>
          <td>60 Low , 160 High</td>
          <td> <a href="#">View</a> </td>
          <td> <a href="#">Replay</a> </td>
        </tr> -->
    </table>
  </body>
</html>
