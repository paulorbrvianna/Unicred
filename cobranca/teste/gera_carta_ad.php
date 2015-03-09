
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

<body onload="MM_openBrWindow('cobcarta_ad2.pdf','','')" >

<?php
$t = $_POST['data'];
list($dia,$mes,$ano) = split("[/.-]",$t);
$r =  $_POST['qtd'];

$x=0;

$vetor = array();
while($x<$r){
if($_POST['enviaCarta'.$x] == ""){
$vetor[$x] = "99999-9";
}else{

$vetor[$x] = $_POST['enviaCarta'.$x];
}
//$re = array_merge($vetor[$x]);
$x++;


}

$contasArray = implode("', '",$vetor);



$contasVetor =  "'".$contasArray."'";






?>
 <?php
include('../connect.php');
$data_registro = date("dmY");
$data = date("d/m/Y");
$hora_registro = date("His");
$usuario = $_SESSION['user'];
$tipo_rel = "CartaAD";
$inseri_relatorio = mysql_query("INSERT INTO relatorios_cobranca (tipo_rel, usuario, data_emissao, hora, data, tipo_carta) VALUES ('$tipo_rel', '$usuario', '$data_registro', '$hora_registro', '$data', '$tc')");

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
 
 include('../connect.php');
include('fpdf/fpdf.php');


$pdf = new FPDF('P','cm','A4');
$pdf->AddPage();

$selec2 = mysql_query ("SELECT * FROM ad WHERE cc IN($contasVetor)");
 
$num_linhas2 = mysql_num_rows($selec2);

for($x=0;$x<$num_linhas2;$x++){ $resul2 = mysql_fetch_array($selec2,MYSQL_ASSOC);

$contacorrente = $resul2['cc'];
$gerente = mysql_query("SELECT gerente, codgerente FROM cad_completo WHERE conta = '$contacorrente'");
$nomegerente = mysql_fetch_assoc($gerente);
$codgerente = $nomegerente['codgerente'];

if($codgerente == 74 or $codgerente == 48){
$nome1gerente ='VANESSA RATIS DE OLIVEIRA';
}elseif($codgerente == 7001){
$nome1gerente = 'DEIZIANE ALBUQUERQUE DE SOUZA';
}elseif($codgerente != 74 or $codgerente != 48 or $codgerente != 7001){
$nome1gerente = $nomegerente['gerente'];
}
$pdf->SetFont('Arial', '', 12);
//$pdf->Image("cab.jpg", 15,1,4,1);
//$pdf->Image("lado.jpg", 0,-2,6,36);
//$pdf->Image("roda.jpg", 0,28,30,2);
//$pdf->Image("roda2.jpg", 7,27,13,1);
$pdf->Ln(1);	
$pdf->Cell(0, 2,iconv('utf-8','iso-8859-1','Recife, '.$dia.' de '.$mes.' de '.$ano.'.'), 0, 1, 'R');
$pdf->Ln(2);
$pdf-> SetFont('Arial', 'B', 12);
$pdf-> Cell(0, 0.7,"Ilmo. (a) Sr. (a)", 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(0, 0.7,$resul2['nome'], 0, 1, 'L');
$pdf-> SetFont('Arial', 'B', 12);
$pdf->Cell(0, 0.7,"Nesta", 0, 1, 'L');
$pdf->Ln();
$pdf-> MultiCell(0,0.6, iconv('utf-8','iso-8859-1',' '.' '.' '.' '.' '.' '.' '.' '. ' '.'Referência: Saldo devedor em sua conta de depósitos N° '.$resul2['cc'].' , desde, '.$resul2['data_ad']), 0,1,'J');
$pdf->Ln();
$pdf-> MultiCell(0,0.6, iconv('utf-8','iso-8859-1','Prezado (a) Cooperado (a):'), 0,1,'J');
$pdf->Ln();
$pdf-> Cell(26,0.6, iconv('utf-8','iso-8859-1',' '.' '.' '.' '.' '.' '.' '.' '. ' '.'Face às  normas emanadas do Banco Central do Brasil, comunicamos-lhe da impossibi- '),0,1,'J'); 
$pdf-> Cell(19,0.6, iconv('utf-8','iso-8859-1','lidade  de manutenção de excessos sobre saldo devedor em conta de depósitos, solicitamos  '),0,1,'J');
$pdf-> Cell(26,0.6, iconv('utf-8','iso-8859-1','imediata regularização  deste débito, sob pena  de incorrer em  descumprimento do  estatuto'),0,1,'J');
$pdf-> Cell(26,0.6, iconv('utf-8','iso-8859-1','desta Cooperativa.'),0,1,'J');
$pdf->Ln();
$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1',' '.' '.' '.' '.' '.' '.' '.' '. ' '.'Lembramos,  por  oportuno,  que  o  atraso  referente ao  excesso  sobre saldo devedor,'), 0,1,'J');
$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1','quando  da existência  de limite de cheque especial, acarreta o seu vencimento antecipado e'), 0,1,'J');
$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1','a sua  exigibilidade  imediata,  conforme  ficou estabelecido  na CLÁUSULA  '.'-'.'  VENCIMENTO'), 0,1,'J');
$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1','ANTECIPADO, da  Cédula de  Crédito Bancária  ou  Contrato de abertura de conta corrente  '.'-'.''), 0,1,'J');
$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1','cheque especial Nº '.$resul2['cc'].'.'), 0,1,'J');
$pdf->Ln();
$pdf-> MultiCell(0,0.6, iconv('utf-8','iso-8859-1',' '.' '.' '.' '.' '.' '.' '.' '. '  '.'Dirija-se à nossa coperativa ou entre em contato pelo Fone: (81) 2101.6161 e fale com seu(sua) gerente:'), 0,1,'J');
$pdf-> Cell(0,0.6, ' '.' '.' '.' '.' '.' '.' '.' '. '  '.$nome1gerente, 0,1,'J');
$pdf->Ln();
$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1',' '.' '.' '.' '.' '.' '.' '.' '. '  '.'Caso  sua  situação  já  se  encontre  regularizada,  por  gentileza  desconsiderar  esta'), 0,1,'J');
$pdf-> Cell(0,0.6, iconv('utf-8','iso-8859-1','comunicação.'), 0,1,'J');
$pdf->Ln(1);
$pdf->Cell(0, 0.7,'Atenciosamente', 0, 1, 'C');
$pdf->Ln(1.5);
$pdf->Cell(0, 0.7,'UNICRED RECIFE', 0, 1, 'C');
$pdf->Cell(0, 0.7,iconv('utf-8','iso-8859-1','Setor de Cobrança'), 0, 1, 'C');

$pdf->AddPage();
}
$pdf->Output('cobcarta_ad2.pdf');







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
	  <p align="center" class="style5"><span class="style2 style1 style4">Para gerar novas cartas </span> <a href="emite_carta_ad.php" target="mainFrame">Click aqui!</a></p>
    <? echo $contasVetor; ?>
	  	</div>
</div>
</body>
</html>
