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

<style type="text/css">
<!--
.style8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 16px; color: #FFFFFF; }
.style19 {color: #000000}
.style20 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 16px; color: #000000; }
.style27 {font-size: 14px}
.style28 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 14px; color: #000000; }
.style29 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style31 {
	font-size: 16px;
	color: #000000;
}
.style35 {color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; }
.style36 {
	font-size: 18px
}
-->
</style>
</head>

<body>
<?php
$contrato = $_POST['incluir_contrato'];
include('connect.php');

$query = mysql_query("SELECT * FROM rel_carta_cob_emp WHERE cont LIKE '$contrato'");
$resul2 = mysql_fetch_array($query, MYSQL_ASSOC);
 $soma = mysql_query("SELECT SUM(Valor_a_Cobrar) FROM posicaodeliquidacao WHERE nr_titulo = '$contrato'");
$resultado = mysql_fetch_assoc($soma);
?>
<?php

include('extenso.php');
$final_resul0 = $resul2['CC'];
if($final_resul0 == ''){
$naoIncluida = 'naoIncluida';
$_SESSION['naoIncluida'] = $naoIncluida;
header('Location: consul_exclusao_emp.php');
}else{

$final_resul1 = $resul2['nome'];
$final_resul2 = $resul2['cont'];
$final_resul3 = $resul2['modalidade'];
$final_resul4 = $resul2['Dt_Liber'];
$final_resul5 = $resul2['Dt_Prim_Ven'];
$final_resul6 = $resul2['Dt_Ult_Ven'];
$final_resul7 = $resul2['Vlr_Liberado'];
$final_resul8 = $resul2['Qtde_Parc'];
$final_resul9 = $resul2['Vlr_Parcela'];
$final_resul10 = $resul2['Sld Dev Ctbi'];
$final_resul11 = $resul2['Qtde Parc Rest'];
$final_resul12 = $resul2['Sld Devedor'];
$final_resul13 = $resultado['SUM(Valor_a_Cobrar)'];
$final_resul14 = $resul2['DataEmAberto'];
$final_resul15 = $resul2['DiasEmAtraso'];
$final_resul16 = $resul2['Nome_Gerente'];



$valor = $resultado['SUM(Valor_a_Cobrar)'];
$dim = extenso($valor);
$dim = ereg_replace(" E "," e ",ucwords($dim));
$valor = number_format($valor, 2, ",", ".");



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
<script src="../jquery/development-bundle/ui/jquery.ui.accordion.js"></script>
<script src="../jquery/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script src="../jquery/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
<link rel="stylesheet" href="../jquery/development-bundle/demos/demos.css">
	<style>
	h1 {
	padding: 0.2em;
	margin: 0;
	font-size: 16px;
}
	#products { float:left; width: 900px; margin-right: 2em; }
	
.style2 {font-size: 36px}
.style5 {font-size: 16px}
    .style6 {font-size: 18px}
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
<h1 class="ui-widget-header">Excluir</h1>
  
      <table width="729" border="0">
  <tr>
    <th width="255" class="style20" scope="col"><div align="left" class="style20 style19 style27">
      <div align="left"><?php echo  "Conta: "; ?></div>
    </div></th>
    <th width="464" class="style20" scope="col"><div align="left" class="style28">
      <div align="left"><?php echo  $final_resul0; ?></div>
    </div></th>
  </tr>
  <tr>
    <th width="255" class="style20" scope="col"><div align="left" class="style20 style19 style27">
      <div align="left"><?php echo  "Modalidade: "; ?></div>
    </div></th>
    <th width="464" class="style20" scope="col"><div align="left" class="style28">
      <div align="left"><?php echo  $final_resul3; ?></div>
    </div></th>
  </tr>
  <tr>
    <th width="255" class="style20" scope="col"><div align="left" class="style20 style19 style27">
      <div align="left"><?php echo  "Contrato: "; ?></div>
    </div></th>
    <th width="464" class="style20" scope="col"><div align="left" class="style28">
      <div align="left"><?php echo  $final_resul2; ?></div>
    </div></th>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28">
      <div align="left"><?php echo  "Nome: "; ?></div>
    </div></td>
    <td class="style20"><div align="left" class="style28">
      <div align="left"><?php echo  utf8_encode($final_resul1); ?></div>
    </div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Valor Atrasado: "; ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $valor; ?></div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Dias em Atraso: "; ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $final_resul15; ?></div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Data do Atraso: " ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $final_resul14; ?></div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Gerente: " ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  utf8_encode($final_resul16); ?></div></td>
    		
  </tr>
</table>

<form id="form1" name="form1" method="post" action="exclusao_emp.php">
  <label for="inclui"></label>
  <label for="atua_carta"></label>
  <input name="inclui" type="submit" id="inclui" value="EXCLUIR" />
</form>

<?php
$_SESSION['CC'] = $final_resul0; 
$_SESSION['nome'] = $final_resul1;
$_SESSION['contrato'] = $final_resul2;
$_SESSION['modalidade'] = $final_resul3;
$_SESSION['Dt_Liber'] = $final_resul4;
$_SESSION['Dt_Prim_Ven'] = $final_resul5;
$_SESSION['Dt_Ult_Ven'] = $final_resul6;
$_SESSION['Vlr_Liberado'] = $final_resul7;
$_SESSION['Qtde_Parc'] = $final_resul8;
$_SESSION['Vlr_Parcela'] = $final_resul9;
$_SESSION['Sld Dev Ctbi'] = $final_resul10;
$_SESSION['Qtde Parc Rest'] = $final_resul11;
$_SESSION['Sld Devedor'] = $final_resul12;
$_SESSION['Sld_em_Atraso'] = $final_resul13;
$_SESSION['DataEmAberto'] = $final_resul14;
$_SESSION['DiasEmAtraso'] = $final_resul15;
$_SESSION['Nome Gerente'] = $final_resul16;
  }
?>

</body>
</html>
