<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alterar Senha</title>
</head>
<style>
.style1{ text-align:left; font-family:"Times New Roman", Times, serif; font-size:18px; font-weight:bold}
.log{
	font:bold;
	height:167px;
	width:328px;
	top:129px;
	left: 578px;
	margin-top: 10px;
	margin-left: -250px;
	position: absolute;
}
.cabecalho{background-image:url(cablogin.jpg); width:1000px; height:100px}
.atalho{ color:#000099; font:bold; font-size:12px;}
.botao{ text-align:right;}
.tarjameio{background-image:url(maoaberta.jpg); width:758px; height:310px; margin-top:2%; top:20%; }
.erro{ color:#FFFFFF; font:bold; font-size:18px; background:#FF0000; height:50px; width:300px;top:25%;left: 90%;margin-top: 5px;margin-left: -250px;
position: absolute; }
</style>
<body>
<div class="cabecalho">
</div>


<form action="senhaalterada.php"  method="post" target="_self">
<table  class="log" width="251" border="0">
  <tr>
    <th  width="167" class="style1">Usuario:</th>
    <th width="120" class="div"><input name="user" type="text" size="20" maxlength="20" /></th>
  </tr>
  <tr>
    <td class="style1" >Senha Anterior:</td>
    <td class="style1"><input name="senha" type="password" size="20" maxlength="20" /></td>
  </tr>
  <tr>
    <td class="style1">Senha Atual:</td>
    <td class="style1"><input name="senhaatual" type="password" size="20" maxlength="20" /></td>
  </tr>
   <tr>
    <td class="style1">Confirmar Senha:</td>
    <td class="style1"><input name="senhaatualconf" type="password" size="20" maxlength="20" /></td>
  </tr>
  <tr>
    <td class="style1"><a  class="atalho" href="Login.php"> Voltar para o Login? </a></td>
    <td class="style1 botao"><input name="altera" type="submit" size="20" value="Alterar Senha" /></td>
  </tr>
</table>
</form>


<div class="tarjameio">
</div>
<?php
$erro2 = $_SESSION['erro2'];
$senhasdiferentes  = $_SESSION['senhasdiferentes'];
$faltadados = $_SESSION['faltadados'];
if($erro2 == "erro2"){

echo "<script>alert ('USUARIO OU SENHA INCORRETOS')</script>";
$erro2 = '';	
}elseif($senhasdiferentes == "senhasdiferentes"){
echo "<script>alert ('FAVOR AS SENHAS ESTÃO DIFERENTES')</script>";
$senhasdiferentes = '';
}elseif($faltadados == "faltadados"){
echo "<script>alert ('FAVOR PREENCHER TODOS OS CAMPOS')</script>";
$faltadados = '';
}

?>

</body>
</html>
