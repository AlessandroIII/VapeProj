<?php 
session_start();
include "header.php";

if(isset($_GET['act'])){
	switch($_GET['act']){
		//disable all users
		case 'dau':
			endisAllUsers('dis');
		break;
		//reactive all users
		case 'rau':
			endisAllUsers('en');
		break;
		//logout all users
		case 'lau':
			Database::update("utente", "stato = 0", "id != ".$_SESSION['ID']);
			Database::insertRecord("log", "azione, utente, level", "' ha disconnesso tutti gli utenti',". $_SESSION['ID'].", 3");
		break;
		//delete user log
		case 'dul':
			echoVar($_GET);
			deleteSingleLog($_GET['ui']);
		break;
		//delete all logs
		case 'dall':
			deleteDataTable("log");	
		break;
		case 'cr':
			changeRole($_GET);
		break;
		case 'idutd':
			changeState($_GET['ui'], 'del', 'u');
		break;
		case 'idutr':
			changeState($_GET['ui'], 'react', 'u');
		break;
		default:
		break;
	}
}

$utenti=getAllUsers();

?>


<div class="row" id="row_admin_action" name="row_admin_action">
	<div class="col-sm-4 col-xs-4 col-md-2 col-lg-1">
		<a class="btn btn-warning btn-round" onclick="redirect_to('backend.php?act=lau', 's')">Logout users</a>
	</div>
	<div class="col-sm-4 col-xs-4 col-md-2 col-lg-1">
		<a class="btn btn-warning btn-round" onclick="redirect_to('backend.php?act=dau', 's')">Disable users</a>
	</div>
	<div class="col-sm-4 col-xs-4 col-md-2 col-lg-1">
		<a class="btn btn-warning btn-round" onclick="redirect_to('backend.php?act=dall', 's')">Cancella Log</a>
	</div>
	<div class="col-sm-4 col-xs-4 col-md-2 col-lg-1">
		<a class="btn btn-success btn-round" onclick="redirect_to('backend.php?act=rau', 's')">Riattiva users</a>
	</div>
</div>

	<div class="row">
	<?php for ($i=0; $i < sizeof($utenti); $i++) { 
		$utente = $utenti[$i];
		if($utente['stato'] == 0){$status = "red";}else{$status = "green";}
		?>
		<div class="col-md-3 col-sm-4 col-xs-12 col-lg-3 profile_details">
			<div class="well profile_view">
				<div class="col-sm-12">
					<h4 class="brief"><em><?php echo $utente[USERNAME]; ?></em></h4>
					<div class="left col-xs-12 col-md-12 col-sm-12">
						<h2>
							<span style="color: <?php echo $status; ?>"><i class="fas fa-wifi"></i></span> <?php echo $utente['nome']." ".$utente['cognome']; ?>
						</h2>
						<ul class="list-unstyled">
							<li><i class="fas fa-id-badge"></i> <strong>ID</strong>: <?php echo $utente['id']; ?></li>
							<li><i class="fas fa-envelope"></i> <strong>Email</strong>: <?php echo $utente['email']; ?></li>
							<li>
								<i class="fas fa-user-circle"></i> <strong>Tipo account</strong>: <?php echo $utente['ruolo']; ?>
								<button type="button" class="btn btn-info btn-xs" onclick="redirect_to('<?php echo $utente['change_role_link']; ?>', 's')">
									<i class="fas fa-sync-alt"></i>
								</button>
							</li>
							<li><i class="fas fa-calendar"></i> <strong>Registrato il</strong>: <?php echo $utente['data_iscrizione']; ?></li>
							<li><i class="fas fa-birthday-cake"></i> <strong>Data Nascita</strong>: <?php echo $utente['data_nascita']; ?></li>
							<li><i class="fas fa-door-open"></i> <strong>Ultima Visita</strong>: <?php echo $utente['ultimo_accesso']; ?></li>
							<li><?php if($utente[DISATTIVO] == 0){ ?> 
									<span style="color:green"><i class="fas fa-smile"></i></span> <strong>ATTIVO</strong>
								<?php }else{ ?>
									<span style="color:red"><i class="fas fa-frown"></i></span> <strong>NON ATTIVO</strong>
							<?php } ?>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-xs-12 bottom text-center">
					<div class="col-xs-12 col-sm-12 emphasis">
						<a onclick="redirect_to('<?php echo $utente['log_link']; ?>', 's')" class="btn btn-info btn-sm"><i class="fas fa-scroll"></i>Vedi log </a>
						<a onclick="redirect_to('<?php echo $utente['del_log_link']; ?>', 's')" class="btn btn-warning btn-sm"><i class="fas fa-book-dead"></i> Cancella log</a>
						<?php  if($utente[DISATTIVO] == 0){  ?>
						<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_delete_<?php echo $utente['id']; ?>">
							<i class="fa fa-trash"> </i> Elimina
						</button>
					<?php } else { ?>
						<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_delete_<?php echo $utente['id']; ?>">
							<i class="fas fa-reply"></i> Riattiva
						</button>
					<?php } ?>
						<div class="x_content">
							<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_delete_<?php echo $utente['id']; ?>">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
											</button>
											<h4 class="modal-title" id="myModalLabel" style="text-align: left"><strong>Conferma</strong></h4>
										</div>
										<div class="modal-body">
											<?php  if($utente[DISATTIVO] == 0){ ?>
												<h4>Vuoi davvero eliminare <?php echo $utente[USERNAME]; ?>?</h4>
											<?php } else{ ?>
												<h4>Vuoi davvero riattivare <?php echo $utente[USERNAME]; ?>?</h4>
											<?php } ?>
										</div>
										<div class="modal-footer">
											<?php   if($utente[DISATTIVO] == 0){ ?>
												<button type="button" class="btn btn-danger" id="elimina_user" name="elimina_user" onclick="<?php echo "window.location.href='backend.php?act=idutd&ui=".$utente['id']."'"; ?>"> <i class="fas fa-minus-circle"></i> Elimina</button>
											<?php } else { ?>
												<button type="button" class="btn btn-success" id="riattiva_user" name="riattiva_user" onclick="<?php echo "window.location.href='backend.php?act=idutr&ui=".$utente['id']."'"; ?>"><i class="fas fa-reply"></i> Elimina</button>
											<?php } ?>
											<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>

<script src="js/backend.js"></script>