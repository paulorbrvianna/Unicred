<?php
ob_start();
session_start();

if(!isset($_SESSION["nomeUsuarioLogado"]) || !isset($_SESSION["idUsuarioLogado"]) || $_SESSION["nomeUsuarioLogado"] == "" || 
$_SESSION["idUsuarioLogado"] == "" ){
	header("Location:index.php?M=erro");
}


?>