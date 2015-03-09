<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "gerente"
 * in 2014-09-04
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package entidades
 *
 */

class Gerente extends Lumine_Base {

    
    public $idgerente;
    public $gerenteNome;
    public $gerenteCod;
    public $gerenteStatus;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('gerente');
        $this->metadata()->setPackage('entidades');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('idgerente', 'idgerente', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('gerenteNome', 'gerente_nome', 'varchar', 255, array());
        $this->metadata()->addField('gerenteCod', 'gerente_cod', 'int', 11, array());
        $this->metadata()->addField('gerenteStatus', 'gerente_status', 'int', 11, array());

        
    }

    #### END AUTOCODE


}
