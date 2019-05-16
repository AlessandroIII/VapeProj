<?php 
	session_start();
	include "header.php";

	if(isset($_GET['id'])){
		Database::update("utente", "disattivo = 0", "id =".$_GET['id']);
		Database::update("segnalazione", "stato = 1", "id=".$_GET['segn']);
		// Database::update("log", );	
		//invia email
	}

	$lista_segnalazione = Database::search("s.id, s.titolo, s.descrizione, CONCAT(u.nome, \" \", u.cognome) AS 'Anagrafica', u.username, s.stato, s.segnalatore", "segnalazione s, utente u", "u.id = s.segnalatore ORDER BY s.stato DESC");

?>
<div class="row">
	<div class="col-md-10 col-sm-10 col-xs-10 col-lg-11">
		<h1>Lista Segnalazioni</h1>
	</div>
</div>
	
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="row">
	<?php if($lista_segnalazione){
	for ($index_segnalazioni=0; $index_segnalazioni < sizeof($lista_segnalazione); $index_segnalazioni++) { 
		$current_segnalazione = $lista_segnalazione[$index_segnalazioni];
		$link_riattivo="lista_segnalazioni.php?id=".$current_segnalazione['segnalatore']."&segn=".$current_segnalazione['id']; ?>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
			<div class="card" style="background-color: white">
			  <div class="card-body">
			    <h4 class="card-title"><label class="reg-label"><?php echo $current_segnalazione['titolo']; ?></label></h4>
			    <p class="card-text"><?php  echo $current_segnalazione['descrizione']; ?></p>
				<?php if($current_segnalazione['stato'] == 0){ ?>
			    	<a href="<?php echo $link_riattivo; ?>" class="btn btn-primary">Riattiva utente</a>
			    <?php } else if($current_segnalazione['stato'] == 1){ ?>
			    	<h4 style="color:green">Segnalazione chiusa</h4>
					<?php }?>
			  </div>
			</div>
		</div>
	<?php }}else{
	echo "<h2>NESSUNA SEGNALAZIONE</h2>"; 
	} ?>

</div>

</div>