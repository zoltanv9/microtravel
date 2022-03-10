<?php
session_start();
require_once('osztalyok/Ab.php');
require_once('osztalyok/Felhasznalo.php');
require_once('osztalyok/Utazas.php');

//---példányosítás---
$felhasznalo = new Felhasznalo;
$utazas = new Utazas;

//---Kilépés, és $_SESSION változók törlése--
if($_GET['menu'] == 'kilepes'){
	$_SESSION['user'] = '';
	$_SESSION['user_id'] = '';
	$_SESSION['user_nev'] = '';
	$_SESSION['user_email'] = '';
	$_SESSION['user_stat'] = '';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MicroTravel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/microtravel/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <!-- Ikonok-->
  <link rel="stylesheet" id="font-awesome-official-css"  href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" type="text/css" media="all" integrity="sha384-v8BU367qNbs/aIZIxuivaU55N5GPF89WBerHoGA4QTcbUjYiLQtKdrfXnqAcXyTv" crossorigin="anonymous" />
  <link rel="stylesheet" id="font-awesome-official-v4shim-css"  href="https://use.fontawesome.com/releases/v5.12.1/css/v4-shims.css" type="text/css" media="all" integrity="sha384-C8a18+Gvny8XkjAdfto/vjAUdpGuPtl1Ix/K2BgKhFaVO6w4onVVHiEaN9h9XsvX" crossorigin="anonymous" />
  <style id="font-awesome-official-v4shim-inline-css" type="text/css">
  @font-face {
  font-family: "FontAwesome";
  src: url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-brands-400.eot"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-brands-400.eot?#iefix") format("embedded-opentype"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-brands-400.woff2") format("woff2"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-brands-400.woff") format("woff"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-brands-400.ttf") format("truetype"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-brands-400.svg#fontawesome") format("svg");
  }
  @font-face {
  font-family: "FontAwesome";
  src: url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-solid-900.eot"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-solid-900.eot?#iefix") format("embedded-opentype"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-solid-900.woff2") format("woff2"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-solid-900.woff") format("woff"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-solid-900.ttf") format("truetype"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-solid-900.svg#fontawesome") format("svg");
  }
  @font-face {
  font-family: "FontAwesome";
  src: url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-regular-400.eot"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-regular-400.eot?#iefix") format("embedded-opentype"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-regular-400.woff2") format("woff2"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-regular-400.woff") format("woff"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-regular-400.ttf") format("truetype"),
  		url("https://use.fontawesome.com/releases/v5.12.1/webfonts/fa-regular-400.svg#fontawesome") format("svg");
  		unicode-range: U+F004-F005,U+F007,U+F017,U+F022,U+F024,U+F02E,U+F03E,U+F044,U+F057-F059,U+F06E,U+F070,U+F075,U+F07B-F07C,U+F080,U+F086,U+F089,U+F094,U+F09D,U+F0A0,U+F0A4-F0A7,U+F0C5,U+F0C7-F0C8,U+F0E0,U+F0EB,U+F0F3,U+F0F8,U+F0FE,U+F111,U+F118-F11A,U+F11C,U+F133,U+F144,U+F146,U+F14A,U+F14D-F14E,U+F150-F152,U+F15B-F15C,U+F164-F165,U+F185-F186,U+F191-F192,U+F1AD,U+F1C1-F1C9,U+F1CD,U+F1D8,U+F1E3,U+F1EA,U+F1F6,U+F1F9,U+F20A,U+F247-F249,U+F24D,U+F254-F25B,U+F25D,U+F267,U+F271-F274,U+F279,U+F28B,U+F28D,U+F2B5-F2B6,U+F2B9,U+F2BB,U+F2BD,U+F2C1-F2C2,U+F2D0,U+F2D2,U+F2DC,U+F2ED,U+F328,U+F358-F35B,U+F3A5,U+F3D1,U+F410,U+F4AD;
  }
  </style>
</head>
<body>
<div class="container-fluid top-container">
	<div class="pt-2 pb-2 container">
		<div class="row">
			<div class="col-sm-6 top-box-left"><a href="mailto:info@microtravel.hu"><i class="fas fa-envelope"></i> info@microtravel.hu</a> <a href="tel:+36301118888"><i class="fas fa-phone"></i> +36 30 111 8888</a></div>
            <?php if(!$_SESSION['user']) { ?>
              <div class="col-sm-6 top-box-right"><button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#myModal">Bejelentkezés</button></div>
            <?php } else { ?>
              <div class="col-sm-6 top-box-right"><i class="fas fa-user-circle"></i> <b style="margin-right:15px;"><?php echo $_SESSION['user_nev']; ?></b> <a class="btn btn-outline-secondary btn-sm" href="/microtravel/fooldal?menu=kilepes" onclick="return confirm('Biztosan kilépsz?')">Kilépés</a></div>
            <?php } ?>
        </div>
	</div>
