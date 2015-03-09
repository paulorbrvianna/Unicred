<?
ob_start();
session_start();
  
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logar</title>
</head>

<body>
<?php

include('connect.php'); 
$user = $_POST['user'];
$senha = $_POST['senha'];
$query = mysql_query("SELECT * FROM tab_user WHERE (user = '$user') AND (senha = '$senha')");
$resul = mysql_fetch_assoc($query);

if($user == '' or $senha ==''){
$falta = "falta";
$_SESSION['falta'] = $falta;
header("Location: login.PHP");
}elseif($resul!='' ){
header("Location: UntitledFrameset-2.PHP");
$_SESSION['usuarioCobranca'] = $user;

$usuario = $_SESSION['usuarioCobranca'];
$tipo_rel = "LOGIN";
$data = date("d/m/Y");
$modulo = "LOGON";
$data_registro = date("dmY");
$hora_registro = date("His");
$tipocarta = $_POST['diaemp'];
$tc = '';
$t = $_POST['data'];
list($dia,$mes,$ano) = split("[/.-]",$t);

$inseri_relatorio = mysql_query("INSERT INTO relatorios_cobranca 
(tipo_rel, usuario, data_emissao, hora, data, tipo_carta, modulo) 
VALUES ('$tipo_rel', '$usuario', '$data_registro', '$hora_registro', '$data', '$tc', '$modulo')");



}elseif($resul == ''){
$erro = "erro";
$_SESSION['erro'] = $erro;
header("Location: login.PHP");
}
?>


</body>

</html>
