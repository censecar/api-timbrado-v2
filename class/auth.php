<?php
// Clases requeridas
require_once 'conecction.php';

class auth extends conecction
{
    // Función principal para Autenticar al usuario y posterior generar su token
    public function login($usuario,$contrasena,$tiempo)
    {
        // Igualamos la contraseña para comparar
        $contrasena = $this->encrypt($contrasena);

        // Obtenemos los datos del usuario con base al nombre del usuario
        $usuario = $this->obtenerDatosUsuario($usuario);

        // Validamos la respuesta de obtener la información del usuario
        if ($usuario['status'] === 1)
        {
            // Verificamos que la contraseña sea válida
            if ($usuario['data']['sContrasena'] === $contrasena)
            {
                // Validamos que sea un usuario activo
                if ($usuario['data']['boEstatus'] === 1){
                    return $usuario;
                }

                // Regresamos el error de usuario inactivo
                $usuario['status'] = 0;
                $usuario['data'] = 'El usuario esta inactivo.';

                return $usuario;
            }

            // Regresamos error de contraseña incorrecta
            $usuario['status'] = 0;
            $usuario['data'] = 'La contraseña es incorrecta.';
            return $usuario;
        }

        // Regresamos error petición no exitosa
        $usuario['status'] = 0;
        $usuario['data'] = 'La petición falló.';
        return $usuario;
    }

    // Función para encriptar cualquier string en MD5
    protected function encrypt($string): string
    {
        return md5($string);
    }

    // Función para obtener los datos del usuario con base a su usuario
    private function obtenerDatosUsuario($usuario): array
    {
        // Array de respuestas
        $response['status'] = 0;

        // Obtenemos la conexión
        $link = $this->conexion();

        // Prepared statement, etapa 1: Preparación del Query
        $stmt = $link->prepare('SELECT iID,sContrasena,boEstatus FROM usuarios WHERE sUsuario = ?');

        // Prepared statement, etapa 2: Enlazar y ejecutar
        $stmt->bind_param("s", $usuario);

        // Ejecutamos
        $stmt->execute();

        // Obtenemos el resultado
        $result = $stmt->get_result();

        // Validamos que la consulta traiga datos
        if ($result->num_rows<=0)
        {
            // Obtenemos el arreglo con los valores y retornamos los valores
            $response['data'] = 'El usuario '.$usuario.' no existe.';
            return $response;
        }

        // Valores a retornar
        $response['status'] = 1;
        $response['data'] = $result->fetch_assoc();

        // Regresamos los datos
        return $response;
    }
}