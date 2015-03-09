<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "mvt_diario"
 * in 2014-09-04
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package entidades
 *
 */

class MvtDiario extends Lumine_Base {

    
    public $mvtUnidade;
    public $mvtPosto;
    public $mvtCooperativa;
    public $mvtCliente;
    public $mvtConta;
    public $mvtNome;
    public $mvtCpfCnpj;
    public $mvtModalidade;
    public $mvtHistorico;
    public $mvtDescricaoHistoico;
    public $mvtDocumento;
    public $mvtData;
    public $mvtValor;
    public $mvtSaldo;
    public $mvtSequencial;
    public $mvtNatureza;
    public $mvtTipo;
    public $mvtDescricaoTipo;
    public $mvtRetroativo;
    public $mvtContaContabil;
    public $mvtCodGerente;
    public $mvtNomeGerente;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('mvt_diario');
        $this->metadata()->setPackage('entidades');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('mvtUnidade', 'mvt_unidade', 'int', 11, array());
        $this->metadata()->addField('mvtPosto', 'mvt_posto', 'int', 11, array());
        $this->metadata()->addField('mvtCooperativa', 'mvt_cooperativa', 'varchar', 255, array());
        $this->metadata()->addField('mvtCliente', 'mvt_cliente', 'int', 11, array());
        $this->metadata()->addField('mvtConta', 'mvt_conta', 'varchar', 45, array());
        $this->metadata()->addField('mvtNome', 'mvt_nome', 'varchar', 255, array());
        $this->metadata()->addField('mvtCpfCnpj', 'mvt_cpf_cnpj', 'varchar', 45, array());
        $this->metadata()->addField('mvtModalidade', 'mvt_modalidade', 'varchar', 45, array());
        $this->metadata()->addField('mvtHistorico', 'mvt_historico', 'int', 11, array());
        $this->metadata()->addField('mvtDescricaoHistoico', 'mvt_descricao_histoico', 'varchar', 255, array());
        $this->metadata()->addField('mvtDocumento', 'mvt_documento', 'int', 11, array());
        $this->metadata()->addField('mvtData', 'mvt_data', 'datetime', null, array());
        $this->metadata()->addField('mvtValor', 'mvt_valor', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('mvtSaldo', 'mvt_saldo', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('mvtSequencial', 'mvt_sequencial', 'int', 11, array());
        $this->metadata()->addField('mvtNatureza', 'mvt_natureza', 'varchar', 45, array());
        $this->metadata()->addField('mvtTipo', 'mvt_tipo', 'varchar', 45, array());
        $this->metadata()->addField('mvtDescricaoTipo', 'mvt_descricao_tipo', 'varchar', 45, array());
        $this->metadata()->addField('mvtRetroativo', 'mvt_retroativo', 'varchar', 45, array());
        $this->metadata()->addField('mvtContaContabil', 'mvt_conta_contabil', 'text', 65535, array());
        $this->metadata()->addField('mvtCodGerente', 'mvt_cod_gerente', 'int', 11, array());
        $this->metadata()->addField('mvtNomeGerente', 'mvt_nome_gerente', 'varchar', 255, array());

        
    }

    #### END AUTOCODE


}
