<?php 
	// PROBLEMA:VISUALIZZAZIONE MOBILE
	session_start();
	include "header.php";

	$id_liquido = $_GET['id'];

	$liquido = Database::search("*", "liquido", "id = $id_liquido")[0];
	$aromi = Database::search("*", "composizione", "id_liquido = $id_liquido");
	$numero_aromi = Database::search("COUNT(*) as NumeroAromi", "composizione", "id_liquido = $id_liquido")[0]['NumeroAromi'];

	$checked;
	$display = "none";
	if($liquido['prefatto'] == 0){
		$checked = "checked";
		$display = "block";
	}	
	
	// if(isset($_POST['conferma_btn'])){
		// printdump($_POST);
		// if($_POST['prefatto']=="on"){
		// 	$isPrefatto = 0;
		// }else{
		// 	$isPrefatto = 1;
		// }
		// $fields = "id, nome, prezzo, VG, PG, note, creatore, prefatto";
		// $table = "liquido";
		// $values = "0, 
		// 	'".$_POST["nome_liquido"]."',
		// 	".$_POST["prezzo"].",
		// 	".$_POST["vg"].",
		// 	".$_POST["pg"].",
		// 	'".$_POST["note"]."',
		// 	'".$_SERVER['REMOTE_ADDR'] ."',
		// 	$isPrefatto
		// 	";
		// Database::insertRecord($table, $fields, $values);
		// 
		// $ultimo_liquido_inserito = Database::search("MAX(id) as id, creatore", "liquido", "data_inserimento = (SELECT MAX(data_inserimento) FROM liquido WHERE creatore = '".$_SERVER['REMOTE_ADDR'] ."')")[0];
		// 
		// $id_liquido_inserito = $ultimo_liquido_inserito['id'];
		// $creatore_liquido = $ultimo_liquido_inserito['creatore'];
		// 
		// $device = $_POST['device'];
		// if($isPrefatto[0] == 0){
		// 	if(isset($_POST['aroma1']) && isset($_POST["quantita_aroma_1_".$device])){
		// 		$qta_aroma_1 = $_POST["quantita_aroma_1_".$device];
		// 		$fields = "id_liquido, id_aroma, quantita";
		// 		$table = "composizione";
		// 		$values = "$id_liquido_inserito,
		// 			".$_POST['aroma1'].", 
		// 			$qta_aroma_1";
		// 		Database::insertRecord($table, $fields, $values);
		// 	}
		// 	if(isset($_POST['aroma2']) && isset($_POST['quantita_aroma_2_'.$device])){
		// 		$qta_aroma_2 = $_POST['quantita_aroma_2_'.$device];
		// 		$fields = "id_liquido, id_aroma, quantita";
		// 		$table = "composizione";
		// 		$values = "$id_liquido_inserito,
		// 			".$_POST['aroma2'].",
		// 			$qta_aroma_2";
		// 		Database::insertRecord($table, $fields, $values);
		// 	}
		// 	if(isset($_POST['aroma3']) && isset($_POST['quantita_aroma_3_'.$device])){
		// 		$qta_aroma_3 = $_POST['quantita_aroma_3_'.$device];
		// 		$fields = "id_liquido, id_aroma, quantita";
		// 		$table = "composizione";
		// 		$values = "$id_liquido_inserito,
		// 			".$_POST['aroma3'].",
		// 			$qta_aroma_3";
		// 		Database::insertRecord($table, $fields, $values);
		// 	}
		// 	if(isset($_POST['aroma4']) && isset($_POST['quantita_aroma_4_'.$device])){
		// 		$qta_aroma_4 = $_POST['quantita_aroma_4_'.$device];
		// 		$fields = "id_liquido, id_aroma, quantita";
		// 		$table = "composizione";
		// 		$values = "$id_liquido_inserito,
		// 			".$_POST['aroma4'].", 
		// 			$qta_aroma_4";
		// 		Database::insertRecord($table, $fields, $values);
		// 	}
		// 
		// }
		// exit;
		// echo "
		// <script type=\"text/javascript\">
		// 	location.href=\"index.php\";
		// </script>";
	// }
	// $fields="a.id, a.nome";
	// $tables="aroma a";
	// $condition="id > 0";
	// $aromi=Database::search($fields, $tables, $condition);

	// $produttori = Database::search("p.id, p.ragione_sociale, n.id as CodiceNazione, n.descrizione", "produttore p, nazione n", "n.id = p._nazione");

?>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
<!-- <script type="text/javascript">
	$(document).ready(function(){
    $("select.aroma1").change(function(){
        var selectedCountry = $(this).children("option:selected").val();
        // if(selectedCountry != "India"){
            alert(selectedCountry);
        // }
    });
});
</script> -->

