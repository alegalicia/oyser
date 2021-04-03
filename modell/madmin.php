<?php

class funciones_BD
{

    private $db;
    public function __construct()
    {
        //inicio de la conexion de la base marcamos directorio raiz
        require_once $_SERVER['DOCUMENT_ROOT'] . '/conexion/conexion.php';
        $this->db = new conexion();
    }

    //===============INICIO DE SECSION Y SELECTOR DE PERFILS===========

    public function login($usuario, $clave)
    {
        $sql = "SELECT u.*, p.*
                    FROM
                    usuarios u, perfiles p
                    WHERE
                    u.usuario = :usuario and u.clave = :clave and u.estado =1";

        $stmt = $this->db->connect()->prepare($sql);
        //==============================CONVERTIMOS A HTML
        $u = htmlentities(addslashes($usuario));
        $c = htmlentities(addslashes($clave));

        $stmt->bindValue(":usuario", $u);
        $stmt->bindValue(":clave", $c);

        $stmt->execute();

        $num = 0;

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $num++;
            $_SESSION["login"] = "ok";
            $_SESSION["id_perfil"] = $fila["id_perfil"];
            $_SESSION["nombre"] = strtoupper($fila["nombre"]);
            $_SESSION["apellido"] = strtoupper($fila["apellido"]);
            $_SESSION["dni"] = $fila["dni"];
            // if (password_verify($clave, $pass)) {
            //     $num++;
            // } else {
            //     echo 'Invalid password.';
            // }
        }

        $opcion = $_SESSION["id_perfil"];

        if ($num > 0) {
            switch ($opcion) {

                case "1":
                    //perfil superadminsitrador
                    echo "<meta http-equiv='refresh' content='0;url=../admin/index.php'>";
                    break;

                    //     case "2":
                    //         echo "";
                    //         break; // Perfil Jefe de Zona

                    //     case "3":
                    //         //echo "<meta http-equiv='refresh' content='0;url=../view/operador_menu.php'>";
                    //         break; // perfil Operador

                    //     default:
                    //         echo "<script>alert('error en el perfil...!!!');</script>";
            }
        } else {
            echo "<script>alert('Usuario inexistente o contraseña incorrecta...!!!');</script>";
            echo "<meta http-equiv='refresh' content='0;url=../index.html'>";
        }
    }
}
