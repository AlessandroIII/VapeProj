<?php
include "database.php";
Database::connect();

function echoVar($toprint){
  echo "<div style=\"margin-left:20%\"><pre>";
  var_dump($toprint);
  echo "</pre></div>";
}

//aggiunge un'azione al log
function actionLog($text, $priority){
	Database::insertRecord("log", "azione, utente, level", "'$text',". $_SESSION['ID'].", $priority");
}

//Disattivazione/Riattivazione aromi/liquidi/utenti
function changeState($id, $action, $table){
	switch($table){
		case "l":
			if($action == "del"){
				$set = "disattivo = 1";
				$text_log = "ha eliminato liquido $id";
				$priority = 4;
			}else if($action == "react"){
				$set = "disattivo = 0";
				$text_log = "ha riattivato liquido $id";
				$priority = 3;
			}
			Database::update("liquido", $set, "id = ".$id);
		break;
		case "a":
			if($action == "del"){
				$set = "disattivo = 1";
				$text_log = "ha eliminato $id";
				$priority = "4";
			}else if($action == "react"){
				$set = "disattivo = 0";
				$text_log = "ha riattivato $id";
				$priority = "3";
			}
			Database::update("aroma", $set, "id = ".$id);
		break;
		case "u":
			if($action == "del"){
				$fields="disattivo = 1";
				$table="utente";
				$conditions="id=".$id;						
				$text_log = "ha disattivato utente $id";
				$priority = "4";
				// Database::insertRecord("log", "azione, utente, level", "' ha disattivato utente ".$data['id_user_to_delete']."',". $_SESSION['ID'].", ");
				// actionLog();
			}else if($action == "react"){
				$fields="disattivo = 0";
				$table="utente";
				$conditions="id=".$id;
				$text_log = "ha riattivato utente $id";
				$priority = "3";
			}
			Database::update($table, $fields, $conditions);
		break;
	}
	actionLog($text_log, $priority);
}

//Elimina i dati della tabella $tbl
function deleteDataTable($tbl){
	Database::deleteData($tbl);
	actionLog("ha eliminato i record di $tbl", 4);
}

// ------------------------------------------------------------------------------------------------------------------------------------------------------

// 																	AROMI

// ------------------------------------------------------------------------------------------------------------------------------------------------------


//Estrae gli aromi
function getAromi($page){
	//case i: estrazione per index.php
	//case l: estrazione per nuovo_liquido.php
	switch($page){
		case 'i':
			$fields="a.id, a.nome, a.produttore, a.ml, a.prezzo, a.ml, a.dose_consigliata, a.pezzi, a.creatore, u.username, u.username, a.note, a.data_inserimento, a.disattivo";
			$tables="aroma a, utente u";
			$conditions="u.id = a.creatore";
		break;
		case 'l':
			$fields="a.id, a.nome";
			$tables="aroma a";
			$conditions="id > 0";
		break;
	}	
		// if($_SESSION['TIPO_ACCOUNT'] == "USER"){$conditions.=" AND a.disattivo = 0";}
	$aromi=Database::search($fields, $tables, $conditions);
	return $aromi;
}

//inserisce un nuovo aroma
function newAroma($datiAroma){
	if($datiAroma["link"]==""){
		$datiAroma["link"] = "'www.svapodream.it'";
	}
	str_replace("'", "\"", $datiAroma['nome_aroma']);

	$fields = "id, nome, produttore, ml, prezzo, link, pezzi, dose_consigliata, note, creatore";
	$table = "aroma";
	$values = "0,
		'".$datiAroma["nome_aroma"]."',
		'".strtoupper($datiAroma["produttore"])."',
		".$datiAroma["quantita"].",
		".$datiAroma["prezzo"].",
		".$datiAroma["link"].",
		".$datiAroma["pezzi"].",
		".$datiAroma["dose_consigliata"].",
		'".$datiAroma["note"]."',
		".$_SESSION['ID']."";
	Database::insertRecord($table, $fields, $values);
	actionLog("' ha inserito ".$datiAroma['nome_aroma']."'", 2);
	// Database::insertRecord("log", "azione, utente, level", ,". $_SESSION['ID'].", 2");
}

