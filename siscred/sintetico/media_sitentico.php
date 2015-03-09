<?php
ob_start();
session_start();
include '../connecta.php';
include_once '../autoloader.php';


// INICIO DO MVT
$conta = $_POST['conta'];
$dataInicial = implode("-",array_reverse(explode("/",$_POST['dataInicial'])));
$dataFinal = implode("-",array_reverse(explode("/",$_POST['dataFinal'])));

$qry = mysql_query("select mvt_conta AS Conta,
		mvt_nome AS Cooperado, 
		mvt_historico AS Cod_Movimentacao,
		mvt_descricao_histoico as Desc_Movimentacao,
		sum(mvt_valor) as Valor, 
		round(sum(mvt_valor/6),2) as Media,
		count(mvt_historico) as Qnt from mvt_diario
		
		WHERE
		mvt_natureza = 'C' 
		AND mvt_conta = '$conta'
		AND mvt_data BETWEEN  '$dataInicial' and '$dataFinal'
		AND mvt_historico IN (501,502,503,504,509,510,511,588,587,590,600,612,620,640,641,657,674,796,968,5064,5065,5071,5083,5082)  
		Group BY mvt_descricao_histoico
		ORDER BY valor");

$totalMediaMvt = '';
$totalValorMvt = '';


?>


<h1 align="center">Proposta de Credito - Anexo - I</h1>
<h2 align="center">Media de Movimenta&ccedil;&atilde;o</h2>


<div>
<?php
//Pegando os nomes dos campos
echo "<table align='center' border='1'>
	<tr><td align='center'>Conta</td>
	<td align='center'>Cooperado</td>
	<td align='center'>Cod_Movimentacao</td>
	<td align='center'>Desc_Movimentacao</td>
	<td align='center'>Total</td>
	<td align='center'>Media</td>
	<td align='center'>Qnt</td></tr>";


/*Enquanto houver dados na tabela para serem mostrados ser� executado tudo que esta dentro do while */



while($escrever=mysql_fetch_array($qry)){


	$totalMediaMvt += $escrever['Media'];//faz o incremento do valor.
	$totalValorMvt += $escrever['Valor'];



	/*Escreve cada linha da tabela*/
	echo 	"<tr>
			<td>" . $escrever['Conta'] .
   			"</td><td>" . $escrever['Cooperado'] . 
			"</td><td>" . $escrever['Cod_Movimentacao'] .	
			"</td><td>" . $escrever['Desc_Movimentacao'] .
		 	"</td><td>" . 'R$ '. number_format($escrever['Valor'] ,2, ',', '.') .
	 		"</td><td>" . 'R$ '. number_format($escrever['Media'] ,2, ',', '.') .
	 		"</td><td>" . $escrever['Qnt'] ."</td>
	 		</tr>";



}/*Fim do while*/

echo "</table>"; /*fecha a tabela apos termino de impress�o das linhas*/
mysql_close(con);

?>
</div>






<h3 align="center">
<?php 	echo ' Media Total = R$ ' . number_format($totalMediaMvt,2, ',', '.');
echo ' Valor Total = R$ ' .  number_format($totalValorMvt,2, ',', '.');

$log = new LogSistema();
$log->logModulo = 'MEDIA SINTETICO';
$log->logAcao = "GERAR PERIODO $dataInicial - $dataFinal";
$log->usuarioIdUsuario = $_SESSION["idUsuarioLogado"];
$log->logIdRegistro = $conta;
$log->logData = date("Y-m-d");
$log->logHora = date("H:m:s");

$log->save();

?>
</h3>
</body>
</html>
