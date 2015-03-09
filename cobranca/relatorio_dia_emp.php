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

<body> 
  
<?php
$tipocarta = $_POST['diaemp'];
//$csGarantia = $_POST['csGarantia'];
$csGarantia;
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
$vlr1 = 50;//valor minimo para envio da carta 2
$vlr2 = 100000000000;



}
if($tipocarta == nej){
$tipocarta = 70;
$tipocarta2 = 100000000000000000000000;
$tc = 'nej';
$vlr1 = 500;//valor minimo para Notificação extra judicial
$vlr2 = 10000000000000000000000000000;

}

?>
 <?php
include('connect.php');
$data_registro = date("dmY");
$data = date("d/m/Y");
$hora_registro = date("His");
$usuario = $_SESSION['usuarioCobranca'];
$tipo_rel = "RelatorioDiaEMP";
$modulo = "EMP";
$inseri_relatorio = mysql_query("INSERT INTO relatorios_cobranca (tipo_rel, usuario, data_emissao, hora, data, tipo_carta, modulo) VALUES ('$tipo_rel', '$usuario', '$data_registro', '$hora_registro', '$data', '$tc', '$modulo')");

  ?>

  <?php
include('connect.php');
include('extenso.php');
include('fpdf/fpdf.php');

$pdf = new FPDF('L','cm','A4');

$por_pagina = 15; 
//if($csGarantia == "cGarantia"){