//modifica l'aroma aggiornando i vecchi dati con $datiAromaDaModificare
function modifyAroma($datiAromaDaModificare){
	str_replace("'", "\"", $datiAromaDaModificare['nome_aroma']);
		$table = "aroma";
		$fields = "nome = '".$datiAromaDaModificare["nome_aroma"]."',
			produttore = '".strtoupper($datiAromaDaModificare["produttore"])."',
			ml = ".$datiAromaDaModificare["quantita"].",
			prezzo = ".$datiAromaDaModificare["prezzo"].",
			pezzi = ".$datiAromaDaModificare["pezzi"].",
			dose_consigliata = ".$datiAromaDaModificare["dose_consigliata"].",
			note = '".$datiAromaDaModificare["note"]."'";
		$conditions = "id = ".$datiAromaDaModificare['id_aroma']."";
		Database::update($table, $fields, $conditions);
		// actionLog("' ha modificato ".$datiAromaDaModificare['nome_aroma']."'", 3);
		// Database::insertRecord("log", "azione, utent, level", ,". $_SESSION['I,D'].", 3");
		echo "<script type=\"text/javascript\">
			location.href=\"index.php\";
			</script>";
}

//Estrae il numero di aromi
function getNumeroAromi($src, $prop){
	switch($src){
		//in function:getLiquidi
		case 'lqd':
			$numero_aromi = Database::customQuery("SELECT id_liquido, COUNT(*) as NumeroAromi FROM composizione GROUP BY id_liquido;");
		break;
		//in profilo.php
		case 'prf':
			$fields="COUNT(*) as NumeroAromi";
			$table="aroma";
			$conditions="creatore = $prop";
			$numero_aromi=Database::search($fields, $table, $conditions)[0]['NumeroAromi'];
		break;
	}	
	return $numero_aromi;
}

// ------------------------------------------------------------------------------------------------------------------------------------------------------

// 																	LIQUIDI

// ------------------------------------------------------------------------------------------------------------------------------------------------------

//restituisce il numero di liquidi di un dato utente
function getNumeroLiquidi($prop){
	$fields="COUNT(*) as NumeroLiquidi";
	$table="liquido";
	$conditions="creatore = $prop";
	$n_liquidi = Database::search($fields, $table, $conditions)[0]['NumeroLiquidi'];
	return $n_liquidi;
}

// Estrae i liquidi prefatti
function getLiquidiPrefatti(){
	$fields="l.creatore, l.nome as NomeLiquido, l.id as IdLiquido, l.PG, l.VG, u.username, l.prezzo, l.note, l.prefatto, l.data_inserimento, l.disattivo";
	$tables="liquido l, utente u";
	$conditions="l.prefatto = 1 AND u.id = l.creatore";
	// if($_SESSION['TIPO_ACCOUNT'] == "USER"){$conditions.=" AND l.disattivo = 0";}
	$liquidi_prefatti = Database::search($fields, $tables, $conditions);
	return $liquidi_prefatti;
}

//Estrae tutti gli ingredienti dei liquidi non prefatti
function getIngredienti(){
	$fields="c.id_aroma as 'IdAroma', a.nome as 'NomeAroma', c.quantita as ML, c.id_liquido as 'IdLiquido', l.nome as 'NomeLiquido',  u.username, l.prezzo, l.note, l.data_inserimento, l.disattivo, l.creatore, l.PG, l.VG";
	$tables="liquido l, composizione c, aroma a, utente u";
	$conditions="a.id = c.id_aroma AND l.id = c.id_liquido AND u.id = l.creatore AND l.prefatto = 0";
	// if($_SESSION['TIPO_ACCOUNT'] == "USER"){$conditions.=" AND l.disattivo = 0";}
	$lista_ingredienti=Database::search($fields, $tables, $conditions);
	return $lista_ingredienti;
}

