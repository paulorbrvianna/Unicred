<?php
/**
 * [ - Classe Que Gerencia Tarefas Comuns - ]
 *
 * @package [ -- ]
 * @category [Utilidade Geral]
 * @name [Super Classe]
 * @author [Jorge Medeiros] []
 * @copyright [ - ]
 * @license [ - ] [ - ]
 * @link [ - ]
 * @version [1.0 - 1.2 - 1.3] [04/11/2010] [20/04/2012] [31/01/2013]
 * @since [Arquivo existe desde: [04/11/2010] ]
 *
 * */

class Utilidades
{

	/**
	 * @author jorge
	 * Construtor Vazio Da Classe
	 *
	 */
	public function __construct() {

		include_once 'wideimage/lib/WideImage.php';


	}

	// SEGURANÇA ===================================================================


	/**
	 * @author jorge
	 * [ Método de Tratamento anti Sql-Injection para Parâmetros Inteiros ]
	 */
	public function antiSqlInjectionInt($intEntrada) {

		$intEntrada = intval ( $intEntrada ); //elimina caractere não numérico deixando somente valores inteiros.
		return $intEntrada;
	}

	//==============================================================================


	/**
	 * @author jorge
	 * [ Método de Tratamento anti Sql-Injection para Parâmetros String ]
	 */
	public function antiSqlInjectionString($stringEntrada) {

		$badchar [1] = "drop";
		$badchar [2] = "select";
		$badchar [3] = "delete";
		$badchar [4] = "update";
		$badchar [5] = "insert";
		$badchar [6] = "alter";
		$badchar [7] = "destroy";
		$badchar [8] = "table";
		$badchar [9] = "database";
		$badchar [10] = "drop";
		$badchar [11] = "union";
		$badchar [12] = "TABLE_NAME";
		$badchar [13] = "1=1";
		$badchar [14] = 'or 1';
		$badchar [15] = 'exec';
		$badchar [16] = 'INFORMATION_SCHEMA';
		$badchar [17] = 'TABLE_NAME';
		$badchar [18] = 'like';
		$badchar [19] = 'COLUMNS';
		$badchar [20] = 'into';
		$badchar [21] = 'VALUES';

		$y = 1;
		$x = sizeof ( $badchar );

		while ( $y <= $x ) {
			$pos = strpos ( strtolower ( $stringEntrada ), strtolower ( $badchar [$y] ) );
			if ($pos !== false) {
				$stringEntrada = str_replace ( strtolower ( $badchar [$y] ), "", strtolower ( $stringEntrada ) );
			}
			$y ++;
		}

		if (empty ( $stringEntrada )) {
			echo "Tentativa de SQL Injection";
		} else {
			return $stringEntrada;
		}

	}

	//==============================================================================


	// UPLOAD DE ARQUIVOS ==========================================================


	/**
	 * @author Jorge Medeiros
	 * [ - 14/05/2011 - ]
	 * [ - 12/05/2012 - ]
	 * [ Método Para UpLoad de Imagens, Suporta .jpg .gif .bmp .
	 * [ - Caso Não Haja Necessidade de Setar o Tamanho Máx do File, Setar $tamMax = 0 - ]
	 * [ - Setar Altura e Largura da Imagem - ]
	 * [ 50000 == 50k ]
	 */
	public function uploadFotos($imagem,$diretorio,$tamMaxK,$altura,$largura) {

		$realizado = 0;
		$tamMaxK = $tamMaxK * 1000;

		// Array da imagem para Upload =================================
		$arquivoRecebido = $imagem;
		$arquivoRecebido ['nome'] = $arquivoRecebido ['name'];
		$arquivoRecebido ['tipo'] = $arquivoRecebido ['type'];
		$arquivoRecebido ['tamanho'] = $arquivoRecebido ['size'];
		//==============================================================


		// Testa Se Haverá Tamanho máximo ==============================
		if ($tamMaxK != 0) {
			if ($arquivoRecebido ['tamanho'] > $tamMaxK) {
				$realizado = 1;
			}
		}
		//==============================================================


		// Extrai o Tipo Do Arquivo ====================================
		$ext = "";

		switch ($arquivoRecebido ['tipo']) {
				
			case "image/jpeg" :
				$ext = ".jpg";
				break;
			case "image/gif" :
				$ext = ".gif";
				break;
			case "image/png" :
				$ext = ".png";
				break;
			case "application/octet-stream" :
				$ext = ".png";
				break;
			case "image/pjpeg" :
				$ext = ".jpg";
				break;
			case "application/x-shockwave-flash" :
				$ext = ".swf";
				break;
			default :
				$realizado = "";
		}
		;

		//==============================================================
		switch ($realizado) {
			case 0 :

				$uni = uniqid ();

				$arquivo = $arquivoRecebido;
				$pasta_dir = $diretorio . "/"; //diretorio dos arquivos
				//se não existir a pasta ele cria uma
				if (! file_exists ( $pasta_dir )) {
					mkdir ( $pasta_dir );
				}
				$arquivo_nome = $pasta_dir.$uni.$ext;

				// Faz o upload da imagem
				move_uploaded_file($arquivo["tmp_name"],$arquivo_nome);

				$arquivo_nomer = $arquivo_nome;

				// Redimensionamento da Imagem =================================

				$caminhoImagemThumb = substr($arquivo_nomer,0,-4);
				$caminhoImagemThumb .= "_thumb.jpg";



				$imagem = WideImage::load($arquivo_nome);
				$imagemPadrao = $imagem->resize($altura,$largura,'fill');
				$imagemThumb = $imagem->resize(75,75,'fill');

				$imagemPadrao->saveToFile($arquivo_nome);
				$imagemThumb->saveToFile($caminhoImagemThumb);
				$imagem->destroy();

				//==============================================================


				// SUCESSO = UPLOAD REALIZADO COM SUCESSO!
				$imagemRetorno["normal"] = $arquivo_nomer;
				$imagemRetorno["thumb"] = $caminhoImagemThumb;

				return $imagemRetorno;
				break;
			case 1 :
				// "ERRO 1: Tamanho Máximo de Upload Excedido!";
				return "";
				break;
			case 2 :
				// "ERRO 2: Formato de Arquivo Inválido!";
				return "";
				break;
		}

	}

