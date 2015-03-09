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

$dataAutorizacao = date("d/m/Y");
$select_cel= mysql_query("SELECT  `dddcel` ,  `cel` FROM  `cad_completo` WHERE conta =  '$conta'");
$resul = mysql_fetch_assoc($select_cel);
$cel = $resul['dddcel'].$resul['cel'];
//UPDATE table_nameSET column1=value, column2=value2,...WHERE some_column=some_value
$Update_SMS = mysql_query("UPDATE cobrancaSMS SET autorizacao = 'Autorizado', dataDeAutorizacao = '$dataAutorizacao' WHERE conta = '$conta'");
$inseri_SMS = mysql_query("INSERT INTO sms (conta, cel, msg) VALUES ('$conta', '$cel', 'UNICRED RECIFE INFORMA: NAO IDENTIFICAMOS O PAGAMENTO DE SUA PARCELA E/OU AD.EM CASO DE DUVIDAS, CONTATE O SEU GERENTE.SE REGULARIZADO DESCONSIDERAR MENSAGEM.')");

}
//$re = array_merge($vetor[$x]);
$x++;


}

header("Location: liberaSMS.php");





?>
</body>
</html>
