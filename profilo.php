<?php 
	session_start();
	include "header.php";

	if(isset($_GET['deleteUser'])){		// Database::insertRecord("log", "azione, utente, level", "' ha disattivato il suo account,".$dati['id'].", 4");
		changeState($_SESSION['ID'], 'del', 'u');
		echo "<script type=\"text/javascript\">
			location.href=\"logout.php\";
			</script>";
	}
	if($_POST){
		$table = "utente";
		$fields = "";
		if(($_POST['nome'] != $_SESSION['NOME']) && ($_POST['nome']) != ""){
			$fields .= "nome = '".$_POST['nome']."'";
			$_SESSION['NOME'] = $_POST['nome'];
		}
		if(($_POST['cognome'] != $_SESSION['COGNOME']) && ($_POST['cognome']) != ""){
			if($fields != "") $fields .= ", ";
			$fields .= "cognome = '".$_POST['cognome']."'";
			$_SESSION['COGNOME'] = $_POST['cognome'];
		}
		if(($_POST['nickname'] != $_SESSION['USERNAME']) && ($_POST['nickname'] != "")){
			if($fields != "") $fields .= ", ";
			$fields .= "username = '".$_POST['nickname']."'";
			$_SESSION['USERNAME'] = $_POST['nickname'];
		}
		if(($_POST['email'] != $_SESSION['EMAIL']) && ($_POST['email'] != "")){
			if($fields != "") $fields .= ", ";
			$fields .= "email = '".$_POST['email']."'";
			$_SESSION['EMAIL'] = $_POST['email'];
		}
		if(($_POST['password'] != $_SESSION['PASSWORD']) && $_POST['password'] != ""){
			if($fields != "") $fields .= ", ";
			$fields .= "password = '".$_POST['password']."'";
			$_SESSION['PASSWORD'] = $_POST['password'];
		}
		if(isset($_POST['visibilita_stato']) && $_SESSION['VISIBILITA_STATO'] == "UNCHECKED"){
			if($fields != "") $fields .= ", ";
			$fields .= "public_show_state = 1";
			$_SESSION['VISIBILITA_STATO'] = "CHECKED";
		}else if(!isset($_POST['visibilita_stato']) && $_SESSION['VISIBILITA_STATO'] == "CHECKED"){
			if($fields != "") $fields .= ", ";
			$fields .= "public_show_state = 0";
			$_SESSION['VISIBILITA_STATO'] = "UNCHECKED";
		}
		if(isset($_POST['visibilita_email']) && $_SESSION['VISIBILITA_EMAIL'] == "UNCHECKED"){
			if($fields != "") $fields .= ", ";
			$fields .= "public_show_mail = 1";
			$_SESSION['VISIBILITA_EMAIL'] = "CHECKED";
		}else if(!isset($_POST['visibilita_email']) && $_SESSION['VISIBILITA_EMAIL'] == "CHECKED"){
			if($fields != "") $fields .= ", ";
			$fields .= "public_show_mail = 0";
			$_SESSION['VISIBILITA_EMAIL'] = "UNCHECKED";
		}
		if(isset($_POST['visibilita_data_reg']) && $_SESSION['VISIBILITA_DATA_REG'] == "UNCHECKED"){
			if($fields != "") $fields .= ", ";
			$fields .= "public_show_registration = 1";
			$_SESSION['VISIBILITA_DATA_REG'] = "CHECKED";
		}else if(!isset($_POST['visibilita_data_reg']) && $_SESSION['VISIBILITA_DATA_REG'] == "CHECKED"){
			if($fields != "") $fields .= ", ";
			$fields .= "public_show_registration = 0";
			$_SESSION['VISIBILITA_DATA_REG'] = "UNCHECKED";
		}
		if(isset($_POST['visibilita_data_nasc']) && $_SESSION['VISIBILITA_DATA_NASCITA'] == "UNCHECKED"){
			if($fields != "") $fields .= ", ";
			$fields .= "public_show_birthday = 1";
			$_SESSION['VISIBILITA_DATA_NASCITA'] = "CHECKED";
		}else if(!isset($_POST['visibilita_data_reg']) && $_SESSION['VISIBILITA_DATA_NASCITA'] == "CHECKED"){
			if($fields != "") $fields .= ", ";
			$fields .= "public_show_birthday = 0";
			$_SESSION['VISIBILITA_DATA_NASCITA'] = "UNCHECKED";
		}
		if(isset($_POST['visibilita_ultimo_accesso']) && $_SESSION['VISIBILITA_ULTIMO_ACCESSO'] == "UNCHECKED"){
			if($fields != "") $fields .= ", ";
			$fields .= "public_show_last_seen = 1";
			$_SESSION['VISIBILITA_ULTIMO_ACCESSO'] = "CHECKED";
		}else if(!isset($_POST['visibilita_ultimo_accesso']) && $_SESSION['VISIBILITA_ULTIMO_ACCESSO'] == "CHECKED"){
			if($fields != "") $fields .= ", ";
			$fields .= "public_show_last_seen = 0";
			$_SESSION['VISIBILITA_ULTIMO_ACCESSO'] = "UNCHECKED";
		}
		if(isset($_POST['visibilita_ruolo']) && $_SESSION['VISIBILITA_RUOLO'] == "UNCHECKED"){
			if($fields != "") $fields .= ", ";
			$fields .= "public_show_role = 1";
			$_SESSION['VISIBILITA_RUOLO'] = "CHECKED";
		}else if(!isset($_POST['visibilita_ruolo']) && $_SESSION['VISIBILITA_RUOLO'] == "CHECKED"){
			if($fields != "") $fields .= ", ";
			$fields .= "public_show_role = 0";
			$_SESSION['VISIBILITA_RUOLO'] = "UNCHECKED";
		}
		if($fields != ""){
			$conditions = "id = ".$_SESSION['ID'];
			Database::update($table, $fields, $conditions);
			Database::insertRecord("log", "azione, utente, level", "' ha modificato il suo profilo',". $_SESSION['ID'].", 2");
		}
	}

	
	$n_aromi = getNumeroAromi('prf', $_SESSION["ID"]);	
	$n_liquidi = getNumeroLiquidi($_SESSION["ID"]);

