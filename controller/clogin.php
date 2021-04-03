<?php
session_start();
class clogin
{

    public function login($usuario, $clave)
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/modell/madmin.php';
        $ins = new funciones_BD();
        if ($ins->login($usuario, $clave)) {


            
        }
    }
}
