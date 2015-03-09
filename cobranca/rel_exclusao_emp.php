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
<title>Untitled Document</title>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style2 {font-size: 16px}
-->
</style>
</head>

<body>
 <?php
include('connect.php');
$data_registro = date("dmY");
$data = date("d/m/Y");
$hora_registro = date("His");
$usuario = $_SESSION['usuarioCobranca'];
$tipo_rel = "RelatorioExclusaoEMP";
$modulo = "EMP";
$inseri_relatorio = mysql_query("INSERT INTO relatorios_cobranca (tipo_rel, usuario, data_emissao, hora, data, tipo_carta, modulo) VALUES ('$tipo_rel', '$usuario', '$data_registro', '$hora_registro', '$data', '$tc', '$modulo')");

  ?>

<?php

include('connect.php');
include('fpdf/fpdf.php');

$pdf = new FPDF('P','cm','A4');
$c1 = '';
$c2 = '';
$nej = '';
$por_pagina = 15; 

$selec2 = mysql_query ("SELECT  r.cc, r.cont, r.nome, g.garantia, g.dev_solidario,  r.C1, r.C2, r.nej FROM rel_carta_cob_emp as r LEFT JOIN garantias_devedorsolidario as g ON (nro_titulo = cont) WHERE cont NOT IN(SELECT contrato FROM posicaocontabil WHERE (sld_em_atraso >= 0.1))");



$num_linhas2 = mysql_num_rows($selec2);

$paginas = ceil($num_linhas2/$por_pagina);

$linha_atual = 0;
$inicio = 0;

for($i=1; $i<=$paginas; $i++) {

$inicio = $linha_atual;
$fim = $linha_atual + $por_pagina;
if($fim > $num_linhas2) $fim = $num_linhas2;
$pdf->Open(); 
$pdf->AddPage(); 
$pdf->SetFont("Arial", "B", 10); 
$pdf->SetFont('Times','',12);
$hora = date('H:i:s');
$pdf->SetFont('Arial', '', 7);
$pdf->SetY("1"); 
$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1','Data de Emissão: '.date('d/m/Y')), 0, 1, 'C');
$pdf->Cell(0, 0,$hora, 0, 1, 'L');
$pdf->Ln(1);
$pdf->SetFont('Arial','B', 9);
$pdf->Cell(0, 0,'UNICRED NATAL 2207', 0, 1, 'L');
$pdf->SetFont('Arial','B', 12);
$pdf->SetX("0.5");
$pdf->Cell(0, 0,'____________________________________________________________________________________________________________________', 0, 1, 'L');
$pdf->Ln(0.5);
$pdf->SetFont('Arial','B', 8.5);
$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1','Relatório Exclusão EMP '.$tc.':'), 0, 1, 'L');
$pdf->SetFont('Arial','B', 9);
$pdf->SetX("0.5");
$pdf->Cell(0, 0,'_______________________________________________________________________________________________________________________', 0, 1, 'L');
$pdf->Cell(0, 0,'Pagina '.$i.' de '.$paginas, 0, 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial','B', 6.5);
$pdf->SetX("0.5");
$pdf->Cell(0, 0,'CC', 0, 1, 'L');
$pdf->SetX("1.5");
$pdf->Cell(0, 0,'Contrato', 0, 1, 'L');
$pdf->SetX("3");
$pdf->Cell(0, 0,'Nome', 0, 1, 'L');
$pdf->SetX("8");
$pdf->Cell(0, 0,'Garantia(s)', 0, 1, 'L');
$pdf->SetX("13");
$pdf->Cell(0, 0,'Dev Solidario', 0, 1, 'L');
$pdf->SetX("17");
$pdf->Cell(0, 0,'C1', 0, 1, 'L');
$pdf->SetX("18");
$pdf->Cell(0, 0,'C2', 0, 1, 'L');
$pdf->SetX("19");
$pdf->Cell(0, 0,'NEJ', 0, 1, 'L');
$pdf->SetX("0.5");
$pdf->Cell(50, 0,_________________________________________________________________________________________________________________________________________________________________________________________________________, 0, 1, 'L');
$pdf->Ln();
$anterior = '';
for($x=$inicio;$x<$fim;$x++){ $resul2 = mysql_fetch_array($selec2,MYSQL_ASSOC);

if($resul2['C1']=="")
{
	$c1 = "";
}else
{
	$c1 = "X";
}
if($resul2['C2']=="")
{
	$c2 = "";
}else
{
	$c2 = "X";
}
if($resul2['nej']=="")
{
	$nej = "";
}else
{
	$nej = "X";
}

if($resul2['cont'] != $anterior){
$pdf->Ln(0.5);
$pdf->SetX("0.5");
$pdf->Cell(50, 0,_________________________________________________________________________________________________________________________________________________________________________________________________________, 0, 1, 'L');
$pdf->Ln(0.5);
$pdf->SetX("0.5");
$pdf->Cell(0, 0,$resul2['cc'], 0, 1, 'L');

$pdf->SetX("1.5");
$pdf->Cell(0, 0,$resul2['cont'], 0, 1, 'L');
$pdf->SetX("3");
$pdf->Cell(0, 0,substr($resul2['nome'],0,30), 0, 1, 'L');





}else{
$pdf->Ln(0.5);
}


$anterior = $resul2['cont'];

$pdf->SetX("8");
$pdf->Cell(0, 0,substr($resul2['garantia'],0,31), 0, 1, 'L');
$pdf->SetX("13");
$pdf->Cell(0, 0,substr($resul2['dev_solidario'],0,25), 0, 1, 'L');

$pdf->SetX("17");
$pdf->Cell(0, 0,$c1, 0, 1, 'L');
$pdf->SetX("18");
$pdf->Cell(0, 0,$c2, 0, 1, 'L');
$pdf->SetX("19");
$pdf->Cell(0, 0,$nej, 0, 1, 'L');

$pdf->Ln();

}

}
$pdf->Output('relatorios/RelatorioExclusaoEMP'.'_'.$tc.'_'.$usuario.'_'.$data_registro.'_'.$hora_registro.'.pdf');





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
	</script>
    <div id="titi">
	<h1 class="ui-widget-header">Relatório emitido com sucesso!</h1>
	<div class="ui-widget-content">
	  <p align="center" class="style4 style5 style1 style2">Relatório emitido com sucesso!!!!</span></p>
	  <p align="center" class="style5 style2"><span class="style4 style3 style1 style2">Para gerar novas cartas </span> <span class="style4 style1 style2"><a href="emite_rel_geral_emp.php" target="mainFrame">Click aqui!</a></span></p>
  	  </div>
</div>



</body>
</html>
