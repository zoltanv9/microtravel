<div class="container">
<div class="pt-5 pb-5 row">
		<div class="col-sm-7">
        <h3>A MicroTravel</h3>
        <p style="text-align:justify">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam hendrerit ante orci, et sollicitudin purus dapibus a. Sed quis lacus euismod, accumsan ante et, ullamcorper arcu.<br><br>Donec congue augue at dui posuere ultrices. Nam mollis magna non leo tempus iaculis. In sed nibh ac arcu imperdiet aliquet. Vestibulum dapibus tristique urna, quis rhoncus velit lacinia sit amet. Fusce hendrerit ornare ex, sit amet lobortis justo tincidunt at. Nulla lacinia lorem nisl, a cursus nibh interdum et.<br><br>
Vestibulum dapibus tristique urna, quis rhoncus velit lacinia sit amet. Fusce hendrerit ornare ex, sit amet lobortis justo tincidunt at.
		<p>
		<a href="?menu=rolunk"><button class="pt-3 pb-3 btn btn-secondary">RÓLUNK BŐVEBBEN</button></a>
        </p>
		</p>
		</div>
        <div class="col-sm-5 text-center">
			<img src="img/rolunk.jpg" width="100%">
		</div>
</div>
</div>
<div style="background-color:#666666" class="pt-5 pb-5 row">
	<div class="container szolg-cont">
		<div class="pb-5 row">
			<div class="pt-5 pb-5 col-sm-12 text-center">
				<h3>SZOLGÁLTATÁSAINK</h3>
			</div>
			<div class="col-sm-4">
				<div class="col-sm-12 text-center">
				<h4>Utazás autóbusszal</h4>
				<img src="uploads/busz-1.jpg" width="100%">
				<p>Suspendisse dignissim lectus id volutpat facilisis. Vestibulum rhoncus neque nibh, quis dignissim nunc tempor ac. Nulla ultrices, ex eu pharetra eleifend, mi turpis pharetra velit, porta rhoncus erat turpis nec eros.</p>
				<?php if($_SESSION['user'] == 1) { ?>
				<a class="btn btn-light text-dark btn-lg" href="/microtravel/utazas/busz">BŐVEBBEN</a>
				<?php } else { ?>
				<button class="btn btn-light text-dark btn-lg" data-toggle="modal" data-target="#myModal">REGISZTRÁLJ A TARTALOMÉRT!</button>
				<?php } ?>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="col-sm-12  text-center">
				<h4>Utazás hajóval</h4>
				<img src="uploads/hajo-1.jpg" width="100%">
				<p>Suspendisse dignissim lectus id volutpat facilisis. Vestibulum rhoncus neque nibh, quis dignissim nunc tempor ac. Nulla ultrices, ex eu pharetra eleifend, mi turpis pharetra velit, porta rhoncus erat turpis nec eros.</p>
				<?php if($_SESSION['user'] == 1) { ?>
				<a class="btn btn-light text-dark btn-lg" href="/microtravel/utazas/hajo">BŐVEBBEN</a>
				<?php } else { ?>
				<button class="btn btn-light text-dark btn-lg" data-toggle="modal" data-target="#myModal">REGISZTRÁLJ A TARTALOMÉRT!</button>
				<?php } ?>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="col-sm-12  text-center">
				<h4>Utazás repülővel</h4>
				<img src="uploads/repulo-1.jpg" width="100%">
				<p>Suspendisse dignissim lectus id volutpat facilisis. Vestibulum rhoncus neque nibh, quis dignissim nunc tempor ac. Nulla ultrices, ex eu pharetra eleifend, mi turpis pharetra velit, porta rhoncus erat turpis nec eros.</p>
				<?php if($_SESSION['user'] == 1) { ?>
				<a class="btn btn-light text-dark btn-lg" href="/microtravel/utazas/repulo">BŐVEBBEN</a>
				<?php } else { ?>
				<button class="btn btn-light text-dark btn-lg" data-toggle="modal" data-target="#myModal">REGISZTRÁLJ A TARTALOMÉRT!</button>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