	//==============================================================================


	/**
	 * @author Jorge Medeiros
	 * [ - 14/05/2011 - ]
	 * [ Método Para UpLoad de Textos, Suporta .txt .pdf .doc
	 * [ - Caso Não Haja Necessidade de Setar o Tamanho Máx do File, Setar $tamMax = 0 - ]
	 * [ 50000 == 50k ]
	 */

	public function uploadTexto($arquivo, $diretorio, $tamMaxK) {

		$realizado = 0;
		$tamMaxK = $tamMaxK * 1000;

		// Array da imagem para Upload =================================
		$arquivoRecebido = $arquivo;
		$arquivoRecebido ['nome'] = $arquivoRecebido ['name'];
		$arquivoRecebido ['tipo'] = $arquivoRecebido ['type'];
		$arquivoRecebido ['tamanho'] = $arquivoRecebido ['size'];
		//==============================================================


		// Testa Se Haverá Tamanho máximo ==============================
		if ($tamMaxK != 0) {
			if ($arquivoRecebido ['tamanho'] > $tamMaxK) {
				$realizado = 1;
			}
		}
		//==============================================================


		// Extrai o Tipo Do Arquivo ====================================
		$ext = "";

		switch ($arquivoRecebido ['tipo']) {
				
			case "application/pdf" :
				$ext = ".pdf";
				break;
			case "application/msword" :
				$ext = ".doc";
				break;
					
			default :
				$realizado = '';
		}
		;

		//==============================================================


		switch ($realizado) {
			case 0 :

				$uni = uniqid ();

				$file = $arquivoRecebido;
				$pasta_dir = $diretorio; //diretorio dos arquivos
				//se não existir a pasta ele cria uma
				if (! file_exists ( $pasta_dir )) {
					mkdir ( $pasta_dir );
				}
				$arquivo_nome = $pasta_dir . $uni . $ext;

				// Faz o upload da imagem
				move_uploaded_file ( $file ["tmp_name"], $arquivo_nome );
				$arquivo_nomer = $arquivo_nome;

				return $arquivo_nomer;

				break;
			case 1 :
				// "ERRO 1: Tamanho Máximo de Upload Excedido!";
				return 1;
				break;
			case 2 :
				// "ERRO 2: Formato de Arquivo Inválido!";
				return 2;
				break;
		}

	}

	//==============================================================================


	/**
	 * @author Jorge Medeiros
	 * [ - 14/05/2011 - ]
	 * [ Método Para UpLoad de arquivos compactados, Suporta .zip
	 * [ - Caso Não Haja Necessidade de Setar o Tamanho Máx do File, Setar $tamMax = 0 - ]
	 * [ 50000 == 50k ]
	 */

