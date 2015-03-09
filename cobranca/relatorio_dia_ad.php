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
<p>
  <?php
$tipocarta = $_POST['diaad'];

if($tipocarta == C1){
$tipocarta = 15;//quantidade de dias
$tipocarta2 = 30;
$tc = 'C1';
$adto1 = 0;//valor minimo para envio da carta
$adto2 = 1000000000000000000000;


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
include('connect.php');
$data_registro = date("dmY");
$data = date("d/m/Y");
$hora_registro = date("His");
$usuario = $_SESSION['usuarioCobranca'];
$tipo_rel = "RelatorioDiaAD";
$modulo = "AD";
$inseri_relatorio = mysql_query("INSERT INTO relatorios_cobranca (tipo_rel, usuario, data_emissao, hora, data, tipo_carta, modulo) VALUES ('$tipo_rel', '$usuario', '$data_registro', '$hora_registro', '$data', '$tc', '$modulo')");



  ?>
  <?php
include('connect.php');
include('extenso.php');
include('fpdf/fpdf.php');

$pdf = new FPDF('L','cm','A4');

$por_pagina = 30; 
$selec2 = mysql_query ("SELECT ad.cc, ad.nome,analise_ger.sldaplicliq, ad.dias_ad, ad.adto, ad.data_ad, ad.gerente FROM ad LEFT JOIN analise_ger ON (ad.cc = analise_ger.cc)  WHERE ad.cc NOT IN(SELECT CC FROM rel_carta_cob_ad WHERE $tc != '') AND (adto BETWEEN $adto1 AND $adto2)  AND (dias_ad BETWEEN $tipocarta  AND $tipocarta2)");

//SELECT ad.cc, ad.nome,analise_ger.sldaplicliq, ad.dias_ad, ad.adto, ad.data_ad, cad_completo.gerente FROM ad, analise_ger,  cad_completo WHERE ad.cc NOT IN(SELECT CC FROM rel_carta_cob_ad WHERE $tc != '') AND (adto BETWEEN $adto1 AND $adto2) AND (ad.cc = cad_completo.conta) AND (ad.cc = analise_ger.cc) AND (dias_ad BETWEEN $tipocarta  AND $tipocarta2)
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
$pdf->SetFont("Arial", "B", 8); 
$pdf->SetFont('Times','',8);
$hora = date('H:i:s');
$pdf->SetFont('Arial', '', 7);
$pdf->SetY("1"); 
$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1','Data de Emissão: '.date('d/m/Y')), 0, 1, 'C');
$pdf->Cell(0, 0,$hora, 0, 1, 'L');
$pdf->Ln(1);
$pdf->SetFont('Arial','B', 9);
$pdf->Cell(0, 0,'UNICRED NATAL 2207', 0, 1, 'L');
$pdf->SetFont('Arial','B', 8);
$pdf->Cell(0, 0,'_______________________________________________________________________________________________________________', 0, 1, 'L');
$pdf->Ln(0.5);
$pdf->SetFont('Arial','B', 9);
$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1','Relatório do dia contas em AD '.$tc.':'), 0, 1, 'L');
$pdf->SetFont('Arial','B', 8);
$pdf->Cell(0, 0,'_______________________________________________________________________________________________________________', 0, 1, 'L');
$pdf->Cell(0, 0,'Pagina '.$i, 0, 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial','B', 7);
$pdf->SetX("1");
$pdf->Cell(0, 0,'CC', 0, 1, 'L');
$pdf->SetX("2.3");
$pdf->Cell(0, 0,'Nome', 0, 1, 'L');
$pdf->SetX("11");
$pdf->Cell(0, 0,'Dias em AD', 0, 1, 'L');
$pdf->SetX("13");
$pdf->Cell(0, 0,'Valor AD', 0, 1, 'L');
$pdf->SetX("16");
$pdf->Cell(0, 0,'Data AD', 0, 1, 'L');
$pdf->SetX("18");
$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1','Aplicação'), 0, 1, 'L');
$pdf->SetX("20");
$pdf->Cell(0, 0,'Gerente', 0, 1, 'L');
$pdf->Cell(0, 0,'____________________________________________________________________________________________________________________________________________________', 0, 1, 'L');

$pdf->Ln();
for($x=$inicio;$x<$fim;$x++){ $resul2 = mysql_fetch_array($selec2,MYSQL_ASSOC);
$valor = $resul2['adto'];
$dim = extenso($valor);
$dim = ereg_replace(" E "," e ",ucwords($dim));
$valor = number_format($valor, 2, ",", ".");
$valor_cifrao = 'R$ '.$valor;
if($valor == '0,00'){
$valor_cifrao = '';
}

$pdf->Ln(0.5);
$pdf->SetX("1");
$pdf->Cell(0, 0,$resul2['cc'], 0, 1, 'L');
$pdf->SetX("2.3");
$pdf->Cell(0, 0,$resul2['nome'], 0, 1, 'L');
$pdf->SetX("11.3");
$pdf->Cell(0, 0,$resul2['dias_ad'], 0, 1, 'L');
$pdf->SetX("13");
$pdf->Cell(0, 0,$valor_cifrao, 0, 1, 'L');
$pdf->SetX("16");
$pdf->Cell(0, 0,$resul2['data_ad'], 0, 1, 'L');
$pdf->SetX("18");
$pdf->Cell(0, 0,$resul2['sldaplicliq'], 0, 1, 'L');
$pdf->SetX("20");
$pdf->Cell(0, 0,$resul2['gerente'], 0, 1, 'L');
$data = date('YmdiH');
if($resul2['sldaplicliq']>0)
{
$pdf->Ln(0.8);
$pdf->SetX("10");
$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1',"Autorizo resgate de aplicação para cobertura da conta ").$resul2['cc'] ." :______________________________________________________________________", 0, 1, 'L');

$fim = $fim;
}


}
}

$pdf->Output('relatorios/RelatorioDiaAD'.'_'.$tc.'_'.$usuario.'_'.$data_registro.'_'.$hora_registro.'.pdf');

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
	  <p align="center" class="style5 style2"><span class="style2 style4 style3">Para gerar novas cartas </span> <span class="style4"><a href="emite_rel_geral.php" target="mainFrame">Click aqui!</a></span></p>
  	  </div>
</div>


</body>
</html>
