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
$contrato = $_POST['incluir_conta'];

include('connect.php');

$query = mysql_query("SELECT * FROM posicaocontabil WHERE contrato LIKE '$contrato'");
$resul = mysql_fetch_array($query, MYSQL_ASSOC);
 $conta2 = $resul['contrato'];

$soma = mysql_query("SELECT SUM(Valor_a_Cobrar) FROM posicaodeliquidacao WHERE nr_titulo = '$conta2'");
$resultado = mysql_fetch_assoc($soma);

$gerente = mysql_query("SELECT * FROM cad_completo WHERE conta = '$conta2'");
$gerenteCompleto = mysql_fetch_assoc($gerente);




 
 
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
      <div align="left"><?php echo  "Contrato: "; ?></div>
    </div></th>
    <th width="443" class="style20" scope="col"><div align="left" class="style28">
      <div align="left"><?php echo  $resul['contrato']; ?></div>
    </div></th>
    <th width="18" class="style20" scope="col">&nbsp;</th>
    <th width="81" class="style20" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28">
      <div align="left"><?php echo  "Nome: "; ?></div>
    </div></td>
    <td class="style20"><div align="left" class="style28">
      <div align="left"><?php echo  utf8_encode($resul['nome']); ?></div>
    </div></td>
    <td class="style20">&nbsp;</td>
    <td class="style20">&nbsp;</td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Valor: "; ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  number_format($resultado['SUM(Valor_a_Cobrar)'], 2, ",", "."); ?></div></td>
    <td class="style20">&nbsp;</td>
    <td class="style20">&nbsp;</td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Dias em atraso: "; ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $resul['diasematraso']; ?></div></td>
    <td class="style20">&nbsp;</td>
    <td class="style20">&nbsp;</td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Data do Atraso: " ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $resul['dataemaberto']; ?></div></td>
    <td class="style20">&nbsp;</td>
    <td class="style20">&nbsp;</td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Gerente: " ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  utf8_encode( $gerenteCompleto['gerente']); ?></div></td>
    <td class="style20">&nbsp;</td>
    <td class="style20">&nbsp;</td>
  </tr>
</table>
</p>
  <form id="form1" name="form1" method="post" action="atualizar_valor_emp.php">
    <label for="atualiza_valor"></label>
    <input type="submit" name="atualiza_valor" id="atualiza_valor" value="Atualizar Valor" />
  </form>
  </div>
</div>

<?php
	  $_SESSION['contratoatualiza'] = $contrato;
	  $_SESSION['nomeatualizaemp'] = $resul['nome'];		
      $_SESSION['valoratualizaemp'] =  $resultado['SUM(Valor_a_Cobrar)'];  
      $_SESSION['DiasEmAtrasoatualiza'] = $resul['diasematraso'];
      $_SESSION['Nome Gerenteatualiza'] =  $gerenteCompleto['gerente'];
	  $_SESSION['DataEmAbertoatualiza'] = $resul['dataemaberto'];
  ?>
</body>
</html>
