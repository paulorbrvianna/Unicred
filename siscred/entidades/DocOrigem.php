<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "doc_origem"
 * in 2014-09-04
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package entidades
 *
 */

class DocOrigem extends Lumine_Base {

    
    public $compe;
    public $banco;
    public $agencia;
    public $docConta;
    public $docData;
    public $docTipo;
    public $valor;
    public $docDestinatario;
    public $docCpfCnpjDestinatario;
    public $docOrigem;
    public $docCpfCnpjOrigem;
    public $docNumero;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('doc_origem');
        $this->metadata()->setPackage('entidades');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('compe', 'compe', 'int', 11, array());
        $this->metadata()->addField('banco', 'banco', 'int', 11, array());
        $this->metadata()->addField('agencia', 'agencia', 'int', 11, array());
        $this->metadata()->addField('docConta', 'doc_conta', 'text', 65535, array('notnull' => true));
        $this->metadata()->addField('docData', 'doc_data', 'datetime', null, array());
        $this->metadata()->addField('docTipo', 'doc_tipo', 'varchar', 45, array());
        $this->metadata()->addField('valor', 'valor', 'decimal', null, array('option_list' => array('12', '2')));
        $this->metadata()->addField('docDestinatario', 'doc_destinatario', 'varchar', 255, array());
        $this->metadata()->addField('docCpfCnpjDestinatario', 'doc_cpf_cnpj_destinatario', 'varchar', 45, array());
        $this->metadata()->addField('docOrigem', 'doc_origem', 'varchar', 255, array());
        $this->metadata()->addField('docCpfCnpjOrigem', 'doc_cpf_cnpj_origem', 'varchar', 45, array());
        $this->metadata()->addField('docNumero', 'doc_numero', 'varchar', 45, array());

        
    }

    #### END AUTOCODE


}
