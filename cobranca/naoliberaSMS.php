<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style>
#enviar{ margin:0 0 0 350px; width:179px; height:60px; color:#333333; background:url(bntNaoenvia.png); border:none  }
#enviar:hover{ margin:0 0 0 350px;;width:179px; height:63px; color:#333333; background:url(bntNaoenvia.png) bottom no-repeat; border:none  }
</style>
<body>
<?php
 include('connect.php');
 $selec2 = mysql_query ("SELECT * FROM cobrancasms WHERE autorizacao = 'Pendente'");

$num_linhas2 = mysql_num_rows($selec2);

?>
<table style="margin:-20px 0 0 300px; background:url(topN.png); height:90px" width="450" border="0">
  <tr>
        <td ><a style="font-size:20px; margin-left:85px; text-decoration:none; color:#FFFFFF" href="liberaSMS.php">Autorizar</a></td>
    <td tyle=" width:132px; height:60px;   text-align:center"><a href="naoliberaSMS.php" style=" font-size:20px; margin-left:85px; text-decoration:none; color:#FFFFFF">Desautorizar</a></td>
  </tr>
</table>

<form action="DesautorizacaoSMS.php" method="post">
<input name="qtd" type="hidden" value="<?php echo $num_linhas2; ?>" />

<table width="244" border="0" style=" margin:0 0 0 580px">
  <tr>
    <td width="101"><a href="#" id="MTodas">Marcar todas</a></td>
    <td width="127"><a href="#" id="DTodas">Desmarcar todas</a></td>
  </tr>
</table>

<table width="900"  >
  <tr >
    
    <td width="21"></td>
    <td width="60" style="border:1px #CCCCCC solid; background:#CCCCCC; color:#FFFFFF"><strong>Conta</strong></td>
    <td width="450" style="border:1px #CCCCCC solid; background:#CCCCCC; color:#FFFFFF"><strong>Nome</strong></td>
    <td width="120" style="border:1px #CCCCCC solid; background:#CCCCCC; color:#FFFFFF"><strong>Numero de Celular</strong></td>
    <td width="120" style="border:1px #CCCCCC solid; background:#CCCCCC; color:#FFFFFF"><strong>Situação</strong></td>
    <td width="80" style="border:1px #CCCCCC solid; background:#CCCCCC; color:#FFFFFF"><strong>Modulo</strong></td>
  </tr>
</table>

<?

for($x=0;$x<$num_linhas2;$x++){ $resul2 = mysql_fetch_array($selec2,MYSQL_ASSOC);



?>

<table width="900" border="0">
  <tr>
    <td width="21" style="border:1px #CCCCCC solid"><input  <? echo  $habilita;?>  name="<? echo  "enviaSMS".$x;?>" type="checkbox" value="<?php echo  $resul2['conta']; ?>" /></td>
    <input name="cel" type="hidden" value="<?php echo  $resul2['numCel'];?>" />
    <td width="60" style="border:1px #CCCCCC solid"><?php echo  $resul2['conta']; ?></td>
    <td width="450" style="border:1px #CCCCCC solid"><?php echo  $resul2['nome']; ?></td>
    <td width="120" style="border:1px #CCCCCC solid"><?php echo  $resul2['numCel'];?></td>
        <td id="situacao"  width="120" style="border: 1px #CCCCCC solid"><?php  echo $resul2['autorizacao']; ?></td>
        <td   width="80" style="border: 1px #CCCCCC solid"><?php  echo $resul2['modulo']; ?></td>
    
  </tr>
</table>
<?php
}
?>
<input name="Desautorizar" id="enviar" value=" " type="submit" />

</form>

</body>
</html>

