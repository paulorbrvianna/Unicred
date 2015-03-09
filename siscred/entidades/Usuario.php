<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "usuario"
 * in 2014-09-04
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package entidades
 *
 */

class Usuario extends Lumine_Base {

    
    public $idUsuario;
    public $nomeUsuario;
    public $pswUsuario;
    public $emailUsuario;
    public $status;
    public $fotoUsuario;
    public $logsistemas = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('usuario');
        $this->metadata()->setPackage('entidades');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('idUsuario', 'id_usuario', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('nomeUsuario', 'nome_usuario', 'varchar', 255, array());
        $this->metadata()->addField('pswUsuario', 'psw_usuario', 'varchar', 45, array());
        $this->metadata()->addField('emailUsuario', 'email_usuario', 'varchar', 255, array());
        $this->metadata()->addField('status', 'status', 'varchar', 45, array());
        $this->metadata()->addField('fotoUsuario', 'foto_usuario', 'varchar', 255, array());

        
        $this->metadata()->addRelation('logsistemas', Lumine_Metadata::ONE_TO_MANY, 'LogSistema', 'usuarioIdUsuario', null, null, null);
    }

    #### END AUTOCODE


}
