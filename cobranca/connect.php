<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   
<?php
$serv="localhost"; //nome do servidor
$user="root"; //usu�rio que vai conectar no database
$password=""; //aqui voc� deve especificar a senha do usu�rio
//$db=("unicred"); //especifique o nome da base que voc� criou
$con=mysql_connect($serv,$user,$password) or die ("Erro ao conectar a base de dados");
$db = mysql_select_db("unicred"); 

?> 