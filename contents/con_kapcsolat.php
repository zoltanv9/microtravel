
<?php
if($_SESSION['user'] == 1){
$userAdat = $felhasznalo->felhasznaloLekerdez($_SESSION['user_id']);
}
?>
<div class="pt-5 pb-5 container">
	<div class="row">
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-12"><h5>Kapcsolat</h5></div>
						  </div>
							<div class="row">
							<div class="col-sm-6 text-justify">
										<h6 class="mt-4 mb-4">Elérhetőségek</h6>
										<p><i class="fas fa-map-marker-alt"></i> 2600 Vác, Honvéd utca 1.</p>
										<p><i class="fas fa-envelope"></i> <a href="mailto:travel@microtravel.hu">travel@microtravel.hu</a></p>
										<p><i class="fas fa-phone"></i> <a href="tel:+3611234567">+36 1 123 4567</a></p>
										<p>
											<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2681.1934965580754!2d19.134626015931453!3d47.7776958841357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47402aee5599da9f%3A0x61e23cecd5bf151a!2zVsOhYywgSG9udsOpZCB1LiAxLCAyNjAw!5e0!3m2!1shu!2shu!4v1634212352858!5m2!1shu!2shu" width="100%" height="430" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
										</p>
							</div>
							<div class="col-sm-6 form-group">
								<form method="POST">
								<h6 class="mt-4 mb-4">Írjon nekünk!</h6>
								<label>Név*</label>
								<input class="form-control" type="text" name="nev" placeholder="Név*" value="<?php echo $userAdat['nev']; ?>" required>
								<label>E-mail*</label>
								<input class="form-control" type="email" name="email" placeholder="Email*" value="<?php echo $userAdat['email']; ?>" required>
								<label>Telefon</label>
								<input class="form-control" type="text" name="tel" placeholder="Tel:+36..." value="<?php echo $userAdat['tel']; ?>" required>
								<textarea class="form-control" name="uzenet" placeholder="Kérdés, üzenet..."></textarea>
								<input class="btn btn-outline-secondary w-100 mt-2" name="go_uzi" value="ÜZENET ELKÜLDÉSE">
								</form>
							</div>
							</div>
						</div>
			<div class="pb-5 col-sm-3">
							<?php include('contents/con_oldalsav.php'); ?>
			</div>
	</div>
</div>
