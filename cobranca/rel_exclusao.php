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
$tipo_rel = "RelatorioExclusaoAD";
$modulo = "AD";
$inseri_relatorio = mysql_query("INSERT INTO relatorios_cobranca (tipo_rel, usuario, data_emissao, hora, data, tipo_carta, modulo) VALUES ('$tipo_rel', '$usuario', '$data_registro', '$hora_registro', '$data', '$tc', '$modulo')");

  ?>

<?php

include('connect.php');
include('fpdf/fpdf.php');

$pdf = new FPDF('P','cm','A4');

$por_pagina = 30; 
$selec2 = mysql_query ("SELECT * FROM rel_carta_cob_ad WHERE CC NOT IN(SELECT cc FROM ad WHERE (adto >= 0.1))");
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
$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1','Data Base: '.date('d/m/Y')), 0, 1, 'C');
$pdf->Cell(0, 0,$hora, 0, 1, 'L');
$pdf->Ln(1);
$pdf->SetFont('Arial','B', 9);
$pdf->Cell(0, 0,'UNICRED NATAL 2207', 0, 1, 'L');
$pdf->SetFont('Arial','B', 12);
$pdf->Cell(0, 0,'_______________________________________________________________________________________________________________', 0, 1, 'L');

$pdf->Ln(0.5);
$pdf->SetFont('Arial','B', 9);
$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1','Relatório de Exclusão:'), 0, 1, 'L');
$pdf->SetFont('Arial','B', 12);
$pdf->Cell(0, 0,'_______________________________________________________________________________________________________________', 0, 1, 'L');
$pdf->Cell(0, 0,'Pagina '.$i, 0, 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial','B', 9);
$pdf->SetX("1");
$pdf->Cell(0, 0,'CC', 0, 1, 'L');
$pdf->SetX("3");
$pdf->Cell(0, 0,'Nome', 0, 1, 'L');
$pdf->SetX("12.3");
$pdf->Cell(0, 0,'C1', 0, 1, 'L');
$pdf->SetX("15.3");
$pdf->Cell(0, 0,'C2', 0, 1, 'L');
$pdf->SetX("18.3");
$pdf->Cell(0, 0,'NEJ', 0, 1, 'L');
$pdf->Cell(0, 0,'____________________________________________________________________________________________________________________________________________________', 0, 1, 'L');


for($x=0;$x<$num_linhas2;$x++){ $resul2 = mysql_fetch_array($selec2,MYSQL_ASSOC);
$pdf->Ln(0.5);
$pdf->SetX("1");
$pdf->Cell(0, 0,$resul2['CC'], 0, 1, 'L');
$pdf->SetX("3");
$pdf->Cell(0, 0,$resul2['Nome1'], 0, 1, 'L');
$pdf->SetX("12.3");
$pdf->Cell(0, 0,$resul2['C1'], 0, 1, 'L');
$pdf->SetX("15.3");
$pdf->Cell(0, 0,$resul2['C2'], 0, 1, 'L');
$pdf->SetX("18.3");
$pdf->Cell(0, 0,$resul2['nej'], 0, 1, 'L');
$pdf->Ln();

}
}
$pdf->Output('relatorios/RelatorioExclusaoAD'.'_'.$tc.'_'.$usuario.'_'.$data_registro.'_'.$hora_registro.'.pdf');





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
	  <p align="center" class="style5 style2"><span class="style4 style3 style1 style2">Para gerar novas cartas </span> <span class="style4 style1 style2"><a href="emite_rel_geral.php" target="mainFrame">Click aqui!</a></span></p>
  	  </div>
</div>



</body>
</html>
