<?php
// Librerías (Composer)
require_once 'vendor/autoload.php';

// Leemos las variables de entorno del archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'../../');
$dotenv->load();

class conecction
{
    // Función para devolver la conexión a la base de datos.
    public function conexion()
    {
        // Parámetros para la conexión
        define('DB_SERVER', $_ENV['IDB_SERVER']);
        define('DB_USERNAME', $_ENV['IDB_USERNAME']);
        define('DB_PASSWORD', $_ENV['IDB_PASSWORD']);
        define('DB_NAME', $_ENV['IDB_NAME']);

        // Conexión
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Validamos la conexión
        if($link === false)
        {
            $respuestas['msg'] = 'ERROR: No se puedo realizar la conexión. '. mysqli_connect_error();
            return $respuestas;
        }

        // Regresamos la conexión
        return $link;
    }
}