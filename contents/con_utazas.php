<?php
$utazasAdat = $utazas->UtazasLista();
if($_GET['typ'] == 'busz'){
				echo
				'<div class="pt-5 pb-5 container">
					<div class="row">
						<div class="col-sm-9">
							<div class="row">
							<div class="col-sm-12"><h5>Utazások autóbusszal</h5></div>';
						 foreach($utazasAdat as $idx => $value){
							 if(!file_exists('uploads/'.$value['utazas_kep'])){$value['utazas_kep'] = 'busz-1.jpg';}
							 if($value['utazas_jelleg'] == 'Normal'){$value['utazas_jelleg'] = 'Economy';}
								switch($value['utazas_jelleg']){
									case 'Economy':
									$jelleg_box = 'jelleg-box-eco';
									break;
									case 'First minute':
									$jelleg_box = 'jelleg-box-last';
									break;
									case 'Last minute':
									$jelleg_box = 'jelleg-box-first';
									break;
									case 'All in':
									$jelleg_box = 'jelleg-box-all';
									break;
								}
								if($value['utazas_tipus'] == 'Autóbusz' && $value['utazas_stat'] == 1){
									echo
									'<div class="pb-2 pt-2 col-sm-4">
											<div style="box-shadow:2px 0px 8px #CCCCCC" class="pt-3 pb-3 col-sm-12">
												<img alt="'.$value['utazas_nev'].'" class="img-fluid" src="http://localhost/microtravel/uploads/'.$value['utazas_kep'].'" title="'.$value['utazas_nev'].'"><br>
												<h6 class="pt-2 pb-2 text-center">'.$value['utazas_nev'].'<br><br><span class="'.$jelleg_box.'">'.$value['utazas_jelleg'].'</span></h6>
												<p style="text-align:justify; font-size:85%">'.$value['utazas_leiras'].'</p>
												<p style="text-align:left; font-size:85%"><b><i class="fas fa-bus"></i> Indulás:</b> '.$value['utazas_ind_datum'].'</p>
												<h5 class="text-center">'.$value['utazas_ar'].'</h5>
												<p class="pt-3 text-center">
												<a href="http://localhost/microtravel/utazas/busz/erdekel&utazas_nev='.$value['utazas_nev'].'&utazas_id='.$value['utazas_id'].'"><button class="btn btn-warning"><i class="fas fa-envelope"></i> ÉRDEKEL AZ ÚT</button></a></p>
											</div>
									</div>';
								}
						}
					echo
					'</div>
					</div>
						<div class="pb-5 col-sm-3">';
							include('contents/con_oldalsav.php');
					echo
					 '</div>
					</div>
				 </div>';
}
if($_GET['typ'] == 'hajo'){
				echo
				'<div class="pt-5 pb-5 container">
					<div class="row">
						<div class="col-sm-9">
							<div class="row">
							<div class="col-sm-12"><h5>Utazások hajóval</h5></div>';
						 foreach($utazasAdat as $idx => $value){
							  if(!file_exists('uploads/'.$value['utazas_kep'])){$value['utazas_kep'] = 'hajo-1.jpg';}
							  if($value['utazas_jelleg'] == 'Normal'){$value['utazas_jelleg'] = 'Economy';}
								switch($value['utazas_jelleg']){
									case 'Economy':
									$jelleg_box = 'jelleg-box-eco';
									break;
									case 'First minute':
									$jelleg_box = 'jelleg-box-last';
									break;
									case 'Last minute':
									$jelleg_box = 'jelleg-box-first';
									break;
									case 'All in':
									$jelleg_box = 'jelleg-box-all';
									break;
								}
								if($value['utazas_tipus'] == 'Hajó' && $value['utazas_stat'] == 1){
									echo
									'<div class="pb-2 pt-2 col-sm-4">
											<div style="box-shadow:2px 0px 8px #CCCCCC" class="pt-3 pb-3 col-sm-12">
												<img class="img-fluid" src="http://localhost/microtravel/uploads/'.$value['utazas_kep'].'" ><br>
												<h6 class="pt-2 pb-2 text-center">'.$value['utazas_nev'].'<br><br><span class="'.$jelleg_box.'">'.$value['utazas_jelleg'].'</span></h6>
												<p style="text-align:justify; font-size:85%">'.$value['utazas_leiras'].'</p>
												<p style="text-align:left; font-size:85%"><b><i class="fas fa-ship"></i> Indulás:</b> '.$value['utazas_ind_datum'].'</p>
												<h5 class="text-center">'.$value['utazas_ar'].'</h5>
												<p class="pt-3 text-center"><a href="http://localhost/microtravel/utazas/hajo/erdekel&utazas_nev='.$value['utazas_nev'].'&utazas_id='.$value['utazas_id'].'"><button class="btn btn-warning"><i class="fas fa-envelope"></i> ÉRDEKEL AZ ÚT</button></a></p>
											</div>
									</div>';
								}
						}
					echo
					'</div>
					</div>
						<div class="pb-5 col-sm-3">';
							include('contents/con_oldalsav.php');
					echo
					 '</div>
					</div>
				 </div>';
}
if($_GET['typ'] == 'repulo'){
				echo
				'<div class="pt-5 pt-5 container">
					<div class="row">
						<div class="col-sm-9">
							<div class="row">
							<div class="col-sm-12"><h5>Utazások repülővel</h5></div>';
						 foreach($utazasAdat as $idx => $value){
							  if(!file_exists('uploads/'.$value['utazas_kep'])){$value['utazas_kep'] = 'repulo-1.jpg';}
							  if($value['utazas_jelleg'] == 'Normal'){$value['utazas_jelleg'] = 'Economy';}
								switch($value['utazas_jelleg']){
									case 'Economy':
									$jelleg_box = 'jelleg-box-eco';
									break;
									case 'First minute':
									$jelleg_box = 'jelleg-box-last';
									break;
									case 'Last minute':
									$jelleg_box = 'jelleg-box-first';
									break;
									case 'All in':
									$jelleg_box = 'jelleg-box-all';
									break;
								}
								if($value['utazas_tipus'] == 'Repülő' && $value['utazas_stat'] == 1){
									echo
									'<div class="pb-2 pt-2 col-sm-4">
											<div style="box-shadow:2px 0px 8px #CCCCCC" class="pt-3 pb-3 col-sm-12">
												<img class="img-fluid" src="http://localhost/microtravel/uploads/'.$value['utazas_kep'].'" ><br>
												<h6 class="pt-2 pb-2 text-center">'.$value['utazas_nev'].'<br><br><span class="'.$jelleg_box.'">'.$value['utazas_jelleg'].'</span></h6>
												<p style="text-align:justify; font-size:85%">'.$value['utazas_leiras'].'</p>
												<p style="text-align:left; font-size:85%"><b><i class="fas fa-plane-departure"></i> Indulás:</b> '.$value['utazas_ind_datum'].'</p>
												<h5 class="text-center">'.$value['utazas_ar'].'</h5>
												<p class="pt-3 text-center"><a href="http://localhost/microtravel/utazas/repulo/erdekel&utazas_nev='.$value['utazas_nev'].'&utazas_id='.$value['utazas_id'].'"><button class="btn btn-warning"><i class="fas fa-envelope"></i> ÉRDEKEL AZ ÚT</button></a></p>
											</div>
									</div>';
								}
						}
					echo
					'</div>
					</div>
						<div class="pb-5 col-sm-3">';
							include('contents/con_oldalsav.php');
					echo
					 '</div>
					</div>
				 </div>';
}
if($_GET['erdekel']){
	echo
	'<!-- Ide kell egy javascript, hogy megnyíljon a modal -->
	<script type="text/javascript">
	    $(window).on(\'load\',function(){
	        $(\'#myModalErdekel\').modal(\'show\');
	    });
	</script>
	<!-- The Modal -->
	<div class="modal" id="myModalErdekel">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">'.$_GET['utazas_nev'].' <span style="font-size:65%">utazás éredklődés</span></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12 form-group">
								<label>Utazás neve*</label>
								<input type="text" class="form-control" name="ut_nev" value="'.$_GET['utazas_nev'].'" required>
								<label>Utazás kódja*</label>
								<input type="text" class="form-control" name="ut_id" value="'.$_GET['utazas_id'].'" required>
								<label>Érdeklődő neve*</label>
								<input type="text" class="form-control" name="u_nev" value="'.$_SESSION['user_nev'].'" required>
								<label>Érdeklődő e-mail címe*</label>
								<input type="text" class="form-control" name="u_email" value="'.$_SESSION['user_email'].'" required>
								<label>Megjegyzés*</label>
								<textarea class="form-control own-text-area"></textarea>
							</div>
						</div>
				</div>
				<!-- Modal footer -->
			 <div class="modal-footer">
						<div class="col-sm-12 form-group">
							 <input type="submit" class="form-control btn btn-warning btn-own" name="u_erd" value="ÉRDEKLŐDÉS ELKÜLDÉSE">
						</div>
					</form>
			 </div>
		 </div>
	 </div>
	</div>
	';
}
?>
