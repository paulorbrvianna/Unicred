<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "log_sistema"
 * in 2014-09-04
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package entidades
 *
 */

class LogSistema extends Lumine_Base {

    
    public $idlogSistema;
    public $logModulo;
    public $logAcao;
    public $logData;
    public $usuarioIdUsuario;
    public $logIdRegistro;
    public $logHora;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('log_sistema');
        $this->metadata()->setPackage('entidades');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('idlogSistema', 'idlog_sistema', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('logModulo', 'log_modulo', 'varchar', 255, array());
        $this->metadata()->addField('logAcao', 'log_acao', 'varchar', 255, array());
        $this->metadata()->addField('logData', 'log_data', 'date', null, array());
        $this->metadata()->addField('usuarioIdUsuario', 'usuario_id_usuario', 'int', 11, array('foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'idUsuario', 'class' => 'Usuario'));
        $this->metadata()->addField('logIdRegistro', 'log_id_registro', 'varchar', 45, array());
        $this->metadata()->addField('logHora', 'log_hora', 'time', null, array());

        
    }

    #### END AUTOCODE


}
