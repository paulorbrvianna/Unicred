
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<head>
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
</head>
<body>

<div class="demo">
	
<div id="products">
	<h1 class="ui-widget-header">Relatórios</h1>	
<div id="catalog">
		<h3> <a href="#" class="style6">Emissão de Carta</a></h3>
		<div>
			<ul>
			<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			altField: "#alternate",
			altFormat: "dd 'de' MM 'de' yy"
		});
	});
	</script>
            	<form id="form1" name="form1" method="post" target="mainFrame" action="carta_ad.php">
        <h1>
          <label for="diaad"></label>
                <label for="enviar"></label>
        </h1>
        <div align="right">
          <h1 align="center"><span class="style5">Data da Carta:</span> 
            <input type="text" id="datepicker" name="data" size="10" class="h1" value="<?php echo date("d/m/Y"); ?>"   >
                        
            <span class="style2"></span></h1>
          <h1 align="center"><span class="style5">Tipo de carta:</span>      
            <select name="diaad" id="diaad" >
              <option value="C1">C1</option>
              <option value="C2">C2</option>
            </select>
            
            
            <input type="submit" name="enviar" id="enviar" value="EMITIR" />
          </h1>
        </div>
        </form>         
	    </ul>
		</div>
		<h3><a href="#">Emissão de Envelopes AD</a></h3>
		<div>
			<ul>
				       	<form id="form1" name="form1" method="post" target="mainFrame" action="envelope_carta_ad.php">
        <h1>
          <label for="diaad"></label>
                <label for="enviar"></label>
        </h1>
        <div align="right">
          <h1 align="center">&nbsp;</h1>
          <h1 align="center"><span class="style5">Tipo de carta:</span>      
            <select name="diaadenv" id="diaadenv" >
              <option value="C1">C1</option>
              
            </select>
            
            
            <input type="submit" name="enviar" id="enviar" value="EMITIR" />
          </h1>
        </div>
        </form>   
			</ul>
  </div>
		


		<h3><a href="#">Envia SMS AD</a></h3>
		<div>
			<ul>
				       	<form id="form1" name="form1" method="post" target="mainFrame" action="selec_sms_ad.php">
        <h1>
          <label for="diaad"></label>
                <label for="enviar"></label>
        </h1>
        <div align="right">
          <h1 align="center">&nbsp;</h1>
          <h1 align="center"><span class="style5">Enviar SMS </span>      
            <select name="diaadsms" id="diaadsms" >
              <option value="C1">C1</option>
              
            </select>
            
            
            <input type="submit" name="enviar" id="enviar" value="EMITIR" />
          </h1>
        </div>
        </form>   
			</ul>
  </div>
		
</div>
</div>








</body>
</html>
