<?php require_once('../../private/initialize.php');
  require_doctor_login();  // this page will access only when patient is logged in
  $prescriptons = Prescription::find_all_prescriptions();
  if(!$prescriptons){
    exit("No prescription found");
  }
  $page_title = "Prescription Requests";
  require_once(getSharedFilePath('doctor/header.php'));
?>

  <section class="main_content mb-5">
    <h1 class="mb-4 text-center">Prescriptions Requests</h1>
    <table  class=" col-11 mx-auto col-sm-8 mt-5 table table-responsive" >
      <thead>
        <tr>
          <th>Patient Name</th>
          <th>Patient Email</th>
          <th>Prescription Subject</th>
          <th>BP Reading</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($prescriptons as $prescription): ?>
          <tr>
            <?php if(!$prescription->getDoctorId()) {  ?> <!-- wohi posts output krni hy jis ka kisi doctor ny replay na kiya ho -->
            <td><?php echo $prescription->getPatientName(); ?></td>
            <td><?php echo $prescription->getPatientEmail(); ?></td>
            <td><?php echo $prescription->getSubject(); ?></td>
            <td><?php echo $prescription->getBpLow()." Low, ".$prescription->getBpHigh()." High"; ?></td>
            <td> <a href="<?php echo urlFor("doctor/prescription_detail.php?prescription_id=").$prescription->getPrescriptionId(); ?>">View</a> </td>
          </tr>
        <?php }endforeach; ?>
        </tbody>
    </table>
  </section>



<?php     require_once(getSharedFilePath('doctor/footer.php')); ?>
