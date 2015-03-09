<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Siscred Unicred Natal</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<link rel="stylesheet" href="css/style.shinyblue.html" type="text/css" />

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/modernizr.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="js/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="js/responsive-tables.js"></script>

</head>

<body class="loginpage">

<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><img src="imagens/logo_login.png" alt="" /></div>
        <form id="login" action="login.php" method="post">
           <?php 
           if($_GET['M']=="erro"){
				?>
				<h4 class="widgettitle title-danger">ERRO! Login ou Senha Inválidos!</h4><br />
				<?php
           }
           ?>
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="login" id="username" placeholder="Digite Seu Login" />
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="senha" id="password" placeholder="Digite Sua Senha" />
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit">Acessar</button>
            </div>
            
        </form>
    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<div class="loginfooter">
    <p>&copy; 2014. Unicred.</p>
</div>

</body>

</html>
