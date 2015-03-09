<script type="text/javascript">

        
	$(function() {
	    $("#calendarioInicial").datepicker({
	    	showOtherMonths: true,
	        selectOtherMonths: true,
	        dateFormat: 'dd/mm/yy',
	        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sabado','Domingo'],
	        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab','Dom'],
	        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
	    });  
	    $("#calendarioFinal").datepicker({
	    	showOtherMonths: true,
	        selectOtherMonths: true,
	        dateFormat: 'dd/mm/yy',
	        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sabado','Domingo'],
	        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab','Dom'],
	        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
	    });
	    
	   
	});

	
 </script>




<script type="text/javascript">
$(document).ready( function() {
	

	    $("#form1").validate({
			    rules:{
				    conta:{
					    required: true, minlength: 7,maxlength: 7
					    },
					    dataIncial:{
				    		dateDE:true,
				    		required:true
				    	},
				    	dataFinal:{
				    		dateDE:true,
				    		required:true
				    	}
			    },
			    messages:{
				    conta:{
					    required:"Digite o numero da conta",
					    minlength: "O campo conta deve conter 7 caracteres, preencha com 0 a esquerda" ,
					    maxlength:"O campo conta deve conter 7 caracteres, preencha com 0 a esquerda"
								}
			    }   
		    });
});

</script>

<?php
include_once 'autoloader.php';
$objUtil = new Utilidades();

?>

<ul class="breadcrumbs">
	<li><a href="estrutura.php"><i class="iconfa-home"></i> </a> <span
		class="separator"></span>
	</li>
	<li><a href="?pg=4">Menu Geral Módulo Crédito</a> <span
		class="separator"></span>
	</li>



</ul>

<div class="pageheader">
	<div class="pageicon">
		<span class="iconfa-pencil"></span>
	</div>
	<div class="pagetitle">
		<h5>
		<?php echo $titulo ?>
		</h5>
		<h1>Relatório Sintético</h1>
	</div>
</div>
<!--pageheader-->

<div class="maincontent">
	<div class="maincontentinner">


		<div class="widgetbox box-inverse">
			<h4 class="widgettitle"></h4>
			<div class="widgetcontent wc1">
				<form id="form1" class="stdform" method="post"
					action="sintetico/media_sitentico.php"
					enctype="multipart/form-data">


					<div class="par control-group">
						<label class="control-label" for="firstname">Conta (12345-7)*</label>
						<div class="controls">
							<input type="text" name="conta" id="contaCliente"
								class="input-large" />
						</div>
					</div>

					<div class="par control-group">
						<label class="control-label" for="firstname">Data Incial *</label>
						<div class="controls">
							<input type="text" name="dataInicial" id="calendarioInicial"
								class="date" />
						</div>
					</div>

					<div class="par control-group">
						<label class="control-label" for="firstname">Data Final *</label>
						<div class="controls">
							<input type="text" name="dataFinal" id="calendarioFinal"
								class="date" />
						</div>
					</div>
					<p class="stdformbutton">
						<button class="btn btn-primary" id="submit">Gerar</button>
					</p>
				</form>
			</div>
			<!--widgetcontent-->
		</div>
		<!--widget-->

	</div>

</div>


