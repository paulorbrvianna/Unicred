<?
include('connect.php'); 
ob_start();
session_start();
if(empty($_SESSION['usuarioCobranca'])){ 
    header("Location: login.php");  	
	$faltalogar = "faltalogar";
	$_SESSION['faltalogar'] = $faltalogar;
  }  


$user = $_SESSION['usuarioCobranca'];

$query = mysql_query("SELECT * FROM tab_user WHERE user = '$user'");
$resul = mysql_fetch_assoc($query);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>MENU</title>
    <link type="text/css" href="./menu/menu.css" rel="stylesheet" />
    <script type="text/javascript" src="./menu/jquery2.js"></script>
    <script type="text/javascript" src="./menu/menu2.js"></script>
    	
	<style>
</head>
<body>
<style type="text/css">
* { margin:0;
    padding:0;
}
	#menu { top:4px; }
.cabecalho{background-image:url(cablogin.jpg); width:100%; height:70px; background-repeat:no-repeat;}
.sair{ position:absolute; left:100%; } 
div > a { background:#999999; border:5px groove #666666;  height:15px; width:150px; position: absolute}
</style>
<div class="cabecalho">
</div>

<div id="menu">
    <ul class="menu">
<li  style="margin-left:-10px; margin-right:-12px;  " ><a href="#" class="parent"><span style="font-size:12px;">COBRANCA AD</span></a>
 
            <div class="columns five">
                <ul class="one">
                    <li><a href="emite_rel_geral.php" target="mainFrame"><span>RELATORIOS</span></a></li>
                            </ul>
                <ul class="two">
                    <li><a href="emite_carta_ad.php" target="mainFrame"><span>CARTA</span></a></li>
                                  </ul>
                <ul class="three">
                    <?php if($resul['nivel'] == "2" or $resul['nivel'] == "3"){ ?><li><a href="consul_inclusao.php" target="mainFrame"><span>INCLUSAO</span></a></li>
                   
                </ul>
                 <ul class="four">
                    <li><a href="consul_exclusao.php" target="mainFrame"><span>EXCLUSAO</span></a></li>
                   
                </ul>
                 
                <?php } ?>
               
                </div>
        </li>
        <li style="margin-left:-10px; margin-right:-12px;  " ><a href="#" class="parent"><span style="font-size:12px;">COBRANCA EMPRESTIMO</span></a>
            <div class="columns five">
                <ul class="one">
                    <li><a href="emite_rel_geral_emp.php" target="mainFrame"><span>RELATORIOS</span></a></li>
                            </ul>
                <ul class="two">
                    <li><a href="emite_carta_emp.php" target="mainFrame"><span>CARTA</span></a></li>
                                  </ul>
                <ul class="three">
                    <?php if($resul['nivel'] == "2" or $resul['nivel'] == "3" ){ ?><li><a href="consul_inclusao_emp.php" target="mainFrame"><span>INCLUSAO</span></a></li>
                   
                </ul>
                 <ul class="four">
                    <li><a href="consul_exclusao_emp.php" target="mainFrame"><span>EXCLUSAO</span></a></li>
                   
                </ul>
                 <ul class="five">
                    <li><a href="consul_atualiza_emp.php" target="mainFrame"><span>ATUALIZACAO</span></a></li>
                   
                </ul>
                <?php } ?>
            </div>
        </li>
        
        <li  style="margin-left:-10px; margin-right:-12px;  " ><a href="#" class="parent"><span style="font-size:12px;">COBRANCA CARTAO</span></a>
 
            <div class="columns five">
                <ul class="one">
                    <li><a href="cartao/emite_rel_geral.php" target="mainFrame"><span>RELATORIOS</span></a></li>
                            </ul>
            
      
               
                </div>
        </li>
         
        <li><a href="consul_relatorios.php" target="mainFrame"><span style="font-size:12px;">CONSULTA RELATORIOS</span></a></li>
        
        <?php if($resul['nivel'] == "3"){ ?><li class="last"><a href="consullog.php" target="mainFrame"><span style="font-size:12px;">GERENCIAL</span></a>
        <div class="columns two">
         <ul class="one">
                    <li><a href="consullog.php" target="mainFrame"><span>LOGS</span></a></li>
                     
                            </ul>
                            <ul class="two">
                            
                            <li><a href="liberaSMS.php" target="mainFrame" ><span>LIBERA SMS	</span></a></li>
                            
                            </ul>
                            
                            
                            
                            </div>
        </li>
        <?php } ?>
        
      
       <li><a href="login.php" target="_parent" class="sair" ><span style="font-size:12px;">SAIR <?php $_SESSION['sair'] = "sair"  ?></span></a></li> 
    </ul>
	
</div>



<div style="background:#CCCCCC; position:"absolute";>
</div>

</body>
</html>
