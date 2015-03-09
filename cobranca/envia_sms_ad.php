<?
ob_start();
session_start();
  
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
include('connect.php');




 
$r =  $_POST['qtd'];

$x=0;

$vetor = array();
while($x<$r){
if($_POST['enviaSMS'.$x] == ""){
$vetor[$x] = "99999-9";
}else{

$vetor[$x] = $_POST['enviaSMS'.$x];
$conta = $vetor[$x];
//$selec = mysql_query ("SELECT * FROM cobrancasms WHERE conta = '$conta' and autorizacao = ''");
//$resul_confirma = mysql_fetch_assoc($selec);
$selec2 = mysql_query ("SELECT * FROM cad_completo WHERE conta = '$conta'");
$resul = mysql_fetch_assoc($selec2);
$nome =  $resul['nome'];
$cel = $resul['dddcel'].$resul['cel'];
$data = date("d/m/Y");
$inseri_SMS = mysql_query("INSERT INTO cobrancaSMS (conta, nome, numcel, autorizacao, dataDeSolicitacaoDeEnvio, modulo) VALUES ('$conta', '$nome', '$cel', 'Pendente', '$data', 'AD')");
}
//$re = array_merge($vetor[$x]);
$x++;


}

header("Location: selec_sms_ad.php");





?>
</body>
</html>
