<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "titulos_liberados"
 * in 2014-09-04
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package entidades
 *
 */

class TitulosLiberados extends Lumine_Base {

    
    public $tlUnidade;
    public $tlPosto;
    public $tlCooperativa;
    public $tlCliente;
    public $tlConta;
    public $tlTipoPessoa;
    public $tlNome;
    public $tlCpfCnpj;
    public $tlContrato;
    public $tlSituacao;
    public $tlModalidade;
    public $tlComplementar;
    public $tlPlano;
    public $tlDescricaoPlano;
    public $tlLinhaOp;
    public $tlValorTotal;
    public $tlValorJuros;
    public $tlValorIof;
    public $tlValorSeguro;
    public $tlValorPrincipal;
    public $tlTac;
    public $tlValorLiberado;
    public $tlQuantidadeParcelas;
    public $tlValorParcela;
    public $tlTaxaAnual;
    public $tlTaxaMensal;
    public $tlCet;
    public $tlMetodoCalculo;
    public $tlPrazoUteis;
    public $tlPrazoCorrido;
    public $tlTipoTaxa;
    public $tlTipoPrazo;
    public $tlIndexador;
    public $tlDataLiberacao;
    public $tlDataPrimeiroVct;
    public $tlDataUltimoVct;
    public $tlRestricao;
    public $tlDescricaoRestricao;
    public $tlRenda;
    public $tlUsuario;
    public $tlConvenio;
    public $tlRisco;
    public $tlFormaLiberacao;
    public $tlCreditado;
    public $tlDadosBancarios;
    public $tlComite;
    public $tlDataCreditoConta;
    public $tlComplementar2;
    public $tlCodGerente;
    public $tlNomeGerente;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('titulos_liberados');
        $this->metadata()->setPackage('entidades');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('tlUnidade', 'tl_unidade', 'int', 11, array());
        $this->metadata()->addField('tlPosto', 'tl_posto', 'int', 11, array());
        $this->metadata()->addField('tlCooperativa', 'tl_cooperativa', 'varchar', 45, array());
        $this->metadata()->addField('tlCliente', 'tl_cliente', 'int', 11, array());
        $this->metadata()->addField('tlConta', 'tl_conta', 'varchar', 45, array());
        $this->metadata()->addField('tlTipoPessoa', 'tl_tipo_pessoa', 'varchar', 45, array());
        $this->metadata()->addField('tlNome', 'tl_nome', 'varchar', 255, array());
        $this->metadata()->addField('tlCpfCnpj', 'tl_cpf_cnpj', 'varchar', 45, array());
        $this->metadata()->addField('tlContrato', 'tl_contrato', 'varchar', 45, array());
        $this->metadata()->addField('tlSituacao', 'tl_situacao', 'varchar', 45, array());
        $this->metadata()->addField('tlModalidade', 'tl_modalidade', 'varchar', 45, array());
        $this->metadata()->addField('tlComplementar', 'tl_complementar', 'varchar', 45, array());
        $this->metadata()->addField('tlPlano', 'tl_plano', 'varchar', 45, array());
        $this->metadata()->addField('tlDescricaoPlano', 'tl_descricao_plano', 'varchar', 45, array());
        $this->metadata()->addField('tlLinhaOp', 'tl_linha_op', 'varchar', 45, array());
        $this->metadata()->addField('tlValorTotal', 'tl_valor_total', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tlValorJuros', 'tl_valor_juros', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tlValorIof', 'tl_valor_iof', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tlValorSeguro', 'tl_valor_seguro', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tlValorPrincipal', 'tl_valor_principal', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tlTac', 'tl_tac', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tlValorLiberado', 'tl_valor_liberado', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tlQuantidadeParcelas', 'tl_quantidade_parcelas', 'int', 11, array());
        $this->metadata()->addField('tlValorParcela', 'tl_valor_parcela', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tlTaxaAnual', 'tl_taxa_anual', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tlTaxaMensal', 'tl_taxa_mensal', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tlCet', 'tl_cet', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tlMetodoCalculo', 'tl_metodo_calculo', 'varchar', 45, array());
        $this->metadata()->addField('tlPrazoUteis', 'tl_prazo_uteis', 'int', 11, array());
        $this->metadata()->addField('tlPrazoCorrido', 'tl_prazo_corrido', 'int', 11, array());
        $this->metadata()->addField('tlTipoTaxa', 'tl_tipo_taxa', 'varchar', 45, array());
        $this->metadata()->addField('tlTipoPrazo', 'tl_tipo_prazo', 'varchar', 45, array());
        $this->metadata()->addField('tlIndexador', 'tl_indexador', 'varchar', 45, array());
        $this->metadata()->addField('tlDataLiberacao', 'tl_data_liberacao', 'datetime', null, array());
        $this->metadata()->addField('tlDataPrimeiroVct', 'tl_data_primeiro_vct', 'datetime', null, array());
        $this->metadata()->addField('tlDataUltimoVct', 'tl_data_ultimo_vct', 'datetime', null, array());
        $this->metadata()->addField('tlRestricao', 'tl_restricao', 'varchar', 45, array());
        $this->metadata()->addField('tlDescricaoRestricao', 'tl_descricao_restricao', 'varchar', 45, array());
        $this->metadata()->addField('tlRenda', 'tl_renda', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tlUsuario', 'tl_usuario', 'varchar', 45, array());
        $this->metadata()->addField('tlConvenio', 'tl_convenio', 'varchar', 45, array());
        $this->metadata()->addField('tlRisco', 'tl_risco', 'varchar', 45, array());
        $this->metadata()->addField('tlFormaLiberacao', 'tl_forma_liberacao', 'varchar', 45, array());
        $this->metadata()->addField('tlCreditado', 'tl_creditado', 'varchar', 255, array());
        $this->metadata()->addField('tlDadosBancarios', 'tl_dados_bancarios', 'varchar', 45, array());
        $this->metadata()->addField('tlComite', 'tl_comite', 'varchar', 45, array());
        $this->metadata()->addField('tlDataCreditoConta', 'tl_data_credito_conta', 'datetime', null, array());
        $this->metadata()->addField('tlComplementar2', 'tl_complementar_2', 'varchar', 45, array());
        $this->metadata()->addField('tlCodGerente', 'tl_cod_gerente', 'int', 11, array());
        $this->metadata()->addField('tlNomeGerente', 'tl_nome_gerente', 'varchar', 45, array());

        
    }

    #### END AUTOCODE


}
