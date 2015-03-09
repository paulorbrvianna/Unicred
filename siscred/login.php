<?php
ob_start();
session_start();

include_once 'autoloader.php';


$login = $_POST['login'];
$senha = $_POST['senha'];

$usuario = new Usuario();

$usuario->where("email_usuario = '$login' AND psw_usuario = '$senha'");

$usuario->find();

$usuarioLogado = array();

$i = 0;
while($usuario->fetch()){
	$usuarioLogado[$i]["id"] = $usuario->idUsuario;
	$usuarioLogado[$i]["nome"] = $usuario->nomeUsuario;
	$i++;
}



$numReg = count($usuarioLogado);

if($numReg<=0){
	header("Location:index.php?M=erro");
}elseif($numReg>0){
	$i = 0;
	$_SESSION["nomeUsuarioLogado"] = $usuarioLogado[0]["nome"];
	$_SESSION["idUsuarioLogado"] = $usuarioLogado[0]["id"];
	header("Location:estrutura.php");
}


?>