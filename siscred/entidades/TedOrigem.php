<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "ted_origem"
 * in 2014-09-04
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package entidades
 *
 */

class TedOrigem extends Lumine_Base {

    
    public $tedUnidade;
    public $tedCooperativa;
    public $tedCliente;
    public $tedConta;
    public $tedTipoPessoa;
    public $tedNomeDestinatario;
    public $tedCpfCnpj;
    public $tedDocumento;
    public $tedNomeOrigem;
    public $tedData;
    public $tedValor;
    public $tedInfo;
    public $tedCodGerente;
    public $tedNomeGerente;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('ted_origem');
        $this->metadata()->setPackage('entidades');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('tedUnidade', 'ted_unidade', 'int', 11, array());
        $this->metadata()->addField('tedCooperativa', 'ted_cooperativa', 'varchar', 45, array());
        $this->metadata()->addField('tedCliente', 'ted_cliente', 'int', 11, array());
        $this->metadata()->addField('tedConta', 'ted_conta', 'varchar', 45, array());
        $this->metadata()->addField('tedTipoPessoa', 'ted_tipo_pessoa', 'varchar', 45, array());
        $this->metadata()->addField('tedNomeDestinatario', 'ted_nome_destinatario', 'varchar', 255, array());
        $this->metadata()->addField('tedCpfCnpj', 'ted_cpf_cnpj', 'varchar', 45, array());
        $this->metadata()->addField('tedDocumento', 'ted_documento', 'varchar', 45, array());
        $this->metadata()->addField('tedNomeOrigem', 'ted_nome_origem', 'varchar', 255, array());
        $this->metadata()->addField('tedData', 'ted_data', 'datetime', null, array());
        $this->metadata()->addField('tedValor', 'ted_valor', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('tedInfo', 'ted_info', 'text', 65535, array());
        $this->metadata()->addField('tedCodGerente', 'ted_cod_gerente', 'int', 11, array());
        $this->metadata()->addField('tedNomeGerente', 'ted_nome_gerente', 'varchar', 255, array());

        
    }

    #### END AUTOCODE


}
