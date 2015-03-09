<?
ob_start();
session_start();
  
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Senha_Alterada</title>
</head>

<body>
<?php

include('connect.php'); 
$user = $_POST['user'];
$senha = $_POST['senha'];
$senhaatual = $_POST['senhaatual'];
$confsenha = $_POST['senhaatualconf'];
$query = mysql_query("SELECT * FROM tab_user WHERE (user = '$user') AND (senha = '$senha')");
$resul = mysql_fetch_assoc($query);
 
if($senhaatual == '' or $confsenha == '' or $user =='' or $senha ==''){
$faltadados = "faltadados";
$_SESSION['faltadados'] = $faltadados;
header("Location: Alterar_Senha.PHP");
}elseif($resul == ''){
$erro2 = "erro2";
$_SESSION['erro2'] = $erro2;
header("Location: Alterar_Senha.PHP");
}elseif($senhaatual != $confsenha){
$senhasdiferentes = "senhasdiferentes";
$_SESSION['senhasdiferentes'] = $senhasdiferentes;
header("Location: Alterar_Senha.PHP");
}elseif($resul!='' and $senhaatual == $confsenha ){
$altera = mysql_query("UPDATE tab_user SET senha = '$senhaatual' WHERE user = '$user'");
header("Location: login.PHP");
$sucesso = "sucesso";
$_SESSION['sucesso'] = $sucesso;
}

?>


</body>

</html>