	public function uploadZip($arquivo, $diretorio, $tamMaxK) {

		$realizado = 0;
		$tamMaxK = $tamMaxK * 1000;

		// Array do arquivo para Upload =================================
		$arquivoZip = $arquivo;
		$arquivoZip ['nome'] = $arquivoZip ['name'];
		$arquivoZip ['tipo'] = $arquivoZip ['type'];
		$arquivoZip ['tamanho'] = $arquivoZip ['size'];
		//==============================================================


		// Testa Se Haverá Tamanho máximo ==============================
		if ($tamMaxK != 0) {
			if ($arquivoZip ['tamanho'] > $tamMaxK) {
				$realizado = 1;
			}
		}
		//==============================================================


		// Extrai o Tipo Do Arquivo ====================================
		$ext = "";
		switch ($arquivoZip ['tipo']) {
			case "application/zip" :
				$ext = ".zip";
				break;
			case "application/x-zip-compressed" :
				$ext = ".zip";
				break;
			case "application/force-download" :
				$ext = ".zip";
				break;
			case "application/x-zip" :
				$ext = ".zip";
				break;
					
			default :
				$realizado = 2;
		}
		;
		//==============================================================
		switch ($realizado) {
			case 0 :

				$tituloAlbum = $arquivoZip ['nome'];
				$tamanhoString = strlen ( $tituloAlbum );
				$posicao = strpos ( $tituloAlbum, '.' );
				$posicao = $tamanhoString - $posicao;
				$stringRetirada = substr ( $tituloAlbum, - $posicao );
				$tituloAlbum = @eregi_replace ( $stringRetirada, "", $tituloAlbum );

				$file = $arquivo;
				$pasta_dir = $diretorio . "/"; //diretorio dos arquivos
				//se não existir a pasta ele cria uma
				if (! file_exists ( $pasta_dir )) {
					mkdir ( $pasta_dir );
				}
				$arquivo_nome = $pasta_dir . $tituloAlbum . $ext;

				// Faz o upload do arquivo .zip
				move_uploaded_file ( $file ["tmp_name"], $arquivo_nome );
				$arquivo_nomer = $arquivo_nome;

				$retornoMetodo = array ();
				$retornoMetodo ["resultado"] = 0;
				$retornoMetodo ["string"] = $arquivo_nomer;

				return $arquivo_nomer;

				break;
			case 1 :
				$retornoMetodo = array ();
				$retornoMetodo ["resultado"] = 1;
				$retornoMetodo ["string"] = "ERRO 1: Tamanho Máximo de Upload Excedido!";
				return 1;
				break;
			case 2 :
				$retornoMetodo = array ();
				$retornoMetodo ["resultado"] = 2;
				$retornoMetodo ["string"] = "ERRO 2: Formato de Arquivo Inválido!";
				return 2;
				break;
		}

	}

	//==============================================================================


	/**
	 * @author Jorge Medeiros
	 * [ - 14/05/2011 - ]
	 * [ Método que lê um arquivo .zip e retorna um array dos nomes dos arquivos contidos
	 * [ - Caso Não Haja Necessidade de Setar o Tamanho Máx do File, Setar $tamMax = 0 - ]
	 * [ 50000 == 50k ]
	 */

	public function zipToArray($path) {

		// Instancia a classe
		$zip = new ZipArchive ();

		// Tenta abrir o zip
		if ($zip->open ( $path )) {
				
			// Recupera o numero de arquivos do zip
			$num_files = $zip->numFiles;
				
			// percorre os arquivos pegando os nomes e colocando em um array
			for($i = 0; $i <= ($num_files) - 1; $i ++) {
				$saida [] = $zip->getNameestrutura ( $i );
			}
				
			// fecha a conexão
			$zip->close ();
				
			// Retora o array para ser manipulado
			return $saida;

		}

		return false;

	}
	//==============================================================================


	/**
	 * @author Jorge Medeiros
	 * [ Método Para Verificar se um campo tipo $_FILE está vazio ]
	 * [ - 26/02/2011 - ]
	 * [  ]
	 */

	public function verificarCampoFileVazio($arquivoCampo) {

		$file ['tamanho'] = $arquivoCampo;
		if ($file ['tamanho'] <= 1) {
			$vazio = 1;
		} elseif ($file ['tamanho'] > 0) {
			$vazio = 0;
		}
		return $vazio;

	}

	//==============================================================================


	/**
	 * @author Jorge Medeiros
	 * [ Método Para Verificar extrair um arquivo .zip para um determinado diretorio ]
	 * [ - 26/02/2011 - ]
	 * [  ]
	 */

	public function unzip($path, $pathunzip) {

		//Instancia a classe do Zip
		$zip = new ZipArchive ();

		//Tenta abrir o zip
		if ($zip->open ( $path )) {
			$return = $zip->extractTo ( $pathunzip ); // executa o unzip
			$zip->close (); // fecha a coneção com o .zip
		} else {
			echo "O arquivo não pode ser aberto.";
		}
	}
	//==============================================================================
	// TRATAMENTO DE DATAS =========================================================


	/**
	 * @author jorge
	 * [ - Método Para Exibição De uma Data No Formato Brasileiro -
	 *
	 */

	public function formataData($data) {
		if(isset($data) && !empty($data)){
			$dataFormatada = date ( "d-m-Y", strtotime ( $data ) );
			return $dataFormatada;
		}else{
			return " - ";
		}
	}

	/**
	 * @author jorge
	 * [ - Método Para Explosão de Data, gerando DIA - MES - ANO  - ]
	 * [ - Padrão de Saída Dia[1],Mês[2],Ano[3] -  ]
	 */

	public function explodeDataFormatando($dataEntrada) {
		$dataExplodida = explode ( "-", $dataEntrada );

		$data ["ano"] = $dataExplodida [2];
		$data ["mes"] = $dataExplodida [1];
		$data ["dia"] = $dataExplodida [0];

		return $data ["ano"]."-".$data ["mes"]."-".$data ["dia"];

	}

