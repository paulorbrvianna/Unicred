<?php
$serv="localhost"; //nome do servidor
$user="root"; //usu�rio que vai conectar no database
$password=""; //aqui voc� deve especificar a senha do usu�rio
//$db=("unicred"); //especifique o nome da base que voc� criou
$con=mysql_connect($serv,$user,$password) or die ("Erro ao conectar a base de dados");
$db = mysql_select_db("siscred"); 

?> 
