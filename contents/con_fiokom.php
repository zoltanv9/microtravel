<?php
$userAdat = $felhasznalo->felhasznaloLekerdez($_SESSION['user_id']);

if($_GET['mod']){$userid = $_GET['mod'];}
else $userid = $_SESSION['user_id'];


?>
<div class="pt-5 pb-5 container">
	<div class="row">
		<div class="col-sm-9 form-group">
			<h3 class="pb-5">Fiókom</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus efficitur neque sem, efficitur viverra neque fringilla quis. Sed dictum laoreet felis. Cras eget bibendum orci. Quisque iaculis dapibus viverra. Integer arcu dolor, placerat eget iaculis a, ultricies iaculis diam. Nullam vestibulum ac erat sed auctor. </p>
            <form method="POST">
				<input type="hidden" name="f_id" value="<?php echo $userid; ?>">
				<label>Név*</label><br>
                <input type="text" class="form-control" name="nev" placeholder="Név*" value="<?php echo $userAdat['nev']; ?>" required>
				<label>E-mail*</label><br>
                <input type="email" class="form-control" name="email" placeholder="E-mail*" value="<?php echo $userAdat['email']; ?>" required>
				<label>Telefon*</label><br>
                <input type="text" class="form-control" name="tel" placeholder="Tel.: +36..." value="<?php echo $userAdat['tel']; ?>">
				<label>Kedvelt városaim</label><br>
				        <input type="text" class="form-control" name="kedv_varos" placeholder="Kedvelt városaim (vesszővel sorold fel...)" value="<?php echo $userAdat['f_kedv_varos']; ?>">
				<label>Csak akkor adj meg jelszót, ha a korábbit módosítani kívánod!</label>
                <input type="password" class="form-control" id="PASS1" name="pass1" placeholder="Jelszó, ha módosítod*">
				<input type="password" class="form-control" id="PASS2" name="pass2" placeholder="Jelszó újra*">
        		<input type="submit" class="form-control btn btn-warning btn-own" name="go_mod" value="ADATOK MÓDOSÍTÁSA">
	  		</form>
            <h5 class="pb-5 pt-5">Kiemelt ajánlatok</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus efficitur neque sem, efficitur viverra neque fringilla quis. Sed dictum laoreet felis. Cras eget bibendum orci. Quisque iaculis dapibus viverra. Integer arcu dolor, placerat eget iaculis a, ultricies iaculis diam. Nullam vestibulum ac erat sed auctor. </p>
      	</div>
		<div class="pb-5 col-sm-3">
			<?php include('contents/con_oldalsav.php'); ?>
		</div>
	</div>
</div>
<?php
if(isset($_POST['go_mod'])){
	$f_id = $_POST['f_id'];
	$oldal = 'fiokom';
	$felhasznalo->FelhasznMod($f_id, $oldal);
}
?>
