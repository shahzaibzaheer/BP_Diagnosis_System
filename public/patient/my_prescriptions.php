<?php  require_once('../../private/initialize.php');
    require_patient_login();  // this page will access only when patient is logged in

    // $prescriptions = Prescription::findPrescriptionsByPatientId(loggedInPatientId());
    $prescriptions = Prescription::findPrescriptionsByPatientId(loggedInPatientId());
    if(!$prescriptions){
      exit("No prescriptions found");
    }
    // print_array($prescriptions);
    // just print the data as in table format
    $page_title = "My Prescriptions";
    require_once(getSharedFilePath('patient/header.php'));

?>

    <section class="main_content mt-5 ">
      <?php echo output_message_if_any(); ?>
      <h1 class="mb-4 text-center">My Prescriptions</h1>
    <table  class=" col-11 mx-auto col-sm-8 mt-5 table table-responsive" >
      <thead>
        <tr>
          <th>Subject</th>
          <th>Status</th>
          <th>BP Reading</th>
          <th>Created On</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($prescriptions as $prescription): ?>
            <tr>
              <td><?php echo $prescription->getSubject(); ?></td>
              <td><?php echo $prescription->getStatus(); ?></td>
              <td><?php echo $prescription->getBpLow()." low, ".$prescription->getBpHigh()." high"; ?></td>
              <td><?php echo $prescription->getCreatedOn(); ?></td>
              <td></td>
              <td></td>
              <td> <a href="<?php echo urlFor("patient/my_prescription_detail.php?prescription_id=".$prescription->getPrescriptionId()) ?>">View</a> </td>
              <!-- <td> <a href="#">Cancel</a> </td> -->
            </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>

<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
