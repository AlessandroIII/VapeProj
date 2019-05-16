<?php
session_start();
include "header.php";
$utente=getUser($_GET['id']);
$n_aromi=getNumeroAromi('prf', $id_user);
$n_liquidi=getNumeroLiquidi($id_user);
?>

<div class="row">
	<div class="col-md-10 col-sm-10 col-xs-10 col-lg-11">
		<h1><?php echo $utente['username']; ?></h1>
	</div>
</div>
<div class="row">
	 <div class="x_content">
		<div class="col-md-4 col-sm-6 col-xs-12 col-lg-3 profile_left">
			<div class="profile_img" style="text-align: center">
				<div id="crop-avatar">
					<img class="img-responsive avatar-view propic" src="img/user-noimage.png" alt="Avatar" title="Change the avatar">
				</div>
			</div>
		</div>
		<div class="col-md-8 col-sm-6 col-lg-8">
			<div class="x_title">
				<h2 class="label_white"><i class="fa fa-info-circle"></i> INFO</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="" role="tabpanel" data-example-id="togglable-tabs">
					<div id="myTabContent" class="tab-content">
						<ul class="list-unstyled user_data" >
							<li><label class="label-white"><i class="fas fa-signature fa-2x"></i> ANAGRAFICA: <?php echo $utente['nome']." ".$utente['cognome']; ?></label></li>
							<?php if($utente['public_show_mail'] == 1) {?>
							<li><label class="label-white"><i class="fas fa-envelope fa-2x"></i> EMAIL: <?php echo $utente['email'];?></label></li>
							<?php } ?>
							<?php if($utente['public_show_birthday'] == 1) {?>
							<li><label class="label-white"><i class="fas fa-calendar fa-2x"></i> DATA NASCITA: <?php echo $utente['data_nascita'];?></label></li>
							<?php } ?>
							<li><label class="label-white"><i class="fas fa-flask fa-2x"></i> AROMI CREATI: <?php echo $n_aromi; ?></label></li>
							<li><label class="label-white"><i class="fas fa-vial fa-2x"></i>  LIQUIDI CREATI: <?php echo $n_liquidi; ?></label></li>
							<?php if($utente['public_show_role'] == 1){ ?>
							<li><label class="label-white"><i class="fas fa-user-circle fa-2x"></i> TIPO ACCOUNT: <?php echo $utente['ruolo']; ?></label>
							<?php } ?>	
							</li>
							<?php if($utente['public_show_registration'] == 1){ ?>
							<li><label class="label-white"><i class="fas fa-calendar fa-2x"></i> REGISTRATO IL: <?php echo $data_inserimento; ?> </label>
							</li>
							<?php } ?>
							<?php if($utente['public_show_state'] == 1){ ?>
								<li><label class="label-white"><i class="fas fa-wifi fa-2x"></i> STATO: <?php echo $stato; ?></label>
								</li>
							<?php } ?>
							<?php if($utente['public_show_last_seen'] == 1 && $stato=="OFFLINE"){ ?>
								<li><label class="label-white"><i class="fas fa-door-open fa-2x"></i> ULTIMO ACCESSO: <?php echo $ultimo_accesso; ?></label>
								</li>
							<?php } ?>
						</ul>							
					</div>