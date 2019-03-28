<?php  require_once('../../private/initialize.php');
    require_patient_login();  // this page will access only when patient is logged in

    // $prescriptions = Prescription::findPrescriptionsByPatientId(loggedInPatientId());
    $prescriptions = Prescription::findPrescriptionsByPatientId(loggedInPatientId());
    if(!$prescriptions){
      exit("No prescriptions found");
    }
    // print_array($prescriptions);
    // just print the data as in table format
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Prescriptions</title>
    <style media="screen">
      td,th{
        padding: 8px 16px;
      }
    </style>
  </head>
  <body>
    <h1>My Prescriptions</h1>
    <table>
      <thead>
        <tr>
          <th>Subject</th>
          <th>Status</th>
          <th>BP Reading</th>
          <th>Created On</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($prescriptions as $prescription): ?>
            <tr>
              <td><?php echo $prescription->getSubject(); ?></td>
              <td><?php echo $prescription->getStatus(); ?></td>
              <td><?php echo $prescription->getBpLow()." low, ".$prescription->getBpHigh()." high"; ?></td>
              <td><?php echo $prescription->getCreatedOn(); ?></td>
              <td> <a href="<?php echo urlFor("patient/my_prescription_detail.php?id=".$prescription->getPrescriptionId()) ?>">View</a> </td>
              <td> <a href="#">Cancel</a> </td>
            </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </body>
</html>
