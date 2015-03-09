<?
ob_start();
session_start();
if(empty($_SESSION['nome_session'])){
    header("Location: ./login.php?erro=É necessário efetuar login no sistema!");
  }
?>

<?

unset($_SESSION['codgerente_session']);
unset($_SESSION['ti_session']);
unset($_SESSION['userbrinde_session']);
unset($_SESSION['cademp_session']);
unset($_SESSION['adminalert_session']);
?>

<!-- Template Designed by: www.Best-Templates.net -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>S.A.A.G. - Sistema de Apoio e Análise Gerencial - Unicred Natal Versão 1.0</TITLE>
<STYLE type=text/css>
A:link { COLOR: blue; FONT-WEIGHT: none; TEXT-DECORATION: none }
A:hover { COLOR: red; FONT-WEIGHT: none; TEXT-DECORATION: underline }
A:visited { color: blue; font-weight: none; text-decoration: none }
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {color: #FFFFFF}
.style4 {
	font-family: arial;
	font-size: 12px;
	color: #000000;
}
.style5 {
	color: #006600;
	font-weight: bold;
	font-family: "Courier New", Courier, monospace;
	font-size: 10px;
	font-style: italic;
}
</STYLE>
<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</HEAD>
<body leftMargin=0 topMargin=0 MARGINWIDTH="0" MARGINHEIGHT="0" background="bg.jpg">

<div align="center">

<table cellpadding="0" cellspacing="0" width="780" height="80">
<TR>
  <Td width="780" height="80" bgcolor="">

<img src="../menu/Imagens/bannerunicred.jpg" width="780" height="105">

</tr></table>


<table cellpadding="0" cellspacing="0" width="780" height="1"><TR><!--Td width="780" height="1" bgcolor="black"></tr--></table>

<table cellpadding="0" cellspacing="0" width="780" height="20"><tr>
  <td width="780" bgcolor="#006633" height="20"><span class="style1"><font face="Verdana" size="1">&nbsp;&nbsp;&nbsp;&nbsp;Bem vindo: <? echo $_SESSION['nome_session'];?> </font></span></td>
</tr></table>

<table cellpadding="0" cellspacing="0" width="780" height="1"><TR><!--Td width="780" height="1" bgcolor="black"></tr--></table>

<table cellpadding="0" cellspacing="0" width="780">
<TR><Td width="307" height="200" valign="top">
<!-- Template Designed by: www.Best-Templates.net -->
<P>
  <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','276','height','400','src','menurecife','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','menurecife' ); //end AC code
  </script>
  <noscript>
  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="276" height="400">
    <param name="movie" value="menurecife.swf">
    <param name="quality" value="high">
    <embed src="menurecife.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="276" height="400"></embed>
  </object>
  </noscript>
</P>
</td>

<td width="471" align="center" valign="top">

<P align="right">&nbsp;</p>
<P align="center">&nbsp;</p>
<!-- Template Designed by: www.Best-Templates.net -->
<center>
  <p class="style4">S.A.A.G. - Sistema de Apoio e Análise Gerencial <br>Unicred Natal Versão 2.0</p>
  <p class="style4">&nbsp;</p>
  <p class="style4">&lt;&lt; Escolha    o op&ccedil;&atilde;o desejada</p>
</center>

<P>&nbsp;</p>
<p class="style4"> TESTE
  Desenvolvido pelo Setor de Tecnologia da Informa&ccedil;&atilde;o<br>
  Unicred Natal
  </center>
  <P align="center"><a href="../menu/login.php"><br><img src="Imagens/logout_on.gif" width="44" height="41" border="0"></a> </P></td>
</tr>
<TR>
  <Td height="20" colspan="2" valign="top" bgcolor="#000"><div align="center"><font color="#FFFFFF" size="2" face="Courier New, Courier, mono">&copy; <font size="1">S.A.A.G - 2010 Unicred Natal.
</font> </font></div></td>
  </tr>
</table>

</div>
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
</BODY>
</HTML>
<!-- Template Designed by: www.Best-Templates.net -->