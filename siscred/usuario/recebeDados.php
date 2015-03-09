<?php
ob_start();
session_start();
include_once '../autoloader.php';
include_once '../connecta.php';

$acao = $_POST['acao'];
$obj = new Usuario();
$objUtil = new Utilidades();

$arr = array();

$sucesso = "Location:../estrutura.php?pg=3&mess=sucesso";
$erro = "Location:../estrutura.php?pg=3&mess=erro";

if(!isset($acao) && empty($acao)){
	$acao = $_GET['acao'];
}


switch($acao){
	
	case "salvar":
		
		$imagem = $_FILES['fotoFuncionario'];
		
		if($imagem['size']>0){
			$imagemNormal = $objUtil->uploadFotos($imagem, "../fotos", 0, 100, 100);
		};
		
		$nomeUsuario = $_POST['nomeUsuario'];
		$emailUsuario = $_POST['emailUsuario'];
		$status = 1;
		$senhaUsuario = $_POST['senhaUsuario'];
		
		
		// VALIDAÇÃO DE REGISTROS IGUAIS =======================
		
		$sqlValidacao = "SELECT nome_usuario FROM usuario WHERE nome_usuario = '$nomeUsuario' AND status = 1";
		$queryValidacao = mysql_query($sqlValidacao);
		
		$total = mysql_num_rows($queryValidacao);
		
		$alerta = "<script type=text/javascript'>
		alert('ERRO: Este Funcionario Já Está Cadastrado No Sistema!');
		location.href = '../estrutura.php?pg=3&mess=erro ;
		</script>";
		
		if($total>0){
			echo $alerta;
		}else{
		
			$query = "INSERT INTO usuario(
			nome_usuario,email_usuario,status,psw_usuario,foto_usuario) 
			VALUES ('$nomeUsuario','$emailUsuario',$status,'$senhaUsuario','$fotoFuncionario')";
			
			$result = mysql_query($query)or die(mysql_error());
			$ultimaId = mysql_insert_id();
			
			if($result){
				
				/* LOG DO SISTEMA */
				
				$log = new LogSistema();
				$log->logModulo = 'USUARIO';
				$log->logAcao = "INSERIR";
				$log->usuarioIdUsuario = $_SESSION["idUsuarioLogado"];
				$log->logIdRegistro = $ultimaId;
				$log->logData = date("Y-m-d");
				$log->logHora = date("H:m:s");
				
				$log->save();
					
				
				header($sucesso);			
			}else{
				header($erro);
			}
		}
				
	break;
	
	case "editar":
		
	
		$id = $_POST['id'];
		
		$obj->get($id);
		
		$foto = $_FILES['fotoFuncionario'];
		
		if($foto["size"]>0){
			$fotos = $objUtil->UpLoadFotos($foto,"../fotos",0,100,100);
			$fotoNormal = $fotos["normal"];
			$obj->fotoFuncionario = $fotoNormal;
		}
		
		$obj->nomeUsuario = $_POST['nomeUsuario'];
		$obj->emailUsuario = $_POST['emailUsuario'];		
		$obj->pswUsuario = $_POST['senhaUsuario'];
		
	
		if($obj->update()){
			
			/* LOG DO SISTEMA */
				
				$log = new LogSistema();
				$log->logModulo = 'USUARIO';
				$log->logAcao = "EDITAR";
				$log->usuarioIdUsuario = $_SESSION["idUsuarioLogado"];
				$log->logIdRegistro = $id;
				$log->logData = date("Y-m-d");
				$log->logHora = date("H:m:s");
				
			$log->save();
			/*==============================*/
			
			header($sucesso);			
		}else{
			header($erro);
		}
				
	break;
	
	case "excluir":
	
		$id = $_POST['id'];
		
		$obj->get($id);
	
		$obj->status = 0;
		
		if($obj->update()){
			
			/* LOG DO SISTEMA */
				$log = new LogSistema();
				$log->logModulo = 'USUARIO';
				$log->logAcao = "EXCLUIR";
				$log->usuarioIdUsuario = $_SESSION["idUsuarioLogado"];
				$log->logIdRegistro = $id;
				$log->logData = date("Y-m-d");
				$log->logHora = date("H:m:s");
			
			$log->save();
			/*==============================*/
			
			$arr['retorno'] = 1;
			echo json_encode($arr);
		}else{
			$arr['retorno'] = 0;
			echo json_encode($arr);
		}
	
	break;
	
	case "foto":
	
		$id = $_GET['id'];
	
		$obj->get($id);
	
		unlink($obj->fotoUsuario);
	
	
		$obj->fotoUsuario = "";
	
		if($obj->update()){
			
			/* LOG DO SISTEMA */
				$log = new LogSistema();
				$log->logModulo = 'USUARIO';
				$log->logAcao = "ALTERAR FOTO";
				$log->usuarioIdUsuario = $_SESSION["idUsuarioLogado"];
				$log->logIdRegistro = $ultimaId;
				$log->logData = date("Y-m-d");
				$log->logHora = date("H:m:s");
				
			$log->save();
			/*==============================*/
			
			header("Location:../estrutura.php?pg=31&id=$id");
		}else{
			header("Location:../estrutura.php?pg=31&id=$id");
		}
	
	break;
	
}






?>