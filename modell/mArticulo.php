<?php
//INSERT INTO `jacinta`.`web_admin_productos` (`nombre_producto`, `descripcion_producto`, `mercado_pago`, `precio`, `fechaVencimiento`, `cantidad_alerta`, `talla`, `color`, `imagen_codigo`, `usuario_crea`, `fecha_cracion`, `usuario_modifica`, `fecha_modificacion`, `estado`) VALUES ('nom', 'drsss', 'merca', 'pre', '01-01-2009', '1', '12', '222222', 'asdad', '1', '02-02-2019', '1', '20-20-2011', '1');

class funciones_BD_articulo
{
    private $db;
    public function __construct()
    {
        //inicio de la conexion de la base marcamos directorio raiz
        require_once $_SERVER['DOCUMENT_ROOT'] . '/conexion/conexion.php';
        $this->db = new conexion();
    }

    // lista de personas activas
    public function ingresarArticulo($nombrePro, $descripcionPro, $mercadoPago, $precio, $fechaVencimiento, $cantidadAlerta, $talla, $color, $archivo, $archivo1, $archivo2, $archivo3, $cantidad, $segmento, $filtro, $ubicacion, $subcategoria)
    {
        $id =  $_SESSION["dni"];

        $sql = ("INSERT INTO `web_admin_productos` (id_web_admin_productos, 
        `nombre_producto`, `descripcion_producto`, `mercado_pago`, `precio`,
        `fechaVencimiento`, `cantidad`, `cantidad_alerta`, `talla`,`color`, 
        `imagen_codigo`, `imagen1_codigo`,`imagen2_codigo`,`imagen3_codigo`,
        `filtro`,`segmento`,`ubicacion`, `subcategoria`, `usuario_crea`, `fecha_cracion`, `usuario_modifica`, 
        `fecha_modificacion`, `estado`) 

    VALUES (null, :nombrePro, :descripcionPro, :mercadoPago, :precio, :fechaVencimiento, 
            :cantidad, :cantidadAlerta, :talla, :color, :archivo, :archivo1, :archivo2, :archivo3,
        :filtro, :segmento, :ubicacion, :subcategoria, :id, now(), '1', now(), :id);");
        //$sentencia->bindParam(1, $valor_devuleto, PDO::PARAM_STR, 4000);

        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(":nombrePro", $nombrePro);
        $stmt->bindValue(":descripcionPro", $descripcionPro);
        $stmt->bindValue(":mercadoPago", $mercadoPago);
        $stmt->bindValue(":precio", $precio);
        $stmt->bindValue(":fechaVencimiento", $fechaVencimiento);
        $stmt->bindValue(":cantidadAlerta", $cantidadAlerta);
        $stmt->bindValue(":cantidad", $cantidad);
        $stmt->bindValue(":talla", $talla);
        $stmt->bindValue(":color", $color);
        $stmt->bindValue(":archivo", $archivo);
        $stmt->bindValue(":archivo1", $archivo1);
        $stmt->bindValue(":archivo2", $archivo2);
        $stmt->bindValue(":archivo3", $archivo3);
        $stmt->bindValue(":segmento", $segmento);
        $stmt->bindValue(":filtro", $filtro);
        $stmt->bindValue(":ubicacion", $ubicacion);
        $stmt->bindValue(":id", $id);  
        $stmt->bindValue(":subcategoria", $subcategoria);
        $stmt->execute();

        //====regresa cantidad de redultdos
        $cuentaFila = $stmt->rowCount();
        $cuentaColumna = $stmt->columnCount();

        //===========capturamos errores
        $error[] = $stmt->errorCode();

        if (empty($error) && $cuentaFila == 0) {
            if ($cuentaFila == 0) {
                echo "Sin Resultados errors: ";
                return false;
            }
            //====cod de error
            print_r($stmt->errorInfo());
        } else {
            return true;
        }
    }

    //============0ultimo articulo
    public function ultimoIdProducto()
    {
        $sql = ("SELECT MAX(id_web_admin_productos) as id FROM web_admin_productos");

        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();

        //====regresa cantidad de redultdos
        $cuentaFila = $stmt->rowCount();
        $cuentaColumna = $stmt->columnCount();

        //===========capturamos errores
        $error[] = $stmt->errorCode();

        if (empty($error) && $cuentaFila == 0) {
            if ($cuentaFila == 0) {
                echo "Sin Resultados errors: ";
                return false;
            }
            //====cod de error
            print_r($stmt->errorInfo());
        } else {
            // output data of each row
            $datos = array();
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $datos[] = $fila;
            }
            return $datos;
        }
    }


    public function ingresarColor($colorEnviar, $idProducto)
    {
        $id =  $_SESSION["dni"];

        $sql = ("INSERT INTO `web_admin_productos_colores` 
        (`id_web_admin_productos_colores`, `id_web_admin_productos`,
         `color`, `fecha_crea`, `usuario_crea`, `estado`) 
         VALUES (NULL, :idProducto, :colorEnviar, NOW(), :id, '1')");
        //$sentencia->bindParam(1, $valor_devuleto, PDO::PARAM_STR, 4000);

        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":colorEnviar", $colorEnviar);
        $stmt->bindValue(":idProducto", $idProducto);
        $stmt->execute();

        //====regresa cantidad de redultdos
        $cuentaFila = $stmt->rowCount();
        $cuentaColumna = $stmt->columnCount();

        //===========capturamos errores
        $error[] = $stmt->errorCode();

        if (empty($error) && $cuentaFila == 0) {
            if ($cuentaFila == 0) {
                echo "Sin Resultados errors: ";
                return false;
            }
            //====cod de error
            print_r($stmt->errorInfo());
        } else {
            return true;
        }
    }

    public function ingresarTallas($tallasEnviar, $idProducto)
    {
        $id =  $_SESSION["dni"];

        $sql = ("INSERT INTO `web_admin_productos_tallas` 
                (`id_web_admin_productos_talla`, 
                `id_web_admin_productos`, `talla`, 
                `fecha_crea`, `usuario_crea`, `estado`) 
                VALUES (NULL, :idProducto, :tallasEnviar, NOW(),:id , '1');
        ");
        //$sentencia->bindParam(1, $valor_devuleto, PDO::PARAM_STR, 4000);

        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":tallasEnviar", $tallasEnviar);
        $stmt->bindValue(":idProducto", $idProducto);
        $stmt->execute();

        //====regresa cantidad de redultdos
        $cuentaFila = $stmt->rowCount();
        $cuentaColumna = $stmt->columnCount();

        //===========capturamos errores
        $error[] = $stmt->errorCode();

        if (empty($error) && $cuentaFila == 0) {
            if ($cuentaFila == 0) {
                echo "Sin Resultados errors: ";
                return false;
            }
            //====cod de error
            print_r($stmt->errorInfo());
        } else {
            return true;
        }
    }
}
