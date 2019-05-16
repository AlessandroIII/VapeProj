<?php 
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");



if(!isset($_SESSION['USERNAME'])){
  header("Location: login.php");
}

// include "datatablesbase.php";
include "php_function/function.php";
include "classes/Enumeration/basic_enum.class.php";

Database::connect();

function printdump($toprint){
  echo "<div style=\"margin-left:20%\"><pre>";
  var_dump($toprint);
  echo "</pre></div>";
  exit;
}
?>
<!-- SELECT c.id_aroma as 'IdAroma', a.nome as 'NomeAroma', c.quantita as ML, l.PG, l.VG, c.id_liquido as 'IdLiquido', l.nome as 'NomeLiquido',  u.username, l.prezzo, l.note, l.data_inserimento 
FROM liquido l, composizione c, aroma a, utente u 
WHERE a.id = c.id_aroma AND l.id = c.id_liquido AND u.id = l.creatore AND l.prefatto = 0;

SELECT c.id_aroma as 'IdAroma', a.nome as 'NomeAroma', c.quantita as ML, l.PG, l.VG, c.id_liquido as 'IdLiquido', l.nome as 'NomeLiquido',  u.username, l.prezzo, l.note, l.data_inserimento 
FROM liquido l, composizione c, aroma a, utente u WHERE a.id = c.id_aroma AND l.id = c.id_liquido AND u.id = l.creatore AND l.prefatto = 0; -->

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">    
    <meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="desciption" content="Piattaforma per la condivisione di informazioni riguardo aromi e liquidi, con rispettive dosi di aromi, con gli altri utenti iscritti. ">

    <title>Vape Proj</title>

    <link href="icons/apple-touch-icon.png" rel="apple-touch-icon" />
    <link rel="shortcut icon" href="icons/favicon.ico" />

    <!-- Css -->
    <link href="css/css.css">
    <!-- Bootstrap -->
    <link href="gentelella-files/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Custom Theme Style -->
    <link href="gentelella-files/build/css/custom.min.css" rel="stylesheet">
    <!-- DataTable -->
    <link href="gentelella-files/datatables/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="gentelella-files/datatables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="gentelella-files/datatables/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="gentelella-files/datatables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="gentelella-files/datatables/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link rel="stylesheet" href="js/switchery/dist/switchery.min.css">
  </head>
  <body class="nav-md background" style="height:100%;width:100%; background-color:white">
      <div class="top_nav">
        <div class="nav_menu header">
          <div class="row">
            <div class="col-md-2 col-xs-2 col-sm-2 col-lg-2" style="text-align: center">
              <a onclick="redirect_to('index.php','s')"><i class="fa fa-home" style="margin-top:1%"></i> Home</a>              
            </div>
            <div class="col-md-2 col-xs-2 col-sm-2 col-lg-2" style="text-align: center">
              <a onclick="redirect_to('profilo.php','s')"><i class="fa fa-user" style="margin-top:1%"></i> <?php echo $_SESSION['USERNAME']; ?></a>
            </div>
            <?php if($_SESSION['TIPO_ACCOUNT'] == "ADMIN"){ ?>
              <div class="col-md-2 col-xs-2 col-sm-2 col-lg-2" style="text-align: center">
                <a onclick="redirect_to('backend.php','s')"><i class="fas fa-users" style="margin-top:1%"></i> Utenti</a>
              </div>
              <div class="col-md-2 col-xs-2 col-sm-2 col-lg-2" style="text-align: center">
                <a onclick="redirect_to('lista_segnalazioni.php','s')"><i class="fas fa-envelope" style="margin-top:1%"></i> Segnalazioni</a>
              </div>
            <?php } ?>
            <div class="col-md-2 col-xs-2 col-sm-2 col-lg-2" style="text-align: center">
              <a onclick="redirect_to('guida.php','s')"><i class="fa fa-question-circle" style="margin-top:1%"></i> Supporto</a>
            </div>
            <div class="col-md-2 col-xs-2 col-sm-2 col-lg-2" style="text-align: center">
              <a onclick="redirect_to('logout.php','s')"><i class="fas fa-sign-out-alt" style="margin-top:1%"></i> Logout</a>
            </div>               
          </div>
        </div>
      </div>
      <div class="right_col content" role="main">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <button type="button" class="btn btn-primary" onclick="redirect_to('<?php echo $_SERVER['HTTP_REFERER']; ?>', 's')" style="width: 100%">
              <i class="fa fa-arrow-left"></i>
            </button>
          </div>
        </div>
      

    <!-- jQuery -->
  <script src="gentelella-files/jquery/dist/jquery.min.js"></script> 

  <!-- Bootstrap -->
  <script src="gentelella-files/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Flot -->
  <script src="gentelella-files/Flot/Flot/jquery.flot.js"></script>
  <script src="gentelella-files/Flot/Flot/jquery.flot.pie.js"></script>
  <script src="gentelella-files/Flot/Flot/jquery.flot.time.js"></script>
  <script src="gentelella-files/Flot/Flot/jquery.flot.stack.js"></script>
  <script src="gentelella-files/Flot/Flot/jquery.flot.resize.js"></script>

  <!-- Flot plugins -->
<!--   <script src="gentelella-files/Flot/flot.orderbars/js/jquery.flot.orderBars.js"></script>
  <script src="gentelella-files/Flot/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="gentelella-files/Flot/flot.curvedlines/curvedLines.js"></script> -->

  <!-- DateJS -->
  <script src="gentelella-files/DateJS/build/date.js"></script>
  <script src="gentelella-files/jquery.tagsinput/src/jquery.tagsinput.js"></script>
  <script src="js/switchery/dist/switchery.min.js"></script> 

    <!-- Datatables -->
  <script src="gentelella-files/datatables/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="gentelella-files/datatables/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="gentelella-files/datatables/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="gentelella-files/datatables/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="gentelella-files/datatables/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="gentelella-files/datatables/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="gentelella-files/datatables/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="gentelella-files/datatables/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="gentelella-files/datatables/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="gentelella-files/datatables/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="gentelella-files/datatables/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="gentelella-files/datatables/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
  <script src="gentelella-files/datatables/jszip/dist/jszip.min.js"></script>

  <!-- Switchery -->
  <script src="js/switchery/dist/switchery.min.js"></script>

  <script src="js/index.js"></script>
  <script src="js/header.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="gentelella-files/build/js/custom.min.js"></script> 
  <link rel="stylesheet" href="css/css.css"/>