<?php
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
  <div>
    <label for="">Email: </label>
    <input type="email" name="<?php echo PatientTable::COLUMN_EMAIL ?>" value="" >
  </div>
  <div>
    <label for="">Passwrod: </label>
    <input type="password" name="password">
  </div>
  <input type="submit" name="submit" value="Log in">
</form>

 ?>
