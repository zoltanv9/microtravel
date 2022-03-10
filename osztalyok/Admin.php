<?php
class Admin extends Ab {
/*
  public function AdminReg() {
    $con = $this->connect();
  }
  public function AdminLekerdez() {
    $con = $this->connect();
  }
  public function AdminMod() {
    $con = $this->connect();
  }
 */
  public function AdminBelep() {
    $con = $this->connect();
    $login = 'TiBER-2020';
    $admin_nev = 'Tiberius Admin';
      //vG+xv^6`/]9%t4_=
    $pass = '034a51278daf196b2c9edd35d7fda3ac0a6f4d7b';
    $login_e = $con->real_escape_string($_POST['fo_login']);
    $pass_e = $con->real_escape_string($_POST['fo_pass']);
    $pass_e = sha1($pass_e);
    if(($login == $login_e) && ($pass == $pass_e)){
      $_SESSION['admin'] = 1;
      $_SESSION['admin_nev'] = $admin_nev;
    }
    if(($login != $login_e)){
      echo'<script> alert("Hibás felhasználó") </script>';
	  echo '<meta http-equiv="refresh" content="0;url=index.php">';
    }
    if(($pass != $pass_e)){
      echo'<script> alert("Hibás jelszó") </script>';
	  echo '<meta http-equiv="refresh" content="0;url=index.php">';
    }
  }
}
?>