	/**
	 * @author jorge
	 * [ - Método para tratamento de datas com o a máscara de formatação  - ]
	 * [ - Padrão de Saida  -  ]
	 */

	public function tratarData($dataEntrada) {

		$dataExplodida = explode ( "-", $dataEntrada );

		$data ["ano"] = $dataExplodida [2];
		$data ["mes"] = $dataExplodida [1];
		$data ["dia"] = $dataExplodida [0];

		$dataTratada =  $data[1]."-".$data[2]."-".$data[3];

		return $dataTratada;

	}

	/**
	 * @author jorge
	 * [ - Método Para Retornar String de Meses  - ]
	 * [ - String Tipo 1 == Abreviatura / String Tipo 2 == Completo -  ]
	 */

	public function selectMesesAbreviado($tipoString, $mes) {

		switch ($mes) {
			default :
				echo "";
				break;
			case 1 :
				echo "jan";
				break;
			case 2 :
				echo "fev";
				break;
			case 3 :
				echo "mar";
				break;
			case 4 :
				echo "abr";
				break;
			case 5 :
				echo "mai";
				break;
			case 5 :
				echo "jun";
				break;
			case 7 :
				echo "jul";
				break;
			case 8 :
				echo "ago";
				break;
			case 9 :
				echo "set";
				break;
			case 10 :
				echo "out";
				break;
			case 11 :
				echo "nov";
				break;
			case 12 :
				echo "dez";
				break;

		}

	}

	//================================================================================


	/**
	 * @author jorge
	 * [ - Método Para Retornar um SELECT de Estados   - ]
	 * [ - String Tipo 1 == Abreviatura / String Tipo 2 == Completo -  ]
	 */

	public function selectEstados($estadoSelecionado){
		?>
		<option value="">Estados</option>
		<option value="AC" <?php if($estadoSelecionado=="AC"){echo "selected='selected'"; } ?>>Acre</option>
		<option value="AL" <?php if($estadoSelecionado=="AL"){echo "selected='selected'"; } ?>>Alagoas</option>
		<option value="AM" <?php if($estadoSelecionado=="AM"){echo "selected='selected'"; } ?>>Amazonas</option>
		<option value="AP" <?php if($estadoSelecionado=="AP"){echo "selected='selected'"; } ?>>Amapá</option>
		<option value="BA" <?php if($estadoSelecionado=="BA"){echo "selected='selected'"; } ?>>Bahia</option>
		<option value="CE" <?php if($estadoSelecionado=="CE"){echo "selected='selected'"; } ?>>Ceará</option>
		<option value="DF" <?php if($estadoSelecionado=="DF"){echo "selected='selected'"; } ?>>Distrito Federal</option>
		<option value="ES" <?php if($estadoSelecionado=="ES"){echo "selected='selected'"; } ?>>Espírito Santo</option>
		<option value="GO" <?php if($estadoSelecionado=="GO"){echo "selected='selected'"; } ?>>Goiás</option>
		<option value="MA" <?php if($estadoSelecionado=="MA"){echo "selected='selected'"; } ?>>Maranhão</option>
		<option value="MT" <?php if($estadoSelecionado=="MT"){echo "selected='selected'"; } ?>>Mato Grosso</option>
		<option value="MS" <?php if($estadoSelecionado=="MS"){echo "selected='selected'"; } ?>>Mato Grosso do Sul</option>
		<option value="MG" <?php if($estadoSelecionado=="MG"){echo "selected='selected'"; } ?>>Minas Gerais</option>
		<option value="PA" <?php if($estadoSelecionado=="PA"){echo "selected='selected'"; } ?>>Pará</option>
		<option value="PB" <?php if($estadoSelecionado=="PB"){echo "selected='selected'"; } ?>>Paraíba</option>
		<option value="PR" <?php if($estadoSelecionado=="PR"){echo "selected='selected'"; } ?>>Paraná</option>
		<option value="PE" <?php if($estadoSelecionado=="PE"){echo "selected='selected'"; } ?>>Pernambuco</option>
		<option value="PI" <?php if($estadoSelecionado=="PI"){echo "selected='selected'"; } ?>>Piauí</option>
		<option value="RJ" <?php if($estadoSelecionado=="RJ"){echo "selected='selected'"; } ?>>Rio de Janeiro</option>
		<option value="RN" <?php if($estadoSelecionado=="RN"){echo "selected='selected'"; } ?>>Rio Grande do Norte</option>
		<option value="RO" <?php if($estadoSelecionado=="RO"){echo "selected='selected'"; } ?>>Rondônia</option>
		<option value="RS" <?php if($estadoSelecionado=="RS"){echo "selected='selected'"; } ?>>Rio Grande do Sul</option>
		<option value="RR" <?php if($estadoSelecionado=="RR"){echo "selected='selected'"; } ?>>Roraima</option>
		<option value="SC" <?php if($estadoSelecionado=="SC"){echo "selected='selected'"; } ?>>Santa Catarina</option>
		<option value="SE" <?php if($estadoSelecionado=="SE"){echo "selected='selected'"; } ?>>Sergipe</option>
		<option value="SP" <?php if($estadoSelecionado=="SP"){echo "selected='selected'"; } ?>>São Paulo</option>
		<option value="TO" <?php if($estadoSelecionado=="TO"){echo "selected='selected'"; } ?>>Tocantins</option>
		<?php
	}

