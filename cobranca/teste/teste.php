<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php 

$r =  $_POST['qtd'];

$x=0;
$vetor = array();
while($x<$r){
if($_POST['enviaCarta'.$x] == ""){
$vetor[$x] = "99999-9";
}else{

$vetor[$x] = $_POST['enviaCarta'.$x];
}
//$re = array_merge($vetor[$x]);
$x++;


}

$teste = implode("', '",$vetor);


echo $teste;
$teste2 =  "'".$teste."'";

 include('../connect.php');


$selec5 = mysql_query ("SELECT * FROM ad WHERE cc IN($teste2)");
echo $num_linhas5 = mysql_num_rows($selec5);
for($i=0;$i<$num_linhas5;$i++){ $resul5 = mysql_fetch_array($selec5,MYSQL_ASSOC);
echo $resul5['nome'];



}


?>



</body>
</html>
