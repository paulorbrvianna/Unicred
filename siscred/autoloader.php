<?php 
ob_start();

/**  INICIALIZA OS OBJETOS DE DOMINIO DO SISTEMA  **/

/* INCLUDES */
include_once "lumine/Lumine.php";
include_once "lumine-conf.php";
include_once "util/Utilidades.php";

$obj_lumine = new Lumine_Configuration ( $lumineConfig );

function __autoload( $className )
  {
    Lumine::autoload( $className );
  }

spl_autoload_register(array('Lumine','import'));

//===================================================



?>
