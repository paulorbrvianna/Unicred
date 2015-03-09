<?
ob_start();
session_start();
if(empty($_SESSION['usuarioCobranca'])){ 
    header("Location: login.php");  	
	$faltalogar = "faltalogar";
	$_SESSION['faltalogar'] = $faltalogar;
  }
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<frameset rows="1,152,*" cols="1,*" framespacing="0" frameborder="no" border="0">
  <frame src="UntitledFrame-3">
  <frame src="UntitledFrame-1">
  <frame src="UntitledFrame-4">
  <frame src="UntitledFrame-2.php" name="topFrame" scrolling="no" noresize="noresize" id="topFrame" title="topFrame" />
  <frame src="UntitledFrame-5">
  <frameset cols="1,760" frameborder="no">
    <frame src="UntitledFrame-2">
    <frame src="Untitled-1.php" name="mainFrame" id="mainFrame" title="mainFrame" />
  </frameset>
</frameset>
<noframes><body>
</body>
</noframes>
</html>
