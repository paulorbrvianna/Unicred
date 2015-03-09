<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>
<style>
.style1{ text-align:left; font-family:"Times New Roman", Times, serif; font-size:18px; font-weight:bold}
.log{ font:bold; height:100px; width:255px;top:35%;left: 30%;margin-top: 0%;margin-left: 0%;
position: absolute; }
.cabecalho{background-image:url(cablogin.jpg); width:100%; height:100px}
.atalho{ color:#000099; font:bold; font-size:12px;}
.botao{ text-align:right;}
.tarjameio{background-image:url(maoaberta.jpg); width:758px; height:310px; margin-top:2%; top:20%; }

</style>
<body>
<div class="cabecalho">
</div>


<form action="logar.php"  method="post" target="_self">
<table  class="log" width="251" border="0">
  <tr>
    <th  width="103" class="style1">Usuario:</th>
    <th width="138" class="div"><input name="user" type="text" size="20" maxlength="" /></th>
  </tr>
  <tr>
    <td class="style1" >Senha:</td>
    <td class="style1"><input name="senha" type="password" size="20" maxlength="20" /></td>
  </tr>
  <tr>
    <td class="style1"><a  class="atalho" href="Alterar_Senha.php"> Alterar Senha? </a></td>
    <td class="style1 botao"><input  name="enviar" type="submit" value=" ENTRAR " size="30" width="30" height="30" /></td>
  </tr>
</table>
</form>


<div class="tarjameio">
</div>
<?php

$erro = $_SESSION['erro'];
$faltalogar = $_SESSION['faltalogar'];
$sucesso = $_SESSION['sucesso'];
if($faltalogar == "faltalogar"){
echo "<script>alert ('É NECESSARIO EFETUAR LOGIN')</script>";
$faltalogar = '';
}elseif($erro == "erro"){
echo "<script>alert ('USUARIO OU SENHA INCORRETOS')</script>";
$erro = '';
}elseif($sucesso == "sucesso"){
echo "<script>alert ('SENHA ALTERADA COM SUCESSO')</script>";
$sucesso = '';
}elseif($falta == "falta"){
echo "<script>alert ('FAVOR PREENCHER TODOS OS CAMPOS')</script>";
$falta = '';
}elseif($_SESSION['sair'] == "sair"){
$_SESSION['usuarioCobranca'] = '';
$_SESSION['sair'] = '';
}

?>

</body>
</html>
