<?php
session_start();
include "header.php";

if(isset($_GET['id_aroma_delete'])){
	Database::update("aroma", "disattivo = 1", "id = ".$_GET['id_aroma_delete']);
	Database::insertRecord("log", "azione, utente, level", "' ha eliminato ".$_GET['id_aroma_delete']."',". $_SESSION['ID'].", 4");
	$_GET = "";
}
if(isset($_GET['id_aroma_reactive'])){
	Database::update("aroma", "disattivo = 0", "id = ".$_GET['id_aroma_reactive']);
	Database::insertRecord("log", "azione, utente, level", "' ha riattivato ".$_GET['id_aroma_reactive']."',". $_SESSION['ID'].", 4");
	$_GET = "";
}
if(isset($_GET['id_liquido_delete'])){
	Database::update("liquido", "disattivo = 1", "id = ".$_GET['id_liquido_delete']);
	Database::insertRecord("log", "azione, utente, level", "' ha eliminato ".$_GET['id_liquido_delete']."',". $_SESSION['ID'].", 4");
	$_GET = "";
}
if(isset($_GET['id_liquido_reactive'])){
	Database::update("liquido", "disattivo = 0", "id = ".$_GET['id_liquido_reactive']);
	Database::insertRecord("log", "azione, utente, level", "' ha riattivato ".$_GET['id_liquido_reactive']."',". $_SESSION['ID'].", 4");
	$_GET = "";
}

$fields="a.id, a.nome, a.produttore, a.ml, a.prezzo, a.ml, a.dose_consigliata, a.pezzi, a.creatore, u.username, u.username, a.note, a.data_inserimento, a.disattivo";
$tables="aroma a, utente u";
$conditions="u.id = a.creatore";
if($_SESSION['TIPO_ACCOUNT'] == "USER"){$conditions.=" AND a.disattivo = 0";}
$aromi=Database::search($fields, $tables, $conditions);

$fields="c.id_aroma as 'IdAroma', a.nome as 'NomeAroma', c.quantita as ML, l.PG, l.VG, c.id_liquido as 'IdLiquido', l.nome as 'NomeLiquido',  u.username, l.prezzo, l.note, l.data_inserimento, l.disattivo, l.creatore";
$tables="liquido l, composizione c, aroma a, utente u";
$conditions="a.id = c.id_aroma AND l.id = c.id_liquido AND u.id = l.creatore AND l.prefatto = 0";
if($_SESSION['TIPO_ACCOUNT'] == "USER"){$conditions.=" AND l.disattivo = 0";}
$liquidi=Database::search($fields, $tables, $conditions);



$fields="l.creatore, l.nome as NomeLiquido, l.id as IdLiquido, l.PG, l.VG, u.username, l.prezzo, l.note, l.prefatto, l.data_inserimento, l.disattivo";
$tables="liquido l, utente u";
$conditions="l.prefatto = 1 AND u.id = l.creatore";
if($_SESSION['TIPO_ACCOUNT'] == "USER"){$conditions.=" AND l.disattivo = 0";}
$liquidi_prefatti = Database::search($fields, $tables, $conditions);

