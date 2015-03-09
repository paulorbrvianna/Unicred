<?php
ob_start();
session_start();
include '../connecta.php';
include_once '../autoloader.php';

// INICIO DO BLOCO DE DOCS
$conta = $_POST['conta'];
$dataInicial = implode("-",array_reverse(explode("/",$_POST['dataInicial'])));
$dataFinal = implode("-",array_reverse(explode("/",$_POST['dataFinal'])));

$qry = mysql_query("SELECT doc_conta as conta,
		doc_origem as Fonte_Pagadora, 
		sum(valor)as total, 
		round(sum(valor/6),2) AS Media, 
		count(doc_origem) as Qnt_Docs
			FROM siscred.doc_origem
			where doc_conta = '$conta'
			and doc_data between '$dataInicial' and '$dataFinal'
			group by doc_origem
			order by Qnt_Docs desc");

$totalMediaDoc = '';
$totalValorDoc = '';
?>


	<h1 align="center">Proposta de Cr&eacute;dito - Anexo - II</h1>
	


	<div>
	<?php
	//Pegando os nomes dos campos
	echo "<table align='center' border='1'>
	<tr><td align='center'>Conta</td>
	<td align='center'>Fonte</td>
	<td align='center'>Total</td>
	<td align='center'>M&eacute;dia</td>
	<td align='center'>Qnt</td></tr>";


	/*Enquanto houver dados na tabela para serem mostrados ser� executado tudo que esta dentro do while */
	while($escrever=mysql_fetch_array($qry)){


		$totalMediaDoc += $escrever['Media'];//faz o incremento do valor.
		$totalValorDoc += $escrever['total'];


		/*Escreve cada linha da tabela*/
		echo "<tr><td>" . $escrever['conta'] .
   	 "</td><td>" . $escrever['Fonte_Pagadora'] . 
	 "</td><td>" . 'R$ '. number_format($escrever['total'] ,2, ',', '.') . 
	 "</td><td>" . 'R$ '. number_format($escrever['Media'],2, ',', '.')  . 
	 "</td><td>" . $escrever['Qnt_Docs'] ."</td></tr>";



	}/*Fim do while*/

	echo "</table>"; /*fecha a tabela apos termino de impress�o das linhas*/
	mysql_close(con);

	?>
	</div>


	<h3 align="center">
	<?php echo ' M&eacute;dia Total = R$ ' . number_format($totalMediaDoc,2, ',', '.') ;
	echo ' Valor Total = R$ ' . number_format($totalValorDoc,2, ',', '.') ;

	?>
	</h3>
	<!-- INICIO DO BLOCO DE TEDS -->
	<?php

	$qry2 = mysql_query("SELECT ted_conta AS Conta,
								ted_nome_origem AS Fonte,
								sum(ted_valor) AS Valor,
								round(sum(ted_valor/6),2) AS Media,
								count(ted_nome_origem) as Qnt_Teds
								FROM ted_origem
								WHERE ted_conta = '$conta'
								and ted_data between '$dataInicial' and '$dataFinal'
								GROUP BY ted_nome_origem
								ORDER BY Qnt_Teds DESC");

	$totalMediaTed = '';
	$totalValorTed = '';
	?>
	<h2 align="center">M&eacute;dia de Teds</h2>

	<div>
	<?php
	//Pegando os nomes dos campos
	echo "<table align='center' border='1'>
	<tr><td align='center'>Conta</td>
	<td align='center'>Fonte</td>
	<td align='center'>Total</td>
	<td align='center'>M&eacute;dia</td>
	<td align='center'>Qnt</td></tr>";


	/*Enquanto houver dados na tabela para serem mostrados ser� executado tudo que esta dentro do while */
	while($escrever2=mysql_fetch_array($qry2)){
		$totalMediaTed += $escrever2['Media'];//faz o incremento do valor.
		$totalValorTed += $escrever2['Valor'];
		/*Escreve cada linha da tabela*/
		echo "<tr><td>" . $escrever2['Conta'] .
   			 "</td><td>" . $escrever2['Fonte'] . 
			 "</td><td>" . 'R$ '.number_format($escrever2['Valor'],2, ',', '.') . 
			 "</td><td>" . 'R$ '. number_format($escrever2['Media'],2, ',', '.') . 
			 "</td><td>" . $escrever2['Qnt_Teds'] ."</td></tr>";
	}/*Fim do while*/

	echo "</table>"; /*fecha a tabela apos termino de impress�o das linhas*/
	mysql_close(con);

	?>
	</div>


	<h3 align="center">
	<?php 	echo ' Media Total = R$ ' . number_format($totalMediaTed,2, ',', '.');
			echo ' Valor Total = R$ ' .  number_format($totalValorTed,2, ',', '.');
	?>
	</h3>


<!-- INICIO DO BLOCO DE PRODU��O -->
	<?php

	$qry3 = mysql_query("select 	
			mvt_conta AS Conta, 
			mvt_nome AS Cooperado, 
			mvt_historico AS Cod_Movimentacao,		
			mvt_descricao_histoico as Desc_Movimentacao,
			mvt_documento as Documento,
			sum(mvt_valor) as Valor, 
			round(sum(mvt_valor/6),2) as Media,
			count(mvt_historico) as Qnt
		 from mvt_diario
			where mvt_natureza = 'C' 
				and mvt_conta = '$conta' 
				and mvt_historico = 657 and mvt_conta = '$conta' and mvt_data between '$dataInicial' and '$dataFinal'
				or 	mvt_historico = 641 and mvt_conta = '$conta' and mvt_data between '$dataInicial' and '$dataFinal'
		Group BY mvt_documento
		Order by Qnt DESC");

	$totalMediaProducao = '';
	$totalValorProducao = '';
	?>
	<h2 align="center">M&eacute;dia de Produ&ccedil;&atilde;o</h2>

	<div>
	<?php
	//Pegando os nomes dos campos
	echo "<table align='center' border='1'>
	<tr><td align='center'>Conta</td>
	<td align='center'>Cod.</td>
	<td align='center'>Descri&ccedil;&atilde;o</td>
	<td align='center'>Documento</td>
	<td align='center'>Valor</td>
	<td align='center'>M&eacutedia</td>
	<td align='center'>Qnt</td></tr>";


	/*Enquanto houver dados na tabela para serem mostrados ser� executado tudo que esta dentro do while */
	while($escrever3=mysql_fetch_array($qry3)){
		$totalMediaProducao += $escrever3['Media'];//faz o incremento do valor.
		$totalValorProducao += $escrever3['Valor'];
		/*Escreve cada linha da tabela*/
		echo 	"<tr><td>" . $escrever3['Conta'] .
				"</td><td>" . $escrever3['Cod_Movimentacao'] .
   				"</td><td>" . $escrever3['Desc_Movimentacao'] . 
				"</td><td>" . $escrever3['Documento'] . 
				"</td><td>" . 'R$ '.number_format($escrever3['Valor'],2, ',', '.') . 
				"</td><td>" . 'R$ '. number_format($escrever3['Media'],2, ',', '.') . 
				"</td><td>" . $escrever3['Qnt'] ."</td></tr>";
	}/*Fim do while*/

	echo "</table>"; /*fecha a tabela apos termino de impress�o das linhas*/
	mysql_close(con);
	
	?>
	</div>


	<h3 align="center">
	<?php 	echo ' Media Total = R$ ' . number_format($totalMediaProducao,2, ',', '.');
			echo ' Valor Total = R$ ' .  number_format($totalValorProducao,2, ',', '.');			
				
	?></h3>
	
	<!-- INICIO DO BLOCO DE DESCONTO DE CHEQUES -->
	<?php

	$qry4 = mysql_query("SELECT 
			tl_conta,
			tl_nome,
			tl_modalidade, 
			MD.md_descricao,
			ROUND(SUM(tl_valor_liberado * 0.9962),2) AS total2,
			round(sum(tl_valor_liberado/6 * 0.9962),2) AS media2,
			count(tl_modalidade) as Qnt_Op2	
		FROM titulos_liberados TL
		INNER JOIN modalidade MD
		ON TL.tl_modalidade = MD.md_modalidade
			WHERE tl_conta = '$conta'
			AND tl_data_liberacao BETWEEN '$dataInicial' and '$dataFinal'
			AND tl_linha_op = 'DES'");

	$totalMediaDesconto = '';
	$totalValorDesconto = '';

	
	?>
	
	<h2 align="center">M&eacute;dia de Descontos</h2>

	<div>
	<?php
	//Pegando os nomes dos campos
	echo "<table align='center' border='1'>
	<tr><td align='center'>Conta</td>
	<td align='center'>Cooperado</td>
	<td align='center'>Modalidade</td>
	<td align='center'>Descri&ccedil;&atilde;o</td>
	<td align='center'>Valor</td>
	<td align='center'>M&eacutedia</td>
	<td align='center'>Qnt</td></tr>";


	/*Enquanto houver dados na tabela para serem mostrados ser� executado tudo que esta dentro do while */
	while($escrever3=mysql_fetch_array($qry4)){
		$totalMediaDesconto += $escrever3['media2'];//faz o incremento do valor.
		$totalValorDesconto += $escrever3['total2'];
		/*Escreve cada linha da tabela*/
		echo 	"<tr><td>" . $escrever3['tl_conta'] .
				"</td><td>" . $escrever3['tl_nome'] .
   				"</td><td>" . $escrever3['tl_modalidade'] . 
				"</td><td>" . $escrever3['MD.md_descricao'] . 
				"</td><td>" . 'R$ '.number_format($escrever3['total2'],2, ',', '.') . 
				"</td><td>" . 'R$ '. number_format($escrever3['media2'],2, ',', '.') . 
				"</td><td>" . $escrever3['Qnt_Op2'] ."</td></tr>";
	}/*Fim do while*/

	echo "</table>"; /*fecha a tabela apos termino de impress�o das linhas*/
	mysql_close(con);
	
	?>
	</div>


	<h3 align="center">
	<?php 	echo ' M&eacutedia Total = R$ ' . number_format($totalMediaDesconto,2, ',', '.');
			echo ' Valor Total = R$ ' .  number_format($totalValorDesconto,2, ',', '.');
	
			?>
	</h3>	
		<?php 
				$log = new LogSistema();
				$log->logModulo = 'MEDIA ANALITICO';
				$log->logAcao = "GERAR PERIODO $dataInicial - $dataFinal";
				$log->usuarioIdUsuario = $_SESSION["idUsuarioLogado"];
				$log->logIdRegistro = $conta;
				$log->logData = date("Y-m-d");
				$log->logHora = date("H:m:s");				
				$log->save();
	?>
	
</body>
</html>
