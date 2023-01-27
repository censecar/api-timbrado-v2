<?php
// Agregamos el header para la respuesta
header('Content-Type: application/json');

// Clases requeridas
require_once 'class/responses.php';
require_once 'class/auth.php';

// Variables
$respuesta = array();
$responses = new responses;
$auth = new auth;

// Validamos que el tipo de petición HTTP sea GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Recibimos los datos de la petición
    $body = file_get_contents("php://input");

    // Obtenemos los parámetros JSON de la petición
    $datos = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

    // Validamos que la estructura de la petición sea válida
    if(isset($datos['usuario'], $datos['contrasena'], $datos['tiempo']))
    {
        // Enviamos los datos a la clase
        $usuario = $auth->login($datos['usuario'], $datos['contrasena'], $datos['tiempo']);

        // Evaluamos la respuesta
        if ($usuario['status'] === 1)
        {
            // Devolvemos la respuesta con los datos
            $respuesta = $responses->status_200($usuario['data']);
        }
        else
        {
            // Devolvemos el error
            $respuesta = $responses->status_401($usuario['data']);
        }
    }
    else
    {
        // Devolvemos error con la estructura del JSON
        $respuesta = $responses->status_406('La estructura de la petición no es correcta. Favor de revisar la documentación.');
    }


}

echo json_encode($respuesta);