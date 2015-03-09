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

$CC = $_SESSION['CC']; 
$nome = $_SESSION['nome'];
$contrato = $_SESSION['contrato'];
$modalidade = $_SESSION['modalidade'];
$Dt_Liber = $_SESSION['Dt_Liber'];
$Dt_Prim_Ven = $_SESSION['Dt_Prim_Ven'];
$Dt_Ult_Ven = $_SESSION['Dt_Ult_Ven'];
$Vlr_Liberado = $_SESSION['Vlr_Liberado'];
$Qtde_Parc = $_SESSION['Qtde_Parc'];
$Vlr_Parcela = $_SESSION['Vlr_Parcela'];
$Sld_Dev_Ctbi = $_SESSION['Sld Dev Ctbi'];
$Qtde_Parc_Rest = $_SESSION['Qtde Parc Rest'];
$Sld_Devedor = $_SESSION['Sld Devedor'];
$Sld_em_Atraso = $_SESSION['Sld_em_Atraso'];
$DataEmAberto = $_SESSION['DataEmAberto'];
$DiasEmAtraso = $_SESSION['DiasEmAtraso'];
$Nome_Gerente = $_SESSION['Nome Gerente'];
$C1 = $_POST['data'];
?>
<?php

$inseri = mysql_query("INSERT INTO rel_carta_cob_emp (CC, nome, cont, modalidade, Dt_Liber, Dt_Prim_Ven, Dt_Ult_Ven, Vlr_Liberado, Qtde_Parc, Vlr_Parcela, Sld_Dev_Ctbil, Qtde_Parc_Rest, Sld_Devedor, Sld_em_Atraso2, DataEmAberto, DiasEmAtraso, Nome_Gerente, C1) VALUES ('$CC', '$nome', '$contrato', '$modalidade', '$Dt_Liber', '$Dt_Prim_Ven', '$Dt_Ult_Ven', '$Vlr_Liberado', '$Qtde_Parc', '$Vlr_Parcela', '$Sld_Dev_Ctbi', '$Qtde_Parc_Rest', '$Sld_Devedor', '$Sld_em_Atraso', '$DataEmAberto', $DiasEmAtraso, '$Nome_Gerente', '$C1' )");

?>
<?php 
$data_registro = date("Y-m-d");
$hora_registro = date("H:i");
$usuario = $_SESSION['usuarioCobranca'];


$inseri_registro = mysql_query("INSERT INTO registros_cobranca (data_registro, hora, usuario, tipo_alt, modulo, tipo_carta, data_carta, CC_Contrato, nome, DiasEmAtraso, DataAtraso, Vlr_Atraso) VALUES ('$data_registro', '$hora_registro', '$usuario', 'INCLUSAO', 'EMP', 'C1', '$C1', '$contrato', '$nome', '$DiasEmAtraso', '$DataEmAberto', '$Sld_em_Atraso')");


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
	  <p align="center" class="style5 style2"><span class="style4 style3">Para incluir um novo cooperado</span> <span class="style4"><a href="consul_inclusao_emp.php" target="mainFrame">Click aqui!</a></span></p>
  	  </div>
</div>


</body>
</html>
