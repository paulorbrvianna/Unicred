<?php
include_once 'chave.php';
include_once 'autoloader.php';

// VERIFICA QUAL A PERMISSAO DO USUARIO =============
$objFunc = new Usuario();
//$objPermissao = new Permissao ();

$objFunc->get ( $_SESSION ["idUsuarioLogado"] );

// ===================================================
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>SISCRED</title>

<!-- CSS -->
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<link href="css/jquery-ui-1.10.2.custom.css" rel="stylesheet"
	type="text/css">

<!-- JQUERY -->
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/modernizr.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/responsive-tables.js"></script>
<script type="text/javascript" src="js/jquery.alerts.js"></script>

<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/forms.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/price.js"></script>
<script type="text/javascript" src="js/jquery.smartWizard.min.js"></script>
<script type="text/javascript" src="js/elements.js"></script>
<script src="js/cep.js"></script>

<script type="text/javascript">
</script>
</head>
<body>
	<div class="mainwrapper">
		<div class="header">
			<div class="logo"></div>
			<div class="headerinner">
				<ul class="headmenu">
					<li class="right">
						<div class="userloggedinfo">

							<div class="userinfo">
								<h5>
								<?php echo $_SESSION["nomeUsuarioLogado"]?>
								</h5>
								<ul>
									<li><a href="?pg=2&id=<?php echo $objFunc->idUsuario ?>">Editar Perfil</a>
									</li>
									<li><a href="logout.php">Sair</a></li>
								</ul>
							</div>
						</div>
					</li>
				</ul>
				<!--headmenu-->
			</div>
		</div>
		<div class="leftpanel">
			<div class="leftmenu">
				<ul class="nav nav-tabs nav-stacked">
					<li class="nav-header">Acesso Rápido</li>
					<li class="dropdown"><a href="estrutura.php?pg=4"><span
							class="iconfa-th-list"></span>Módulo de Crédito</a></li>
					<li class="dropdown"><a href="estrutura.php?pg=1"><span
							class="iconfa-th-list"></span>Módulo de Administrativo</a></li>
				</ul>

			</div>
			<!--leftmenu-->
		</div>
		<!-- leftpanel -->
		<div class="rightpanel">
		<?php
		include_once 'util/Utilidades.php';
		$objUtil = new Utilidades ();
		$pg = $objUtil->antiSqlInjectionInt ( $_GET ['pg'] );
		switch ($pg) {
			//default :
			/*include_once 'exibePatio.php';
			break;*/


			case 1 :
				include_once 'menuAdministrativo.php';
				break;
				/* MENU USUARIOS */
			case 2 :
				include_once 'usuario/form.php';
				break;

			case 3 :
				include_once 'usuario/listar.php';
				break;
			case 4 :
				include_once 'menuCredito.php';
				break;
			case 5 :
				include_once 'analitico/form.php';
				break;
			case 6 :
				include_once 'log/listar.php';
				break;
			case 7 :
				include_once 'sintetico/form.php';
				break;
					
					
					


		}
		?>
		</div>
		<!--rightpanel-->
	</div>
	<!--mainwrapper-->
</body>
</html>
