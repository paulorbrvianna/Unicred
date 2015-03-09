<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "modalidade"
 * in 2014-09-04
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package entidades
 *
 */

class Modalidade extends Lumine_Base {

    
    public $mdModalidade;
    public $mdDescricao;
    public $mdTipoModalidade;
    public $mdLinhaOp;
    public $mdNatureza;
    public $mdProduto;
    public $mdTipoPessoa;
    public $mdMetodoCalculo;
    public $mdCriterioCalculo;
    public $mdCarteira;
    public $mdCarteiraDescricao;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('modalidade');
        $this->metadata()->setPackage('entidades');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('mdModalidade', 'md_modalidade', 'varchar', 45, array());
        $this->metadata()->addField('mdDescricao', 'md_descricao', 'varchar', 255, array());
        $this->metadata()->addField('mdTipoModalidade', 'md_tipo_modalidade', 'varchar', 45, array());
        $this->metadata()->addField('mdLinhaOp', 'md_linha_op', 'varchar', 45, array());
        $this->metadata()->addField('mdNatureza', 'md_natureza', 'varchar', 45, array());
        $this->metadata()->addField('mdProduto', 'md_produto', 'varchar', 45, array());
        $this->metadata()->addField('mdTipoPessoa', 'md_tipo_pessoa', 'varchar', 45, array());
        $this->metadata()->addField('mdMetodoCalculo', 'md_metodo_calculo', 'varchar', 45, array());
        $this->metadata()->addField('mdCriterioCalculo', 'md_criterio_calculo', 'varchar', 45, array());
        $this->metadata()->addField('mdCarteira', 'md_carteira', 'varchar', 45, array());
        $this->metadata()->addField('mdCarteiraDescricao', 'md_carteira_descricao', 'varchar', 45, array());

        
    }

    #### END AUTOCODE


}
