<?php  require_once('../../private/initialize.php');
    require_admin_login();  // this page will access only when admin is logged in
    $doctors = Doctor::find_all_doctors();
    if($doctors===false){
      exit("No doctor Found");
    }

    // print_array($doctors);
    // exit;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Doctors</title>
    <style media="screen">
      th,td{
        padding: 5px 10px;
      }
    </style>
  </head>
  <body>
    <h1>Manage Doctors</h1>
    <table>
      <tr>
        <th>Name</th>
        <th>Specialization</th>
        <th>Qualification</th>
        <th>Email</th>
        <th>Username</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>City</th>
        <th>DOB</th>
        <th>Created On</th>
        <th>Action</th>
      </tr>
      <?php foreach ($doctors  as $doctor): ?>
        <tr>
          <td><?php echo $doctor->getName(); ?></td>
          <td><?php echo $doctor->getSpecialization(); ?></td>
          <td><?php echo $doctor->getQualification(); ?></td>
          <td><?php echo $doctor->getEmail(); ?></td>
          <td><?php echo $doctor->getUserName(); ?></td>
          <td><?php echo $doctor->getPhone(); ?></td>
          <td><?php echo $doctor->getGender(); ?></td>
          <td><?php echo $doctor->getCity(); ?></td>
          <td><?php echo $doctor->getDob(); ?></td>
          <td><?php echo $doctor->getCreated_on(); ?></td>
          <td> <a href="<?php echo urlFor('admin/delete_doctor.php')."?doctor_id=".$doctor->getId(); ?>">Remove</a> </td>
        </tr>
      <?php endforeach; ?>
    </table>

  </body>
</html>
