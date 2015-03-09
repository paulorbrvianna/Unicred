<?php
include_once '../autoloader.php';

$obj = new Usuario();
$objUtil = new Utilidades();

$term = trim(strip_tags($_GET['term']));

if(isset($term) and $term != '')
{
	$results = array();

	$obj->where("status = 1 AND nome_usuario LIKE '%$term%'");
	$obj->order("nome_usuario ASC");
	$total = $obj->find();
	
	while($obj->fetch()){
		$results[] = $obj->idUsuario." - ".$obj->nomeUsuario;
	}

	echo json_encode($results);

}