</div>
<div class="container-fluid nav-container">
	<div class="container">
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  			<a class="navbar-brand" href="/microtravel/fooldal"><img src="/microtravel/img/mic-logo.png" width="100%" /></a>
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    		<span class="navbar-toggler-icon"></span>
  			</button>
  			<div class="collapse navbar-collapse" id="collapsibleNavbar">
    			<ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="/microtravel/fooldal">Főoldal</a>
              </li>
      				<li class="nav-item">
        				<a class="nav-link" href="/microtravel/rolunk">Rólunk</a>
      				</li>
      				<li class="nav-item">
        				<a class="nav-link" href="/microtravel/varosok">Városok</a>
      				</li>
              <?php if($_SESSION['user_stat'] == 1) { ?>
       				<li class="nav-item dropdown">
      					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        					Utazás katalógus
      					</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="/microtravel/utazas/busz">Utazás autóbusszal</a>
                  <a class="dropdown-item" href="/microtravel/utazas/repulo">Utazás repülővel</a>
                  <a class="dropdown-item" href="/microtravel/utazas/hajo">Utazás hajóval</a>
                </div>
    			    </li>
						  <?php } if($_SESSION['user'] == 1) { ?>
      				<li class="nav-item">
        				<a class="nav-link" href="/microtravel/fiokom">Fiókom</a>
      				</li>
              <?php } ?>
                    <li class="nav-item">
        				<a class="nav-link" href="/microtravel/kapcsolat">Kapcsolat</a>
      				</li>
    			</ul>
  			</div>
		</nav>
	</div>
</div>
<?php if(!$_GET['menu'] || $_GET['menu'] == 'kilepes' || $_GET['menu'] == 'fooldal') { ?>
  <div class="bg-image p-5 text-center mb-5 text-white" style="background-image: url('img/city.jpg');">
    <h1 class="h2">MICROTRAVEL</h1>
		<p class="mb-5"><strong>Exlúzív utazások elérhető áron</strong></p>
    <p class="mb-5">
      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus praesentium
      labore accusamus sequi,<br>voluptate debitis tenetur in deleniti possimus modi voluptatum
      neque maiores dolorem unde?<br>Aut dolorum quod excepturi fugit.
    </p>
    <p>
      <a class="btn btn btn-light btn-lg text-dark" href="/microtravel/kapcsolat">KAPCSOLAT</a>
    </p>
  </div>
<?php } ?>

<!-- Login Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Bejelentkezés</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <!-- Bejelentkezés-->
        <div class="row">
          <div class="col-sm-12 form-group text-center">
          <form method="POST">
            <input type="email" class="form-control" name="email" placeholder="E-mail*" required>
            <input type="password" class="form-control" name="pass1" placeholder="Jelszó*" required>
            <input type="submit" class="form-control btn btn-warning" name="go_belep" value="BELÉPÉS">
          </form>
          </div>
        </div>
        <div id="demo" class="collapse">
          <div class="row">
          <div class="pb-3 col-sm-12">
            <h4 class="modal-title">Regisztráció</h4>
          </div>
          <div class="col-sm-12 form-group text-center">
           <form method="POST">
             <input type="text" class="form-control" name="nev" placeholder="Név*" required>
             <input type="email" class="form-control" name="email" placeholder="E-mail*" required>
             <input type="text" class="form-control" name="tel" placeholder="Tel.: +36...">
             <input type="text" class="form-control" name="kedv_varos" placeholder="Vesszővel sorolja fel kedvenc városait!">
             <input type="password" class="form-control" id="PASS1" name="pass1" placeholder="Jelszó*" required>
             <input type="password" class="form-control" id="PASS2" name="pass2" placeholder="Jelszó újra*" required>
             <input type="submit" class="form-control btn btn-primary btn-own" name="go_reg" value="REGISZTRÁCIÓ BEKÜLDÉSE">
           </form>
          </div>
         </div>
		    </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-success" data-toggle="collapse" data-target="#demo">Regisztráció</button> <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Bezár</button>
      </div>
    </div>
  </div>
</div>
<?php
//---- belepes -----------

if(isset($_POST['go_belep'])){

	$email = $_POST['email'];
	$felhasznBelep = $felhasznalo->felhasznBelep();
}
if(isset($_POST['go_reg'])){
  $kedv_varos = $_POST['kedv_varos'];
	$felhasznReg = $felhasznalo->FelhasznaloReg($kedv_varos);
}
?>
<div class="container-fluid">
	<?php
//--- menü betöltés------

	if(!$_GET['menu'] || $_GET['menu'] == 'kilepes' || $_GET['menu'] == 'fooldal'){

		include('contents/fooldal.php');

	}
	if($_GET['menu']){

		include('contents/con_'.$_GET['menu'].'.php');

	}
	?>
  <div class="pt-5 pb-5 fluid-container own-footer">
    <div class="container">
      <div class="row">
          <div class="col-sm-12 text-center">microtravel.hu © 2021 <a href="mailto:info@microtravel.hu"><i class="fas fa-envelope"></i> info@microtravel.hu</a> <a href="tel:+36301118888"><i class="fas fa-phone"></i> +36 30 111 8888</a></div>
      </div>
    </div>
  </div>
</div>
<!-- Password ellenőrzés -->
<script>
$('.btn-own').click(function (event) {
	if (PASS1.value != PASS2.value) {
      alert('A jelszavaknak egyezni kell!');
      return false;
	}
});
</script>
</body>
</html>
