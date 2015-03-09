<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

//Aqui estamos adicionando a pagina que possui as funcoes para o LDAP
include("conectar_ad.php");

//Aqui chamamos a funcao Login_LDAP que ira nos retornar True ou False
	if (Login_LDAP($_POST['user'],$_POST['senha'])) {
//Se retornar True (login com sucesso faça os paços abaixo

//Mostra mensagem na Tela, caso demore para processar as linhas abaixo (não ficar uma tela em branco)
	    echo utf8_encode("usuÃ¡rio autenticado");

//Encaminha o usuario para a proxima pagina que neste caso chama-se abertura.php
	    header("Location: UntitledFrameset-2.PHP");
	} else {
//Se retornar Falso execute os paços abaixo

//mostra uma mensagem na tela informando que deu errado o logon e fornece um link para voltar a pagina anterior
	    echo ("usuÃ¡rio ou senha invÃ¡lida. <a href=\"javascript:history.go(-1)\">voltar</agt;");
//Chama a funcao de desconectar o usuario, esta funcao pode ser utiliza no botao sair tb da pagina, ele limpa os cookies
	  
	}

?>
</body>
</html>
