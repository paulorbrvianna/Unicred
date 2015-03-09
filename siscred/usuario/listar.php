<script type="text/javascript">


	//FUNÇÃO PARA INATIVAR UM REGISTRO ===================================================
	
	function DeletarRegistro(id){

		jConfirm('Deseja Realmente Inativar Este Registro?', 'Confirmação de Inativação', function(r) {

			if(r){

				var acao = "excluir";
				
				jQuery.ajax({
					data:{acao:acao,id:id},
					type:"POST",
					url:"usuario/recebeDados.php",
					dataType: "json", //Tipo de Retorno
				    success: function(json){ //Se ocorrer tudo certo
						if(json.retorno==1){

							jQuery.alerts.dialogClass = 'alert-info';
					    	jAlert('Ação Realizada Com Sucesso!', 'Resultado', function(){
					    		jQuery.alerts.dialogClass = null; // reset to default
					    	});
							
					    	location.href="estrutura.php?pg=3&mess=sucesso";
					    	
						}else{
							jQuery.alerts.dialogClass = 'alert-danger';
					    	jAlert('Ação Não Realizada!', 'Resultado', function(){
					    		jQuery.alerts.dialogClass = null; // reset to default
					    	});
						}
				    	
				    }
				});
				
			}else{
				jAlert('Operação Cancelada!', 'Confirmação de Inativação');
			}

			return false;
		});
		return false;	
	}
	//====================================================================================
		
    jQuery(document).ready(function(){
        // dynamic table
    	 jQuery('#dyntable').dataTable({
             "sPaginationType": "full_numbers",
             "aaSortingFixed": [[0,'asc']],
             "iDisplayLength" : 25,
             "oLanguage":{
             	"sSearch":         "Pesquisar:",
             	"oPaginate": {
                     "sFirst":      "Primeiro",
                     "sPrevious":   "Anterior",
                     "sNext":       "Proximo",
                     "sLast":       "Ultimo"
                 },
                 "sInfo": "Exibindo de _START_ a _END_ do total _TOTAL_ Registros",
             },
             "fnDrawCallback": function(oSettings) {
            }
        });
        
    });
</script>
<?php
// PEGA AS REGRAS DE VALIDAÇÃO PARA O MODULO =======================================



//==================================================================================
?>

<ul class="breadcrumbs">
	<li>
	<a href="estrutura.php"><i class="iconfa-home"></i> </a>
	<span class="separator"></span>
	</li>
	<li>
	<a href="?pg=1">Menu Geral Módulo Administração</a> 
	</li>

</ul>

<div class="pageheader">
	<div class="pageicon">
		<span class="iconfa-table"></span>
	</div>
	<div class="pagetitle">
		<h5><a href=""  target="_blank">Ajuda</a></h5>
		<h1>Usuário -<a href="?pg=2"> Cadastrar Usuário </a></h1>
	</div>
</div>
<!--pageheader-->

<div class="maincontent">
	<div class="maincontentinner">
		<?php 
		$mess = $_GET['mess'];
		if($mess=="sucesso"){
		?>
		<h4 class="widgettitle title-success">Operação Realizada com Sucesso!</h4><br />
		<?php 
		}elseif($mess=="erro"){
		?>
		<h4 class="widgettitle title-danger">Operação Não Realizada</h4><br />
		<?php 	
		}	
		?>
		
		<table id="dyntable" class="table table-bordered ">
			<thead>
				<tr>
					<th class="head0">Id</th>
					<th class="head0">Nome</th>
					<th class="head0">Email</th>
					<th class="head1">Ações</th>
				</tr>
			</thead>
			<tbody>
			<?php
			include_once 'autoloader.php';
			$obj = new Usuario();
			$objUtil = new Utilidades();
			
			// RELACIONAMENTOS =========================================
			
			
			//==========================================================	
			
			$obj->order("nome_usuario ASC");

			$obj->status = 1;

			$total = $obj->find();

			while($obj->fetch()){
			?>
				<tr class="gradeX">
					<td class="aligncenter"><?php echo $obj->idUsuario ?></td>
					<td class="aligncenter"><?php echo $obj->nomeUsuario ?></td>
					<td class="centeralign"><?php echo $obj->emailUsuario ?></td>				
					<td class="centeralign">					
					<a href="?pg=2&id=<?php echo $obj->idUsuario ?>" id="editar" title="Editar" class="editar"><span class="icon-book"></span></a>
					<a href="#" onclick="DeletarRegistro(<?php echo $obj->idUsuario ?>)" id="Excluir" title="Excluir" class="Excluir"><span class="icon-trash"></span></a>
					
					</td>
				</tr>
			<?php 
			}
			?>
			</tbody>
		</table>


		<!--footer-->

	</div>
	<!--maincontentinner-->
</div>
<!--maincontent-->