// Estrae tutti i liquidi non prefatti con i rispettivi ingredienti
function getLiquidi(){
	$numero_aromi_per_liquido = getNumeroAromi('lqd', 0);
	$lista_ingredienti = getIngredienti();

	$array_liquidi = array();
	$counter_al = 0;
	$ingredienti = "";
	$index_liquidi = 0;
	$last_value_of_il =0;
	//Controllo su validità lista ingredienti
	if($lista_ingredienti){
		//Per ogni liquido estrae il numero di ingredienti
		for ($index_ingredienti=0; $index_ingredienti < sizeof($numero_aromi_per_liquido); $index_ingredienti++) {
			$current_id_liquido = $numero_aromi_per_liquido[$index_ingredienti]['id_liquido'];
			$current_n_aromi = $numero_aromi_per_liquido[$index_ingredienti]['NumeroAromi'] + $last_value_of_il;
			//Cicla per tutti gli ingredienti di ogni liquido
	 		for ($index_liquidi=$last_value_of_il; $index_liquidi < $current_n_aromi; $index_liquidi++) { 
	 			if(strlen($ingredienti) != 0)$ingredienti .= ", ";
	 			$ingredienti.=$lista_ingredienti[$index_liquidi]['NomeAroma']."(".$lista_ingredienti[$index_liquidi]['ML'].")";
				$last_value_of_il++;
			}
			//Creazione array con lista ingredienti
			$array_liquidi[$counter_al]['id_liquido'] = $lista_ingredienti[$last_value_of_il-1]['IdLiquido'];
			$array_liquidi[$counter_al]['NomeLiquido'] = $lista_ingredienti[$last_value_of_il-1]['NomeLiquido'];
			$array_liquidi[$counter_al]['ingredienti'] = $ingredienti;
			$array_liquidi[$counter_al]['PG'] = $lista_ingredienti[$last_value_of_il-1]['PG'];
			$array_liquidi[$counter_al]['VG'] = $lista_ingredienti[$last_value_of_il-1]['VG'];
			$array_liquidi[$counter_al]['username'] = $lista_ingredienti[$last_value_of_il-1]['username'];
			$array_liquidi[$counter_al]['creatore'] = $lista_ingredienti[$last_value_of_il-1]['creatore'];
			$array_liquidi[$counter_al]['prezzo'] = $lista_ingredienti[$last_value_of_il-1]['prezzo'];
			$array_liquidi[$counter_al]['note'] = $lista_ingredienti[$last_value_of_il-1]['note'];
			$array_liquidi[$counter_al]['data_inserimento'] = $lista_ingredienti[$last_value_of_il-1]['data_inserimento'];
			$array_liquidi[$counter_al]['disattivo'] = $lista_ingredienti[$last_value_of_il-1]['disattivo'];
			$array_liquidi[$counter_al]['ML'] = $lista_ingredienti[$last_value_of_il-1]['ML'];
			$counter_al++;
			$ingredienti="";
		}
	}
	return $array_liquidi;
}

//Inserisce un nuovo liquido.
//Se prefatto, inserisce la descrizione come lista ingredienti
//Se creato, controlla il numero di ingredienti inseriti e li associa al liquido inserito
function newLiquido($datiLiquido){
	if(isset($datiLiquido['prefatto'])){
		$isPrefatto = 0;
	}else{
		$isPrefatto = 1;
	}
	$fields = "id, nome, prezzo, VG, PG, note, creatore, prefatto";
	$table = "liquido";
	$values = "0, 
		'".$datiLiquido["nome_liquido"]."',
		".$datiLiquido["prezzo"].",
		".$datiLiquido["vg"].",
		".$datiLiquido["pg"].",
		'".$datiLiquido["note"]."',
		".$_SESSION["ID"] .",
		$isPrefatto
		";
	Database::insertRecord($table, $fields, $values);

	actionLog( "' ha inserito ".$datiLiquido['nome_liquido']."'", 2);
	// Database::insertRecord("log", "azione, utente, level",,". $_SESSION['ID'].", 2");
	$ultimo_liquido_inserito = Database::search("MAX(id) as id, creatore", "liquido", "data_inserimento = (SELECT MAX(data_inserimento) FROM liquido WHERE creatore = ".$_SESSION['ID'] .")")[0];

	$id_liquido_inserito = $ultimo_liquido_inserito['id'];
	$creatore_liquido = $ultimo_liquido_inserito['creatore'];

	$device = $datiLiquido['device'];
	if($isPrefatto[0] == 0){
		for ($i=0; $i < 4; $i++) { 
			if(isset($datiLiquido["aroma".($i+1)]) && isset($datiLiquido["quantita_aroma_".($i+1)."_".$device])){
				insertIngrediente($datiLiquido, ($i+1));
			}else{
				continue;
			}
		}
	}
}