	/**
	 * @author jorge
	 * [ - Método Para Retornar um SELECT de MESES   - ]
	 * [ - String Tipo 1 == Abreviatura / String Tipo 2 == Completo -  ]
	 */

	public function selectMeses($mesSelecionado){
		?>
		<option value="">Mês</option>
		<option value="JANEIRO" <?php if($mesSelecionado=="JANEIRO"){echo "selected='selected'"; } ?>>JANEIRO</option>
		<option value="FEVEREIRO" <?php if($mesSelecionado=="FEVEREIRO"){echo "selected='selected'"; } ?>>FEVEREIRO</option>
		<option value="MARÇO" <?php if($mesSelecionado=="MARÇO"){echo "selected='selected'"; } ?>>MARÇO</option>
		<option value="ABRIL" <?php if($mesSelecionado=="ABRIL"){echo "selected='selected'"; } ?>>ABRIL</option>
		<option value="MAIO" <?php if($mesSelecionado=="MAIO"){echo "selected='selected'"; } ?>>MAIO</option>
		<option value="JUNHO" <?php if($mesSelecionado=="JUNHO"){echo "selected='selected'"; } ?>>JUNHO</option>
		<option value="JULHO" <?php if($mesSelecionado=="JULHO"){echo "selected='selected'"; } ?>>JULHO</option>
		<option value="AGOSTO" <?php if($mesSelecionado=="AGOSTO"){echo "selected='selected'"; } ?>>AGOSTO</option>
		<option value="SETEMBRO" <?php if($mesSelecionado=="SETEMBRO"){echo "selected='selected'"; } ?>>SETEMBRO</option>
		<option value="OUTUBRO" <?php if($mesSelecionado=="OUTUBRO"){echo "selected='selected'"; } ?>>OUTUBRO</option>
		<option value="NOVEMBRO" <?php if($mesSelecionado=="NOVEMBRO"){echo "selected='selected'"; } ?>>NOVEMBRO</option>
		<option value="DEZEMBRO" <?php if($mesSelecionado=="DEZEMBRO"){echo "selected='selected'"; } ?>>DEZEMBRO</option>
		<?php
	}
	
	/**
	 * @author jorge
	 * [ - Método Para Retornar um SELECT de MESES   - ]
	 * [ - String Tipo 1 == Abreviatura / String Tipo 2 == Completo -  ]
	 */

	public function selectMesesNumeral($mesSelecionado){
		?>
		<option value="">Mês</option>
		<option value="01" <?php if($mesSelecionado=="01"){echo "selected='selected'"; } ?>>JANEIRO</option>
		<option value="02" <?php if($mesSelecionado=="02"){echo "selected='selected'"; } ?>>FEVEREIRO</option>
		<option value="03" <?php if($mesSelecionado=="03"){echo "selected='selected'"; } ?>>MARÇO</option>
		<option value="04" <?php if($mesSelecionado=="04"){echo "selected='selected'"; } ?>>ABRIL</option>
		<option value="05" <?php if($mesSelecionado=="05"){echo "selected='selected'"; } ?>>MAIO</option>
		<option value="06" <?php if($mesSelecionado=="06"){echo "selected='selected'"; } ?>>JUNHO</option>
		<option value="07" <?php if($mesSelecionado=="07"){echo "selected='selected'"; } ?>>JULHO</option>
		<option value="08" <?php if($mesSelecionado=="08"){echo "selected='selected'"; } ?>>AGOSTO</option>
		<option value="09" <?php if($mesSelecionado=="09"){echo "selected='selected'"; } ?>>SETEMBRO</option>
		<option value="10" <?php if($mesSelecionado=="10"){echo "selected='selected'"; } ?>>OUTUBRO</option>
		<option value="11" <?php if($mesSelecionado=="11"){echo "selected='selected'"; } ?>>NOVEMBRO</option>
		<option value="12" <?php if($mesSelecionado=="12"){echo "selected='selected'"; } ?>>DEZEMBRO</option>
		<?php
	}




	// TRATAMENTO DE STRINGS =========================================================


	/**
	 * @author jorge
	 * [ - Método Que Trata String Vazias, não permitindo sua exibição  -
	 *
	 */

	public function tratarStringVazia($stringEntrada) {

		if(!empty($stringEntrada)){
			echo $stringEntrada;
		}
	}


	/**
	 * @author jorge
	 * [ - Método Para Retirar qualquer tag HTML Da String  -
	 *
	 */

	public function retirarHtml($stringEntrada) {
		$stringTratada = strip_tags ( $stringEntrada );
		return $stringTratada;
	}

	/**
	 * @author jorge
	 * [ - Método Para Retirar qualquer R$ Da String  -
	 *
	 */

