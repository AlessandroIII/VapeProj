<?php 

	if(isset($_POST['Username'])){
		include "php_function/function.php";
		newSegnalazione($_POST);
		header("Location: login.php");

	}
?>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VapeProj</title>

    <!-- Bootstrap -->
    <link href="gentelella-master/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- NProgress -->
    <link href="gentelella-master/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="gentelella-master/vendors/animate.css/animate.min.css" rel="stylesheet">
    <link href="css/css.css" rel="stylesheet">

    <link href="icons/apple-touch-icon.png" rel="apple-touch-icon" />
    <link rel="shortcut icon" href="icons/favicon.ico" />


    <script src="js/login.js"></script>
    <!-- Custom Theme Style -->
    <link href="gentelella-master/build/css/custom.min.css" rel="stylesheet">
  </head>
  <body class="login">
  	<div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <button type="button" class="btn btn-primary" onclick="redirect_to('<?php echo $_SERVER['HTTP_REFERER']; ?>', 's')" style="width: 100%">
              <i class="fa fa-arrow-left"></i>
            </button>
          </div>
        </div>
  	<br><br><br>
  	<div class="col-12" style="text-align: center">
  		<h2 style="color: black;font-size: 25px">RICHIEDI RIATTIVAZIONE ACCOUNT</h2>  		
  	</div>
	<form name="richiesta_riattivo" id="richiesta_riattivo" method="POST" action="segnalazione_riattivo.php">
		<div class="row">
			<div class="col-md-3 col-lg-3"></div>
  			<div class="col-md-3 col-sm-4 col-xs-5 col-lg-3"  style="text-align: center">
				<label class="reg-label center" style="margin-top: 2%">Email</label>                
			</div>
			<div class="col-md-3 col-sm-7 col-xs-6 col-lg-3"  style="text-align: center">
				<input type="email" class="form-control" placeholder="Email" required="" id="Email" name="Email"/>
			</div>				
			<div class="col-md-3 col-lg-3"></div>
		</div>
		<div class="row">
			<div class="col-md-3 col-lg-3"></div>
			<div class="col-md-3 col-sm-4 col-xs-5 col-lg-3"  style="text-align: center">
				<label class="reg-label center" style="margin-top: 2%">Nome Utente</label>                
			</div>
			<div class="col-md-3 col-sm-7 col-xs-6 col-lg-3"  style="text-align: center">
				<input type="text" class="form-control" placeholder="Nome Utente" required="" id="Username" name="Username"/>
			</div>
		</div>
		<div class="row">				
			<div class="col-md-3 col-lg-3"></div>
			<div class="col-md-3 col-sm-4 col-xs-5 col-lg-3" style="text-align: center" >
                <label class="reg-label center" style="margin-top: 2%">Password</label>
			</div>
			<div class="col-md-3 col-sm-7 col-xs-6 col-lg-3" style="text-align: center" >
	            <input type="password" class="form-control" placeholder="Password" required="" id="Psw" name="Psw"/>
	        </div>
		</div>
		<div class="row">			
			<div class="col-md-5 col-lg-5"></div>
			<div class="col-md-3 col-sm-4 col-xs-5 col-lg-3" style="text-align: center" >
                <label class="reg-label center">Riceverai una mail alla riattivazione</label>
            </div>

		</div>
		<div class="col-lg-12">
			<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12" style="text-align: center">
				<button type="submit" class="btn btn-primary ">Invia Segnalazione</button>
			</div>
			</div>
		</div>
	</form>
</div>
  </body>
  <script type="text/javascript">
  	function redirect_to(link, dest){
	if(dest=='n')window.open(link);
	if(dest=='s')window.location.href=link;
}
  </script></html>