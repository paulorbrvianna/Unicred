<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

//  Configurações do Script
// ==============================
$_SG['abreSessao'] = true;         // Inicia a sessão com um session_start()?
$_SG['validaSempre'] = true;       // Deseja validar o usuário e a senha a cada carregamento de página?
					// Evita que, ao mudar os dados do usuário no banco de dado o mesmo contiue logado.
$_SG['AdServer'] = '10.81.0.230';
$_SG['dominio'] = 'UNICREDRECIFE';
$_SG['paginaLogin'] = 'login.php'; // Página de login, caso falhe o usuario 

// ==============================
// ======================================
//   ~ Não edite a partir deste ponto ~
// ======================================

// Verifica se precisa iniciar a sessão
if ($_SG['abreSessao'] == true) {
global $_SG;
session_start();
}

function Login_LDAP($user, $password)
{
global $_SG;
    $ldap_server = $_SG['AdServer'];
    $auth_user = $_SG['dominio'] . trim(" \ ") . $user; 
    $auth_pass = $password; 
	echo  $auth_user;
    // Tenta se conectar com o servidor 
    if (!($connect = @ldap_connect($ldap_server))) {
        return FALSE;
    }

    // Tenta autenticar no servidor 
    if (!($bind = @ldap_bind($connect, $auth_user, $auth_pass))) { 
        // se não validar retorna false 
        return FALSE;
    } else {
        // se validar retorna true 
        return TRUE;
    }

}

?>

</body>
</html>
