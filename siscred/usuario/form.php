<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery("input[name=telefoneFuncionario]").mask("(99)9999-9999");
	
	/*  */
	jQuery("#form1").validate({ 
    rules: { 
	
    	nomeFuncionario: {
            required: true 
        },
        emailFuncionario: {
            required: true,
            email:true 
        },
        permissaoIdpermissao: {
            required: true,
        },
        cargoIdcargo: {
            required: true,
        },
        senhaFuncionario: {
            required: true,
        }
    }, 
    messages: {  
    	nomeFuncionario: { 
    		required: "ERRO: O Campo Nome Funcionário Deverá ser Preenchido!" 
    	},
    	emailFuncionario: { 
    		required: "ERRO: O Campo E-mail Deverá ser Preenchido!",
    		email: "ERRO: Insira um Email com formato válido!"
    	},  	      
    	permissaoIdpermissao: { 
    		required: "ERRO: O Campo Permissão Deverá ser Preenchido!",
    	},  	      
    	cargoIdcargo: { 
    		required: "ERRO: O Campo Cargo Deverá ser Preenchido!",
    	},  	      
    	senhaFuncionario: { 
    		required: "ERRO: O Campo Senha Deverá ser Preenchido!",
    	}  	      
    },
	highlight: function(label) {
		jQuery(label).closest('.control-group').addClass('error');
    },
    success: function(label) {
    	label.text('Ok!').addClass('valid').closest('.control-group').addClass('success');
    	
    }

      
	});   
   

	//==================================================================================================

        


	
}); // fim do jquery =============================================================

</script>

	<?php
	include_once 'autoloader.php';
	$objUtil = new Utilidades();
	$acao = "salvar";
	$titulo = "Inserir Usuário";
	$botao = "Salvar";
	$id = $_GET['id'];
	if(isset($id) && !empty($id)){
	$acao = "editar";
	$titulo = "Editar Usuário";
	$botao = "Salvar";
	$obj = new Usuario();
	$obj->get($id);
	}
	?>

<ul class="breadcrumbs">
	<li>
	<a href="estrutura.php"><i class="iconfa-home"></i> </a>
	<span class="separator"></span>
	</li>
	<li>
	<a href="?pg=1">Menu Geral Módulo Administração</a>
	<span class="separator"></span> 
	</li>
	<li>
	<a href="?pg=3">Listagem De Usuários</a>
	</li>

</ul>

<div class="pageheader">
	<div class="pageicon">
		<span class="iconfa-pencil"></span>
	</div>
	<div class="pagetitle">
		<h5><?php echo $titulo ?></h5>
		<h1>Usuário</h1>
	</div>
</div>
<!--pageheader-->

<div class="maincontent">
	<div class="maincontentinner">


<div class="widgetbox box-inverse">
	<h4 class="widgettitle"></h4>
	<div class="widgetcontent wc1">
		<form id="form1" class="stdform" method="post" action="usuario/recebeDados.php" enctype="multipart/form-data" >
		<input type="hidden" name="acao" id="acao" value="<?php echo $acao ?>">
		<input type="hidden" name="id" id="id" value="<?php echo $id ?>">		
			
			<?php 
			if($obj->fotoFuncionario == ""){
			?>
			<div class="par control-group">
				<label class="control-label" for="firstname">Imagem</label>
				
				<div class="controls">
					<input type="file" name="fotoFuncionario" id="fotoFuncionario"  class="btn fileupload-exists" />
				</div>
			</div>
			<?php 
			}elseif($obj->fotoFuncionario != ""){
			?>
			<div class="par control-group">
				<label class="control-label" for="firstname">Foto</label>
				<img alt="foto" src="fotos/<?php echo $obj->fotoFuncionario; ?>">
				<a href="funcionario/recebeDados.php?acao=foto&id=<?php echo $id ?>">Excluir</a>
			</div>
			<?php 
			}
			?>
			
			<div class="par control-group">
				<label class="control-label" for="firstname">Nome Usuário *</label>
				<div class="controls">
					<input type="text" name="nomeUsuario" id="nomeUsuario" value="<?php echo $obj->nomeUsuario ?>" class="input-large" />
				</div>
			</div>
			
			<div class="par control-group">
				<label class="control-label" for="firstname">Email *</label>
				<div class="controls">
					<input type="text" name="emailUsuario" id="emailUsuario" value="<?php echo $obj->emailUsuario ?>" class="input-large" />
				</div>
			</div>
			
			 
						
			<div class="par control-group">
				<label class="control-label" for="firstname">Senha *</label>
				<div class="controls">
					<input type="password" name="senhaUsuario" id="senhaUsuario" value="<?php echo $obj->pswUsuario ?>" class="input-large" />
				</div>
			</div>
			
			

			<p class="stdformbutton">
				<button class="btn btn-primary" id="submit">SALVAR</button>
			</p>
		</form>
	</div>
	<!--widgetcontent-->
</div>
<!--widget-->

</div>

</div>


