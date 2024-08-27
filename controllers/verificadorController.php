<?php

namespace Controllers;

use Model\divisiones;
use MVC\Router;
require '../includes/makeApiRequest.php';

class verificadorController {
    // Método index: Página de inicio de la aplicación
    public static function index(Router $router){
        // Verificar si el usuario está autenticado
        $auth = $_SESSION['auth'] ?? false; // Si no está definida la sesión 'auth', se asigna 'false'
        $tipo = $_SESSION['tipo'] ?? 0; // Si no está definida la sesión 'tipo', se asigna 0
        // Si el usuario no está autenticado o su tipo no es 6, redireccionar a la página principal
        if (!$auth || $tipo != 6) {
            header("Location: https://sie.iest.edu.mx/IESTEventos/");
           
        }
        // Renderizar la vista para el Vice Rector
        $router->render('vistas/viceRector/index', []);
      
    }
    
    // Método eventosrevisar: Obtener eventos que deben ser revisados
    public static function eventosrevisar(){
        // Parámetros para realizar una solicitud a una API (servicio de consulta)
        $paramsSelectAllInfoEventos = array(
            'servicio' => 'consulta',
            'accion' => 'SelectAllInfoEventos',
            'tipoRespuesta' => 'json'
        );
        // Realizar una solicitud a la API para obtener información de eventos
        $SelectAllInfoEventos = makeApiRequest($paramsSelectAllInfoEventos);
        $response = array(); 
        // Recorrer la información de eventos obtenida
        foreach ($SelectAllInfoEventos['info'] as $evento) {
            // Si el estatus del evento es '1', agregarlo a la respuesta
            if ($evento['estatusid'] == '1') {
                $response[] = $evento; 
            }
        }
        // Devolver la respuesta (eventos que deben ser revisados) en formato JSON
        echo json_encode($response);
    }

    // Método mandarRetroalimentacion: Enviar retroalimentación sobre un evento
    public static function mandarRetroalimentacion(){
        // Obtener los datos de retroalimentación enviados por el cliente mediante el método POST
        $retroalimentacion = $_POST['retroalimentacion'];
        $estatus = $_POST['estatus'];
        $idevento = $_POST['idevento'];
        $comentariotipo = 'vr';
        // Parámetros para realizar una solicitud a la API (actualización de evento con retroalimentación)
        $paramsUpdateEventoRetroalimentacion = array(
            'servicio' => 'actualiza',
            'accion' => 'UpdateEventoRetroalimentacion',
            'tipoRespuesta' => 'json',
            'idevento' => $idevento,
            'estatus' => $estatus,
            'retroalimentacion' => $retroalimentacion,
            'comentariotipo' => $comentariotipo
        );
        // Realizar una solicitud a la API para actualizar el evento con la retroalimentación
        $UpdateEventoRetroalimentacion = makeApiRequest($paramsUpdateEventoRetroalimentacion);
        // Obtener el resultado de la actualización
        $success = $UpdateEventoRetroalimentacion['info'][0]['Success'];
        // Crear una respuesta con el resultado de la actualización
        if ($success) {
            $response = array('success' => true, 'message' => 'Se ha enviado la retroalimentacion');
        } else {
            $response = array('success' => false, 'message' => 'No se ha podido mandar la retroalimentación');
        }
        // Devolver la respuesta en formato JSON y terminar la ejecución del script
        exit(json_encode($response));
        // Nota: Aquí se devuelve un JSON con un mensaje de éxito o error sobre el envío de retroalimentación.
    }
}