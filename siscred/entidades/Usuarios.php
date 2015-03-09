<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "usuarios"
 * in 2014-07-29
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package entidades
 *
 */

class Usuarios extends Lumine_Base {

    
    public $idUsuario;
    public $nomeUser;
    public $emailUser;
    public $senhaUser;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('usuarios');
        $this->metadata()->setPackage('entidades');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('idUsuario', 'id_usuario', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('nomeUser', 'nome_user', 'varchar', 200, array('notnull' => true));
        $this->metadata()->addField('emailUser', 'email_user', 'varchar', 200, array('notnull' => true));
        $this->metadata()->addField('senhaUser', 'senha_user', 'varchar', 200, array('notnull' => true));

        
    }

    #### END AUTOCODE


}