	public function retirarCifrao($stringEntrada) {
		$stringTratada = substr($stringEntrada,2);
		return $stringTratada;
	}

	/**
	 * @author jorge
	 * [ - Método Para Formatar qualquer R$ Da String  -
	 *
	 */
	public function formatarMoeda($get_valor) {
		$get_valor = substr($get_valor,2);
		$source = array('.', ',');
		$replace = array('', '.');
		$valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
		return $valor; //retorna o valor formatado para gravar no banco
      }


      /**
       * @author jorge
       * [ - Método Para formatar valores decimal para Formato Brasileiro -
       *
       */

      public function formatarMoedaBr($num) {
      	if(isset($num) && !empty($num)){
      		$valorFormatado = 'R$ ' . number_format($num, 2, ',', '.');
      		return $valorFormatado;
      	}else{
      		return " - ";
      	}
      }
      
      /**
       * @author jorge
       * [ - Método Para Formatar qualquer R$ Da String  -
       *
       */
      public function moeda($get_valor) {
      	$get_valor = substr($get_valor,2);
      	$source = array('.', ',');
      	$replace = array('', '.');
      	$valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
      	return $valor; //retorna o valor formatado para gravar no banco
      }
      
      /**

      /**
       * @author jorge
       * [ - Método Para Retirar Determinada tag HTML Da String  -
       *
       */

    public function retiraHtmlDeterminado($stringEntrada, $tag) {
		$stringTratada = strip_tags ( $stringEntrada, $tag );
		return $stringTratada;

	}

	/**
	 * @author jorge
	 * [ - Método Para Retirar Acentos de String  -
	 *
	 */
	public function removerAcento($frase){
	$frase = str_replace(
		array("à", "á", "â", "ã", "ä", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ò", "ó", "ô", "õ", "ö", "ù", "ú", "û", "ü", "À", "Á", "Â", "Ã", "Ä", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ò", "Ó", "Ô", "Õ", "Ö", "Ù", "Ú", "Û", "Ü", "ç", "Ç", "ñ", "Ñ", " ", "-", "?", "!", "."),
		array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "c", "C", "n", "N", " ", " ", " ", " ", " "), $frase);

