<?php  require_once('../../private/initialize.php');
    require_admin_login();  // this page will access only when admin is logged in
    $patients = Patient::find_all_patients();
    if($patients===false){
      exit("No patient Found");
    }

    // print_array($patients);
    // exit;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Patients</title>
    <style media="screen">
      th,td{
        padding: 5px 10px;
      }
    </style>
  </head>
  <body>
    <h1>Manage Patients</h1>
    <table>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>City</th>
        <th>DOB</th>
        <th>Created On</th>
        <th>Action</th>
      </tr>
      <?php foreach ($patients  as $patient): ?>
        <tr>
          <td><?php echo $patient->getName(); ?></td>
          <td><?php echo $patient->getEmail(); ?></td>
          <td><?php echo $patient->getUserName(); ?></td>
          <td><?php echo $patient->getPhoneNumber(); ?></td>
          <td><?php echo $patient->getGender(); ?></td>
          <td><?php echo $patient->getCity(); ?></td>
          <td><?php echo $patient->getDob(); ?></td>
          <td><?php echo $patient->getCreatedOn(); ?></td>
          <td> <a href="<?php echo urlFor('admin/delete_patient.php')."?patient_id=".$patient->getId(); ?>">Remove</a> </td>
        </tr>
      <?php endforeach; ?>
    </table>

  </body>
</html>
