<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="../jquery/development-bundle/themes/base/jquery.ui.all.css">
	<script src="../jquery/development-bundle/jquery-1.7.1.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.core.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.blind.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.bounce.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.clip.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.drop.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.explode.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.fade.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.fold.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.highlight.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.pulsate.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.scale.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.shake.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.slide.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.effects.transfer.js"></script>
	<link rel="stylesheet" href="../jquery/development-bundle/demos.css">
    
<script type="text/javascript">
function altimagem(){
document.getElementById("imagem1").src = "contacorrente.jpg";
if(document.getElementById("imagem1").src.value = "emprestimo.jpg"){
 document.getElementById("botom1").style.height = "25px";
 document.getElementById("botom2").style.height = "20px";
 }
}
function altimagemtwo(){
 document.getElementById("imagem1").src = "emprestimo.jpg" ;
 
 if(document.getElementById("imagem1").src.value = "emprestimo.jpg"){
 document.getElementById("botom2").style.height = "25px";
 document.getElementById("botom1").style.height = "20px";
 }
}
</script>
<script>
	$(function() {
		// run the currently selected effect
		function runEffect() {
			// get effect type from 
			var selectedEffect = ( "puff" );
			
			// most effect types need no options passed by default
			var options = {};
			// some effects have required parameters
			if ( selectedEffect === "scale" ) {
				options = { percent: 0 };
			} else if ( selectedEffect === "transfer" ) {
				options = { to: "#botom1", className: "ui-effects-transfer" };
			} else if ( selectedEffect === "size" ) {
				options = { to: { width: 200, height: 60 } };
			}

			// run the effect
			$( "#imagem1" ).effect( selectedEffect, options, 500, callback );
		};

		// callback function to bring a hidden box back
		function callback() {
			setTimeout(function() {
				$( "#imagem1" ).removeAttr( "style" ).hide().fadeIn("contacorrente.jpg");
			}, 0 );
		};

		// set effect from select menu value
		$( "#botom1" ).click(function() {
			runEffect();
			return false;
		});
	});
	$(function() {
		// run the currently selected effect
		function runEffect2() {
			// get effect type from 
			var selectedEffect2 = ( "puff" );
			
			// most effect types need no options passed by default
			var options = {};
			// some effects have required parameters
			if ( selectedEffect2 === "scale" ) {
				options = { percent: 0 };
			} else if ( selectedEffect2 === "transfer" ) {
				options = { to: "#botom1", className: "ui-effects-transfer" };
			} else if ( selectedEffect2 === "size" ) {
				options = { to: { width: 200, height: 60 } };
			}

			// run the effect
			$( "#imagem1" ).effect( selectedEffect2, options, 500, callback2 );
		};

		// callback function to bring a hidden box back
		function callback2() {
			setTimeout(function() {
				$( "#imagem1" ).removeAttr( "style" ).hide().fadeIn("emprestimo.jpg");
			}, 0 );
		};

		// set effect from select menu value
		$( "#botom2" ).click(function() {
			runEffect2();
			return false;
		});
	});
</script>
	<style>

#fundo{ width:300px; height:350px; margin-left:20%; margin-top:10%; border:#FFFFFF }
#center{ width: 300px; height:320px; background:#FFFFFF; margin-top:0%; margin-left:0%; }
#botom1{ width: 15px; height:20px;  margin-top:23%; margin-left:80%; border:#666666;text-align:center; font-size:10px;}
#botom2{ width: 15px; height:20px;  margin-top:-8.9%; margin-left:90%; border:#666666; text-align:center; font-size:10px;}
#imagem1{ width: 200px; height:200px; background:#FFFFFF;  margin-top:20%; margin-left:20%; }
</style>
		

</head>

<body>


<div id="fundo" class="ui-widget-header">
<div id="center">
<div id="imagemdiv" class="imagem" >
<img name="imagem2" id="imagem1" src="emprestimo.jpg" />
</div>

</div>

<div id="botom1"  class="ui-widget-header" onclick="altimagem()"  >
<a href="#">1</a>


</div>
<div id="botom2" class="ui-widget-header" onclick="altimagemtwo()" >
<a href="#">2</a>

</div>

</body>
</html>