		return $frase;
	}
	
	/**
	 * @author jorge
	 * [ - Método Para Retirar Acentos de String  -
	 *
	 */
	public function imprimirSemAcento($frase){
		$frase = str_replace(
		array("à", "á", "â", "ã", "ä", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ò", "ó", "ô", "õ", "ö", "ù", "ú", "û", "ü", "À", "Á", "Â", "Ã", "Ä", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ò", "Ó", "Ô", "Õ", "Ö", "Ù", "Ú", "Û", "Ü", "ç", "Ç", "ñ", "Ñ", " ", "-", "?", "!", "."),
		array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "c", "C", "n", "N", " ", " ", " ", " ", " "), $frase);

		echo $frase;
	}

	/**
	 * @author jorge
	 * [ - Método Para Limitar Tamanho de exibição de String  -
	 *
	 */
	public function limitarTamanhoString($stringEntrada, $num) {

		$e = explode ( " ", $stringEntrada );
		$cont = count ( $e );

		// Corrigindo bug do fckeditor
		$check = substr ( $stringEntrada, 0, 3 );
		if ($check == "<p>") {
			$compl = "</p>";
		} else
			$compl = "";

		if ($cont > $num) {
			for($i = 0; $i < $num; $i ++) {
				if (($i + 1) == $num) {
					$res .= $e [$i] . "..." . $compl;
				} else {
					$res .= $e [$i] . " ";
				}
			}
		} else {
			$res = $stringEntrada;
		}
		return $res;

	}

	//================================================================================


	// PAGINAÇÃO DE REGISTROS=========================================================


	/**
	 * @author jorge
	 * [ - Método Para Paginar Registros de Uma Listagem -
	 * [20/04/2012]
	 * $total = quantidade total de registros encontrados
	 * $qtdeLinha = Quantidade de linhas que serão exibidas por pagina
	 * $pagina = numero da pagina atual, pega o valor via GET
	 * $action = representa a variavel de navegação
	 */

	public function paginar($total, $qtdeLinha, $pagina,$action) {
		
		$num = ceil ( $total / $qtdeLinha );
		// Recebe a id do registro e seta para a variavel da url
		if ($_GET ["id"] != "") {
			$qryStr = "&id=" . $_GET ["id"];
		} else {
			$qryStr = "";
		}
		//======================================================

		// Se o numero da pagina for <=4 conta as paginas exibidas
		if ($pagina <= 4) {
			$ini = 1;
			$fim = min ( $num, 5 );
		} elseif ($pagina >= $num - 5) {
			$ini = max ( $num - 5, 1 );
			$fim = $num;
		} else {
			$ini = $pagina - 4;
			$fim = $pagina + 4;
		}

		//========================================================

		if (isset ( $_POST ["busca"] )) {
			$busca = "busca=" . $_POST ["busca"];
		} else if (isset ( $_GET ["busca"] )) {
			$busca = "busca=" . $_GET ["busca"];
		} else {
			$busca = "";
		}
		$paginas = "";

		if ($num > 1) {
			//$paginas .= "<div class='pagination'>";
		}
		if ($pagina != 1) {
			//$paginas .= "<a href='estrutura.php?pg=$action&pagina=1'><<</a>";
		} else
			$paginas .= "";
		for($i = $ini; $i <= $fim; $i ++) {
			if ($i == $pagina) {
				if ($i != $num || $num != 1)
					$paginas .= "<a href='estrutura.php?pg=$action&pagina=$i' style='font-weight:bold; display:inline-block; padding:4px 6px;margin-right:2px;'>$i</a>";
			} else {
				$paginas .= "<a href='estrutura.php?pg=$action&pagina=$i' style='font-weight:bold; display:inline-block; padding:4px 6px;margin-right:2px;'>$i</a>";
			}
		}

		if ($pagina != $num && $num != 0){
			//$paginas .= "<a title='&Uacute;ltima P&aacute;gina' onclick='paginacao($i)'>>></a>";
			}
		else
			$paginas .= "";
		if ($num > 1)
				
			return $paginas;
	}



	//==============================================================

	
	/**
	 * @author jorge
	 * [ - Método Para Paginar Registros de Uma Listagem -
	 * [20/04/2012]
	 * $total = quantidade total de registros encontrados
	 * $qtdeLinha = Quantidade de linhas que serão exibidas por pagina
	 * $pagina = numero da pagina atual, pega o valor via GET
	 * $action = representa a variavel de navegação
	 */
	
	public function paginarSolicitacao($total, $qtdeLinha, $pagina,$action,$post) {
	
		$num = ceil ( $total / $qtdeLinha );
		// Recebe a id do registro e seta para a variavel da url
		if ($_GET ["id"] != "") {
			$qryStr = "&id=" . $_GET ["id"];
		} else {
			$qryStr = "";
		}
		//======================================================
	
		// Se o numero da pagina for <=4 conta as paginas exibidas
		if ($pagina <= 4) {
			$ini = 1;
			$fim = min ( $num, 5 );
		} elseif ($pagina >= $num - 5) {
			$ini = max ( $num - 5, 1 );
			$fim = $num;
		} else {
			$ini = $pagina - 4;
			$fim = $pagina + 4;
		}
	
		//========================================================
	
		//TRATAMENTO DO POST
		
		extract($post);
		
		
		//========================================================
		
		if (isset ( $_POST ["busca"] )) {
			$busca = "busca=" . $_POST ["busca"];
		} else if (isset ( $_GET ["busca"] )) {
			$busca = "busca=" . $_GET ["busca"];
		} else {
			$busca = "";
		}
		$paginas = "";
	
		if ($num > 1) {
			//$paginas .= "<div class='pagination'>";
		}
		if ($pagina != 1) {
			//$paginas .= "<a href='estrutura.php?pg=$action&pagina=1'><<</a>";
		} else
			$paginas .= "";
		for($i = $ini; $i <= $fim; $i ++) {
			if ($i == $pagina) {
				if ($i != $num || $num != 1)
					$paginas .= "<a href='estrutura.php?pg=$action&pagina=$i&idSolicitacao=$idSolicitacao&item=$item&beneficiarioIdbeneficiario=$beneficiarioIdbeneficiario&solicitacaodata1=$solicitacaodata1&solicitacaodata2=$solicitacaodata2&idmunicipio=$idmunicipio&tipoSituacao=$tipoSituacao' style='font-weight:bold; display:inline-block; padding:4px 6px;margin-right:2px;'>$i</a>";
			} else {
				$paginas .= "<a href='estrutura.php?pg=$action&pagina=$i&idSolicitacao=$idSolicitacao&item=$item&beneficiarioIdbeneficiario=$beneficiarioIdbeneficiario&solicitacaodata1=$solicitacaodata1&solicitacaodata2=$solicitacaodata2&idmunicipio=$idmunicipio&tipoSituacao=$tipoSituacao' style='font-weight:bold; display:inline-block; padding:4px 6px;margin-right:2px;'>$i</a>";
			}
		}
	
		if ($pagina != $num && $num != 0){
			//$paginas .= "<a title='&Uacute;ltima P&aacute;gina' onclick='paginacao($i)'>>></a>";
		}
		else
			$paginas .= "";
		if ($num > 1)
	
			return $paginas;
	}
	
	
	
	//==============================================================
	
	
	
	/**
	 * @author jorge
	 * [ - Método Para Imprimir Valores Financeiros Por Extenso -
	 * [20/04/2012]
	 */
	
	
	public function imprimirValorPorExtenso($valor = 0, $maiusculas = false) {

		$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
		$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões",
		"quatrilhões");

		$c = array("", "cem", "duzentos", "trezentos", "quatrocentos",
		"quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
		$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta",
		"sessenta", "setenta", "oitenta", "noventa");
		$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze",
		"dezesseis", "dezesete", "dezoito", "dezenove");
		$u = array("", "um", "dois", "tres", "quatro", "cinco", "seis",
		"sete", "oito", "nove");

		$z = 0;
		$rt = "";

		$valor = number_format($valor, 2, ".", ".");
		$inteiro = explode(".", $valor);
		for($i=0;$i<count($inteiro);$i++)
			for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
			$inteiro[$i] = "0".$inteiro[$i];

		$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
		for ($i=0;$i<count($inteiro);$i++) {
		$valor = $inteiro[$i];
		$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
		$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
		$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

		$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&
		$ru) ? " e " : "").$ru;
		$t = count($inteiro)-1-$i;
		$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
		if ($valor == "000")$z++; elseif ($z > 0) $z--;
		if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
		if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) &&
		($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
		}

		if(!$maiusculas){
		return($rt ? $rt : "zero");
		} else {

		if ($rt) $rt=ereg_replace(" E "," e ",ucwords($rt));
		return (($rt) ? ($rt) : "Zero");
		}

}


