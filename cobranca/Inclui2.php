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
.style1 {color: #FFFFFF}
.style2 {font-size: 16px}
-->
</style>
</head>

<body>
<?php
include('connect.php');
$conta = $_SESSION['conta'];
$nome = $_SESSION['nome'];		
$adto = $_SESSION['adto'];  
$dias_ad = $_SESSION['dias_ad'];
$data_ad = $_SESSION['data_ad'];
$C1 = $_POST['data'];

if ($adto<20 and $dias_ad<5){
?>
<table width="1000" border="1" bgcolor="#006666">
  <tr>
    <th width="990" scope="col"><?php echo $nome." ESTA COM ".$dias_ad." DIAS EM AD E COM UM DEBITO DE ".$adto." POR ISSO NÃO DEVE SER INCLUSO NO SISTEMA!" ?> <p><span class="style1">Para voltar</span> <a href="consul_inclusao.php">Clique aqui!</a></p></th>
  </tr>
</table> 
<?php } else{?>
<?php

$inseri = mysql_query("INSERT INTO rel_carta_cob_ad (CC, Nome1, Adto1, Dias_AD1, data_ad1, C1) VALUES ('$conta', '$nome', '$adto', '$dias_ad', '$data_ad', '$C1')");


?>
<?php 
$data_registro = date("Y-m-d");
$hora_registro = date("H:i");
$usuario = $_SESSION['usuarioCobranca'];

$inseri_registro = mysql_query("INSERT INTO registros_cobranca (data_registro, hora, usuario, tipo_alt, modulo, tipo_carta, data_carta, CC_Contrato, nome, DiasEmAtraso, DataAtraso, Vlr_Atraso) VALUES ('$data_registro', '$hora_registro', '$usuario', 'INCLUSAO', 'AD', 'C1', '$C1', '$conta', '$nome', '$dias_ad', '$data_ad', '$adto')");


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
	<h1 class="ui-widget-header">Incluir</h1>
	<div class="ui-widget-content">
	  <p align="center" class="style1 style2 style4 style5"><?php echo "INCLUSÃO DE  ".$nome." COM SUCESSO!!!" ?></span></p>
	  <p align="center" class="style5 style2"><span class="style4 style3">Para incluir um novo cooperado</span> <span class="style4"><a href="consul_inclusao.php" target="mainFrame">Click aqui!</a></span></p>
  	  </div>
</div>

<?php }?>
</body>
</html>
