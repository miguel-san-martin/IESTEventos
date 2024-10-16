<?php

namespace Controllers;

use MVC\Router;
require '../includes/makeApiRequest.php';


class adminEventosController
{
    public static function index(Router $router)
    {
        $auth=$_SESSION['auth']??false;
        $tipo=$_SESSION['jerarquia']??0;
        if(!$auth ||$tipo!=7){
            header("Location: https://sie.iest.edu.mx/IESTEventos/");
        }
        $router->render('vistas/adminEventos/index', []);
    }
    public static function eventosrevisar()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $retroalimentacion = $_POST['retroalimentacion'];
            $estatus = $_POST['estatus'];
            $idevento = $_POST['idevento'];
            $comentariotipo = 'av';
                 /*API APLICADA */
            $paramsUpdateEventoRetroalimentacion = array(
                'servicio' => 'actualiza',
                'accion' => 'UpdateEventoRetroalimentacion',
                'tipoRespuesta' => 'json',
                'idevento' => $idevento,
                'estatus' => $estatus,
                'retroalimentacion' => $retroalimentacion,
                'comentariotipo' => $comentariotipo
            );
            $UpdateEventoRetroalimentacion = makeApiRequest($paramsUpdateEventoRetroalimentacion);
            $success = $UpdateEventoRetroalimentacion['info'][0]['Success'];
            if($success){
                $response = array('success' => true, 'message' => 'Se ha enviado la retroalimentacion');
            }else{
                $response = array('success' => false, 'message' => 'No se ha podido mandar la retroalimentación');

            }
            exit(json_encode($response));
        }else{
            /* API APLICADA */
            $paramsSelectAllInfoEventos = array(
                'servicio' => 'consulta',
                'accion' => 'SelectAllInfoEventosV2',
                'tipoRespuesta' => 'json'
            );
            $SelectAllInfoEventos = makeApiRequest($paramsSelectAllInfoEventos);
            $response = array(); 
            // Recorrer la información de eventos obtenida
            foreach ($SelectAllInfoEventos['info'] as $evento) {
                // Si el estatus del evento es '1', agregarlo a la respuesta
                if ($evento['estatusid'] == '3') {
                    $response[] = $evento; 
                }
            }
            // Devolver la respuesta (eventos que deben ser revisados) en formato JSON
            echo json_encode($response);
        }
    }
}
