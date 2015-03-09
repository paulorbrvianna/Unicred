<?php
ob_start();
session_start();
if(empty($_SESSION['usuarioCobranca'])){ 
    header("Location: login.php");  	
	$faltalogar = "faltalogar";
	$_SESSION['faltalogar'] = $faltalogar;
  }
  ?>
<?php include('extenso.php');

$contrato = $_POST['incluir_contrato'];
include('connect.php');

$query = mysql_query("SELECT * FROM rel_carta_cob_emp WHERE cont LIKE '$contrato'");

$resul = mysql_fetch_array($query, MYSQL_ASSOC);

$query2 = mysql_query("SELECT * FROM posicaocontabil WHERE contrato LIKE '$contrato'");
$soma = mysql_query("SELECT SUM(Valor_a_Cobrar) FROM posicaodeliquidacao WHERE nr_titulo = '$contrato'");
$resultado = mysql_fetch_assoc($soma);
$resul2 = mysql_fetch_array($query2, MYSQL_ASSOC);
$c2 = $resul['C2'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style>

</style>



<style type="text/css">
<!--
.style8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 16px; color: #FFFFFF; }
.style19 {color: #000000}
.style20 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 16px; color: #000000; text-align: left; }
.style27 {font-size: 14px}
.style28 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 14px; color: #000000;text-align: left }
.style29 {font-family: Verdana, Arial, Helvetica, sans-serif; text-align: left}
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


$gerente = mysql_query("SELECT * FROM cad_completo WHERE conta = '$conta2'");
$gerenteCompleto = mysql_fetch_assoc($gerente);
if ($resul == '' and $resul2 ==''){
echo "<script>alert ('CONTRATO NÃO EXISTE')</script>";
header('Location:/cobranca/consul_inclusao_emp.php');
exit;
}
if($resul == ''){
$final_resul0 = $resul2['cc'];
$final_resul1 = $resul2['nome'];
$final_resul2 = $resul2['contrato'];
$final_resul3 = $resul2['modalidade'];
$final_resul4 = $resul2['dt_liber'];
$final_resul5 = $resul2['dt_prim_ven'];
$final_resul6 = $resul2['dt_ult_ven'];
$final_resul7 = $resul2['vlr_liberado'];
$final_resul8 = $resul2['qtde_parc'];
$final_resul9 = $resul2['vlr_parcela'];
$final_resul10 = $resul2['sld_dev_ctbil'];
$final_resul11 = $resul2['qtde_parc_rest'];
$final_resul12 = $resul2['sld_devedor'];
$final_resul13 = $resultado['SUM(Valor_a_Cobrar)'];
$final_resul14 = $resul2['dataemaberto'];
$final_resul15 = $resul2['diasematraso'];
$resultado['SUM(Valor_a_Cobrar)'];
$gerente = mysql_query("SELECT * FROM cad_completo WHERE conta = '$final_resul0'");
$gerenteCompleto = mysql_fetch_assoc($gerente);
$final_resul16 = $gerenteCompleto['gerente'];
$valor = $resultado['SUM(Valor_a_Cobrar)'];
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
      <div align="left"><?php echo  $final_resul0; ?></div>
    </div></th>
  </tr>
  <tr>
    <th width="255" class="style20" scope="col"><div align="left" class="style20 style19 style27">
      <div align="left"><?php echo  "Modalidade: "; ?></div>
    </div></th>
    <th width="464" class="style20" scope="col"><div align="left" class="style28">
      <div align="left"><?php echo  $final_resul3; ?></div>
    </div></th>
  </tr>
  <tr>
    <th width="255" class="style20" scope="col"><div align="left" class="style20 style19 style27">
      <div align="left"><?php echo  "Contrato: "; ?></div>
    </div></th>
    <th width="464" class="style20" scope="col"><div align="left" class="style28">
      <div align="left"><?php echo  $final_resul2; ?></div>
    </div></th>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28">
      <div align="left"><?php echo  "Nome: "; ?></div>
    </div></td>
    <td class="style20"><div align="left" class="style28">
      <div align="left"><?php echo  utf8_encode($final_resul1); ?></div>
    </div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Valor Atrasado: "; ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $valor; ?></div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Dias em Atraso: "; ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $final_resul15; ?></div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Data do Atraso: " ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $final_resul14; ?></div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Gerente: " ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  utf8_encode($final_resul16); ?></div></td>
    		<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			altField: "#alternate",
			altFormat: "dd 'de' MM 'de' yy"
		});
	});
	</script>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="Inclui_emp.php">
  <label for="inclui"></label>
  <strong class="style28">Data de Inclus&atilde;o da C1:</strong> 
  <input type="text" id="datepicker" name="data" size="10" class="h1" value="<?php echo date("d/m/Y") ?>" >

  <input name="inclui" type="submit" id="inclui" value="INCLUIR" />
</form></p>
  </div>
</div>
<?php }?> 



 <?php
