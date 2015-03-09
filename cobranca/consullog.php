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
.style1 {
	color: #FFFFFF;
	font-size: 16px;
}
.style4 {
	color: #000000;
	font-size: 16px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style5 {
	font-size: 18px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style6 {color: #000000}
-->
</style>
</head>
<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>

<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>

<body>
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
    <script src="../jquery/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script src="../jquery/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
	
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
		$( "#datepicker" ).datepicker({
			altField: "#alternate",
			altFormat: "dd 'de' MM 'de' yy"
		});
	});
	</script>
    		<script>
	$(function() {
		
		$( "#datepicker2" ).datepicker({
			altField: "#alternate",
			altFormat: "dd/MM/yy"
		});
	});
	
	</script>
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
	<h1 class="ui-widget-header">Consultar LOG</h1>
	<div class="ui-widget-content">
	  <p align="center" class="style1 style2 style4 style5"><form action="resullog.php" method="post" name="form1" target="mainFrame" class="style4" id="form1">
  <label for="incluir_conta"></label>
  <span class="style6">Data :</span> 
  <input type="text" name="data" id="datepicker" size="10" maxlength="10" value="<?php echo date("d/m/Y") ?>" />
  <label for="incluir">até </label>
  <label for="data2"></label>
  <input type="text" name="data2" id="datepicker2" size="10" maxlength="10" value="<?php echo date("d/m/Y") ?>" />
      <input type="submit" name="incluir" id="incluir" value="Pesquisar" />
    </p>
	  </form></td>
  </tr>
</table>


</body>
</html>