$selec2 = mysql_query ("SELECT 
					posicaocontabil.cc, 
					analise_ger.sldaplicliq, 
					posicaocontabil.dataemaberto, 
					posicaocontabil.contrato, 
					posicaocontabil.modalidade, 
					posicaocontabil.nome, 
					posicaocontabil.cpf_cnpj, 
					posicaocontabil.diasematraso, 
					posicaocontabil.sld_dev_ctbil, 
					garantias_devedorSolidario.garantia  
						FROM posicaocontabil, garantias_devedorSolidario, analise_ger 
						WHERE 
							contrato NOT IN(SELECT cont FROM rel_carta_cob_emp WHERE $tc != '') 
							AND (sld_em_atraso BETWEEN $vlr1 AND $vlr2) 
							AND (diasematraso BETWEEN $tipocarta AND $tipocarta2) 
							AND posicaocontabil.contrato = garantias_devedorSolidario.nro_titulo 
							AND (posicaocontabil.cc = analise_ger.cc) 
					ORDER BY posicaocontabil.diasematraso, nro_titulo");

/*else{
$selec2 = mysql_query ("SELECT 
						cc, 
						contrato, 
						modalidade, 
						nome, 
						dataemaberto, 
						cpf_cnpj, 
						diasematraso, 
						sld_dev_ctbil 
							FROM posicaocontabil 
								WHERE 
								contrato NOT IN(SELECT cont FROM rel_carta_cob_emp WHERE $tc != '') 
								AND contrato NOT IN(SELECT nro_titulo FROM garantias_devedorSolidario WHERE garantia != '') 
								AND (sld_em_atraso BETWEEN $vlr1 AND $vlr2) 
								AND (diasematraso BETWEEN $tipocarta AND $tipocarta2) 
								ORDER BY posicaocontabil.diasematraso");
}*/
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
$pdf->Cell(0, 0,'_______________________________________________________________________________________________________________________', 0, 1, 'L');
$pdf->Ln(0.5);
$pdf->SetFont('Arial','B', 9);
$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1','Relatório do dia contas em EMP '.$tc.':'), 0, 1, 'L');
$pdf->SetFont('Arial','B', 12);
$pdf->SetX("0.5");
$pdf->Cell(0, 0,'_______________________________________________________________________________________________________________________', 0, 1, 'L');
$pdf->Cell(0, 0,'Pagina '.$i.' de '.$paginas, 0, 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial','B', 7);
$pdf->SetX("0.5");
$pdf->Cell(0, 0,'CC', 0, 1, 'L');
$pdf->SetX("2");
$pdf->Cell(0, 0,'Contrato', 0, 1, 'L');
$pdf->SetX("3.5");
$pdf->Cell(0, 0,'Modalidade', 0, 1, 'L');
$pdf->SetX("5");
$pdf->Cell(0, 0,'Nome', 0, 1, 'L');
$pdf->SetX("12");
$pdf->Cell(0, 0,'CPF', 0, 1, 'L');
$pdf->SetX("14");
$pdf->Cell(0, 0,'Dias Atraso', 0, 1, 'L');
$pdf->SetX("16");
$pdf->Cell(0, 0,'Data Atraso', 0, 1, 'L');
$pdf->SetX("18");
$pdf->Cell(0, 0,'Vlr Atraso', 0, 1, 'L');
$pdf->SetX("20");
$pdf->Cell(0, 0,'Sld Dev Ctbil', 0, 1, 'L');
$pdf->SetX("22");
$pdf->Cell(0, 0,'Garantia', 0, 1, 'L');
$pdf->SetX("28");
$pdf->Cell('utf-8','iso-8859-1',0, 0,'Dv Solidario', 0, 1, 'L');
$pdf->Cell(50, 0,____________________________________________________________________________________________________________________________________________________________________________________________________________, 0, 1, 'L');
$pdf->Ln();
$anterior = '';
for($x=$inicio;$x<$fim;$x++){ $resul2 = mysql_fetch_array($selec2,MYSQL_ASSOC);

if($resul2['dev_solidario'] != ''){
$devSolidario = "SIM";

}else{
$devSolidario = "NAO";
}
$conta = $resul2['contrato'];
		

$soma = mysql_query("SELECT SUM(Valor_a_Cobrar) FROM posicaodeliquidacao WHERE nr_titulo = '$conta'");
$resultado = mysql_fetch_assoc($soma);


if($resul2['contrato'] != $anterior){
$pdf->Ln(0.5);
$pdf->Cell(50, 0,____________________________________________________________________________________________________________________________________________________________________________________________________________, 0, 1, 'L');
$pdf->Ln(0.5);
$pdf->SetX("0.5");
$pdf->Cell(0, 0,$resul2['cc'], 0, 1, 'L');

$pdf->SetX("2");
$pdf->Cell(0, 0,$resul2['contrato'], 0, 1, 'L');
$pdf->SetX("3.5");
$pdf->Cell(0, 0,$resul2['modalidade'], 0, 1, 'L');
$pdf->SetX("5");
$pdf->Cell(0, 0,$resul2['nome'], 0, 1, 'L');
$pdf->SetX("12");
$pdf->Cell(0, 0,$resul2['cpf_cnpj'], 0, 1, 'L');
$pdf->SetX("14.4");
$pdf->Cell(0, 0,$resul2['diasematraso'], 0, 1, 'L');
$pdf->SetX("16");
$pdf->Cell(0, 0,$resul2['dataemaberto'], 0, 1, 'L');
$pdf->SetX("18");
$pdf->Cell(0, 0,number_format($resultado['SUM(Valor_a_Cobrar)'],2,',','.'), 0, 1, 'L');
$pdf->SetX("20");
$pdf->Cell(0, 0,$resul2['sld_dev_ctbil'], 0, 1, 'L');

if($resul2['sldaplicliq']>0)
{
$pdf->Ln(0.5);
$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1',"Valor de Aplicação: ".substr($resul2['sldaplicliq'],0,33)), 0, 1, 'L');
$pdf->Ln(0.5);

$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1',"Autorizo resgate de aplicação para cobertura da conta ").$resul2['cc'].":______________________________________________________________________", 0, 1, 'L');

}


}else{
$pdf->Ln(0.5);
}


$anterior = $resul2['contrato'];

$pdf->SetX("22");
$pdf->Cell(0, 0,substr($resul2['garantia'],0,33), 0, 1, 'L');


$pdf->SetX("28");
$pdf->Cell(0, 0,$devSolidario, 0, 1, 'L');
$pdf->Ln();
$data = date('YmdiH');
}

}


$pdf->Output('relatorios/RelatorioDiaEMP'.$csGarantia.'_'.$tc.'_'.$usuario.'_'.$data_registro.'_'.$hora_registro.'.pdf');

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
	  <p align="center" class="style1 style2 style4 style5">Relatório emitido com sucesso!!!!</span></p>
	  <p align="center" class="style5 style2"><span class="style2 style4 style3">Para gerar novas cartas </span> <span class="style4"><a href="emite_rel_geral_emp.php" target="mainFrame">Click aqui!</a></span></p>
  	  </div>
</div>


</body>
</html>
