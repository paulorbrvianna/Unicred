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
	color: #FFFFFF;
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
<script language="javascript" type="text/javascript"> 

proximoCampo = "incluir_conta" 


nomeForm = "form1" 


function TeclaPressionada( e ) { 

if ( window.event != null)     //IE4+ 
tecla = window.event.keyCode; 
else if ( e != null )          //N4+ o W3C compatíveis 
tecla = e.which; 
else 
return; 

if (tecla == 13) {             //se pressionou enter 
if ( proximoCampo == 'fin' ) { //fim da sequência, faz o submit 
//alert('Envio do formulário.')  //eliminar este alert para uso normal 
return true                   //sustituir por return true para fazer o submit 
} else {                       //passa o foco para o campo seguinte
eval('document.' + nomeForm + '.' + proximoCampo + '.focus()') 
return false 
} 
} 
} 

document.onkeydown = TeclaPressionada;  //faz com que a função TeclaPressionada seja executada no evento onkeydown
if (document.captureEvents)             //netscape é especial: requer ativação da captura do evento 
document.captureEvents(Event.KEYDOWN) 

</script> 




<script type="text/javascript"> 
function mascara(o,f){
        v_obj=o
        v_fun=f
        setTimeout("execmascara()",1)
}
function execmascara(){
        v_obj.value=v_fun(v_obj.value)
}
function mreais(v){
        v=v.replace(/\D/g,"")                                           //Remove tudo o que não é dígito
        v=v.replace(/(\d{1})$/,"-$1")                   //Coloca a virgula
        return v
}
</script>

<script type="text/javascript"> 
function preencheZeros(param,tamanho)
{
var contador = param.value.length;

if (param.value.length != tamanho)
{
do
{
param.value = "0" + param.value;
contador += 1;

}while (contador <tamanho)
}
}
</script> 






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
	<h1 class="ui-widget-header">Excluir Conta</h1>
	<div class="ui-widget-content">
	  <p align="center" class="style1 style2 style4 style5"><form action="resul_exclusao.php" method="post" name="form1" target="mainFrame" class="style4" id="form1">
  <label for="incluir_conta"></label>
  <span class="style6">Digitar conta:</span> 
  <input type="text" name="incluir_conta" id="incluir_conta" onkeypress="mascara(this,mreais)" onblur="preencheZeros(incluir_conta,7)" size="20" maxlength="7" onfocus="proximoCampo ='incluir'"  />
  <label for="incluir"></label>
  <input type="submit" name="incluir" id="incluir" value="Pesquisar" onfocus="proximoCampo ='fin'" />
</form></td>
  </tr>
</table>



  


</body>
</html>
