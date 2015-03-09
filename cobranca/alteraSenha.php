<?php ob_start(); ?>
<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alterar Senha</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="ddaccordion.js"></script>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", 
	contentclass: "submenu", /
	revealtype: "click", 
	mouseoverdelay: 200, 
	collapseprev: true, 
	defaultexpanded: [], 
	onemustopen: false, 
	animatedefault: false, 
	persiststate: true, 
	toggleclass: ["", ""], 
	togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], 
	animatespeed: "fast", 
	oninit:function(headers, expandedindices){ 
	},
	onopenclose:function(header, index, state, isuseractivated){ 
	}
})
</script>

<script type="text/javascript" src="jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>

<script language="javascript" type="text/javascript" src="niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />

</head>
<body>
<div id="main_container">

	<div  class="header_login">
    <div class="logo"><a href="#"><img src="images/logounicred.jpg" alt="" title="" border="0" /></a></div>
    
    </div>

     
         <div  style="background-color:#FFFFFF; height:400px;" class="login_form">
         
         <h3>Alterar Senha</h3>
         
           <a href="login.php" class="forgot_pass">Retornar ao Login</a> 
         
         
         
         <form action="" method="post" class="niceform">
         
                <fieldset>
                    <dl>
                        <dt><label for="email">Usuario:</label></dt>
                        <dd><input type="text" name="usuario" id="" size="54" /></dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Senha Atual:</label></dt>
                        <dd><input type="password" name="senha" id="" size="54" /></dd>
                    </dl>
                     <dl>
                        <dt><label for="password">Senha Nova:</label></dt>
                        <dd><input type="password" name="senhaatual" id="" size="54" /></dd>
                    </dl>
                     <dl>
                        <dt><label for="password">Cofirmar Senha Nova:</label></dt>
                        <dd><input type="password" name="confsenhaatual" id="" size="54" /></dd>
                    </dl>
                    <dl>
                        <dt><label></label></dt>
                     
                    </dl>
                    
                     <dl style="color:#006600" class="submit">
                 
                     <input type="hidden" name="acao"  value="enter"/>
                    <input type="submit" name="submit" id="submit" value="Enter" />
                     </dl>
                    
                </fieldset>
                
         </form>
         </div>  
          
	
    
    

</div>	
 <?php
   require("connect.php");
            if(isset($_POST['acao']) && $_POST['acao'] == 'enter'){
                $usuario  = (!get_magic_quotes_gpc()) ? addslashes($_POST['usuario']) : $_POST['usuario'];
                $senha = (!get_magic_quotes_gpc()) ? addslashes($_POST['senha']) : $_POST['senha'];
                $senhaatual = (!get_magic_quotes_gpc()) ? addslashes($_POST['senhaatual']) : $_POST['senhaatual'];
				$confsenhaatual = (!get_magic_quotes_gpc()) ? addslashes($_POST['confsenhaatual']) : $_POST['confsenhaatual'];
                  
                	$selec = mysql_query("SELECT * FROM usuarios WHERE nome_user = '$usuario' AND senha_user = '$senha'");
				$num_linhas = mysql_num_rows($selec);
				$senhaatual = $senhaatual;
				
             if($confsenhaatual =='' or  $senhaatual == '' or  $usuario =='' or $senha =='' ){
				 echo '<script>alert("Por favor preencha todos os campos!")</script>';
				}elseif($confsenhaatual !=  $senhaatual){
				 echo '<script>alert("Senha Nova, não está confirmada corretamente!")</script>';
				}elseif($num_linhas != 0){
				$altera = mysql_query("UPDATE tab_user SET senha = '$senhaatual' WHERE user = '$usuario'");
header("Location: login.PHP");
$_SESSION['sucesso'] = "sucesso";
				
				}else{
				echo '<script>alert("Senha ou Usuario estão incorretos!")</script>';
				}
				}
               
                
    ?>	
</body>
</html>
