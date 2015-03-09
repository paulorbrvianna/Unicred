<?php	
            if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'):
                $nome  = (!get_magic_quotes_gpc()) ? addslashes($_POST['nome']) : $_POST['nome'];
                $email = (!get_magic_quotes_gpc()) ? addslashes($_POST['email']) : $_POST['email'];
                $senha = (!get_magic_quotes_gpc()) ? addslashes($_POST['senha']) : $_POST['senha'];
                $senha = md5($senha);
                
                require("conexao.php");
                
                $sql = "INSERT INTO usuarios (nome_user, email_user, senha_user)
                                            VALUES
                                            ('$nome', '$email', '$senha')";
                $qr  = mysql_query($sql) or die(mysql_error());
                
                    if($qr):
                        echo '<script>alert("Cadastrado com sucesso!")</script>';
                    else:
                        echo '<script>alert("Erro ao cadastrar")</script>';
                    endif;
                
                
            endif;
?>  
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>S.A.A.G. - Sistema de Apoio e Análise Gerencial - Unicred Natal Versão 1.0</title>
    <style type="text/css">
<!--
body {
	background-image: url(Imagens/UNICRED.jpg);
}
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	font-weight: bold;
}
-->
    </style></head>
    <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
    <body>
<br /> <br /> <br /> <br /> <br /> <br />
    <form method="post" action="">
    <fieldset>
    <legend><span class="style1">Formulário de Cadastro</span></legend>
    <label><span class="style1">Nome</span>
    <input name="nome" type="text" size="35"/></label>
    <label><span class="style1">E-mail</span>
    <input name="email" type="text" size="35"/></label>
    <label><span class="style1">Senha</span>
    <input name="senha" type="password" size="35"/></label>

    <input type="hidden" name="acao"  value="cadastrar"/>
    <input type="submit" class="btn" value="Cadastrar "/>
    </fieldset>
    </form>

    </body>
    </html>
