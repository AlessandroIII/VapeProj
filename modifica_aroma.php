<?php
	session_start();
	include "header.php"; 

	if(isset($_POST['conferma_btn'])){
		modifyAroma($_POST);
	}
	$id_aroma =  $_GET['id'];
	$aroma = Database::search("*", "aroma", "id = $id_aroma")[0];
?>
<div class="row">
	<div class="col-lg-3 col-sm-12 col-xs-12 col-md-12">
		<label class="page_title">MODIFICA AROMA</label>
	</div>
</div>
<div class="row"><div class="col-12 divisor"></div></div>

<form id="modifica_aroma" name="modifica_aroma" action="modifica_aroma.php" method="POST">
	<div class="form-row">
		<div class="item form-group">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-4 col-lg-2">
					<label for="nome_aroma" class="form-label label_white" style="margin-top: 2%">Nome</label>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-8 col-lg-4">
					<input class="form-control form-control-sm" type="text" id="nome_aroma" name="nome_aroma" required="required" value="<?php echo $aroma['nome']; ?>"/>
				</div>
				<div class=" new section"></div>
				<div class="col-md-3 col-sm-3 col-xs-4 col-lg-2">
					<label for="quantita" class="form-label label_white" style="margin-top: 2%">ml</label>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-8 col-lg-4">
					<input type="number" id="quantita" name="quantita" required="required" data-validate-minmax="1,1500" step="0.5" class="form-control" value="<?php echo $aroma['ml']; ?>">
				</div>
			</div>
			<div class="new_section"></div>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-4 col-lg-2">
					<label for="produttore" class="form-label label_white" style="margin-top: 2%">Produttore</label>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-8 col-lg-4">
					<input type="text" class="form-control form-control-sm" id="produttore" name="produttore" required="required" value="<?php echo $aroma['produttore']; ?>"/>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-4 col-lg-2">
					<label for="prezzo" class="form-label label_white" style="margin-top: 2%">Prezzo (in €)</label>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-8 col-lg-4">
					<input type="number" id="prezzo" name="prezzo" required="required" data-validate-minmax="1,1500" step="0.01" min="2" max="100" class="form-control" value="<?php echo $aroma['prezzo']; ?>">
				</div>
			</div>
			<div class="new_section"></div>
			<div class="row">
				<div class="col-md-2 col-sm-3 col-xs-4 col-lg-2">
					<label for="pezzi" class="form-label label_white" style="margin-top: 2%">Pezzi</label>
				</div>
				<div class="col-md-4 col-sm-3 col-xs-8 col-lg-4">
					<input type="number" id="pezzi" name="pezzi" data-validate-minmax="1,10000" min="0" max="10000" step="1" class="form-control" value="<?php echo $aroma['pezzi']; ?>">
				</div>
				<div class="col-md-2 col-sm-3 col-xs-4 col-lg-2">
					<label for="dose_consigliata" class="form-label label_white" style="margin-top: 2%">Dose (%)</label>
				</div>
				<div class="col-md-4 col-sm-9 col-xs-8 col-lg-4">
					<input type="number" id="dose_consigliata" name="dose_consigliata" value="5" data-validate-minmax="1,100" min="1" max="100" step="1" class="form-control" value="<?php echo $aroma['dose_consigliata']; ?>">
				</div>
			</div>
			<div class="new_section"></div>
			<div class="divisor"></div>
			<div class="row">
				
				<div class="new_section no_pc"></div>
				<div class="col-md-3 col-sm-3 col-xs-4 col-lg-3">
					<label for="note" class="form-label label_white">Note</label>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-8 col-lg-3">
					<textarea id="note" name="note" class="form-control" value="<?php echo $aroma['note']; ?>"></textarea>
				</div>
				<div>
					<input type="hidden" id="id_aroma" name="id_aroma" value="<?php echo $aroma['id']; ?>">
				</div>
			</div>
			<div class="divisor"></div>
			<div class="divisor"></div>
			<div class="divisor"></div>
			<div class="divisor"></div>
			<div class="row new_section">
				<div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
					<button class="btn btn-round btn-primary extended" id="conferma_btn" name="conferma_btn" type="submit" style="width:100%">Modifica</button>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12 col-lg-6 no_cell">
					<button class="btn btn-round btn-danger extended" id="annulla_btn" name="annulla_btn" type="reset" style="width:100%">Annulla</button>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 no_pc new_section">
					<button class="btn btn-round btn-danger extended" id="annulla_btn" name="annulla_btn" type="reset" style="width:100%">Annulla</button>
				</div>
			</div>
		</div>
	</div>
</form>
?>