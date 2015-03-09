<?
ob_start();
session_start();
if(empty($_SESSION['usuarioCobranca'])){
	header("Location: login.php");
	$faltalogar = "faltalogar";
	$_SESSION['faltalogar'] = $faltalogar;
}

include('connect.php');
include('fpdf/fpdf.php');
include('extenso.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COBRANÇA</title>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style type="text/css">
<!--
.style1 {
	font-size: 16px
}

.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}

.style4 {
	color: #000000
}

.style5 {
	font-size: 16px;
	color: #000000;
}
-->
</style>
</head>

<body onload="MM_openBrWindow('cobemp.pdf','','')">

<?php

$usuario = $_SESSION['usuarioCobranca'];
$tipo_rel = "CartaEMP";
$data = date("d/m/Y");
$modulo = "EMP";
$data_registro = date("dmY");
$hora_registro = date("His");
$tipocarta = $_POST['diaemp'];
$tc = 'C1';
$t = $_POST['data'];
list($dia,$mes,$ano) = split("[/.-]",$t);

$inseri_relatorio = mysql_query("INSERT INTO relatorios_cobranca 
(tipo_rel, usuario, data_emissao, hora, data, tipo_carta, modulo) 
VALUES ('$tipo_rel', '$usuario', '$data_registro', '$hora_registro', '$data', '$tc', '$modulo')");


if($tipocarta == C1){
	$tipocarta = 15;//quantidade de dias
	$tipocarta2 = 30;
	$tc = 'C1';
	$vlr1 = 0;//valor minimo para envio da carta
	$vlr2 = 1000000000000000000000;


}

if($tipocarta == C2){
	$tipocarta = 31;//inclusão no serasa
	$tipocarta2 = 1000000000000000000;
	$tc = 'C2';
	$adto1 = 50;//valor minimo para envio da carta 2
	$adto2 = 100000000000;



}
if($tipocarta == nej){
	$tipocarta = 70;
	$tipocarta2 = 100000000000000000000000;
	$tc = 'nej';
	$adto1 = 500;//valor minimo para Notificação extra judicial
	$adto2 = 10000000000000000000000000000;

}

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


if($tipocarta != C5){
	$pdf = new FPDF('P','cm','A4');
	$pdf->AddPage();
	$selec2 = mysql_query ("SELECT * FROM posicaodeliquidacao, posicaocontabil WHERE contrato NOT IN(SELECT cont FROM rel_carta_cob_emp WHERE $tc != '') AND (sld_em_atraso BETWEEN $vlr1 AND $vlr2) AND (diasematraso BETWEEN $tipocarta AND $tipocarta2) AND (posicaodeliquidacao.nr_titulo = posicaocontabil.contrato) ORDER BY posicaocontabil.diasematraso, posicaocontabil.contrato");
	$num_linhas2 = mysql_num_rows($selec2);
	for($x=0;$x<$num_linhas2;$x++){ $resul2 = mysql_fetch_array($selec2,MYSQL_ASSOC);
	$conta = $resul2['nr_titulo'];
	

	$soma = mysql_query("SELECT SUM(Valor_a_Cobrar) FROM posicaodeliquidacao WHERE nr_titulo = '$conta'");
	$resultado = mysql_fetch_assoc($soma);

	$pdf->SetFont('Arial', '', 12);
	//$pdf->Image("cab.jpg", 15,1,4,1);
	//$pdf->Image("lado.jpg", 0,-2,6,36);
	//$pdf->Image("roda.jpg", 0,28,30,2);
	//$pdf->Image("roda2.jpg", 7,27,13,1);
	$pdf->Ln(1);
	$pdf->Cell(0, 2,iconv('utf-8','iso-8859-1','Natal, '.$dia.' de '.$mes.' de '.$ano.'.'), 0, 1, 'R');
	$pdf->Ln(2);
	$pdf-> SetFont('Arial', 'B', 12);
	$pdf-> Cell(0, 0.7,"Ilmo. (a) Sr. (a)", 0, 1, 'L');
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(0, 0.7,$resul2['nome'], 0, 1, 'L');
	$pdf-> SetFont('Arial', 'B', 12);
	//$pdf->Cell(0, 0.7,"Nesta", 0, 1, 'L');
	//$pdf->Ln();
	$pdf->Cell(0, 0.7, iconv('utf-8','iso-8859-1','REF:COMUNICADO DE DÉBITO'), 0, 1, 'L');
	//$pdf-> MultiCell(0,0.6, iconv('utf-8','iso-8859-1',' '.' '.' '.' '.' '.' '.' '.' '. ' '.'Referência: Parcela vencida em '.$resul2['dataemaberto'].' no valor de R$ '.number_format($resultado['SUM(Valor_a_Cobrar)'],2,',','.').' , relativas à operação e Crédito nº ' .$resul2['contrato'].'.'), 0,1,'J');
	$pdf->Ln();
	$pdf-> MultiCell(0,0.6, iconv('utf-8','iso-8859-1','Prezado (a) Cooperado (a):'), 0,1,'J');
	$pdf->Ln();
	if ($resul2['lin_oper']=='DES'){
	$pdf-> Cell(26,0.6, iconv('utf-8','iso-8859-1',' '.' '.' '.' '.' '.' '.' '.' '. ' '.'Vimos, pela presente, comunicar-lhe que se encontra(m) pendente(s) de pagamento o(s) '),0,1,'J');
	$pdf-> Cell(19,0.6, iconv('utf-8','iso-8859-1','débito(s) de sua responsabilidade, referente a operação de desconto de cheque nº ' .$resul2['contrato'].'. '),0,1,'J');
	
	}else{ 
	$pdf-> Cell(26,0.6, iconv('utf-8','iso-8859-1',' '.' '.' '.' '.' '.' '.' '.' '. ' '.'Vimos, pela presente, comunicar-lhe que se encontra(m) pendente(s) de pagamento o(s) '),0,1,'J');
	$pdf-> Cell(19,0.6, iconv('utf-8','iso-8859-1','débito(s) de sua responsabilidade. '),0,1,'J');
		
	}
	$pdf->Ln();
	$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1',' '.' '.' '.' '.' '.' '.' '.' '. ' '.'Solicitamos o seu comparecimento nesta Cooperativa para a regularização da(s) pendên-'), 0,1,'J');
	$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1','cia(s), evitando-se, assim, a inclusão do seu nome no SERASA/SPC conforme estabelecido na'), 0,1,'J');
	$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1','CLÁUSULA  VENCIMENTO ANTECIPADO, o que seremos compelidos a fazer caso não haja o '), 0,1,'J');
	$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1','cumprimento de sua obrigação no prazo de 05 (cinco) dias.  '), 0,1,'J');
	//$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1','cheque especial Nº '.$resul2['cc'].'.'), 0,1,'J');
	$pdf->Ln();

	if ($resul2['lin_oper']!='DES'){
	$pdf-> MultiCell(0,0.6, iconv('utf-8','iso-8859-1',' Contrato nº ' .$resul2['contrato'].'.'), 0,1,'J');
	//$pdf-> Cell(0,0.6, ' '.' '.' '.' '.' '.' '.' '.' '. '  '.$nome1gerente, 0,1,'J');
	}else{ 
	$pdf->Ln();
	$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1',' '.' '.' '.' '.' '.' '.' '.' '. '  '.'Favor desconsiderar o presente comunicado, caso a referida pendência tenha sido '), 0,1,'J');
	$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1','regularizada.'), 0,1,'J');
	$pdf->Ln(1);
	$pdf->Cell(0, 0.7,'Atenciosamente', 0, 1, 'C');
	$pdf->Ln(1.5);
	$pdf->Cell(0, 0.7,'UNICRED NATAL', 0, 1, 'C');
	$pdf->Cell(0, 0.7,iconv('utf-8','iso-8859-1','Setor de Cobrança'), 0, 1, 'C');

	}
	$pdf->AddPage();
	}
	$pdf->Output('relatorios/CartaEMP'.'_'.$tc.'_'.$usuario.'_'.$data_registro.'_'.$hora_registro.'.pdf');
	
}

?>
<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="../jquery/development-bundle/themes/base/jquery.ui.all.css">
	<script src="../jquery/development-bundle/jquery-1.7.1.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.mouse.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.draggable.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.droppable.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.sortable.js"></script>
	<link rel="stylesheet" href="../jquery/development-bundle/demos/demos.css">
	<style>
	h1 { padding: .2em; margin: 0; }
	#titi { float:left; width: 980px; margin-right: 2em; }
	#titi {
	width: 980px;
	float: left;
}
	
	#titi ol { margin: 0; padding: 1em 0 1em 3em; }
	</style>
	<script>
	$(function() {
		$( "#catalog" ).accordion();
		$( "#catalog li" ).draggable({
			appendTo: "body",
			helper: "clone"
		});
		$( "#cart ol" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
			}
		}).sortable({
			items: "li:not(.placeholder)",
			sort: function() {

				$( this ).removeClass( "ui-state-default" );
			}
		});
	});
	</script><div id="titi">
	<h1 class="ui-widget-header">Cartas emitidas com sucesso!</h1>
	<div class="ui-widget-content">
	  <p align="center" class="style1 style2 style4">Cartas geradas com sucesso!!!</p>
	  <p align="center" class="style5"><span class="style2 style1 style4">Para gerar novas cartas </span> <a href="carta_emp.php" target="mainFrame">Click aqui!</a></p>
   
	  	</div>
</div>
</body>
</html>

