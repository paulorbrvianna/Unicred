<?
ob_start();
session_start();
if(empty($_SESSION['usuarioCobranca'])){ 
    header("Location: login.php");  	
	$faltalogar = "faltalogar";
	$_SESSION['faltalogar'] = $faltalogar;
  }
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ENVELOPE</title>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
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

<body  onload="MM_openBrWindow('envelope_emp.pdf','','')">

<?php

$tipocarta = $_POST['diaempenv'];

if($tipocarta == C1){
$tipocarta = 5;
$tipocarta2 = 14;
$tc = 'C1';
$vlr1 = 20;
$vlr2 = 1000000000000000000000;
}
?>

 <?php
include('connect.php');
include('fpdf/fpdf.php');
//$pdf = new FPDF('P','cm','A4');
$pdf = new FPDF('L','cm','A4');
$pdf->AddPage();




$selec2 = mysql_query ("SELECT * FROM  posicaocontabil WHERE contrato NOT IN(SELECT cont FROM rel_carta_cob_emp WHERE $tc != '') AND (sld_em_atraso BETWEEN $vlr1 AND $vlr2) AND (diasematraso BETWEEN $tipocarta AND $tipocarta2) ORDER BY diasematraso");

$num_linhas2 = mysql_num_rows($selec2);

for($x=0;$x<$num_linhas2;$x++){ $resul2 = mysql_fetch_array($selec2,MYSQL_ASSOC);
$conta = $resul2['cc'];
		

$endereco = mysql_query("SELECT * FROM ccr0asso WHERE fconta = '$conta'");
$endereco2 = mysql_fetch_assoc($endereco);

$pdf->SetFont('Arial', 'B', 12);
//$pdf->SetFont('Arial', 'B', 9);

$pdf->Ln(9);
//$pdf->Ln(5);
//$pdf->SetX(9);
$pdf->SetX(5);
$pdf->Cell(0, 0,$resul2['nome'], 0, 1, 'L');
$pdf->Ln(0.6);
//$pdf->SetX(9);
$pdf->SetX(5);
$pdf->Cell(0, 0,$endereco2['fender'], 0, 1, 'L');
$pdf->Ln(0.6);
//$pdf->SetX(9);
$pdf->SetX(5);
$pdf->Cell(0, 0,$endereco2['fbairro'], 0, 1, 'L');
$pdf->Ln(0.6);
//$pdf->SetX(9);
$pdf->SetX(5);
$pdf->Cell(0, 0,$endereco2['fmunic'].' '.' '.'-'.' '.' '.$endereco2['fuf'], 0, 1, 'L');
$pdf->Ln(0.6);
//$pdf->SetX(9);
$pdf->SetX(5);
$pdf->Cell(0, 0,$endereco2['fcep'], 0, 1, 'L');
$pdf->Image("carimbo.jpg", 18,5,5,5);
//$pdf->Image("carimbo.jpg", 15,2,3,3);

$pdf->AddPage();
}
$pdf->Output('envelope_emp.pdf');


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
	  <p align="center" class="style5"><span class="style2 style1 style4">Para gerar novas cartas </span> <a href="emite_carta_emp.php" target="mainFrame">Click aqui!</a></p>
	  	</div>
</div>
</body>
</html>

