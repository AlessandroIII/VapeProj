
<?php
    require_once "php_function/function.php";
    $esito;
    $showNotice = 0;
    if(isset($_POST['username']) && isset($_POST['password'])){
      $esito=validateLogin($_POST);
      //password corretta e account attivo   
      if($esito == 0){
        header( "location: index.php");
      //password corretta e account inattivo
      }else if($esito == -1){
        $showNotice = 1;
      //password incorretta
      }else if($esito == 1){
        $showNotice = 2;
      }
    }
    if(isset($_POST['reg_username'])){
      registrationUser($_POST);
    }
  
  ?>

<html lang="it">
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
    <div role="main">
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
        	<h2 class="text-center">
            <img src="img/header/logo.png" width="auto" height="auto">
          </h2>
          <section class="login_content">

            <?php if($showNotice == 1){ ?>
              <div style="border: 2px orange solid; border-radius: 20px 20px 20px 20px">
               <h4 style="color:orange"><u>Account disattivato. <a href="segnalazione_riattivo.php">Richiedi la riattivazione</a></u></h4>
             </div>
            <?php }else if($showNotice == 2){ ?>
              <div style="border: 2px red solid; border-radius: 20px 20px 20px 20px">
               <h4 style="color:red"><u>Password non corretta </u></h4>
             </div>
            <?php } ?>
            <form action="login.php" method="POST" id="login" name="login">
              <h1 style="color:black"> Login </h1>
              <div>
                <input type="text" class="form-control form-control-sm" placeholder="Username" required="" name="username"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
              </div>
              <div>
                <button class="btn btn-primary ">Login</button>
              </div>
              <div class="clearfix"></div>
              <div class="separator"></div>
                <a href="#signup" id="iscrizione" name="iscrizione">Sei nuovo? Iscriviti <i class="fas fa-caret-right"></i><i class="fas fa-caret-right"></i></a>
                <br>
                <div>
                  <h1 style="color:black"><i class="fa fa-flask"></i>VAPEPROJ<i class="fa fa-flask"></i> </h1>
                </div>
            </form>
          </section>
        </div>
        <div id="register" class="animate form registration_form">
          <h2 class="text-center">
            <img src="img/header/logo.png" width="auto" height="auto">
          </h2>
          <section class="login_content">
            <form action="login.php" method="POST" id="register" name="register">
              <h1 style="color:black">Registrati</h1>
              <div>
                <label class="reg-label left">Username</label>
                <input type="text" class="form-control" placeholder="Username" required=""  name="reg_username"/>
              </div>
              <div>
                <label class="reg-label left">Email</label>
                <input type="email" class="form-control" placeholder="Email" required="" id="reg_email" name="reg_email"/>
              </div>
              <div>
                <label class="reg-label left">Password</label>
                <input type="password" class="form-control" placeholder="Password" required="" id="reg_psw" name="reg_psw"/>
              </div>
              <div>
                <label class="reg-label left">Conferma Password</label>
                <input type="password" class="form-control" placeholder="Conferma password" required="" id="reg_conferma" name="reg_conferma"/>
              </div>
              <div>
                <label class="reg-label left">Nome</label>
                <input type="text" class="form-control" placeholder="Nome" required="" id="reg_nome" name="reg_nome"/>
              </div>
              <div>
                <label class="reg-label left">Cognome</label>
                <input type="text" class="form-control" placeholder="Cognome" required="" id="reg_cognome" name="reg_cognome"/>
              </div>
              <div>
                <label class="reg-label left">Data Nascita</label>
                <input type="date" class="form-control" placeholder="Data nascita" required="" id="reg_compleanno" name="reg_compleanno"/>
              </div>
              <br>
              <div>
               <button class="btn btn-primary" id="registrazione_btn" name="registrazione_btn">Registrati</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                  <a href="#signin" class="to_register" id="to_login" name="to_login"><i class="fas fa-caret-left"></i><i class="fas fa-caret-left"></i> Hai un account? Accedi</a>
                </p>
                <div>
                  <h1 style="color:black"><i class="fa fa-flask"></i>VAPEPROJ<i class="fa fa-flask"></i> </h1>
                </div>
                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

