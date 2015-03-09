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
.style2 {
	font-size: 16px;
	color: #FFFFFF;
}
.style3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #000000;
}
.style4 {color: #000000}
.style5 {font-size: 16px}
-->
</style>
</head>

<body >
 <?php
include('connect.php');
$data_registro = date("dmY");
$data = date("d/m/Y");
$hora_registro = date("His");
$usuario = $_SESSION['usuarioCobranca'];
$tipo_rel = "RelatorioGeralAD";
$modulo = "AD";
$inseri_relatorio = mysql_query("INSERT INTO relatorios_cobranca (tipo_rel, usuario, data_emissao, hora, data, tipo_carta, modulo) VALUES ('$tipo_rel', '$usuario', '$data_registro', '$hora_registro', '$data', '$tc', '$modulo')");

  ?>
<?php
 include('connect.php');
include('fpdf/fpdf.php');
include('extenso.php');
$pdf = new FPDF('L','cm','A4');

$por_pagina = 15; 
$selec2 = mysql_query ("SELECT * FROM rel_carta_cob_ad WHERE CC !='CC'");
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
$pdf->Cell(0, 0,'Data Base: '.date('d/m/Y'), 0, 1, 'C');
$pdf->Cell(0, 0,$hora, 0, 1, 'L');
$pdf->Ln(1);
$pdf->SetFont('Arial','B', 9);
$pdf->Cell(0, 0,'UNICRED NATAL 2207', 0, 1, 'L');
$pdf->SetFont('Arial','B', 12);
$pdf->Cell(0, 0,'_______________________________________________________________________________________________________________', 0, 1, 'L');

$pdf->Ln(0.5);
$pdf->SetFont('Arial','B', 9);
$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1','Relatório Geral:'), 0, 1, 'L');
$pdf->SetFont('Arial','B', 12);
$pdf->Cell(0, 0,'_______________________________________________________________________________________________________________', 0, 1, 'L');
$pdf->Cell(0, 0,'Pagina '.$i, 0, 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial','B', 9);
$pdf->SetX("1");
$pdf->Cell(0, 0,'CC', 0, 1, 'L');
$pdf->SetX("3");
$pdf->Cell(0, 0,'Nome', 0, 1, 'L');
$pdf->SetX("14");
$pdf->Cell(0, 0,'Data AD', 0, 1, 'L');
$pdf->SetX("16.4");
$pdf->Cell(0, 0,'Adto', 0, 1, 'L');
$pdf->SetX("18.8");
$pdf->Cell(0, 0,'C1', 0, 1, 'L');
$pdf->SetX("21.2");
$pdf->Cell(0, 0,'C2', 0, 1, 'L');
$pdf->SetX("23.6");
$pdf->Cell(0, 0,'NEJ', 0, 1, 'L');
$pdf->SetFont('Arial','B', 12);
$pdf->Cell(0, 0,'_______________________________________________________________________________________________________________', 0, 1, 'L');
$pdf->SetFont('Arial','B', 9);

for($x=$inicio;$x<$fim;$x++){ $resul2 = mysql_fetch_array($selec2,MYSQL_ASSOC);
$valor = $resul2['Adto1'];
$dim = extenso($valor);
$dim = ereg_replace(" E "," e ",ucwords($dim));
$valor = number_format($valor, 2, ",", ".");
$valor_cifrao = 'R$ '.$valor;
if($valor == '0,00'){
$valor_cifrao = '';
}
$pdf->Ln(0.5);
$pdf->SetX("1");
$pdf->Cell(0, 0,$resul2['CC'], 0, 1, 'L');
$pdf->SetX("3");
$pdf->Cell(0, 0,$resul2['Nome1'], 0, 1, 'L');
$pdf->SetX("14");
$pdf->Cell(0, 0,$resul2['data_ad1'], 0, 1, 'L');
$pdf->SetX("16.4");
$pdf->Cell(0, 0,$valor_cifrao, 0, 1, 'L');
$pdf->SetX("18.8");
$pdf->Cell(0, 0,$resul2['C1'], 0, 1, 'L');
$pdf->SetX("21.2");
$pdf->Cell(0, 0,$resul2['C2'], 0, 1, 'L');
$pdf->SetX("23.6");
$pdf->Cell(0, 0,$resul2['nej'], 0, 1, 'L');
$pdf->Ln();

}
}
$pdf->Output('relatorios/RelatorioGeralAD'.'_'.$tc.'_'.$usuario.'_'.$data_registro.'_'.$hora_registro.'.pdf');






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
	  <p align="center" class="style1 style2 style4">Relatór<span class="style5">io emitido com sucesso!!!!</span></p>
	  <p align="center" class="style5 style2"><span class="style2 style4 style3">Para gerar novas cartas </span> <span class="style4"><a href="emite_rel_geral.php" target="mainFrame">Click aqui!</a></span></p>
  	  </div>
</div>

</body>
</html>

