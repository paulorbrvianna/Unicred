<?
ob_start();
session_start();
if(empty($_SESSION['usuarioCobranca'])){ 
    header("Location: login.php");  	
	$faltalogar = "faltalogar";
	$_SESSION['faltalogar'] = $faltalogar;
  }elseif($_SESSION['erro4'] == "erro4"){
  echo "<script>alert ('ATENÇÃO O PRIMEIRO VALOR DEVE SER INFERIOR AO SEGUNDO')</script>";
$_SESSION['erro4'] = '';
}elseif($_SESSION['erro3'] == "erro3"){
echo "<script>alert ('FAVOR PREENCHER TODOS OS CAMPOS')</script>";
$_SESSION['erro3'] = '';

}
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
function numeros(ie, ff) {
    if (ie) {
        tecla = ie;
    } else {
        tecla = ff;
    }
 
    /**
    * 13 = [ENTER]
    * 8  = [BackSpace]
    * 9  = [TAB]
    * 46 = [Delete]
    * 48 a 57 = São os números
    */
    if ((tecla >= 48 && tecla <= 57) || (tecla == 8) || (tecla == 13) || (tecla == 9) || (tecla == 46)) {
        return true;
    }
    else {
        return false;
    }
}
</script>


<style type="text/css">
<!--
.style7 {color: #999999}
.style9 {font-size: 14px}
-->
</style>
<head>
	<link rel="stylesheet" href="../../jquery/development-bundle/themes/base/jquery.ui.all.css">
	<script src="../../jquery/development-bundle/jquery-1.7.1.js"></script>
	<script src="../../jquery/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../../jquery/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../../jquery/development-bundle/ui/jquery.ui.mouse.js"></script>
	<script src="../../jquery/development-bundle/ui/jquery.ui.draggable.js"></script>
	<script src="../../jquery/development-bundle/ui/jquery.ui.droppable.js"></script>
	<script src="../../jquery/development-bundle/ui/jquery.ui.sortable.js"></script>
	<script src="../../jquery/development-bundle/ui/jquery.ui.accordion.js"></script>
<script src="../../jquery/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script src="../../jquery/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
<link rel="stylesheet" href="../../jquery/development-bundle/demos/demos.css">
	<style>
	h1 {
	padding: 0.2em;
	margin: 0;
	font-size: 16px;
}
	#products { float:left; width: 980px;margin-right: 2em; }
    .style6 {font-size: 15px}
    .style8 {color: #666666}
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
</head>
<body>


	
<div id="products">
	<h1 class="ui-widget-header style9">Relatórios Cartão</h1>	
<div id="catalog">
		<h3> <a href="#" class="style6">Relatório de Cartões em Atraso</a> </h3>
		<div>
        <th width="982" scope="col"><div align="center" class="style1 style8" id="demo-config"> Deseja emitir Relatório de Cartoes Atrasados?</div></th>
		  <ul class="style7">
			<form id="form1" name="form1" method="post" action="relatorio_cartao.php">
            <label for="EMITIR"></label>

              <div align="center">
                <label for="dia1">Quantidade de dias</label>
                <input type="text" name="dia1" id="dia1" size="4" onkeypress="return numeros(event.keyCode, event.which);" maxlength="4" />
 
                 até 
                 <label for="dia2"></label><input type="text" name="dia2" id="dia2" size="4" onkeypress="return numeros(event.keyCode, event.which);" maxlength="4" />
 <p>
								Agencia: <select id="agencia" name="agencia">

									<option value="9999">Unicred Natal</option>
									<option value="PF">Gerentes PF</option>
									<option value="PJ">Gerentes PJ</option>


								</select>
							</p>
  							<p>
								Gerente: <select id="gerente2207" name="gerente2207">
									<option value="9999">TODOS OS GERENTES</option>

								</select> <select id="gerentePF" name="gerentePF">
									<option value="8888">TODOS OS GERENTES</option>
									<option value="308">AKZA PRISCYLLA FARIAS DA SILVA</option>


									<option value="329">COOPERADO DEMITIDOS UNICRED NATAL</option>
									<option value="284">DANIELLE SARAIVA DE MACEDO</option>
									<option value="349">EVELYNE NORONHA VILAR DE SOUZA</option>
									<option value="333">GERENTE A DEFINIR 2 NATAL</option>
									<option value="348">GERENTE A DEFINIR 4 NATAL</option>
									<option value="4">JERLANE KARLA XAVIER ARAUJO</option>

									<option value="42">LUIZ FRANCISCO DE BARROS MOURA</option>
									<option value="128">MERCIO HENRIQUE T DA SILVA</option>
									<option value="377">PATRICIA PORPINO DA SILVA</option>
									<option value="282">RENATA CHRISTINE DA MATA S ALBUQUE</option>
									<option value="350">ROSELY REGINA M MOURA ANDRADE</option>

									<option value="16001">UNICRED NATAL</option>
								</select> <select id="gerentePJ" name="gerentePJ">
									<option value="7777">TODOS OS GERENTES</option>
									<option value="368">ANA CAROLINA PESSOA SOARES PENAFORTE</option>
									<option value="122">CARMELO PENA FRAGA</option>
									<option value="127">JULIANNE LUCENA RIBEIRO</option>
									<option value="368">ROSEMBERG SOUZA DE ARAUJO</option>

								</select>


							</p>
       </p>   
                 
                 <p>
                   <input type="submit" name="EMITIR" id="EMITIR" value="EMITIR" size="15" />
                    </p>
              </div>
			</form>                          
	    </ul>
</div>
    <!--    <h3> <a href="#" class="style6">Relatório de Incluidos</a> </h3>
		<div>
        <th width="982" scope="col"><div align="center" class="style1 style8" id="demo-config"> Deseja emitir Relatório de Incluidos?</div></th>
		  <ul class="style7">
			<form id="form1" name="form1" method="post" action="relatorio_cartao.php">
            <label for="EMITIR"></label>

              <div align="center">
                <input type="submit" name="EMITIR" id="EMITIR" value="EMITIR" size="15" />
              </div>
			</form>                          
	    </ul>
		</div>
		<h3> <a href="#" class="style6">Relatório para Inclusão</a></h3>
		<div>
        <th width="982" scope="col"><div align="center" class="style1 style8"> Deseja emitir Relatório para Inclusão?</div></th>
		  <ul class="style7">
		  <form id="form1" name="form1" method="post" target="mainFrame" action="relatorio_dia_cartao.php">
  <label for="diacard"></label>
  <label for="enviar"></label>
        <div align="center"><span class="style2">Tipo de carta:</span>      
          <select name="diacard" id="diacard" >
            <option value="C1">C1</option>
            <option value="C2">C2</option>
           
          </select>
          
          
          <input type="submit" name="enviar" id="enviar" value="EMITIR" />
        </div>
			</form>
     		
</ul>
		</div>
		<h3> <a href="#" class="style6">Relatório Exclusão</a></h3>
		<div>
        <th width="982" scope="col"><div align="center" class="style1 style8"> Deseja emitir Relatório Exclusão?</div></th>
<form id="form1" name="form1" method="post" action="rel_exclusao.php">
            <label for="EMITIR"></label>

    <div align="center">
      <input type="submit" name="EMITIR" id="EMITIR" value="EMITIR" size="15" />
    </div>
</form>               


 </div>
 	<h3> <a href="#" class="style6">Relatório de Atualização</a></h3>
		<div>
        <th width="982" scope="col"><div align="center" class="style1 style8"> Deseja emitir Relatório Atualização?</div></th>
<form id="form1" name="form1" method="post" action="rel_atualiza.php">
            <label for="EMITIR"></label>

    <div align="center">
      <input type="submit" name="EMITIR" id="EMITIR" value="EMITIR" size="15" />
    </div>
</form>                   

-->
 </div>
<script>
$("select").change(function () {
    var str = "";
    $( "select option:selected").each(function() {
      str += $( this ).val() + " ";
    });

	if($("#agencia").val() == "9999")
	{
	$("#gerentePF").hide();	
	$("#gerentePJ").hide();
	$("#gerente2207").show();
	}

	if($("#agencia").val() == "PF")
	{
		$("#gerentePF").show();	
		$("#gerentePJ").hide();
		$("#gerente2207").hide();
		}

	if($("#agencia").val() == "PJ")	
	{	$("#gerentePF").hide();	
		$("#gerentePJ").show();
		$("#gerente2207").hide();
		}
    
  }).change();
</script>
</body>
</html>
