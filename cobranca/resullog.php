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
<title>Resultado LOG</title>
</head>

<body>
<?php
$data = $_POST['data'];
list($dia1,$mes1,$ano1) = split("[/.-]",$data);
$datainicio = $ano1.'-'.$mes1.'-'.$dia1;
$data2 = $_POST['data2'];
list($dia2,$mes2,$ano2) = split("[/.-]",$data2);
$datafim = $ano2.'-'.$mes2.'-'.$dia2;
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
	.style1{ font-size:10px;}	
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
	<h1 class="ui-widget-header">Resultado LOG <?php echo "de ".$data." até ".$data2;  ?> </h1>
	<h2 class="ui-widget-header style1"><table width="970" border="0">
  <tr>
    <th width="70" scope="col"> DATA REGISTRO</th>
    <th width="60" scope="col">USUARIO</th>
    <th width="50" scope="col">TIPO ALTERAÇÃO</th>
    <th width="30" scope="col">MODULO</th>
     <th width="30" scope="col"> TIPO CARTA</th>
     <th width="70" scope="col"> DATA CARTA</th>
     <th width="80" scope="col">CC/CONTRATO</th>
     <th width="300" scope="col">NOME</th>
     <th width="80" scope="col">DIAS ATRASO</th>
     <th width="100" scope="col">DATA ATRASO</th>
     <th width="100" scope="col">VLR ATRASO</th> 
  </tr>
</table> </h2>




  <?php
  include('connect.php');
$selec2 = mysql_query ("SELECT * FROM registros_cobranca WHERE (data_registro BETWEEN '$datainicio' AND '$datafim')"); 
$num_linhas2 = mysql_num_rows($selec2);
for($x=0;$x<$num_linhas2;$x++){ $resul2 = mysql_fetch_array($selec2,MYSQL_ASSOC);


?>

<table width="970" border="0" class="style1">
  <tr>
    <th width="70" scope="col"> <?php echo $resul2['data_registro']; ?></th>
    <th width="60" scope="col"><?php echo $resul2['usuario']; ?></th>
    <th width="50" scope="col"><?php echo $resul2['tipo_alt']; ?></th>
    <th width="30" scope="col"><?php echo $resul2['modulo']; ?></th>
     <th width="30" scope="col"><?php echo $resul2['tipo_carta']; ?></th>
     <th width="70" scope="col"><?php echo $resul2['data_carta']; ?></th>
     <th width="80" scope="col"><?php echo $resul2['CC_Contrato']; ?></th>
     <th width="330" scope="col"><?php echo $resul2['nome']; ?></th>
     <th width="80" scope="col"><?php echo $resul2['DiasEmAtraso']; ?></th>
     <th width="100" scope="col"><?php echo $resul2['DataAtraso']; ?></th>
     <th width="100" scope="col" align="right"><?php echo $resul2['Vlr_Atraso']; ?></th> 
  </tr>
</table>

<?php
}
?>
</body>
</html>