if($resul != ''){
 
$final_resul0 = $resul['CC'];
$final_resul1 = $resul['nome'];
$final_resul2 = $resul['cont'];
$final_resul3 = $resul['modalidade'];
$final_resul4 = $resul['Dt_Liber'];
$final_resul5 = $resul['Dt_Prim_Ven'];
$final_resul6 = $resul['Dt_Ult_Ven'];
$final_resul7 = $resul['Vlr_Liberado'];
$final_resul8 = $resul['Qtde_Parc'];
$final_resul9 = $resul['Vlr_Parcela'];
$final_resul10 = $resul['Sld Dev Ctbi'];
$final_resul11 = $resul['Qtde Parc Rest'];
$final_resul12 = $resul['Sld Devedor'];
$final_resul13 = $resul['Sld_em_Atraso2'];
$final_resul14 = $resul['DataEmAberto'];
$final_resul15 = $resul['DiasEmAtraso'];

$gerente = mysql_query("SELECT * FROM cad_completo WHERE conta = '$final_resul0'");
$gerenteCompleto = mysql_fetch_assoc($gerente);
$final_resul16 = $gerenteCompleto['gerente'];
$valor = $resul['Sld_em_Atraso2'];
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
	  <p  class="style1 style2 style4 style5">
           <table width="729" border="0">
  <tr>
    <th width="255" class="style20" scope="col"><div align="left" class="style20 style19 style27">
      <div align="left"><?php echo  "Conta: "; ?></div>
    </div></th>
    <th width="464" class="style20" scope="col"><div align="left" class="style28">
      <div align="left"><?php echo  $final_resul0; ?></div>
    </div></th>
  </tr>
  <tr>
    <th width="255" class="style20" scope="col"><div align="left" class="style20 style19 style27">
      <div align="left"><?php echo  "Modalidade: "; ?></div>
    </div></th>
    <th width="464" class="style20" scope="col"><div align="left" class="style28">
      <div align="left"><?php echo  $final_resul3; ?></div>
    </div></th>
  </tr>
  <tr>
    <th width="255" class="style20" scope="col"><div align="left" class="style20 style19 style27">
      <div align="left"><?php echo  "Contrato: "; ?></div>
    </div></th>
    <th width="464" class="style20" scope="col"><div align="left" class="style28">
      <div align="left"><?php echo  $final_resul2; ?></div>
    </div></th>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28">
      <div align="left"><?php echo  "Nome: "; ?></div>
    </div></td>
    <td class="style20"><div align="left" class="style28">
      <div align="left"><?php echo  utf8_encode($final_resul1); ?></div>
    </div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Valor Atrasado: "; ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $valor; ?></div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Dias em Atraso: "; ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $final_resul15; ?></div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Data do Atraso: " ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $final_resul14; ?></div></td>
  </tr>
  <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Gerente: " ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  utf8_encode($final_resul16); ?></div></td>
      </tr>
       <tr>
    <td class="style20"><div align="left" class="style28"><?php echo  "Data C1: " ?></div></td>
    <td class="style20"><div align="left" class="style28"><?php echo  $resul['C1']; ?></div></td>
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
<form id="form1" name="form1" method="post" action="atualiza_emp.php">
  <div ><span class="style28">Data do envio da Carta:</span>
       <input type="text" id="datepicker" name="data" size="10" class="h1" value="<?php echo date("d/m/Y") ?>" >
  </div>
  <label for="inclui"></label>
  <label for="atua_carta"></label>
  <div >
    <select id="tipocarta" name="atua_carta" id="atua_carta">

      <option id="c2" value="C2" selected="selected">C2</option>
	
      <option id="nej" value="nej">NEJ</option>
    </select>
    
    <input name="inclui" type="submit" id="inclui" value="ATUALIZAR" />
    
  
  </div>
</form>
      
     
      </p>
  </div>
</div>

<?php }?>

<?php 
$_SESSION['CC'] = $final_resul0; 
$_SESSION['nome'] = $final_resul1;
$_SESSION['contrato'] = $final_resul2;
$_SESSION['modalidade'] = $final_resul3;
$_SESSION['Dt_Liber'] = $final_resul4;
$_SESSION['Dt_Prim_Ven'] = $final_resul5;
$_SESSION['Dt_Ult_Ven'] = $final_resul6;
$_SESSION['Vlr_Liberado'] = $final_resul7;
$_SESSION['Qtde_Parc'] = $final_resul8;
$_SESSION['Vlr_Parcela'] = $final_resul9;
$_SESSION['Sld Dev Ctbi'] = $final_resul10;
$_SESSION['Qtde Parc Rest'] = $final_resul11;
$_SESSION['Sld Devedor'] = $final_resul12;
$_SESSION['Sld_em_Atraso'] = $final_resul13;
$_SESSION['DataEmAberto'] = $final_resul14;
$_SESSION['DiasEmAtraso'] = $final_resul15;
$_SESSION['Nome Gerente'] = $final_resul16;

  ?>
</body>

</html>
