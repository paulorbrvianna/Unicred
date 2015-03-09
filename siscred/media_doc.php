
<?php

include_once 'autoloader.php';



// INICIO DO BLOCO DE DOCS
$conta = $_POST['conta'];
$dataIncial = implode("-",array_reverse(explode("/",$_POST['dataIncial'])));
$dataFinal = implode("-",array_reverse(explode("/",$_POST['dataFinal'])));

$qry = mysql_query("SELECT doc_conta as conta,
		doc_origem as Fonte_Pagadora, 
		sum(valor)as total, 
		round(sum(valor/6),2) AS Media, 
		count(doc_origem) as Qnt_Docs
			FROM siscred.doc_origem
			where doc_conta = '$conta'
			and doc_data between '$dataIncial' and '$dataFinal'
			group by doc_origem
			order by Qnt_Docs desc");

$totalMediaDoc = '';
$totalValorDoc = '';
?>


	<h1 align="center">Proposta de Crédito - Anexo - I</h1>
	<h2 align="center">Média de Docs</h2>


	<div>
	<?php
	//Pegando os nomes dos campos
	echo "<table align='center' border='1'>
	<tr><td align='center'>Conta</td>
	<td align='center'>Fonte</td>
	<td align='center'>Total</td>
	<td align='center'>Media</td>
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
	<?php echo ' Média Total = R$ ' . number_format($totalMediaDoc,2, ',', '.') ;
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
	<h2 align="center">Média de Teds</h2>

	<div>
	<?php
	//Pegando os nomes dos campos
	echo "<table align='center' border='1'>
	<tr><td align='center'>Conta</td>
	<td align='center'>Fonte</td>
	<td align='center'>Total</td>
	<td align='center'>Media</td>
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
	<?php 	echo ' Média Total = R$ ' . number_format($totalMediaTed,2, ',', '.');
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
	<h2 align="center">Média de Produção</h2>

	<div>
	<?php
	//Pegando os nomes dos campos
	echo "<table align='center' border='1'>
	<tr><td align='center'>Conta</td>
	<td align='center'>Cod.</td>
	<td align='center'>Descri��o</td>
	<td align='center'>Documento</td>
	<td align='center'>Valor</td>
	<td align='center'>Media</td>
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
	<?php 	echo ' Média Total = R$ ' . number_format($totalMediaProducao,2, ',', '.');
			echo ' Valor Total = R$ ' .  number_format($totalValorProducao,2, ',', '.');

	?>
	</h3>
</body>
</html>
