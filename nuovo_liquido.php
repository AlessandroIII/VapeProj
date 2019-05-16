<?php 
	session_start();
	include "header.php"; 

	if(isset($_POST['conferma_btn'])){
		newLiquido($_POST);
		echo "
		<script type=\"text/javascript\">
			location.href=\"index.php\";
		</script>";
	}	
	$aromi=getAromi('l');
?>

<div class="row">
	<!-- <div class="col-lg-1 col-sm-1 col-xs-1 col-md-1"></div> -->
	<div class="col-lg-3 col-sm-12 col-xs-12 col-md-12">
		<label class="page_title">NUOVO LIQUIDO</label>
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
				<div class="col-md-9 col-sm-9 col-xs-6 col-lg-3">
					<input class="form-control form-control-sm" type="text" id="nome_liquido" name="nome_liquido" required="required"/>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
					<label for="prezzo" class="form-label label_white" style="margin-top: 2%">Prezzo (in €)</label>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-6 col-lg-3">
					<input type="number" id="prezzo" name="prezzo" data-validate-minmax="0,1500" step="0.01" min="0" max="100" class="form-control" placeholder="0.0 se non comprato">
				</div>
			</div>
			<div class="divisor"></div>
			<div class="row new_section">
				<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
					<label for="pg" class="form-label label_white" style="margin-top: 2%">PG*</label>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-6 col-lg-3">
					<input type="number" id="pg" name="pg" required="required" data-validate-minmax="1,90" step="1" class="form-control">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
					<label for="vg" class="form-label label_white" style="margin-top: 2%">VG*</label>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-6 col-lg-3">
					<input type="number" id="vg" name="vg" required="required" data-validate-minmax="1,90" step="1" class="form-control">
				</div>
			</div>
			<div class="divisor"></div>
			<div class="row new_section">
				<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
					<label for="note" class="form-label label_white">Note</label>
				</div>
				<!-- <div class="col-md-1 col-sm-1 col-xs-1 col-lg-1"></div> -->
				<div class="col-md-9 col-sm-9 col-xs-6 col-lg-3">
					<textarea id="note"  name="note" class="form-control"></textarea>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
					<label for="prefatto" class="form-label label_white">Prefatto?</label>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-6 col-lg-3">
					<label class="form-label label_white">Si</label>
					<label class="form-label">
						<input type="checkbox" class="js-switch" id="prefatto" name="prefatto"/>
					</label>
					<label class="form-label label_white">No</label>
				</div>
			</div>
			<div class="new_section"></div>
			<div id="div_ingredienti_liquido" style="display: none">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-5 col-lg-3">
						<label class="form-label label_white">Aroma 1</label>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-6 col-lg-3">
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
					<div class="col-md-9 col-sm-9 col-xs-6 col-lg-3">
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
					<div class="col-md-9 col-sm-9 col-xs-6 col-lg-3">
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
					<div class="col-md-9 col-sm-9 col-xs-6 col-lg-3">
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
				<div class="col-sm-9 col-xs-6">
					<input type="number" id="quantita_aroma_1_cell" name="quantita_aroma_1_cell" data-validate-minmax="1,90" step="1" class="form-control">
				</div>
			</div>
			<div class="row no_pc new_section" id="qta_aroma2_cell" style="display:none">
				<div class="col-sm-3 col-xs-5">
					<label class="form-label label_white">Qtà Aroma 2</label>
				</div>
				<div class="col-sm-9 col-xs-6">
					<input type="number" id="quantita_aroma_2_cell" name="quantita_aroma_2_cell" data-validate-minmax="1,90" step="1" class="form-control">
				</div>
			</div>
			<div class="row no_pc new_section" id="qta_aroma3_cell" style="display:none">
				<div class="col-sm-3 col-xs-5">
					<label class="form-label label_white">Qtà Aroma 3</label>
				</div>
				<div class="col-sm-9 col-xs-6">
					<input type="number" id="quantita_aroma_3_cell" name="quantita_aroma_3_cell" data-validate-minmax="1,90" step="1" class="form-control">
				</div>
			</div>
			<div class="row no_pc new_section" id="qta_aroma4_cell" style="display:none">
				<div class="col-sm-3 col-xs-5">
					<label class="form-label label_white">Qtà Aroma 4</label>
				</div>
				<div class="col-sm-9 col-xs-6">
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
