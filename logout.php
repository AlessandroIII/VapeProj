<?php
session_start();
include "database.php";
Database::connect();
Database::update("utente", "stato = 0", "id = ".$_SESSION['ID']);

Database::insertRecord("log", "azione, utente, level", "' ha effettuato il logout', ". $_SESSION['ID'].", 1");
$_SESSION = "";
session_unset(); 
session_destroy();
header("location: login.php");
?>