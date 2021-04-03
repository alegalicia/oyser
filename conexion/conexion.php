<?php
class conexion {
  private $db;
    public function connect(){
		
		require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
		
        $dsn = DB_HOST;
		$usuario = DB_USER;
		$contrasena = DB_PASSWORD;

		try 
		{
			$db = new PDO($dsn, $usuario, $contrasena);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->exec('SET CHARACTER SET utf8');
			return $db;
			
		} catch (PDOException $e) 
		{
			die('Falló la conexión: ' . $e->getMessage(). 'line: '.$e->getLine().' code: '.$e->getCode( ));
		}

		finally {
			$db =null;
		}
    }
}

?>