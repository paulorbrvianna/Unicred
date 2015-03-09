<?php 
session_start();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bem Vindo</title>
</head>

<body>
<?php
include('connect.php');

$query = mysql_query("SELECT  `database` FROM  `posicaocontabil` WHERE 1 LIMIT 0 , 1");
$resul = mysql_fetch_assoc($query);
?>

	
	
	<script type="text/javascriptsrc=" src="../jquery/development-bundle/jquery-1.7.1.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.mouse.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.draggable.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.droppable.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.sortable.js"></script>
	
	<style>
	h1 { padding: .2em; margin: 0; }
	#titi { float:left; width: 100%; margin-right: 2em;  text-align:right }
	#titi {
	width: 100%;
	float: left;
}
	
	#titi ol { margin: 0; padding: 1em 0 1em 3em; }
	</style>
	<script type="text/javascriptsrc=">
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
    	
        <?php $database = $resul['database']; ?>
	<h3 class="ui-widget-header"><?php echo "Bem Vindo: ".$_SESSION['usuarioCobranca']; ?></h3>
	
</div>
<?
echo "<script>";
echo "alert('Data de Atualização: .$database')";
echo "</script>";
?>





</body>
</html>