//==============================================================


public function detectarSo($stringEntrada) {

$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (preg_match("/Windows 95/i", $user_agent))     		$so = "Windows 95";
else if (preg_match("/Win95/i", $user_agent))    		$so = "Windows 95";
else if (preg_match("/Win98/i", $user_agent))    		$so = "Windows 98";
else if (preg_match("/Windows ME/i", $user_agent))    	$so = "Windows ME";
else if (preg_match("/Windows 98/i", $user_agent))    	$so = "Windows 98";
else if (preg_match("/Win 9x 4.90/i", $user_agent)) 	$so = "Windows ME";
else if (preg_match("/Windows 2000/i", $user_agent)) 	$so = "Windows 2000";
else if (preg_match("/Windows NT 5.0/i", $user_agent)) 	$so = "Windows 2000";
else if (preg_match("/Windows XP/i", $user_agent))    	$so = "Windows XP";
else if (preg_match("/Windows NT 5.1/i", $user_agent)) 	$so = "Windows XP";
else if (preg_match("/Windows NT 5.2/i", $user_agent)) 	$so = "Windows XP x64 Edition";
else if (preg_match("/Windows NT 6.0/i", $user_agent)) 	$so = "Windows Vista";
else if (preg_match("/Windows NT/i", $user_agent)) 		$so = "Windows NT";
else if (preg_match("/WinNT/i", $user_agent))        	$so = "Windows NT";
else if (preg_match("/Windows CE/i", $user_agent))     	$so = "Windows Mobile";
else if (preg_match("/Linux/i", $user_agent))          	$so = "Linux";
else if (preg_match("/FreeBSD/i", $user_agent))    		$so = "BSD";
else if (preg_match("/OpenBSD/i", $user_agent))    		$so = "BSD";
else if (preg_match("/BSD/i", $user_agent))    			$so = "BSD";
else if (preg_match("/SunOS/i", $user_agent))          	$so = "Solaris";
else if (preg_match("/Mac OS X/i", $user_agent))       	$so = "Mac OS X";
else if (preg_match("/Mac_PowerPC/i", $user_agent)) 	$so = "Mac OS";
else if (preg_match("/Macintosh/i", $user_agent))      	$so = "Mac OS";
else if (preg_match("/Mac/i", $user_agent))    			$so = "Mac OS";
else 													$so = "Desconhecido";

return $so;

}


public function detectarBrowser($stringEntrada) {

	$useragent = $stringEntrada;
 
  if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'IE';
  } elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Opera';
  } elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Firefox';
  } elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Chrome';
  } elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Safari';
  } else {
    // browser not recognized!
    $browser_version = 0;
    $browser= 'other';
  }
  return $browser;

}


/**
 * @author Jorge 
 * [ - Método Para Validação de CPF -
 * [20/04/2012]
 */


function validaCPF($cpf = null) {

	// Verifica se um número foi informado
	if(empty($cpf)) {
		return false;
	}

	// Elimina possivel mascara
	$cpf = ereg_replace('[^0-9]', '', $cpf);
	$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	 
	// Verifica se o numero de digitos informados é igual a 11
	if (strlen($cpf) != 11) {
		return false;
	}
	// Verifica se nenhuma das sequências invalidas abaixo
	// foi digitada. Caso afirmativo, retorna falso
	else if ($cpf == '00000000000' ||
	$cpf == '11111111111' ||
	$cpf == '22222222222' ||
	$cpf == '33333333333' ||
	$cpf == '44444444444' ||
	$cpf == '55555555555' ||
	$cpf == '66666666666' ||
	$cpf == '77777777777' ||
	$cpf == '88888888888' ||
	$cpf == '99999999999') {
		return false;
		// Calcula os digitos verificadores para verificar se o
		// CPF é válido
	} else {
		 
		for ($t = 9; $t < 11; $t++) {
			 
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				return false;
			}
		}

		return true;
	}
}






//================================================================================
} //fim da classe
?>






















