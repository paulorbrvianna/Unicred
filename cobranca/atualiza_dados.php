<?php
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

$query = mysql_query("SELECT * FROM rel_cob_ad WHERE CC LIKE '$conta'");
$resul = mysql_fetch_array($query, MYSQL_ASSOC);
 

$valor = $resul['Adto'];
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
	<h1 class="ui-widget-header">Atualizar</h1>
	<div class="ui-widget-content">
	  <p align="center" class="style1 style2 style4 style5">
	  <div align="left"></div>
	  <table width="725" border="0">
  <tr>
    <th width="165" class="style20" scope="col"><div align="left" class="style20 style19 style27">
      <div align="left"><?php echo  "Conta: "; ?></div>
    </div></th>
    <th width="443" class="style20" scope="col"><div align="left" class="style28">
      <div align="left"><?php echo  $resul['CC']; ?></div>
    </div></th>
    <th width="18" class="style20" scope="col">&nbsp;</th>
    <th width="81" class="style20" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28">
      <div align="left"><?php echo  "Nome: "; ?></div>
    </div></td>
    <td class="style20"><div align="left" class="style28">
      <div align="left"><?php echo  utf8_encode($resul['Nome']); ?></div>
    </div></td>
    <td class="style20">&nbsp;</td>
    <td class="style20">&nbsp;</td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Adiantamento: "; ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  number_format($resul['Adto'], 2, ",", "."); ?></div></td>
    <td class="style20">&nbsp;</td>
    <td class="style20">&nbsp;</td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Dias em atraso: "; ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $resul['Dias_AD']; ?></div></td>
    <td class="style20">&nbsp;</td>
    <td class="style20">&nbsp;</td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Data do adiantamento: " ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $resul['data_ad']; ?></div></td>
    <td class="style20">&nbsp;</td>
    <td class="style20">&nbsp;</td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Gerente: " ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  utf8_encode($resul['gerente1']); ?></div></td>
    <td class="style20">&nbsp;</td>
    <td class="style20">&nbsp;</td>
  </tr>
</table>
</p>
  <form id="form1" name="form1" method="post" action="atualizar_valor.php">
    <label for="atualiza_valor"></label>
    <input type="submit" name="atualiza_valor" id="atualiza_valor" value="Atualizar Valor" />
  </form>
  </div>
</div>

<?php $_SESSION['conta'] = $conta;
	  $_SESSION['nome'] = $resul['Nome'];		
      $_SESSION['adto'] =  $resul['Adto'];  
      $_SESSION['dias_ad'] = $resul['Dias_AD'];
      $_SESSION['gerente'] = $final_resul5;
	  $_SESSION['data_ad'] = $resul['gerente'];
  ?>
</body>
</html>
