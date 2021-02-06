<?php
$opcion = isset($_REQUEST['opcion']) ? $_REQUEST['opcion'] : isset($_REQUEST['opcion']);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $opcion == "enviar") {

    $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : isset($_REQUEST['nombre']);
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : isset($_REQUEST['email']);
    $telefono = isset($_REQUEST['telefono']) ? $_REQUEST['telefono'] : isset($_REQUEST['telefono']);
    $message = isset($_REQUEST['message']) ? $_REQUEST['message'] : isset($_REQUEST['message']);

    $para      = 'consultas@oyser.ar, claudioperalta1@live.com';
    $titulo    = 'Consulta realizada desde la pagina web: Nombre: ' . $nombre . " Tel: " . $telefono;


    $mensaje =  $message;

    $cabeceras = 'From: ' . $email;

    mail($para, $titulo, $mensaje, $cabeceras);
}