//inserisce un singolo ingrediente di un liquido non prefatto
function insertIngrediente($datiIngrediente, $nAroma){
	$qta_aroma = $datiLiquido["quantita_aroma".$i."_".$device];
	$fields = "id_liquido, id_aroma, quantita";
	$table = "composizione";
	$values = "$id_liquido_inserito,
		".$datiLiquido["aroma".$nAroma].", 
		$qta_aroma";
	Database::insertRecord($table, $fields, $values);
}


// ------------------------------------------------------------------------------------------------------------------------------------------------------

// 																	ACCESSO-REGISTRAZIONE-SEGNALAZIONE

// ------------------------------------------------------------------------------------------------------------------------------------------------------


//  Controlla i dati inseriti dall'utente
// 	0: login_successfull
//	1: password_incorrect
//	-1: password_correct and account disabled 
function validateLogin($post_login){
	$username = $post_login['username'];
	$password = $post_login['password'];
	$fields = "*";
	$table = "utente";
	$conditions = "username = '$username'";
	$dati = Database::search($fields, $table, $conditions)[0];
	$vtr = -10;
	$dati['data_iscrizione'] = date('d/m/Y H:i:s', strtotime($dati['data_iscrizione']));
	$dati['data_nascita'] = date('d / m / y', strtotime($dati['data_nascita']));
	$vis_mail = ($dati['public_show_mail'] == 1) ? "CHECKED" : "UNCHECKED";
	$vis_data_reg = ($dati['public_show_registration'] == 1) ? "CHECKED" : "UNCHECKED";
	$vis_state =  ($dati['public_show_state'] == 1) ? "CHECKED" : "UNCHECKED";
	$vis_data_nasc = ($dati['public_show_birthday'] == 1) ? "CHECKED" : "UNCHECKED";
	$vis_last_seen = ($dati['public_show_last_seen'] == 1) ? "CHECKED" : "UNCHECKED";      
	$vis_role = ($dati['public_show_role'] == 1) ? "CHECKED" : "UNCHECKED";
	if($dati['password'] == $password && $dati['disattivo'] == 0){
		session_start();
		// Database::insertRecord("log", "azione, utente, level", "' ha effettuato il login',".$dati['id'].", 1");
		Database::update("utente", "stato = 1", "id = ".$dati['id']);
		$_SESSION['ID'] = $dati['id'];
		$_SESSION['USERNAME'] = $dati['username'];
		$_SESSION['TIPO_ACCOUNT'] = $dati['ruolo'];
		$_SESSION['PASSWORD'] = $dati['password'];
		$_SESSION['NOME'] = $dati['nome'];
		$_SESSION['COGNOME'] = $dati['cognome'];
		$_SESSION['EMAIL'] = $dati['email'];
		$_SESSION['DATA_REGISTRAZIONE'] = $dati['data_iscrizione'];
		$_SESSION['DATA_NASCITA'] = $dati['data_nascita'];
		$_SESSION['VISIBILITA_EMAIL'] = $vis_mail;
		$_SESSION['VISIBILITA_STATO'] = $vis_state;
		$_SESSION['VISIBILITA_DATA_REG'] = $vis_data_reg;
		$_SESSION['VISIBILITA_DATA_NASCITA'] = $vis_data_nasc;
		$_SESSION['VISIBILITA_ULTIMO_ACCESSO'] = $vis_last_seen;
		$_SESSION['VISIBILITA_RUOLO'] = $vis_role;
		actionLog("' ha effettuato il login'", 1);
		$vtr = 0;
	}else if($dati['password'] == $password && $dati['disattivo'] == 1){
		$vtr = -1;
	}else if($dati['password'] != $password){
		$vtr = 1;
	}
	return $vtr;
}

