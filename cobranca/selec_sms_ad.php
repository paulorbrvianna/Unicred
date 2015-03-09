
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COBRANÇA</title>
<script src="../jquery/development-bundle/jquery-1.7.1.js"></script>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<script>

</script>
<style type="text/css">
<!--
.style1 {font-size: 16px}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
.style4 {color: #000000}
.style5 {font-size: 16px; color: #000000; }
-->
</style>
</head>

<body  >

<?php

//$tipocarta = $_POST['diaadsms'];
$tipocarta = "C1";

if($tipocarta == C1){
$tipocarta = 5;
$tipocarta2 = 14;
$tc = 'C1';
$adto1 = 20;
$adto2 = 1000000000000000000000;


}

if($tipocarta == C2){
$tipocarta = 15;
$tipocarta2 = 1000000000000000000;
$tc = 'C2';
$adto1 = 20;
$adto2 = 1000000;



}
if($tipocarta == nej){
$tipocarta = 30;
$tipocarta2 = 100000000000000000000000;
$tc = 'nej';
$adto1 = 100;
$adto2 = 10000000000000000000000000000;

}
?>
 <?php
/*
include('../connect.php');
$data_registro = date("dmY");
$data = date("d/m/Y");
$hora_registro = date("His");
$usuario = $_SESSION['user'];
$tipo_rel = "CartaAD";
$inseri_relatorio = mysql_query("INSERT INTO relatorios_cobranca (tipo_rel, usuario, data_emissao, hora, data, tipo_carta) VALUES ('$tipo_rel', '$usuario', '$data_registro', '$hora_registro', '$data', '$tc')");
*/
  ?>

 <?php
 if($mes == '01'){
 $mes = "Janeiro";
 }
  if($mes == '02'){
 $mes = "Fevereiro";
 }
  if($mes == '03'){
 $mes = "Março";
 }
  if($mes == '04'){
 $mes = "Abril";
 }
  if($mes == '05'){
 $mes = "Maio";
 }
  if($mes == '06'){
 $mes = "Junho";
 }
  if($mes == '07'){
 $mes = "Julho";
 }
if($mes == '08'){
 $mes = "Agosto";
 }
 if($mes == '09'){
 $mes = "Setembro";
 }
 if($mes == '10'){
 $mes = "Outubro";
 }
  if($mes == '11'){
 $mes = "Novembro";
 }
  if($mes == '12'){
 $mes = "Dezembro";
 }
 
 include('connect.php');



$selec2 = mysql_query ("SELECT * FROM ad, cad_completo WHERE cc NOT IN(SELECT CC FROM rel_carta_cob_ad WHERE $tc != '') AND  (adto BETWEEN $adto1 AND $adto2) AND (dias_ad BETWEEN $tipocarta AND $tipocarta2) AND cad_completo.conta = ad.cc");

$num_linhas2 = mysql_num_rows($selec2);?>
<form action="envia_sms_ad.php" method="post">
<input name="qtd" type="hidden" value="<?php echo $num_linhas2; ?>" />


<table width="244" border="0" style=" margin:0 0 0 580px">
  <tr>
    <td width="101"><a href="#" id="MTodas">Marcar todas</a></td>
    <td width="127"><a href="#" id="DTodas">Desmarcar todas</a></td>
  </tr>
</table>

<table width="900"  >
  <tr >
    <td width="21"></td>
    <td width="60" style="border:1px #CCCCCC solid; background:#CCCCCC; color:#FFFFFF"><strong>Conta</strong></td>
    <td width="450" style="border:1px #CCCCCC solid; background:#CCCCCC; color:#FFFFFF"><strong>Nome</strong></td>
    <td width="120" style="border:1px #CCCCCC solid; background:#CCCCCC; color:#FFFFFF"><strong>Numero de Celular</strong></td>
    <td width="120" style="border:1px #CCCCCC solid; background:#CCCCCC; color:#FFFFFF"><strong>Situação</strong></td>
  </tr>
</table>

<?
for($x=0;$x<$num_linhas2;$x++){ $resul2 = mysql_fetch_array($selec2,MYSQL_ASSOC);
//echo "<input name='enviaCarta".$x."' type='checkbox' value='".$resul2['cc']."' />".$resul2['nome']."<br />";
$conta = $resul2['conta'];

$data = date("d/m/Y");
$selec = mysql_query ("SELECT * FROM cobrancasms WHERE conta = '$conta' and (autorizacao = 'Pendente' OR autorizacao = 'Autorizado' OR autorizacao = 'Desautorizado' ) AND dataDeSolicitacaoDeEnvio = '$data'");
$resulsms = mysql_fetch_assoc($selec);
if($resulsms['conta'] == "")
{
$habilita = "";
}else{
$habilita = "disabled='disabled'";
}

?>

<table width="900" border="0">
  <tr>
    <td width="21" style="border:1px #CCCCCC solid"><input  <? echo  $habilita;?>  name="<? echo  "enviaSMS".$x;?>" type="checkbox" value="<?php echo  $resul2['cc'];  ?>" /></td>
    
    <td width="60" style="border:1px #CCCCCC solid"><?php echo  $resul2['cc']; ?></td>
    <td width="450" style="border:1px #CCCCCC solid"><?php echo  $resul2['nome']; ?></td>
    <td width="120" style="border:1px #CCCCCC solid"><?php echo  $resul2['dddcel'].$resul2['cel']; ?></td>
        <td id="situacao"  width="120" style="border:1px #CCCCCC solid"><?php  echo $resulsms['autorizacao']; ?></td>
    
  </tr>
</table>


<?
}



?>
<? if($num_linhas2 != 0){
?>
<input name="" value="Enviar"  type="submit" />
<? 
}else{
echo "Não existe nenhuma carta para ser gerada!";
}
?>
</form>

<script>

$('#MTodas').click(function(){

$('input:checkbox').attr("checked",true);

return false;
});
$('#DTodas').click(function(){

$('input:checkbox').attr("checked",false);

return false;
});


</script>

	
</body>
</html>