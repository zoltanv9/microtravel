<?php
// -- Itt adjuk hozzá a szükséges külső erőforrásokat --------------------------
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
session_start();
require_once('../function.php');
require_once('../osztalyok/Ab.php');
require_once('../osztalyok/Felhasznalo.php');
require_once('../osztalyok/Admin.php');
require_once('../osztalyok/Utazas.php');
//------------ példányosítás----------------------------------------------------
$admin = new Admin;
$user = new Felhasznalo;
$utazas = new Utazas;
//------------ Kilépés esetén ez kiüríti a $_SESSION változókat-------------------
if($_GET['exit'] == 'ok'){
  $_SESSION['admin'] = '';
  $_SESSION['admin_nev'] = '';
  //session_destroy(); // Ez kinyirja session-t
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//HU" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Hívja azt a függvényt, ami  head-et elkészíti (function.php)  ----------->
<?php
mainHeader();
?>
<!-- Beléptető űrlap -->
<?php if($_SESSION['admin'] != 1 && !$_POST['belep_go']){ ?>
<div class="container">
  <form method="POST">
  <div class="pb-5 row">
  <div class="pt-5 pb-5 col-sm-12 text-center">
    <h3>MICRO TRAVEL adminisztrátori belépés</h3>
  </div>
  <div class="col-sm-4 offset-sm-4 form-group">
    <input type="text" class="form-control" name="fo_login" placeholder="Felhasználó*" value="<?php echo $_POST['login']; ?>" required>

  </div>
  <div class="col-sm-4 offset-sm-4 form-group">
    <input type="password" class="form-control" name="fo_pass" id="PASS" placeholder="Jelszó*" value="<?php echo $_POST['pass']; ?>" required>
    <span toggle="#PASS" class="fa fa-fw fa-eye field-icon toggle-password"></span>
  </div>
  <div class="col-sm-4 offset-sm-4 form-group">
    <input style="width:100%" type="submit" class="btn btn-warning" name="belep_go" value="BELÉPÉS A FELÜLETRE">
  </div>
  </div>
  </form>
</div>
<?php
}
if(isset($_POST['belep_go'])){
  $admin->AdminBelep();
}
if($_SESSION['admin'] == 1){
//---------------------Belépve, mint admin--------------------------------------
echo'
<div style="box-shadow:none !important; border:0; padding:0" class="container">
<nav style="border-bottom:1px solid #CCCCCC" class="navbar navbar-expand-lg navbar-light">
  <span style="background-color: #CCCCCC;padding: 5px 15px;"><i class="fas fa-user-tie"></i> '.$_SESSION['admin_nev'].'</span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Főoldal <span class="sr-only">(current)</span></a>
      </li>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-users-cog"></i> Felhasználók kezelése
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="?menu=ujfelhasznalo"><i class="fas fa-user-plus"></i> Új felhasználó hozzáadás</a>
          <a class="dropdown-item" href="?menu=aktiv-felhasznalok"><i class="fas fa-user"></i> Aktív felhasználók</a>
		  <a class="dropdown-item" href="?menu=inaktiv-felhasznalok"><i class="fas fa-user-slash"></i> Inaktív felhasználók</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-route"></i> Utazások kezelése
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="?menu=ujutazas"><i class="fas fa-user-plus"></i> Új utazás hozzáadás</a>
          <a class="dropdown-item" href="?menu=utazas-szerkesztes"><i class="fas fa-cog"></i> Utazás szerkesztés</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?exit=ok" onclick="return confirm(\'Biztosan kilépsz?\')"><i class="fas fa-sign-out-alt"></i> Kilépés</a>
      </li>
    </ul>
  </div>
</nav>
</div>
<div class="pt-5 container cont-own">
';
// A legfissebben regisztráltakból 10 személy listázása, ha nem kapunk menüt-----
if(!$_GET['menu'] || $_GET['menu'] == 'ujfelhasznalo' || $_GET['menu'] == 'ujutazas'){
$felhasznalokTombFo = $user->felhasznaloListaFo();
echo'
<div class="row">
<div class="pb-5 col-sm-12">
<h3>A legfrissebben regisztrált felhasználók</h3>
</div>
</div>
';

foreach($felhasznalokTombFo as $key => $value){
if($value['stat'] == 1){
	$status = '<a title="Inaktivál" href="?fid='.$value['f_id'].'&akt=0&oldal=fooldal"><i class="fas fa-toggle-on"></i></a>';
	$pont = '<div class="pont-zold"></div>';
}
if($value['stat'] == 0){
	$status = '<a title="Aktivál" href="?fid='.$value['f_id'].'&akt=1&oldal=fooldal"><i class="fas fa-toggle-off"></i></a>';
	$pont = '<div class="pont-piros"></div>';
}
echo
		'
		<div class="pb-3 row">
			<div class="col-sm-4">
				<label>Név</label><br>
				'.$pont.' '.$value['nev'].'<br>
				<span style="font-size:65%">Regisztráció: <b>'.$value['reg_datum'].'</b></span>
			</div>
			<div class="col-sm-3">
				<label>E-mail</label><br>
				<a href="mailto:'.$value['email'].'">'.$value['email'].'</a>
			</div>
			<div class="col-sm-3">
				<label>Tel</label><br>
				<a href="tel:'.$value['tel'].'">'.$value['tel'].'</a>
			</div>
			<div class="col-sm-1 text-center">
			<label>&nbsp;</label><br>
				<a title="Módosít" href="?mod='.$value['f_id'].'"><i class="fas fa-edit"></i></a>
			</div>
			<div class="col-sm-1 text-center">
			<label>&nbsp;</label><br>
				'.$status.'
			</div>
		</div><hr>
		';
}
if($_GET['fid']){
	$akt = $_GET['akt'];
	$fid = $_GET['fid'];
	$oldal = $_GET['oldal'];
	$user->FelhasznStatMod($akt,$fid,$oldal);
}
}
//--------------aktív felhasználók listázása------------------------------------
if($_GET['menu'] == 'aktiv-felhasznalok'){

echo'
<div class="row">
<div class="pb-5 col-sm-12">
<h3>Aktív felhasználók</h3>
<a style="padding:4px 8px; border:1px solid #CCC; border-radius:4px" href="?menu=aktiv-felhasznalok&alany=nev&rend=ASC">Rendezés név szerint</a> <a style="padding:4px 8px; border:1px solid #CCC; border-radius:4px" href="?menu=aktiv-felhasznalok&alany=f_id&rend=DESC">Rendezés id szerint</a>
</div>
</div>
';

$alany = 'f_id';  // ez maradt ki :(
$rend = 'DESC';   // ez is kimaradt :(
if($_GET['alany']){
	$alany = $_GET['alany'];
	$rend = $_GET['rend'];
}

$felhasznalokTombAktiv = $user->felhasznaloListaAktiv($alany,$rend);

foreach($felhasznalokTombAktiv as $key => $value){

echo
		'
		<div class="pb-3 row">
			<div class="col-sm-4">
				<label>Név</label><br>
				<div class="pont-zold"></div>'.$value['nev'].'
			</div>
			<div class="col-sm-3">
				<label>E-mail</label><br>
				<a href="mailto:'.$value['email'].'?subject=Üzenet az utazási irodától...&body=Kedves '.$value['nev'].'!">'.$value['email'].'</a>
			</div>
			<div class="col-sm-3">
				<label>Tel</label><br>
				<a href="tel:'.$value['tel'].'">'.$value['tel'].'</a>
			</div>
			<div class="col-sm-1 text-center">
			<label>&nbsp;</label><br>
				<a title="Módosít" href="?mod='.$value['f_id'].'&menu=aktiv-felhasznalok"><i class="fas fa-edit"></i></a>
			</div>
			<div class="col-sm-1 text-center">
			<label>&nbsp;</label><br>
				<a title="Inktivál" href="?fid='.$value['f_id'].'&akt=0&oldal=aktiv"><i class="fas fa-toggle-on"></i></a>
			</div>
		</div><hr>
		';
}
if($_GET['fid']){
	$akt = $_GET['akt'];
	$fid = $_GET['fid'];
	$oldal = $_GET['oldal'];
	$user->FelhasznStatMod($akt,$fid,$oldal);
}
}
//--------------------Inaktív felhasználók listázása----------------------------
if($_GET['menu'] == 'inaktiv-felhasznalok'){
$felhasznalokTombInaktiv = $user->felhasznaloListaInaktiv();
echo'
<div class="row">
<div class="pb-5 col-sm-12">
<h3>Inaktív felhasználók</h3>
</div>
</div>
';

foreach($felhasznalokTombInaktiv as $key => $value){

echo
		'
		<div class="pb-3 row">
			<div class="col-sm-4">
				<label>Név</label><br>
				<div class="pont-piros"></div>'.$value['nev'].'
			</div>
			<div class="col-sm-3">
				<label>E-mail</label><br>
				<a href="mailto:'.$value['email'].'">'.$value['email'].'</a>
			</div>
			<div class="col-sm-3">
				<label>Tel</label><br>
				<a href="tel:'.$value['tel'].'">'.$value['tel'].'</a>
			</div>
			<div class="col-sm-1 text-center">
			<label>&nbsp;</label><br>
				<a title="Módosít" href="?mod='.$value['f_id'].'&menu=inaktiv-felhasznalok"><i class="fas fa-edit"></i></a>
			</div>
			<div class="col-sm-1 text-center">
			<label>&nbsp;</label><br>
				<a title="Aktivál" href="?fid='.$value['f_id'].'&akt=1&oldal=inaktiv"><i class="fas fa-toggle-off"></i></a>
			</div>
		</div><hr>
		';
}
if($_GET['fid']){
	$akt = $_GET['akt'];
	$fid = $_GET['fid'];
	$oldal = $_GET['oldal'];
	$user->FelhasznStatMod($akt,$fid,$oldal);
}
}
//-------------------új felhasználó---------------------------------------------

if($_GET['menu'] == 'ujfelhasznalo'){

echo'
<!-- Ide kell egy javascript, hogy megnyíljon a modal -->
<script type="text/javascript">
    $(window).on(\'load\',function(){
        $(\'#myModal1\').modal(\'show\');
    });
</script>
<!-- The Modal -->
<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Új felhasználó</span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST">
		<input type="text" class="form-control" name="nev" placeholder="Név*" value="'.$_POST['nev'].'" required>
		<input type="email" class="form-control" name="email" placeholder="E-mail*" value="'.$_POST['email'].'" required>
		<input type="text" class="form-control" name="tel" placeholder="Tel.: +36..." value="'.$_POST['tel'].'">
		<input type="password" class="form-control" id="PASS1" name="pass1" placeholder="Jelszó*" required>
		<input type="password" class="form-control" id="PASS2" name="pass2" placeholder="Jelszó újra*"required>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
	  	<input type="submit" class="form-control btn btn-warning btn-own" id="GO_REG" name="go_reg" value="ADATOK RÖGZÍTÉSE">
	  	</form>
      </div>

    </div>
  </div>
</div>
';
if($_POST['go_reg']){
   $user->FelhasznaloReg();
}
}
//-------------------felhasználó adatmódosítása---------------------------------

if($_GET['mod']){

	$fid = $_GET['mod'];
	$felhasznaloAdatat = $user->felhasznaloLekerdez($fid);

echo'
<!-- Ide kell egy javascript, hogy megnyíljon a modal -->

<script type="text/javascript">
    $(window).on(\'load\',function(){
        $(\'#myModal\').modal(\'show\');
    });
</script>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">'.$felhasznaloAdatat['nev'].'<span style="font-size:65%"> adatainak kezelése</span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST">
		<input type="hidden" name="f_id" value="'.$felhasznaloAdatat['f_id'].'">
		<input type="hidden" name="menu" value="'.$_GET['menu'].'">
		<input type="text" class="form-control" name="nev" placeholder="Név*" value="'.$felhasznaloAdatat['nev'].'" required>
		<input type="email" class="form-control" name="email" placeholder="E-mail*" value="'.$felhasznaloAdatat['email'].'" required>
		<input type="text" class="form-control" name="tel" placeholder="Tel.: +36..." value="'.$felhasznaloAdatat['tel'].'">
    <input type="text" class="form-control" name="kedv_varos" placeholder="Kedvelt városok (vesszővel tagolva add meg...)" value="'.$felhasznaloAdatat['f_kedv_varos'].'">
		<input type="password" class="form-control" id="PASS1" name="pass1" placeholder="Jelszó, ha módosítod*">
		<input type="password" class="form-control" id="PASS2" name="pass2" placeholder="Jelszó újra*">
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
	  	<input type="submit" class="form-control btn btn-warning btn-own" name="go_mod" value="ADATOK MÓDOSÍTÁSA">
	  	</form>
      </div>

    </div>
  </div>
</div>
';
if($_POST['go_mod']){
   $fid = $_POST['f_id'];
   $oldal = $_POST['menu'];
   $user->FelhasznMod($fid, $oldal);
}
}
//----------------------------új utazás feltöltése------------------------------
if($_GET['menu'] == 'ujutazas' ){
  if(!file_exists('uploads/'.$value['admin_logo']) || $logokep == ''){
					$logokep = 'travellogo.jpg';
				}
echo
'<!-- Ide kell egy javascript, hogy megnyíljon a modal -->
<script type="text/javascript">
    $(window).on(\'load\',function(){
        $(\'#myModalUt\').modal(\'show\');
    });
</script>
<!-- The Modal -->
<div class="modal" id="myModalUt">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Új utazás rögzítése</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-12 form-group">
              <label>Utazás neve*</label>
              <input type="text" class="form-control" name="utazas_nev" placeholder="Utazás név*" value="'.$_POST['utazas_nev'].'" required>
            </div>
            <div class="col-sm-12 form-group">
		          <label>Tervezett kezdési dátum*</label>
		          <input class="form-control" id="date1" name="date1" type="text" placeholder="Indulási dátum*" autocomplete="off" value="'.$_POST['date1'].'" required>
		        </div>
            <div class="col-sm-12 form-group">
              <label>Utazás típusa*</label>
              <select class="form-control" name="utazas_tipus" required>
              <option value="">Válassz...</option>
              <option value="Autóbusz">Autóbusz</option>
              <option value="Repülő">Repülő</option>
              <option value="Hajó">Hajó</option>
              </select>
            </div>
            <div class="col-sm-12 form-group">
              <label>Utazás jellege*</label>
              <select class="form-control" name="utazas_jelleg" required>
              <option value="">Válassz...</option>
              <option value="Normal">Normál</option>
              <option value="First minute">First minute</option>
              <option value="Last minute">Last minute</option>
              <option value="All in">All in</option>
              </select>
            </div>
            <div class="col-sm-10 form-group">
              <label>Utazás leírás</label>
              <textarea class="form-control" name="utazas_leiras"></textarea>
            </div>
            <div class="col-sm-12 form-group">
              <label>Utazás ár*</label>
              <input type="text" class="form-control" name="utazas_ar" placeholder="Utazás ár*" value="'.$_POST['utazas_ar'].'" required>
            </div>
            <div style="padding:0 15px" class="col-sm-12">
              <div style="border:3px dashed #CCCCCC; background-color:#F9F9F9" class="pt-4 pb-3 col-sm-12">
                <div class="col-sm-12 text-center">
                  <img src="../uploads/'.$logokep.'" id="preview" class="img-thumbnail">
                </div>
              <div class="col-sm-12">
                <input type="file" name="utazaslogo" class="file" accept="image/*">
                  <div class="input-group my-3">
                    <input type="text" class="form-control" disabled placeholder="Válassz képet..." id="file">
                  <div class="input-group-append">
                    <button type="button" class="browse btn btn-primary">Tallózás...</button>
                  </div>
                  </div>
              </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <div class="pt-5 col-sm-12 form-group">
                <input type="submit" class="form-control btn btn-warning btn-own" name="ut_reg" value="ADATOK FELVITEL">
              </div>
              </form>
            </div>
';

if(isset($_POST['ut_reg'])){
  if(!empty($_FILES['utazaslogo'])){
					$path = '../uploads/';
					$path = $path.session_id().'-'.time().'-'.basename( $_FILES['utazaslogo']['name']);

					if(move_uploaded_file($_FILES['utazaslogo']['tmp_name'], $path)) {
						$kepnev = session_id().'-'.time().'-'.basename( $_FILES['utazaslogo']['name']);
						/* echo '<script>alert("A képfeltöltés sikerült.")</script>'; */
					}
					else{
						/* echo '<script>alert("A képfeltöltés nem sikerült.")</script>'; */
					}
				}
$utazas->UtazasReg($kepnev);
}
}
//------------------------utazások listázása------------------------------------
if($_GET['menu'] == 'utazas-szerkesztes'){
  $utazasTomb = $utazas->UtazasLista();

  echo
			'<form method="POST">
			   <div class="row">
			      <div class="pt-3 pb-3 col-sm-12">
			           <h5>Keresés az utazások között</h5>
			           <p style="font-size:85%"><i class="fas fa-info-circle"></i> Kezdd el beírni az utazás nevét vagy kódját és a kiválasztás után kattintson a LEKÉRDEZ gombra!<p>
			      </div>
			      <div class="col-sm-10 form-group">
	      	       <input type="text" class="form-control" name="u_lista" id="LISTA" autocomplete="off" placeholder="Utazás név vagy utazás kód...">
	          </div>
			      <div class="col-sm-2 form-group">
					       <input style="width:100%" type="submit" class="btn btn-warning" name="ut_keres_go" value="LEKÉRDEZ">
			      </div>
			   </div>
			</form>';

//--------------utazás egyedi lekérdezés----------------------------------------
if($_POST['ut_keres_go']){
  $utazas_resz = explode(' ',$_POST['u_lista']);
  $utazasKonkret = $utazas->UtazasKonkret($utazas_resz[0]);
  foreach($utazasKonkret as $key => $value){
    if($value['utazas_stat'] == 1){
    	$status = '<a title="Inaktivál" href="?utid='.$value['ut_id'].'&akt=0&menu=utazas-szerkesztes"><i class="fas fa-toggle-on"></i></a>';
    	$pont = '<div class="pont-zold"></div>';
    }
    if($value['utazas_stat'] == 0){
    	$status = '<a title="Aktivál" href="?utid='.$value['ut_id'].'&akt=1&menu=utazas-szerkesztes"><i class="fas fa-toggle-off"></i></a>';
    	$pont = '<div class="pont-piros"></div>';
    }
    echo
    		'
    		<div class="pb-3 row">
    			<div class="col-sm-4">
    				<label>Utazás név</label><br>
    				'.$pont.' '.$value['utazas_nev'].' ('.$value['utazas_ind_datum'].')
    			</div>
    			<div class="col-sm-2">
    				<label>Utazás típus</label><br>
    				'.$value['utazas_tipus'].'
    			</div>
    			<div class="col-sm-2">
    				<label>Utazas jelleg</label><br>
    				'.$value['utazas_jelleg'].'
    			</div>
          <div class="col-sm-2">
    				<label>Utazas ár</label><br>
    				'.$value['utazas_ar'].'
    			</div>
    			<div class="col-sm-1 text-center">
    			<label>&nbsp;</label><br>
    				<a title="Módosít" href="?utmod='.$value['ut_id'].'&menu=utazas-szerkesztes"><i class="fas fa-edit"></i></a>
    			</div>
    			<div class="col-sm-1 text-center">
    			<label>&nbsp;</label><br>
    				'.$status.'
    			</div>
    		</div><hr>
    		';
  }
}
//-------------utazás lista keresés nélkül------------------------------------
if(!$_POST['ut_keres_go']){
  foreach($utazasTomb as $key => $value){
    if($value['utazas_stat'] == 1){
    	$status = '<a title="Inaktivál" href="?utid='.$value['ut_id'].'&akt=0&menu=utazas-szerkesztes"><i class="fas fa-toggle-on"></i></a>';
    	$pont = '<div class="pont-zold"></div>';
    }
    if($value['utazas_stat'] == 0){
    	$status = '<a title="Aktivál" href="?utid='.$value['ut_id'].'&akt=1&menu=utazas-szerkesztes"><i class="fas fa-toggle-off"></i></a>';
    	$pont = '<div class="pont-piros"></div>';
    }
    echo
    		'
    		<div class="pb-3 row">
    			<div class="col-sm-4">
    				<label>Utazás név</label><br>
    				'.$pont.' '.$value['utazas_nev'].' ('.$value['utazas_ind_datum'].')
    			</div>
    			<div class="col-sm-2">
    				<label>Utazás típus</label><br>
    				'.$value['utazas_tipus'].'
    			</div>
    			<div class="col-sm-2">
    				<label>Utazas jelleg</label><br>
    				'.$value['utazas_jelleg'].'
    			</div>
          <div class="col-sm-2">
    				<label>Utazas ár</label><br>
    				'.$value['utazas_ar'].'
    			</div>
    			<div class="col-sm-1 text-center">
    			<label>&nbsp;</label><br>
    				<a title="Módosít" href="?utmod='.$value['ut_id'].'&menu=utazas-szerkesztes"><i class="fas fa-edit"></i></a>
    			</div>
    			<div class="col-sm-1 text-center">
    			<label>&nbsp;</label><br>
    				'.$status.'
    			</div>
    		</div><hr>
    		';
  }
}
  if($_GET['utid']){
    $akt = $_GET['akt'];
    $ut_id = $_GET['utid'];
    $menu = $_GET['menu'];
    $utazas->UtazasStatMod($akt,$ut_id,$menu);
  }
}
//---------------------------utazás módosítás-----------------------------------
if($_GET['utmod'] && !$_POST['ut_keres_go']){
$ut_id = $_GET['utmod'];
$utazasEgyed = $utazas->UtazasListaEgyed($ut_id);
if($utazasEgyed['utazas_kep'] == 'Nincs foto'){
  $utazasEgyed['utazas_kep'] = 'travellogo.jpg';
}
echo
'<!-- Ide kell egy javascript, hogy megnyíljon a modal -->
<script type="text/javascript">
    $(window).on(\'load\',function(){
        $(\'#myModalUtmod\').modal(\'show\');
    });
</script>
<!-- The Modal -->
<div class="modal" id="myModalUtmod">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">'.$utazasEgyed['utazas_nev'].' <span style="font-size:65%"> ('.$utazasEgyed['utazas_id'].') utazás kezelése</span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-12 form-group">
              <label>Utazás neve*</label>
              <input type="hidden" name="ut_id" value="'.$utazasEgyed['ut_id'].'">
              <input type="hidden" name="ut_kep" value="'.$utazasEgyed['utazas_kep'].'">
              <input type="text" class="form-control" name="utazas_nev" placeholder="Utazás név*" value="'.$utazasEgyed['utazas_nev'].'" required>
            </div>
            <div class="col-sm-12 form-group">
		          <label>Tervezett kezdési dátum*</label>
		          <input class="form-control" id="date1" name="date1" type="text" placeholder="Indulási dátum*" autocomplete="off" value="'.$utazasEgyed['utazas_ind_datum'].'" required>
		        </div>
            <div class="col-sm-12 form-group">
              <label>Utazás típusa*</label>
              <select class="form-control" name="utazas_tipus" required>';
              if($utazasEgyed['utazas_tipus'] == 'Autóbusz'){$selected1 = 'selected';}
              if($utazasEgyed['utazas_tipus'] == 'Repülő'){$selected2 = 'selected';}
              if($utazasEgyed['utazas_tipus'] == 'Hajó'){$selected3 = 'selected';}
              echo
              '<option value="">Válassz...</option>
              <option '.$selected1.' value="Autóbusz">Autóbusz</option>
              <option '.$selected2.' value="Repülő">Repülő</option>
              <option '.$selected3.' value="Hajó">Hajó</option>
              </select>
            </div>
            <div class="col-sm-12 form-group">
              <label>Utazás jellege*</label>
              <select class="form-control" name="utazas_jelleg" required>';
              if($utazasEgyed['utazas_jelleg'] == 'Normal'){$selected4 = 'selected';}
              if($utazasEgyed['utazas_jelleg'] == 'First minute'){$selected5 = 'selected';}
              if($utazasEgyed['utazas_jelleg'] == 'Last minute'){$selected6 = 'selected';}
              if($utazasEgyed['utazas_jelleg'] == 'All in'){$selected7 = 'selected';}
              echo
              '<option value="">Válassz...</option>
              <option '.$selected4.' value="Normal">Normál</option>
              <option '.$selected5.' value="First minute">First minute</option>
              <option '.$selected6.' value="Last minute">Last minute</option>
              <option '.$selected7.' value="All in">All in</option>
              </select>
            </div>
            <div class="col-sm-10 form-group">
              <label>Utazás leírás</label>
              <textarea class="form-control" name="utazas_leiras">'.$utazasEgyed['utazas_leiras'].'</textarea>
            </div>
            <div class="col-sm-12 form-group">
              <label>Utazás ár*</label>
              <input type="text" class="form-control" name="utazas_ar" placeholder="Utazás ár*" value="'.$utazasEgyed['utazas_ar'].'" required>
            </div>
            <div style="padding:0 15px" class="col-sm-12">
              <div style="border:3px dashed #CCCCCC; background-color:#F9F9F9" class="pt-4 pb-3 col-sm-12">
                <div class="col-sm-12 text-center">
                  <img src="../uploads/'.$utazasEgyed['utazas_kep'].'" id="preview" class="img-thumbnail">
                </div>
              <div class="col-sm-12">
                <input type="file" name="utazaslogo" class="file" accept="image/*">
                  <div class="input-group my-3">
                    <input type="text" class="form-control" disabled placeholder="Válassz képet..." id="file">
                  <div class="input-group-append">
                    <button type="button" class="browse btn btn-primary">Tallózás...</button>
                  </div>
                  </div>
              </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <div class="pt-5 col-sm-12 form-group">
                <input type="submit" class="form-control btn btn-warning btn-own" name="ut_mod" value="ADATOK MÓDOSÍTÁSA">
              </div>
              </form>
            </div>
';
}
if($_POST['ut_mod']){

  if(!empty($_FILES['utazaslogo'])){
          $path = '../uploads/';
          $path = $path.session_id().'-'.time().'-'.basename( $_FILES['utazaslogo']['name']);

          if(move_uploaded_file($_FILES['utazaslogo']['tmp_name'], $path)) {
            $kepnev = session_id().'-'.time().'-'.basename( $_FILES['utazaslogo']['name']);
            /*echo '<script>alert("A képfeltöltés sikerült.")</script>'; */
          }
          else{
            /* echo '<script>alert("A képfeltöltés nem sikerült.")</script>' ; */
          }
        }

$ut_id = $_POST['ut_id'];
$logokep = $_POST['ut_kep'];
$utazas->utazasMod($ut_id,$kepnev,$logokep);
}
}
?>
</div>
</div>
<script src="../js/naptar.js"></script>
<!-- A script megváltoztatja kliens oldalon a mező típusát -->
<script>
$(".toggle-password").click(function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  }
	else {
    input.attr("type", "password");
  }
});
</script>
<!-- Ellenörző JS-(ek) -->
<script>
$('#GO_REG').click(function (event) {
	if (PASS1.value != PASS2.value) {
      alert('A jelszavaknak egyezni kell!');
      return false;
	}
});
</script>
<!-- !Ellenörző JS-(ek) -->
<!-- Fájlfeltöltő mező animációja -->
<script>
$(document).on("click", ".browse", function() {
  var file = $(this).parents().find(".file");
  file.trigger("click");
});
$('input[type="file"]').change(function(e) {
  var fileName = e.target.files[0].name;
  $("#file").val(fileName);

  var reader = new FileReader();
  reader.onload = function(e) {
    // betöltött adatok lekérése és indexképek renderelése.
    document.getElementById("preview").src = e.target.result;
  };
  // beolvassa a képfájlt adatot URL-ként.
  reader.readAsDataURL(this.files[0]);
});
$("#file-1").fileinput({
    theme: 'fa',
    uploadUrl: '#',
    allowedFileExtensions: ['jpg', 'png', 'gif'],
    overwriteInitial: false,
    maxFileSize:2000,
    maxFilesNum: 10,
    slugCallback: function (filename) {
    return filename.replace('(', '_').replace(']', '_');
    }
});
</script>
<!-- Fájlfeltöltő mező animációja -->
<!-- Utazáskereső -->

<script>
$( function() {
var utazaslista = [
<?php
foreach($utazasTomb as $key => $value){
	echo '"'.$value['utazas_id'].' • '.$value['utazas_nev'].'",';
}
?>
];
    $( "#LISTA" ).autocomplete({
      source: utazaslista
    });
  } );
</script>
</body>
</body>
</html>
