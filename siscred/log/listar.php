<?php 
include '../connecta.php';
include_once '../autoloader.php';


$mesVigente = date("m");
$anoVigente = date("Y");
$qtdDiasMesCorrente = date('t');

extract($_POST);

$mesForm = $mesForm;
$anoForm = $anoForm;

if($anoForm == ""){
	$anoSelecionado = $anoVigente;
}else{
	$anoSelecionado = $anoForm;
}

if($mesForm == ""){
	$mesSelecionado = $mesVigente;
}else{
	$mesSelecionado = $mesForm;
}


//==================================================================================

function meses($mes){
	switch($mes){
		case 01:
			echo "Janeiro";
			break;
		case 02:
			echo "Fevereiro";
			break;
		case 03:
			echo "Março";
			break;
		case 04:
			echo "Abril";
			break;
		case 05:
			echo "Maio";
			break;
		case 06:
			echo "Junho";
			break;
		case 07:
			echo "Julho";
			break;
		case 08:
			echo "Agosto";
			break;
		case 09:
			echo "Setembro";
			break;
		case 10:
			echo "Outubro";
			break;
		case 11:
			echo "Novembro";
			break;
		case 12:
			echo "Dezembro";
			break;
	}
}



?>
<script type="text/javascript">
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

//$objPermissaoLog = new Permissao();

//$objPermissaoLog->get($idPermissao);


//$listar = $objPermissaoLog->listarLog;


//==================================================================================
?>

<ul class="breadcrumbs">
	<li>
	<a href="estrutura.php"><i class="iconfa-home"></i> </a>
	<span class="separator"></span>
	</li>
	<li>
	<a href="?pg=2">Menu Geral Módulo Administração</a> 
	</li>

</ul>

<div class="pageheader">
	<div class="pageicon">
		<span class="iconfa-table"></span>
	</div>
	<div class="pagetitle">
		<h5><a href="">Ajuda</a></h5>
		<h1>Log do Sistema</h1>
		
		<h5>Filtro por Mês / Ano</h5>
		
		<div style="margin-top: 30px;">
		
		<form action="estrutura.php?pg=6" method="post">
			
			<p>
			
			<select name="mesForm">
			<?php 
			$objUtil->selectMesesNumeral($mesSelecionado);
			?>
			</select>
			
			
			<select name="anoForm">
			<option value="">Ano</option>
			<?php 
			for($anoSel=2000;$anoSel<=2020;$anoSel++){
			?>
				<option <?php if($anoSelecionado == $anoSel){ echo "selected='selected'"; } ?> value="<?php echo $anoSel ?>"><?php echo $anoSel ?></option>
			<?php 
			}
			?>
			</select>
			
			<p class="stdformbutton">
				<button class="btn btn-warning" id="submit">PESQUISAR</button>
			</p>
			
			</p>
		
		</form>
		
		</div>
	</div>
	
</div>
<!--pageheader-->

<div class="maincontent">
	<div class="maincontentinner">
	
		<table id="dyntable" class="table table-bordered ">
			<thead>
				<tr>
					<th class="head0 nosort">Módulo</th>
					<th class="head0">Ação</th>
					<th class="head1">Usuário</th>
					<th class="head1">Id Registro</th>
					<th class="head1">Data - Hora</th>
				</tr>
			</thead>
			<tbody>
			<?php
			
			$obj = new LogSistema(); // Instancia o objeto do dominio;
			$objUsuario = new Usuario();
			$objUtil = new Utilidades();
			
			$obj->join($objUsuario);
			
			$objUtil = new Utilidades(); // Instancia o objeto da classe de utilidades, são métodos de uso constante no sistema;
			//$obj->where("YEAR(logData) = $anoSelecionado AND MONTH(logData) = $mesSelecionado");
			$obj->order("logData ASC"); // Para ordenar, deve passar o mesmo titulo do campo de acordo com a tabela do banco de dados;

			$obj->find(); // Realiza a consulta no Banco de Dados;

			// Realiza o laço de listagem de registros, o método $obj->fetch() equivale ao while numa consulta sem lumine;
			while($obj->fetch()){
			?>
				<tr class="gradeX">
					<td><?php echo $obj->logModulo ?></td>
					<td><?php echo $obj->logAcao?></td>
					<td><?php echo $obj->nomeUsuario ?></td>
					<td><?php echo $obj->logIdRegistro ?></td>
					<td><?php echo $objUtil->formataData($obj->logData)." - ".$obj->logHora?></td>
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
