<?
ob_start();
session_start();
if(empty($_SESSION['usuarioCobranca'])){ 
    header("Location: login.php");  	
	$faltalogar = "faltalogar";
	$_SESSION['faltalogar'] = $faltalogar;
  }
  ?>
   <?php
$dia1 = $_POST['dia1'];
$dia2 = $_POST['dia2'];
$agencia = $_POST['agencia'];
$gerente = "";
if($agencia == '9999'){
$gerente = $_POST['gerente2207'];
}elseif($agencia == 'PF')
{
$gerente = $_POST['gerentePF'];
}elseif($agencia == 'PJ')
{
$gerente = $_POST['gerentePJ'];
}

//GERENTE  // AGENCIA
if($gerente == '8888'){
$gerente = array(8888,308,284,351,349,332,348,4,42,128,282,350,377,16001);
$ids = join(',',$gerente);
}
elseif($gerente == '9999'){
$gerente = array(9999,308,284,351,349,332,348,4,127,122,128,282,350,126,377,392,391,371,16001);
$ids = join(',',$gerente);
}
elseif($gerente == '7777'){
$gerente = array(7777,127,122,126,368);
$ids = join(',',$gerente);

}else{
$ids = $gerente;
}

if($dia1 == '' or $dia2 == ''){
header("Location: emite_rel_geral_emp.php");
$erro2 = "erro2";
$_SESSION['erro2'] = $erro2;

}
elseif($dia1 > $dia2){
header("Location: emite_rel_geral_emp.php");
$erro = "erro";
$_SESSION['erro'] = $erro;

} else{


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
 
include('connect.php');
$data_registro = date("dmY");
$data = date("d/m/Y");
$hora_registro = date("His");
$usuario = $_SESSION['usuarioCobranca'];
$tipo_rel = "RelatorioParcelasEmp";
$modulo = "EMP";
$inseri_relatorio = mysql_query("INSERT INTO relatorios_cobranca (tipo_rel, usuario, data_emissao, hora, data, tipo_carta, modulo) VALUES ('$tipo_rel', '$usuario', '$data_registro', '$hora_registro', '$data', '$tc', '$modulo')");


  ?>
  <?php
include('connect.php');
include('extenso.php');
include('fpdf/fpdf.php');

$pdf = new FPDF('L','cm','A4');
$por_pagina = 15; 

$selec2 = mysql_query ("SELECT  saldocc.cc, posicaocontabil.risco , posicaocontabil.contrato, cad_completo.dddcel, cad_completo.cel, diasematraso, posicaocontabil.nome, saldocc.gerente, saldocc.codger, posicaodeliquidacao.Nro_Parc, posicaodeliquidacao.nr_titulo, Valor_a_Cobrar, sld_em_atraso, posicaocontabil.modalidade, dataemaberto FROM saldocc LEFT JOIN posicaocontabil ON (posicaocontabil.cc = saldocc.cc) 
LEFT JOIN cad_completo ON (saldocc.cc = cad_completo.conta), posicaodeliquidacao WHERE (diasematraso  BETWEEN  $dia1 AND $dia2) AND (sld_em_atraso >= 20) AND saldocc.codger IN ($ids)  AND (posicaocontabil.contrato = posicaodeliquidacao.nr_titulo) ORDER BY diasematraso, contrato ");

// original SELECT DISTINCT (conta) conta, posicaocontabil.contrato, cad_completo.dddcel, cad_completo.cel, diasematraso, posicaocontabil.nome, cad_completo.gerente, cad_completo.codgerente, posicaodeliquidacao.Nro_Parc, posicaodeliquidacao.nr_titulo, Valor_a_Cobrar, sld_em_atraso, modalidade, dataemaberto FROM cad_completo, posicaocontabil, posicaodeliquidacao WHERE (diasematraso BETWEEN $dia1 AND $dia2) AND (sld_em_atraso >= 20) AND cad_completo.codgerente IN ($ids) AND (posicaocontabil.cc = cad_completo.conta) AND (posicaocontabil.contrato = posicaodeliquidacao.nr_titulo) ORDER BY diasematraso, contrato
$num_linhas2 = mysql_num_rows($selec2);


$paginas = ceil($num_linhas2/$por_pagina);

$linha_atual = 0;
$inicio = 0;

for($i=1; $i<=$paginas; $i++) {

$inicio = $linha_atual;
$fim = $linha_atual + $por_pagina;
if($fim > $num_linhas2) {
$fim = $num_linhas2;
}elseif($i == $paginas and  $i>1){
$fim= $num_linhas2 - ($paginas - 1)*$por_pagina;

}

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
$pdf->SetX(0.5);
$pdf->Cell(0, 0,'_____________________________________________________________________________________________________________________', 0, 1, 'L');
$pdf->Ln(0.5);
$pdf->SetFont('Arial','B', 8);
$pdf->Cell(0, 0,iconv('utf-8','iso-8859-1','Relatório do dia contas em EMP '.$tc.':'), 0, 1, 'L');
$pdf->SetFont('Arial','B', 12);
$pdf->SetX(0.5);
$pdf->Cell(0, 0,'_____________________________________________________________________________________________________________________', 0, 1, 'L');
$pdf->Cell(0, 0,'Pagina '.$i.' de '.$paginas, 0, 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial','B', 6);
$pdf->SetX("0.5");
$pdf->Cell(0, 0,'CONTRATO', 0, 1, 'L');
$pdf->SetX("2");
$pdf->Cell(0, 0,'CONTA', 0, 1, 'L');
$pdf->SetX("3.5");
$pdf->Cell(0, 0,'NOME', 0, 1, 'L');
$pdf->SetX("8.9");
$pdf->Cell(0, 0,'RISCO', 0, 1, 'L');
$pdf->SetX("10.5");
$pdf->Cell(0, 0,'TELEFONE', 0, 1, 'L');
$pdf->SetX("12.5");
$pdf->Cell(0, 0,'NUM.PARC(S)', 0, 1, 'L');
$pdf->SetX("14.5");
$pdf->Cell(0, 0,'VALOR', 0, 1, 'L');
$pdf->SetX("16");
$pdf->Cell(0, 0,'VLR TOTAL', 0, 1, 'L');
$pdf->SetX("18");
$pdf->Cell(0, 0,'DIAS ATRASO', 0, 1, 'L');
$pdf->SetX("20");
$pdf->Cell(0, 0,'DATA ATRASO', 0, 1, 'L');
$pdf->SetX("22");
$pdf->Cell(0, 0,'MODALIDADE', 0, 1, 'L');
$pdf->SetX("24");
$pdf->Cell(0, 0,'GERENTE', 0, 1, 'L');
$pdf->SetX("0.5");
	 	   	   $pdf->Cell(50, 0,__________________________________________________________________________________________________________________________________________________________________________________________________________________________________________, 0, 1, 'L');
?>
  
 <?php
$pdf->SetFont("Arial", "B", 5.8);

for($x=$inicio;$x<$fim;++$x){$row_events = mysql_fetch_assoc($selec2);
     $conta = $row_events['nr_titulo'];
			

$soma = mysql_query("SELECT SUM(Valor_a_Cobrar) FROM posicaodeliquidacao WHERE nr_titulo = '$conta'");
$resultado = mysql_fetch_assoc($soma);



       if ($row_events['nr_titulo'] !=  $previous) {

       
	   $pdf->Ln(0.5);
  $pdf->SetX("0.5");	   
	 	   	   $pdf->Cell(50, 0,_________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________, 0, 1, 'L');

		  $pdf->Ln(0.5);
	   $pdf->SetX("0.5");	   
	  $pdf->Cell(0, 0,$row_events['nr_titulo'], 0, 1, 'L');
        $pdf->SetX("2");
	   $pdf->Cell(50, 0,$row_events['cc'], 0, 1, 'L');
	    $pdf->SetX("3.5");
	   $pdf->Cell(50, 0, substr($row_events['nome'], 0, 35) , 0, 1, 'L');
	   $pdf->SetX("9");
	   $pdf->Cell(50, 0, $row_events['risco'] , 0, 1, 'L');
		$pdf->SetX("24");
	   $pdf->Cell(0, 0,$row_events['gerente'], 0, 1, 'L');
		$pdf->SetX("20.3");
$pdf->Cell(0, 0,$row_events['dataemaberto'], 0, 1, 'L');
$pdf->SetX("22");
$pdf->Cell(0, 0,$row_events['modalidade'], 0, 1, 'L');
$pdf->SetX("16.3");
$pdf->Cell(0, 0,number_format($resultado['SUM(Valor_a_Cobrar)'],2,',','.'), 0, 1, 'L');
$pdf->SetX("18.5");
$pdf->Cell(0, 0,$row_events['diasematraso'], 0, 1, 'L');
$pdf->SetX("10.5");
$pdf->Cell(0, 0,'( '.$row_events['dddcel'].' ) '.$row_events['cel'] , 0, 1, 'L');
 
       } else {
	   

     $pdf->Ln(0.5);  
	   
	   }
              
$previous = $row_events['nr_titulo'];
$previous1 = $row_events['nome'];
$pdf->SetX("13");
$pdf->Cell(0, 0,$row_events['Nro_Parc'], 0, 1, 'L');
$pdf->SetX("14.5");
$pdf->Cell(0, 0,number_format($row_events['Valor_a_Cobrar'],2,',','.'), 0, 1, 'L');




 
}
}
 
$pdf->Output('relatorios/RelatorioParcelasEmp'.'_'.$tc.'_'.$usuario.'_'.$data_registro.'_'.$hora_registro.'.pdf');
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

<?php  }?>