<div class="row">
	<div class="col-lg-3 col-sm-12 col-xs-12 col-md-12">
		<label class="page_title">MODIFICA LIQUIDO</label>
	</div>
</div>
<div class="row"><div class="divisor"></div></div>

<form id="nuovo_liquido" name="nuovo_liquido" action="nuovo_liquido.php" method="POST">
	<div class="form row">
		<div class="item form-group">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
					<label for="nome_liquido" class="form-label label_white" style="margin-top: 2%">Nome Liquido*</label>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-7 col-lg-3">
					<input class="form-control form-control-sm" type="text" id="nome_liquido" name="nome_liquido" required="required" value="<?php echo $liquido['nome']; ?>"/>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
					<label for="prezzo" class="form-label label_white" style="margin-top: 2%">Prezzo (in €)</label>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-7 col-lg-3">
					<input type="number" id="prezzo" name="prezzo" data-validate-minmax="0,1500" step="0.01" min="0" max="100" class="form-control" placeholder="0.0 se non comprato" value="<?php echo $liquido['prezzo']; ?>">
				</div>
			</div>
			<div class="divisor"></div>
			<div class="row new_section">
				<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
					<label for="pg" class="form-label label_white" style="margin-top: 2%">PG*</label>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-7 col-lg-3">
					<input type="number" id="pg" name="pg" required="required" data-validate-minmax="1,90" step="1" class="form-control" value="<?php echo $liquido['PG']; ?>">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
					<label for="vg" class="form-label label_white" style="margin-top: 2%">VG*</label>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-7 col-lg-3">
					<input type="number" id="vg" name="vg" required="required" data-validate-minmax="1,90" step="1" class="form-control" value="<?php echo $liquido['VG']; ?>">
				</div>
			</div>
			<div class="divisor"></div>
			<div class="row new_section">
				<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
					<label for="note" class="form-label label_white">Note</label>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-7 col-lg-3">
					<textarea id="note"  name="note" class="form-control"><?php echo $liquido['note']; ?></textarea>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
					<label for="prefatto" class="form-label label_white">Prefatto?</label>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-7 col-lg-3">
					<label class="form-label label_white">Si</label>
					<label class="form-label">
						<input type="checkbox" class="js-switch" id="prefatto" name="prefatto" <?php echo $checked; ?>/>
					</label>
					<label class="form-label label_white">No</label>
				</div>
			</div>
			<div class="new_section"></div>
			<div id="div_ingredienti_liquido" style="display: <?php echo $display; ?>">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
						<label class="form-label label_white">Aroma 1</label>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-7 col-lg-3">
						<select class="form-control" id="aroma1" name="aroma1">
							<option value="0" selected="">- - -</option>
							<?php for ($i=0; $i < sizeof($aromi); $i++) { ?>
								<option id="<?php echo $aromi[$i]["id"]; ?>" value="<?php echo $aromi[$i]["id"]; ?>">
									<?php echo $aromi[$i]["id"] . " - " .$aromi[$i]['nome']; ?>
								</option>
							<?php } ?>
		                </select>
					</div>
					<div id="qta_aroma1_pc" class="no_cell" style="display:none">
						<div class="col-md-2 col-lg-2">
							<label class="form-label label_white">Qtà Aroma 1</label>
						</div>
						<div class="col-md-4 col-lg-4">
							<input type="number" id="quantita_aroma_1_pc" name="quantita_aroma_1_pc" data-validate-minmax="1,90" step="1" class="form-control">
						</div>
					</div>
				</div>
				<div class="row new_section">
					<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
						<label class="form-label label_white">Aroma 2</label>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-7 col-lg-3">
						<select class="form-control" id="aroma2" name="aroma2">
							<option value="0" selected="">- - -</option>
							<?php  for ($i=0; $i < sizeof($aromi); $i++) { ?>
								<option id="<?php echo $aromi[$i]["id"]; ?>" value="<?php echo $aromi[$i]["id"]; ?>">
									<?php echo $aromi[$i]["id"] . " - " .$aromi[$i]['nome']; ?>
								</option>
							<?php } ?>
		                </select>
					</div>
					<div id="qta_aroma2_pc" class="no_cell" style="display:none">
						<div class="col-md-3 col-sm-3 col-xs-3 col-lg-2">
							<label class="form-label label_white">Qtà Aroma 2</label>
						</div>
						<div class="col-md-9 col-sm-9 col-xs-6 col-lg-4">
							<input type="number" id="quantita_aroma_2_pc" name="quantita_aroma_2_pc" data-validate-minmax="1,90" step="1" class="form-control">
						</div>
					</div>
				</div>
				<div class="row new_section">
					<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
						<label class="form-label label_white">Aroma 3</label>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-7 col-lg-3">
						<select class="form-control" id="aroma3" name="aroma3">
							<option value="0" selected="">- - -</option>
							<?php for ($i=0; $i < sizeof($aromi); $i++) { ?>
								<option id="<?php echo $aromi[$i]["id"]; ?>" value="<?php echo $aromi[$i]["id"]; ?>">
									<?php echo $aromi[$i]["id"] . " - " .$aromi[$i]['nome']; ?>
								</option>
							<?php } ?>
		                </select>
					</div>
					<div id="qta_aroma3_pc" class="no_cell" style="display:none">
						<div class="col-md-3 col-sm-3 col-xs-5 col-lg-2">
							<label class="form-label label_white">Qtà Aroma 3</label>
						</div>
						<div class="col-md-9 col-sm-9 col-xs-7 col-lg-4">
							<input type="number" id="quantita_aroma_3_pc" name="quantita_aroma_3_pc" data-validate-minmax="1,90" step="1" class="form-control">
						</div>
					</div>
				</div>
				<div class="row new_section">
					<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
						<label class="form-label label_white">Aroma 4</label>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-7 col-lg-3">
						<select class="form-control" id="aroma4" name="aroma4">
							<option value="0" selected="">- - -</option>
							<?php for ($i=0; $i < sizeof($aromi); $i++) { ?>
								<option id="<?php echo $aromi[$i]["id"]; ?>" value="<?php echo $aromi[$i]["id"]; ?>">
									<?php echo $aromi[$i]["id"] . " - " .$aromi[$i]['nome']; ?>
								</option>
							<?php } ?>
		                </select>
					</div>
					<div id="qta_aroma4_pc" class="no_cell" style="display:none">
						<div class="col-md-3 col-sm-3 col-xs-5 col-lg-2">
							<label class="form-label label_white">Qtà Aroma 4</label>
						</div>
						<div class="col-md-9 col-sm-9 col-xs-7 col-lg-4">
							<input type="number" id="quantita_aroma_4_pc" name="quantita_aroma_4_pc" data-validate-minmax="1,90" step="1" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<!-- SEZIONE CELL -->
			<div class="row no_pc new_section" id="qta_aroma1_cell" style="display:none">
				<div class="col-sm-3 col-xs-5">
					<label class="form-label label_white">Qtà Aroma 1</label>
				</div>
				<div class="col-sm-9 col-xs-7">
					<input type="number" id="quantita_aroma_1_cell" name="quantita_aroma_1_cell" data-validate-minmax="1,90" step="1" class="form-control">
				</div>
			</div>
			<div class="row no_pc new_section" id="qta_aroma2_cell" style="display:none">
				<div class="col-sm-3 col-xs-5">
					<label class="form-label label_white">Qtà Aroma 2</label>
				</div>
				<div class="col-sm-9 col-xs-7">
					<input type="number" id="quantita_aroma_2_cell" name="quantita_aroma_2_cell" data-validate-minmax="1,90" step="1" class="form-control">
				</div>
			</div>
			<div class="row no_pc new_section" id="qta_aroma3_cell" style="display:none">
				<div class="col-sm-3 col-xs-5">
					<label class="form-label label_white">Qtà Aroma 3</label>
				</div>
				<div class="col-sm-9 col-xs-7">
					<input type="number" id="quantita_aroma_3_cell" name="quantita_aroma_3_cell" data-validate-minmax="1,90" step="1" class="form-control">
				</div>
			</div>
			<div class="row no_pc new_section" id="qta_aroma4_cell" style="display:none">
				<div class="col-sm-3 col-xs-5">
					<label class="form-label label_white">Qtà Aroma 4</label>
				</div>
				<div class="col-sm-9 col-xs-7">
					<input type="number" id="quantita_aroma_4_cell" name="quantita_aroma_4_cell" data-validate-minmax="1,90" step="1" class="form-control">
				</div>
			</div>
			<div class="row new_section">
				<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
					<button class="btn btn-round btn-primary" id="conferma_btn" name="conferma_btn" type="submit" style="width: 100%">Inserisci</button>
				</div>			
				<div class="col-md-6 col-sm-12 col-xs-12 col-lg-6 no_cell">
					<button class="btn btn-round btn-danger extended" id="annulla_btn" name="annulla_btn" type="reset" style="width:100%">Annulla</button>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 no_pc new_section">
					<button class="btn btn-round btn-danger extended" id="annulla_btn" name="annulla_btn" type="reset" style="width:100%">Annulla</button>
				</div>
			</div>
			<input type="hidden" id="device" name="device" value="">
		</div>
	</div>
</form>
<script src="js/nuovo_liquido.js"></script>