?>
<div class="row">
	<div class="col-md-10 col-sm-10 col-xs-10 col-lg-11">
		<h1><?php echo $_SESSION['USERNAME']; ?></h1>
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
						<ul class="list-unstyled user_data">
							<li><label class="label-white"><i class="fas fa-signature fa-2x"></i> ANAGRAFICA: <?php echo $_SESSION['NOME']." ".$_SESSION['COGNOME']; ?></label></li>
							<li><label class="label-white"><i class="fas fa-envelope fa-2x"></i> EMAIL: <?php echo $_SESSION['EMAIL']; ?></label></li>
							<li><label class="label-white"><i class="fas fa-calendar fa-2x"></i> DATA NASCITA: <?php echo $_SESSION['DATA_NASCITA'];?></label></li>
							<li><label class="label-white"><i class="fas fa-flask fa-2x"></i> AROMI CREATI: <?php echo $n_aromi; ?></label></li>
							<li><label class="label-white"><i class="fas fa-vial fa-2x"></i>  LIQUIDI CREATI: <?php echo $n_liquidi; ?></label></li>
							<li><label class="label-white"><i class="fas fa-user-circle fa-2x"></i> TIPO ACCOUNT: <?php echo $_SESSION['TIPO_ACCOUNT']; ?></label>
							</li>
							<li><label class="label-white"><i class="fas fa-calendar fa-2x"></i> REGISTRATO IL: <?php echo $_SESSION['DATA_REGISTRAZIONE']; ?> </label>
							</li>
						</ul>
					</div>
					<div id="updateDatiTab" class="tab-content" style="display: none">
						<form id="modifica_dati" name="modifica_dati" action="profilo.php" method="POST">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-4 col-lg-2">
									<label class="form-label label_white" style="margin-top: 2%">Nome</label>
								</div>
								<div class="col-md-3 col-sm-9 col-xs-8 col-lg-4">
									<input class="form-control form-control-sm" type="text" id="nome" name="nome" required="required"/>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-4 col-lg-2">
									<label for="cognome" class="form-label label_white" style="margin-top: 2%">Cognome</label>
								</div>
								<div class="col-md-3 col-sm-9 col-xs-8 col-lg-4">
									<input type="text" id="cognome" name="cognome" required="required" data-validate-minmax="1,1500" step="0.5" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-4 col-lg-2">
									<label class="form-label label_white" style="margin-top: 2%">Email</label>
								</div>
								<div class="col-md-3 col-sm-9 col-xs-8 col-lg-4">
									<input class="form-control form-control-sm" type="email" id="email" name="email" required="required"/>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-4 col-lg-2">
									<label class="form-label label_white" style="margin-top: 2%">Username</label>
								</div>
								<div class="col-md-3 col-sm-9 col-xs-8 col-lg-4">
									<input class="form-control form-control-sm" type="text" id="nickname" name="nickname" required="required"/>
								</div>
							</div>							
							<div class="row">								
								<div class="col-md-3 col-sm-3 col-xs-4 col-lg-2">
									<label class="form-label label_white" style="margin-top: 2%">Nuova psw</label>
								</div>
								<div class="col-md-3 col-sm-9 col-xs-8 col-lg-4">
									<input class="form-control form-control-sm" type="password" id="password" name="password" required="required"/>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-4 col-lg-2">
									<label class="form-label label_white" style="margin-top: 2%">Conferma</label>
								</div>
								<div class="col-md-3 col-sm-9 col-xs-8 col-lg-4">
									<input class="form-control form-control-sm" type="password" id="conferma_password" name="conferma_password" required="required"/>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-4 col-lg-2">
									<label class="form-label label_white" style="margin-top: 2%">Ruolo</label>
								</div>
								<div class="col-md-3 col-sm-9 col-xs-8 col-lg-4">
									<label class="form-label label_white" style="margin-top: 2%"><?php echo $_SESSION['TIPO_ACCOUNT']; ?></label>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-4 col-lg-2">
									<label class="form-label label_white" style="margin-top: 2%">Registrato il</label>
								</div>
								<div class="col-md-3 col-sm-9 col-xs-8 col-lg-4">
									<label class="form-label label_white" style="margin-top: 2%"><?php echo $_SESSION['DATA_REGISTRAZIONE']; ?></label>
								</div>
							</div>
							<div class="separator">
								<h2 class="label_white"><i class="fas fa-user-lock"></i> PRIVACY</h2>
							</div>
							<div class="separator"></div>
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-5 col-lg-2">
									<label for="visibilita_stato" class="form-label label_white">Stato</label>
								</div>
								<div class="col-md-8 col-sm-8 col-xs-7 col-lg-4">
									<input type="checkbox" class="flat" id="visibilita_stato" name="visibilita_stato" <?php echo $_SESSION['VISIBILITA_STATO']; ?>/>
									<label class="form-label label_white">Mostra</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-5 col-lg-2">
									<label for="visibilita_email" class="form-label label_white">Email</label>
								</div>
								<div class="col-md-8 col-sm-8 col-xs-7 col-lg-4">
									<input type="checkbox" class="flat" id="visibilita_email" name="visibilita_email" <?php echo $_SESSION['VISIBILITA_EMAIL']; ?>/>
									<label class="form-label label_white"> Mostra</label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-5 col-lg-2">
									<label for="visibilita_data_reg" class="form-label label_white">Registrazione</label>
								</div>
								<div class="col-md-8 col-sm-8 col-xs-7 col-lg-4">
									<input type="checkbox" class="flat" id="visibilita_data_reg" name="visibilita_data_reg" <?php echo $_SESSION['VISIBILITA_DATA_REG']; ?>/>
									<label class="form-label label_white">Mostra</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-5 col-lg-2">
									<label for="visibilita_data_nasc" class="form-label label_white">Compleanno</label>
								</div>
								<div class="col-md-8 col-sm-8 col-xs-7 col-lg-4">
									<input type="checkbox" class="flat" id="visibilita_data_nasc" name="visibilita_data_nasc" <?php echo $_SESSION['VISIBILITA_DATA_NASCITA']; ?>/>
									<label class="form-label label_white">Mostra</label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-5 col-lg-2">
									<label for="visibilita_ultimo_accesso" class="form-label label_white">Ultima Visita</label>
								</div>
								<div class="col-md-8 col-sm-8 col-xs-7 col-lg-4">
									<input type="checkbox" class="flat" id="visibilita_ultimo_accesso" name="visibilita_ultimo_accesso" <?php echo $_SESSION['VISIBILITA_ULTIMO_ACCESSO']; ?>/>
									<label class="form-label label_white">Mostra</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-5 col-lg-2">
									<label for="visibilita_ruolo" class="form-label label_white">Ruolo</label>
								</div>
								<div class="col-md-8 col-sm-8 col-xs-7 col-lg-4">
									<input type="checkbox" class="flat" id="visibilita_ruolo" name="visibilita_ruolo" <?php echo $_SESSION['VISIBILITA_RUOLO']; ?>/>
									<label class="form-label label_white">Mostra</label>
								</div>
							</div>
							<div class="separator row">
								<div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
									<button class="btn btn-primary" type="button" id="modifica" name="modifica" style="width: 100%">Aggiorna</button>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
									<button class="btn btn-danger" type="button" id="annulla" name="annulla" style="width: 100%">Annulla</button>
								</div>
							</div>
						</form>
					</div>
					<div class="row" id="button_row">
						<button class="btn btn-info" id="modifica_dati_btn" name="modifica_dati_btn">Modifica dati</button>
						<button class="btn btn-danger" id="elimina_account" name="elimina_account" data-toggle="modal" data-target="#cea">Elimina Account</button>
					</div>
					<div class="x_content">
						<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="cea">
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
										<h4><b>ELIMINARE ACCOUNT?</b></h4>
									</div>
									<div class="modal-body">
										L'eliminazione può essere annullata entro 15gg a partire da oggi. Tale operazione e' possibile solo facendo richiesta all'amministratore del sito. <br>Dopo i 15 giorni, perderai ogni dato inserito, proseguire?
									</div>
									<div class="modal-footer">
										<a href="profilo.php?deleteUser=yes" class="btn btn-danger">Prosegui</a>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/profile.js"></script>