//registra un nuovo utente
function registrationUser($dati){
	$data_nascita = date("d/m/y", strtotime($dati['reg_compleanno']));
	$table="utente";
	$fields="id, nome, cognome, username, password, email, data_nascita, ruolo";
	$values="0, '".$dati['reg_nome']."',
	'".$dati['reg_cognome']."',
	'".$dati['reg_username']."',
	'".$dati['reg_psw']."',
	'".$dati['reg_email']."',
	'".$dati['reg_compleanno']."',
	'USER'";
	Database::insertRecord($table, $fields, $values);
	header("Location: login.php");
}

//inserisce una nuova segnalazione
function newSegnalazione($data){
	$id = Database::search("id", "utente", "disattivo = 1 AND username = '".$data['Username']."' AND disattivo = 1 AND password ='".$data['Psw']."' AND Email = '".$data['Email']."'")[0]['id'];
	Database::insertRecord("segnalazione", "id, titolo, descrizione, segnalatore", "0, 'Riattivazione Utente', '".$data['Username']." ha richiesto la riattivazione del suo account', $id");
}


// ------------------------------------------------------------------------------------------------------------------------------------------------------

// 																	PROFILO UTENTE

// ------------------------------------------------------------------------------------------------------------------------------------------------------

//restituisce i dati dell'utente $id
function getUser($id){
	$utente = Database::search("*", "utente", "id = $id")[0];
	if($utente['stato'] == 1){
		$utente['stato']="ONLINE";
	}else{
		$utente['stato']="OFFLINE";
	}
	$str_data_inserimento = strtotime($utente['data_iscrizione']);
	$utente['data_iscrizione'] = date('d/m/Y H:i:s', $str_data_inserimento);
	$utente['ultimo_accesso'] = date('H:i:s d/m/Y', strtotime($utente['ultimo_accesso']));
	return $utente;
}

// ------------------------------------------------------------------------------------------------------------------------------------------------------

// 																	BACKEND

// ------------------------------------------------------------------------------------------------------------------------------------------------------

//estrai tutti gli utenti iscritti 
function getAllUsers(){
	$fields="*";
	$table="utente";
	$conditions="TRUE ORDER BY data_iscrizione DESC";
	$users = Database::search($fields, $table, $conditions);
	$users = setStandardData($users);
	return $users;
}

// setta date e collegamenti di ogni utente
function setStandardData($vect){
	for ($index_vect=0; $index_vect < sizeof($vect); $index_vect++) { 
		$curr_row = $vect[$index_vect];
		$curr_row['data_iscrizione'] = date("d/m/Y", strtotime($curr_row['data_iscrizione']));
		$curr_row['data_nascita'] = date("d/m/Y", strtotime($curr_row['data_nascita']));
		$curr_row['ultimo_accesso'] = date("H:i:s d/m/Y", strtotime($curr_row['ultimo_accesso']));
		$curr_row['log_link'] = "view_log.php?id=".$curr_row['id']."&username=".$curr_row['username']."";
		$curr_row['del_log_link'] = "backend.php?act=dul&ui=".$curr_row['id'];
		// $curr_row['']
		if($curr_row['ruolo'] == "ADMIN"){
			$curr_row['change_role_link'] = "backend.php?act=cr&id=".$curr_row['id']."&r=U";
		}else{
			$curr_row['change_role_link'] = "backend.php?act=cr&id=".$curr_row['id']."&r=A";
		}
		$vect[$index_vect] = $curr_row;
	}
	return $vect;
}

//Attiva/Disattiva tutit gli utenti
function endisAllUsers($op){
	$set = "";
	if($op == 'dis'){$set="disattivo = 1"; $text_log = "ha disattivato tutti gli utenti";}
	else if($op == 'en'){$set="disattivo = 0"; $text_log = "ha riattivato tutti gli utenti";}
	Database::update("utente", $set,"id != ".$_SESSION['ID']);

}

//Elimina il log di un utente $id
function deleteSingleLog($id){
	Database::delete("log", "utente = ".$id);
}

function changeRole($data){
	Database::update("utente", "ruolo = '".$data['r']."'", "id = ".$data['id']);
	// actionLog("'  '", )
}

// function logout

?>