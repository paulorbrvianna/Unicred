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
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; }
.style6 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; }
-->
</style>
</head>

<body>
<?php
$conta= $_POST['incluir_conta'];
include('connect.php');

$query = mysql_query("SELECT * FROM rel_carta_cob_ad WHERE CC LIKE '$conta'");
$resul = mysql_fetch_array($query, MYSQL_ASSOC);
 
?>
<?php
include('extenso.php');
$final_resul = $resul['CC'];
$final_resul2 = $resul['Nome1'];
$final_resul3 = $resul['Adto1'];
$final_resul4 = $resul['Dias_AD1'];
$final_resul5 = $resul['gerente1'];
$final_resul6 = $resul['data_ad1'];
$final_resul7 = date('d/m/y');
$valor = $resul['Adto1'];
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
  
	  <table width="980" border="0">
  <tr>
    <th width="177" scope="col"><div align="left" class="style6"><strong><?php echo  "Conta: "; ?></strong></div></th>
    <th width="700" scope="col"><div align="left" class="style6"><?php echo  $final_resul; ?></div></th>
  </tr>
  <tr>
    <td><div align="left" class="style6"><?php echo  "Nome: "; ?></div></td>
    <td><div align="left" class="style5"><?php echo  utf8_encode($final_resul2); ?></div></td>
  </tr>
  <tr>
    <td class="style6"><?php echo  "Adiantamento: " ?></span></td>
    <td><span class="style5"><?php echo  $valor; ?></span></td>
  </tr>
  <tr>
    <td><span class="style6"><?php echo  "Dias em atraso: " ?></span></td>
    <td><span class="style5"><?php echo  $final_resul4; ?></span></td>
  </tr>
  <tr>
    <td><span class="style6"><?php echo  "Data do adiantamento: " ?></span></td>
    <td><span class="style5"><?php echo  $final_resul6; ?></span></td>
  </tr>
  <tr>
    <td><span class="style6"><?php echo  "Gerente: " ?></span></td>
    <td><span class="style5"><?php echo  utf8_encode($final_resul5); ?></span></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="exclusao.php">
  <label for="inclui"></label>
  <label for="atua_carta"></label>
  <input name="inclui" type="submit" id="inclui" value="EXCLUIR" />
</form>


<?php $_SESSION['conta'] = $final_resul;
	  $_SESSION['nome'] = $final_resul2;		
      $_SESSION['adto'] = $final_resul3;  
      $_SESSION['dias_ad'] = $final_resul4;
      $_SESSION['gerente'] = $final_resul5;
	  $_SESSION['data_ad'] = $final_resul6;
  ?>
</body>
</html>
