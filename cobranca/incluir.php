<?
ob_start();
session_start();
if(empty($_SESSION['usuarioCobranca'])){ 
    header("Location: login.php");  	
	$faltalogar = "faltalogar";
	$_SESSION['faltalogar'] = $faltalogar;
  }
  ?>
<?php include('extenso.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
$conta = $_POST['incluir_conta'];
include('connect.php');

$query = mysql_query("SELECT * FROM rel_carta_cob_ad WHERE CC LIKE '$conta'");
$resul = mysql_fetch_array($query, MYSQL_ASSOC);
 $query2 = mysql_query("SELECT * FROM ad WHERE cc LIKE '$conta'");
$resul2 = mysql_fetch_array($query2, MYSQL_ASSOC);

if($resul == ''){
$final_resul = $resul2['cc'];
$final_resul2 = $resul2['nome'];
$final_resul3 = $resul2['adto'];
$final_resul4 = $resul2['dias_ad'];
$final_resul6 = $resul2['data_ad'];

$valor = $resul2['adto'];
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
	<h1 class="ui-widget-header">Incluir</h1>
	<div class="ui-widget-content">
	  <p align="center" class="style1 style2 style4 style5">
	  <div align="left"></div>
	  <table width="729" border="0">
  <tr>
    <th width="255" class="style20" scope="col"><div align="left" class="style20 style19 style27">
      <div align="left"><?php echo  "Conta: "; ?></div>
    </div></th>
    <th width="464" class="style20" scope="col"><div align="left" class="style28">
      <div align="left"><?php echo  $final_resul; ?></div>
    </div></th>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28">
      <div align="left"><?php echo  "Nome: "; ?></div>
    </div></td>
    <td class="style20"><div align="left" class="style28">
      <div align="left"><?php echo  utf8_encode($final_resul2); ?></div>
    </div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Adiantamento: "; ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $valor; ?></div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Dias em atraso: "; ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $final_resul4; ?></div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Data do adiantamento: " ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $final_resul6; ?></div></td>
  </tr>


    		<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			altField: "#alternate",
			altFormat: "dd 'de' MM 'de' yy"
		});
	});
	</script>
 
</table>
<form id="form1" name="form1" method="post" action="Inclui2.php">
  <label for="inclui"></label>
  <strong class="style28">Data de Inclus&atilde;o da C1:</strong> 
  <input type="text" id="datepicker" name="data" value="<?php echo date("d/m/Y"); ?>" size="10" class="h1" >

  <input name="inclui" type="submit" id="inclui" value="INCLUIR" />
</form></p>
  </div>
</div>
<?php }?> 



 <?php
if($resul != ''){
 
$final_resul = $resul['CC'];
$final_resul2 = $resul['Nome1'];
$final_resul3 = $resul['Adto1'];
$final_resul4 = $resul['Dias_AD1'];
$final_resul6 = $resul['data_ad1'];


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
	  <p align="center" class="style1 style2 style4 style5"><table width="725" border="0" >
  <tr>
    <th width="177" scope="col"><div align="left" class="style8 style29 style31">
      <div align="left"><?php echo  "Conta: "; ?></div>
    </div></th>
    <th width="538" scope="col"><div align="left" class="style8 style29 style27 style19">
      <div align="left"><?php echo  $final_resul; ?></div>
    </div></th>
  </tr>
  <tr>
    <td><div align="left" class="style20">
      <div align="left"><?php echo  "Nome: "; ?></div>
    </div></td>
    <td><div align="left" class="style8 style29 style27 style19">
      <div align="left"><?php echo  utf8_encode($final_resul2); ?></div>
    </div></td>
  </tr>
  <tr>
    <td><div align="left" class="style20">
      <div align="left"><?php echo  "Adiantamento: " ?></div>
    </div></td>
    <td><div align="left" class="style35">
      <div align="left"><strong><?php echo  $valor; ?></strong></div>
    </div></td>
  </tr>
  <tr>
    <td><div align="left" class="style20">
      <div align="left"><?php echo  "Dias em atraso: " ?></div>
    </div></td>
    <td><div align="left" class="style35">
      <div align="left"><strong><?php echo  $final_resul4; ?></strong></div>
    </div></td>
  </tr>
  <tr>
    <td><div align="left" class="style20">
      <div align="left"><?php echo  "Data do adiantamento: " ?></div>
    </div></td>
    <td><div align="left" class="style35">
      <div align="left"><strong><?php echo  $final_resul6; ?></strong></div>
    </div></td>
  </tr>
  
  <script>
	$(function() {
		$( "#datepicker" ).datepicker({
			altField: "#alternate",
			altFormat: "dd 'de' MM 'de' yy"
		});
	});
	</script>
</table>
<form id="form1" name="form1" method="post" action="atualiza.php">
  <div align="center"><span class="style28">Data do envio da Carta:</span>
       <input type="text" id="datepicker" value="<?php echo date("d/m/Y"); ?>" name="data" size="10" class="h1" >
  </div>
  <label for="inclui"></label>
  <label for="atua_carta"></label>
  <div align="center">
    <select name="atua_carta" id="atua_carta">
      <option value="C2" selected="selected">C2</option>
      <option value="nej">NEJ</option>
    </select>
    <input name="inclui" type="submit" id="inclui" value="ATUALIZAR" />
  </div>
</form>
      
      
      </p>
  </div>
</div>

<?php }?>

<?php $_SESSION['conta'] = $final_resul;
	  $_SESSION['nome'] = $final_resul2;		
      $_SESSION['adto'] = $final_resul3;  
      $_SESSION['dias_ad'] = $final_resul4;
  	  $_SESSION['data_ad'] = $final_resul6;
  ?>
</body>
</html>
