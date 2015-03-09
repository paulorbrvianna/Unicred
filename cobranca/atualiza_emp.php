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
include('connect.php');
$contrato = $_SESSION['contrato'];
$tipocarta = $_POST['atua_carta'];
$data = $_POST['data'];

$atualiza = mysql_query("UPDATE rel_carta_cob_emp SET $tipocarta = '$data' WHERE cont = '$contrato'");


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
<link rel="stylesheet" href="../jquery/development-bundle/demos/demos.css">	<style>
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
	<h1 class="ui-widget-header style36">Atualizar</h1>
<div class="ui-widget-content">
	  <p align="center" class="style1 style2 style4 style5">
       
<table width="1000" border="0">
  <tr>
    <th width="990" scope="col"><span  class="style3"></span><p class="style28"><?php echo "ATUALIZAÇÃO  DE  ".$nome." COM SUCESSO!!!" ?> <p><span class="style1"><p class="style28">Para voltar</span> <a class="style28" href="consul_inclusao_emp.php">Clique aqui!</a></p></th>
  </tr>
</table> 
<?php 
$data_registro = date("Y-m-d");
$hora_registro = date("H:i");
$usuario = $_SESSION['usuarioCobranca'];

$inseri_registro = mysql_query("INSERT INTO registros_cobranca (data_registro, hora, usuario, tipo_alt, modulo, tipo_carta, data_carta, CC_Contrato, nome, DiasEmAtraso, DataAtraso, Vlr_Atraso) VALUES ('$data_registro', '$hora_registro', '$usuario', 'INCLUSAO', 'EMP', '$tipocarta', '$data', '$contrato', '$nome', '$DiasEmAtraso', '$DataEmAberto', '$Sld_em_Atraso')");


?>

</body>
</html>
