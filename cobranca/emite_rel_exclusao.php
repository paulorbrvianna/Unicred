<?
ob_start();
session_start();
if(empty($_SESSION['usuarioCobranca'])){ 
    header("Location: login.php");  	
	$faltalogar = "faltalogar";
	$_SESSION['faltalogar'] = $faltalogar;
  }
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Relatório Geral</title>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 24px;
}
.style3 {color: #FFFFFF}
-->
</style>
</head>

<body>
<table width="992" border="1" bgcolor="#006666">
  <tr>
    <th width="982" scope="col"><div align="center" class="style1"> Deseja emitir Relatório Exclusão</div></th>
  </tr>
  <tr>
    <td><table width="979" border="0">
        <tr>
          <th width="171" class="style3" scope="col">&nbsp;</th>
          <th width="298" class="style3" scope="col"><form id="form1" name="form1" method="post" action="rel_exclusao.php">
            <label for="EMITIR"></label>
            <div align="right">
              <input type="submit" name="EMITIR" id="EMITIR" value="EMITIR" size="15" />
              </div>
          </form>          </th>
          <th width="496" class="style3" scope="col"><form id="form2" name="form2" method="post" action="Untitled-1.php">
            <label for="VOLTAR"></label>
            <div align="left">
              <input type="submit" name="VOLTAR" id="VOLTAR" value="VOLTAR" size="15" />
              </div>
          </form>          </th>
        </tr>
      </table>    </td>
  </tr>
</table>

</body>
</html>
