<?
ob_start();
session_start();
include_once connecta.php;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SISCRED VERSÃO ALPHA</title>

<link rel="stylesheet"
	href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

<style type="text/css">
<!--
.style1 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
	color: #002C1F;
}

.style2 {
	color: #002C1F
}

.style3 {
	font-size: 24px;
	font-weight: bold;
}

.style4 {
	font-size: 12px;
	font-weight: bold;
	color: #002C1F;
}

.cor {
	
}

body {
	background-color: #FFFFFF;
	background-repeat: no-repeat;
}
-->
</style>

<script language="javascript" type="text/javascript"> 

//nome do primeiro campo da sequência
proximoCampo = "conta" 

//nome do formulário
nomeForm = "formconta" 

//função que gere o evento
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


<script>

	$(function() {
	    $("#calendarioInicial").datepicker({
	    	showOtherMonths: true,
	        selectOtherMonths: true,
	        dateFormat: 'dd/mm/yy',
	        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
	        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
	        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
	    });  
	    $("#calendarioFinal").datepicker({
	    	showOtherMonths: true,
	        selectOtherMonths: true,
	        dateFormat: 'dd/mm/yy',
	        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
	        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
	        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
	    });
	});
	</script>


</head>

<body>
	<div>
		<div>
			<table width="588" align="left" border="0" cellpadding="0"
				cellspacing="0">
			</table>
		</div>
	</div>
	<p>&nbsp;</p>
	<p align="center">
		<img src="imagens/UNICRED_logo.jpg" width="334" height="51" />
	</p>
	<p>&nbsp;</p>
	<p align="center" class="style1">Siscred Versão Alpha</p>
	<p align="center" class="style2">Digite a Conta</p>
	<div align="center">
		<form id="formconta" name="formconta" method="post"
			action="media_doc.php">
			Conta: <input name="conta" type="text" id="conta"
				onkeypress="mascara(this,mreais)" onblur="preencheZeros(conta,7)"
				size="20" maxlength="7" onfocus="proximoCampo ='btlogin'" /><br></br>
			Data Incial:<input name="dataIncial" type="text"
				id="calendarioInicial" /> Data Final:<input name="dataFinal"
				type="text" id="calendarioFinal" />
	
	</div>
	<label for="Submit"></label>
	<div align="center">
		<input name="btlogin" type="submit" value="Gerar Media Docs"
			onfocus="proximoCampo ='fin'">
	
	</div>
	</form>
	<p align="center">
		<a href="../menu/index.php" target="_parent"></a>
	</p>
	<p align="center">&nbsp;</p>
	<p align="center">
		<a href="../menu/index.php" target="_parent"></a>
	</p>
</body>
</html>
