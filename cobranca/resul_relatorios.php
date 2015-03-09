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
<title>Resultado Relatorios</title>
</head>

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
	<link rel="stylesheet" href="../jquery/development-bundle/demos/demos.css">
	<style>
	h1 { padding: .2em; margin: 0; }
	#titi { float:left; width: 900px; margin-right: 2em; }
	#titi {
	width: 980px;
	float: left;
}
	.style1{font:Arial, Helvetica, sans-serif, bold; font-size:14px; text-align:left}
	#titi ol { margin: 0; padding: 1em 0 1em 3em; }
	tr:hover{background-color:#CCCCCC}
	a:visited{color:#0000CC}
	a:ative{color:#000000}
	a:hover{color:#000000}
	
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
   
    <?php
	include('connect.php');
$data = $_POST['relatorios'];
$usuario = $_SESSION['usuarioCobranca'];

$selec2 = mysql_query ("SELECT * FROM relatorios_cobranca WHERE data = '$data' AND usuario= '$usuario' AND modulo = 'AD' ORDER BY hora DESC ");
$num_linhas = mysql_num_rows($selec2);
 
	
	 ?>
    <div id="titi">
	<h1 class="ui-widget-header">Relatórios</h1>
    <h2 class="ui-widget-header"><table width="900" border="0" class="style1">
  <tr>
    <th width="623" scope="col">Nome</th>
    <th width="156" scope="col">Data Solitação</th>
    <th width="107" scope="col">Situação</th>
  </tr></h2>
</table>
</h1>
	<div class="style1">
    <h5 class="ui-widget-header"><table width="900" border="0" class="style1">Relatórios AD</table></h5>
<?php
if($num_linhas == 0){
echo "Nenhum relatório foi emitido";
}else{
for($i=0;$i<$num_linhas;$i++) { $resul = mysql_fetch_assoc($selec2);

$parte1 = '/cobranca/relatorios/';
$parte2 = $resul['tipo_rel'].'_'.$resul['tipo_carta'].'_'.$resul['usuario'].'_'.$resul['data_emissao'].'_'.$resul['hora'].'.pdf';
$resultado = $parte1.$parte2;

?>



	  <table width="900"    border="0">
        
       <tr>
          <th width="625" height="39" class="style1" scope="col" ><?php  echo  "<a href=".$resultado." target="._blank." > ".$parte2."  </a> <br />" ?></th>
          <th width="155" class="style1" scope="col"><?php echo $resul['data']; ?></th>
          <th width="106" class="style1" scope="col">Concluido</th>
        </tr>
      </table>
      
<?php

}
}

?>
<h5 class="ui-widget-header"><table width="900" border="0" class="style1">Relatórios EMP</table></h5>
<?php
$selec = mysql_query ("SELECT * FROM relatorios_cobranca WHERE data = '$data' AND usuario= '$usuario'  AND modulo = 'EMP' or modulo = 'CartaEMP'  ORDER BY hora DESC ");
$num_linhas2 = mysql_num_rows($selec);
if($num_linhas2 == 0){
echo "Nenhum relatório foi emitido";
}else{
for($x=0;$x<$num_linhas2;$x++) { $resul2 = mysql_fetch_assoc($selec);

$parte3 = '/cobranca/relatorios/';
$parte4 = $resul2['tipo_rel'].'_'.$resul2['tipo_carta'].'_'.$resul2['usuario'].'_'.$resul2['data_emissao'].'_'.$resul2['hora'].'.pdf';
$resultado2 = $parte3.$parte4;

?>



	  <table width="900"    border="0">
        
        <tr>
          <th width="625" height="39" class="style1" scope="col" ><?php  echo  "<a href=".$resultado2." target="._blank." > ".$parte4."  </a> <br />" ?></th>
          <th width="155" class="style1" scope="col"><?php echo $resul2['data']; ?></th>
          <th width="106" class="style1" scope="col">Concluido</th>
        </tr>
      </table>
      
<?php
}
}

?>

<h5 class="ui-widget-header"><table width="900" border="0" class="style1">Relatórios Cartão</table></h5>
<?php
$selec = mysql_query ("SELECT * FROM relatorios_cobranca WHERE data = '$data' AND usuario= '$usuario'  AND modulo = 'CARD'  ORDER BY hora DESC ");
$num_linhas2 = mysql_num_rows($selec);
if($num_linhas2 == 0){
echo "Nenhum relatório foi emitido";
}else{
for($x=0;$x<$num_linhas2;$x++) { $resul2 = mysql_fetch_assoc($selec);

$parte3 = '/cobranca/relatorios/';
$parte4 = $resul2['tipo_rel'].'_'.$resul2['tipo_carta'].'_'.$resul2['usuario'].'_'.$resul2['data_emissao'].'_'.$resul2['hora'].'.pdf';
$resultado2 = $parte3.$parte4;

?>



	  <table width="900"    border="0">
        
        <tr>
          <th width="625" height="39" class="style1" scope="col" ><?php  echo  "<a href=".$resultado2." target="._blank." > ".$parte4."  </a> <br />" ?></th>
          <th width="155" class="style1" scope="col"><?php echo $resul2['data']; ?></th>
          <th width="106" class="style1" scope="col">Concluido</th>
        </tr>
      </table>
      
<?php
}
}

?>


</body>
</html>