$numero_liquidi_per_aroma = Database::customQuery("SELECT id_liquido, COUNT(*) as NumeroAromi FROM composizione GROUP BY id_liquido;");
?>
<div class="row">
	<div class="col-md-10 col-sm-10 col-xs-10 col-lg-11">
		<h1>Inventario</h1>
	</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
		<a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#tab_aromi" aria-expanded="true" aria-controls="collapseOne">
			<h4 class="panel-title" style="text-align: center">AROMI</h4>
		</a>
		<div id="tab_aromi" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			<div class="row new_section">
				<div class="col-md-10 col-lg-10"></div>
				<div class="col-md-2 col-sm-12 col-xs-12 col-lg-1">
					<button type="button" class="btn btn-primary" onclick="redirect_to('nuovo_aroma.php', 's')" style="width: 100%"><i class="fa fa-plus"></i></button>
				</div>
			</div>
			<!-- SEZIONE AROMI -->
			<div class="row new_section">
				<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
					<!-- TABELLA AROMI -->
					<table id="tableAromi" name="tableAromi" class="table table-bordered" style="width:100%">
						<thead>
							<tr>
								<th></th><th>Nome</th><th>Creatore</th><th class="no_cell">Produttore</th>
								<?php if($_SESSION['TIPO_ACCOUNT']=="ADMIN"){ ?>
									<th></th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php if($aromi != 0){
								for ($i=0; $i < sizeof($aromi); $i++) {
									if($aromi){
										$id_creatore=$aromi[$i]["creatore"];
										?>
										<tr>
											<td><a href="#" data-toggle="modal" data-target="#modal_<?php echo $i; ?>"><img src="img/icon_button/show_info_32x32.png"></a></td>
											<td><?php echo $aromi[$i]['nome']."   ".$aromi[$i]['ml']." ml"; ?></td>
											<td><u>
												<?php if($id_creatore == $_SESSION['ID']){$link = "profilo.php";}else{$link="profilo_view.php?id=".$id_creatore;}
													?>
												<a onclick="redirect_to('<?php echo $link; ?>', 's')" class="profile_link"> <?php echo $aromi[$i]['username']; ?></a>
												<?php ?>
											</u></td>
											<td class="no_cell"><?php echo $aromi[$i]['produttore']; ?></td>
											<?php if($_SESSION['TIPO_ACCOUNT']=="ADMIN"){ ?>
												<td><?php if($aromi[$i]['disattivo'] == 0){
													$i_class="fas fa-check";
													$color = "green";
												}else{
													$i_class="fas fa-times";
													$color = "red";
												}?>
													<span style="color: <?php echo $color; ?>">
														<i class="<?php echo $i_class; ?>"></i>
													</span>
												</td>
											<?php } ?>
											<!-- MODAL INFORMAZIONI AROMA -->
											<div class="x_content">
												<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_<?php echo $i; ?>">
													<div class="modal-dialog modal-sm">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
																</button>
																<h3 class="modal-title" id="myModalLabel" style="text-align: center"><b><?php echo strtoupper($aromi[$i]['nome']); ?></b></h3>
															</div>
															<div class="modal-body">
																<h4><b>QUANTITA': </b><?php echo $aromi[$i]['ml']; ?> ml</h4>
																<h4><b>PREZZO: </b><?php echo $aromi[$i]['prezzo']; ?> €</h4>
																<h4><b>DOSE: </b><?php echo $aromi[$i]['dose_consigliata']; ?> %</h4>
																<h4><b>NOTE: </b><?php echo $aromi[$i]['note']; ?></h4>
																<h4><b>INSERITO DA: </b><?php echo $aromi[$i]['username']; ?></h4>
																<?php if($_SESSION["TIPO_ACCOUNT"] == "ADMIN"){
																	if($aromi[$i]['disattivo'] == 0){ $attivo = "Si";}else{
																		$attivo="No";}
																	$data_inserimento = strtotime($aromi[$i]['data_inserimento']); ?>
																	<h4><b>- IL: </b><?php echo date('d/m/Y H:i:s', $data_inserimento); ?></h4>
																	<h4><b>ATTIVO: </b><?php echo $attivo; ?> </h4>
																<?php } ?>
																<h4><a href="<?php echo $aromi[$i]['link']; ?>">Vedi prodotto</a></h4>
															</div>
															<div class="modal-footer">
																<?php if(($_SESSION["ID"] == $aromi[$i]["creatore"])||$_SESSION['TIPO_ACCOUNT'] == "ADMIN" ){ ?>
																	<button type="button" class="btn btn-info btn-sm" onclick="modifyAdmin(<?php echo $aromi[$i]['id'];?>, 'aroma')"><i class="fa fa-edit"></i> Modifica</button>
																	<?php if($aromi[$i]['disattivo'] == 0){ ?>
																	<button type="button" class="btn btn-danger btn-sm" onclick="redirect_to('index.php?id_aroma_delete=<?php echo $aromi[$i]['id']; ?>', 's')"><i class="fa fa-trash"></i> Elimina</button>
																<?php } else{ ?>
																	<button type="button" class="btn btn-success btn-sm" onclick="redirect_to('index.php?id_aroma_reactive=<?php echo $aromi[$i]['id']; ?>', 's')"><i class="fa fa-reply"></i> Riattiva</button>
																<?php }
																 } ?>

																<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Chiudi</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</tr>
								<?php }
								}
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="new_section"></div>	<div class="new_section"></div>
	<!-- SEZIONE LIQUIDI -->
	<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
		<a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#tab_liquidi" aria-expanded="true" aria-controls="collapseOne">
			<h4 class="panel-title" style="text-align: center">LIQUIDI</h4>
		</a>
		<div id="tab_liquidi" class="panel-collapse collapse in extended" role="tabpanel" aria-labelledby="headingOne">
			<div class="row new_section"><div class="divisor"></div>
				<div class="col-md-10 col-lg-10"></div>
				<div class="col-sm-12 col-md-2 col-xs-12 col-lg-1">
					<button type="button" class="btn btn-primary" onclick="redirect_to('nuovo_liquido.php', 's')" style="width: 100%"><i class="fa fa-plus"></i></button>
				</div>
			</div>
			<div class="row new_section">
				<div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
					<!-- TABELLA LIQUIDI  -->
					<table id="tableLiquidi" name="tableLiquidi" class="table table-bordered" style="width:100%">
						<thead>
							<tr>
								<th></th><th>Nome</th><th>Aromi</th><th class="no_cell">PG/VG</th>
								<?php if($_SESSION['TIPO_ACCOUNT']=="ADMIN"){ ?>
									<th></th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
							$id_liquido = 0;
							$index_liquidi_aroma = 0;
							$ingredienti = "";
							if($liquidi != 0){
								for ($i=0; $i < sizeof($liquidi); $i++) {
									if($liquidi){
										if($id_liquido != $liquidi[$i]["IdLiquido"]){
											$id_creatore_liquido = $liquidi[$i]['creatore'];
										?>
										<tr>
											<td>
												<a href="#" data-toggle="modal" data-target="#modal_liquidi_<?php echo $i; ?>"><img src="img/icon_button/show_info_32x32.png"></a>
												<img class="no_prefatto" src="img/boccetta_no.png">
											</td>
											<td class="table-text">
												<?php if($id_creatore_liquido == $_SESSION['ID']){$link = "profilo.php";}else{$link="profilo_view.php?id=".$id_creatore_liquido;}
													echo $liquidi[$i]['NomeLiquido']; ?>
												<b><u><a onclick="redirect_to('<?php echo $link; ?>', 's')" class="profile_link">(<?php echo $liquidi[$i]["username"]; ?>)</a></u></b>
											</td>
											<td class="table-text">
												<?php
												$id_liquido = $liquidi[$i]["IdLiquido"];
												for ($index_ingredienti=0; $index_ingredienti < $i+$numero_liquidi_per_aroma[$index_liquidi_aroma]['NumeroAromi']; $index_ingredienti++) {
													if($id_liquido == $liquidi[$i]["IdLiquido"]){
														// if((strlen($ingredienti) > 1) && ($index_ingredienti%2==0)){
														// 	$ingredienti .= '<br>';
														// }else{
         												 	if(strlen($ingredienti) != 0)
																$ingredienti .= ", ";
														// }
														$ingredienti.=$liquidi[$index_ingredienti]["NomeAroma"]."(".$liquidi[$index_ingredienti]["ML"]."%)";
													}else{
														
												$ingredienti="";
														continue;	
														// echo 
													}
												}
												echo $ingredienti;
												$ingredienti="";
												$index_liquidi_aroma++;
												?>
											</td>
											<td class="no_cell">
													<b><?php echo $liquidi[$i]["PG"]."/".$liquidi[$i]["VG"]; ?></b>
											</td>
											<?php if($_SESSION['TIPO_ACCOUNT']=="ADMIN"){ ?>
												<td>
													<?php if($liquidi[$i]['disattivo'] == 0){
													$i_class="fas fa-check";
													$color = "green";
												}else{
													$i_class="fas fa-times";
													$color = "red";
												}?>
													<span style="color: <?php echo $color; ?>">
														<i class="<?php echo $i_class; ?>"></i>
													</span>
												</td>
											<?php } ?>
											<!-- MODAL INFORMAZIONI LIQUIDO -->
											<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_liquidi_<?php echo $i; ?>">
												<div class="modal-dialog modal-sm">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
															</button>
															<h3  class="modal-title" id="myModalLabel" style="text-align: center"><b><?php echo strtoupper($liquidi[$i]['NomeLiquido']); ?></b></h4>
														</div>
														<div class="modal-body">
															<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="text-align: center">
																<img class="boccetta_vuota" src="img/boccetta_vuota.png">
															</div>
															<h4><b>QUANTITA': </b><?php echo $liquidi[$i]['ML']; ?> ml</h4>
															<h4><b>PREZZO: </b><?php echo $liquidi[$i]['prezzo']; ?> €</h4>
															<h4><b>INGREDIENTI: </b><?php echo $ingredienti; ?> </h4>
															<h4><b>PG/VG: </b><?php echo $liquidi[$i]["PG"]."/".$liquidi[$i]["VG"]; ?></h4>
															<h4><b>DESCRIZIONE: </b><?php echo $liquidi[$i]['note']; ?></h4>
															<h4><b>INSERITO DA: </b><?php echo $liquidi[$i]['username']; ?></h4>
														</div>
														<div class="modal-footer">
															<?php if($_SESSION["ID"] == $liquidi[$i]["creatore"] || $_SESSION['TIPO_ACCOUNT'] == "ADMIN" ){
																	if($liquidi[$i]['disattivo'] == 0){ ?>
																	<button type="button" class="btn btn-danger btn-sm" onclick="redirect_to('index.php?id_liquido_delete=<?php echo $liquidi[$i]['IdLiquido']?>', 's')"><i class="fa fa-trash"></i> Elimina</button>
															<?php }else{ ?>
																	<button type="button" class="btn btn-success btn-sm" onclick="redirect_to('index.php?id_liquido_reactive=<?php echo $liquidi[$i]['IdLiquido']?>', 's')"><i class="fa fa-reply"></i> Riattiva</button>
															<?php } } ?>
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
										</tr>
										<?php
											$ingredienti = "";
										}
									}
								}
							}
							if($liquidi_prefatti){
								for ($index_lp=0; $index_lp < sizeof($liquidi_prefatti); $index_lp++) { 
									if($liquidi_prefatti !=0){
										$id_creatore = $liquidi_prefatti[$index_lp]['creatore'];
									?>
									<tr>
										<td>
											<a data-toggle="modal" data-target="#modal_liquidi_p_<?php echo $index_lp; ?>"><img src="img/icon_button/show_info_32x32.png"></a>
											<img class="si_prefatto" src="img/boccetta_si.png">
										</td>
										<td class="table-text">
											<?php if($id_creatore == $_SESSION['ID']){$link = "profilo.php";}else{$link="profilo_view.php?id=".$id_creatore;}
													?>
												
												<?php
												echo $liquidi_prefatti[$index_lp]['NomeLiquido'];?>
												<u><b>(<a onclick="redirect_to('<?php echo $link; ?>', 's')" class="profile_link"><?php echo $liquidi_prefatti[$index_lp]['username']; ?></a>)</b></u>
										</td>
										<td class="table-text">
											<?php echo $liquidi_prefatti[$index_lp]['note']; ?>
										</td>
										<td class="no_cell">
											<b><?php echo $liquidi_prefatti[$index_lp]['PG']."/".$liquidi_prefatti[$index_lp]['VG']; ?></b>
										</td>
										<?php if($_SESSION['TIPO_ACCOUNT']=="ADMIN"){ ?>
											<td>
												<?php if($liquidi_prefatti[$index_lp]['disattivo'] == 0){
													$i_class="fas fa-check";
													$color = "green";
												}else{
													$i_class="fas fa-times";
													$color = "red";
												}?>
												<span style="color: <?php echo $color; ?>">
													<i class="<?php echo $i_class; ?>"></i>
												</span>
											</td>
										<?php } ?>
									</tr>
									<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="false" id="modal_liquidi_p_<?php echo $index_lp; ?>">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
													</button>
													<h3  class="modal-title" id="myModalLabel" style="text-align: center"><b><?php echo strtoupper($liquidi_prefatti[$index_lp]['NomeLiquido']); ?></b></h4>
												</div>
												<div class="modal-body">
													<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="text-align: center">
														<img class="boccetta_vuota" src="img/boccetta_vuota.png">
													</div>
													<h4><b>PREZZO: </b><?php echo $liquidi_prefatti[$index_lp]['prezzo']; ?> €</h4>
													<h4><b>PG/VG: </b><?php echo $liquidi_prefatti[$index_lp]["PG"]."/".$liquidi_prefatti[$index_lp]["VG"]; ?></h4>
													<h4><b>DESCRIZIONE: </b><?php echo $liquidi_prefatti[$index_lp]['note']; ?></h4>
													<h4><b>INSERITO DA: </b><?php echo $liquidi_prefatti[$index_lp]['username']; ?></h4>
												</div>
												<div class="modal-footer">
													<?php if($_SESSION["ID"] == $liquidi_prefatti[$index_lp]["creatore"] || $_SESSION['TIPO_ACCOUNT'] == "ADMIN"){
																if($liquidi_prefatti[$index_lp]['disattivo'] == 0){ ?>
																	<button type="button" class="btn btn-danger btn-sm" onclick="redirect_to('index.php?id_liquido_delete=<?php echo $liquidi_prefatti[$index_lp]['IdLiquido']?>', 's')"><i class="fa fa-trash"></i> Elimina</button>
															<?php }else{ ?>
																	<button type="button" class="btn btn-success btn-sm" onclick="redirect_to('index.php?id_liquido_reactive=<?php echo $liquidi_prefatti[$index_lp]['IdLiquido']?>', 's')"><i class="fa fa-reply"></i> Riattiva</button>
															<?php } } ?>
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
							<?php	}
								}
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="js\index.js"></script>