<?php

namespace Controllers;

use MVC\Router;
use DateTime;
use DateTimeZone;
require '../includes/makeApiRequest.php';

class userController
{
    public static function index(Router $router)
    {
        $params = array(
            'servicio' => 'consulta',
            'accion' => 'SelectAllInfoPublicados',
            'tipoRespuesta' => 'json',
        );
        $SelectAllInfoEventos = makeApiRequest($params);
        $response = array();
        // Recorrer la información de eventos obtenida
        foreach ($SelectAllInfoEventos['info'] as $evento) {
            // Si el estatus del evento es '1', agregarlo a la respuesta
            if ($evento['estatusid'] == '6') {
                $response[] = $evento;
            }
        }
        $router->render('index/index', ["eventos" => $response]);

    }
    public static function calendar(Router $router)
    {
        $params = array(
            'servicio' => 'consulta',
            'accion' => 'SelectAllInfoEventos',
            'tipoRespuesta' => 'json',
        );
        $SelectAllInfoEventos = makeApiRequest($params);
        $response = array();
        // Recorrer la información de eventos obtenida
        foreach ($SelectAllInfoEventos['info'] as $evento) {
            // Si el estatus del evento es '1', agregarlo a la respuesta
            if ($evento['estatusid'] == '6') {
                $response[] = $evento;
            }
        }

        $router->render('index/calendar', ["eventos" => $response]);
    }
    public static function evento(Router $router)
    {
        
        $ideventoseleccionado = $_GET['id'] ?? header('Location: /');
        $idUsuario = $_SESSION['id_user'] ?? 0;
        $paramsSelectInfoEventobyToken = array(
            'servicio' => 'consulta',
            'accion' => 'SelectInfoEventobyToken',
            'tipoRespuesta' => 'json',
            'token' => $ideventoseleccionado,
        );
        $SelectInfoEventobyToken = makeApiRequest($paramsSelectInfoEventobyToken);
        $paramsSelectUserEnEvento = array(
            'servicio' => 'consulta',
            'accion' => 'SelectUserEnEvento',
            'tipoRespuesta' => 'json',
            'id_usuario' => $idUsuario,
            'token_evento' => $ideventoseleccionado,
        );
        $SelectUserEnEvento = makeApiRequest($paramsSelectUserEnEvento);
        // Verificar si la clave "info" tiene contenido
        if (!empty($SelectUserEnEvento["info"])) {
            // La clave "info" tiene contenido (elementos en el array)
            $registrado = true;
        } else {
            // La clave "info" está vacía (no contiene elementos en el array)
            $registrado = false;
        }

        $paramsSelectSubEventosofEventos = array(
            'servicio' => 'consulta',
            'accion' => 'SelectSubEventosofEventos',
            'tipoRespuesta' => 'json',
            'token' => $ideventoseleccionado,
        );
        $SelectSubEventosofEventos = makeApiRequest($paramsSelectSubEventosofEventos);
        // Decodificar el resultado JSON en un array asociativo
        // Inicializar el array $arraysub
        $arraysub = array();

        // Verificar si la clave "info" del array no está vacía
        if (!empty($SelectSubEventosofEventos["info"])) {
            $existeSubEventos = true;

            // Recorrer los datos dentro de "info" y guardarlos en el array $arraysub
            foreach ($SelectSubEventosofEventos["info"] as $fila) {
                $arraysub[] = $fila;
            }
        } else {
            $existeSubEventos = false;
        }

        $router->render('index/evento', ["subeventos" => $arraysub, "existeSubEventos" => $existeSubEventos, "eventoselecc" => $SelectInfoEventobyToken, "registrado" => $registrado]);
    }
    public static function profile(Router $router)
    {
        
        $auth = $_SESSION['auth'] ?? false;
        $tipo = $_SESSION['tipo'] ?? false;
        if (!$auth||!$_SESSION['tipo']) {
            header("Location: http://localhost/IESTEventos/");
        }
        $tokenqr = $_SESSION['iestcode'];
        $writer = new \Endroid\QrCode\Writer\PngWriter();
        $qrCode = \Endroid\QrCode\QrCode::create("$tokenqr")
            ->setEncoding(new \Endroid\QrCode\Encoding\Encoding('ISO-8859-1')) // Cambiar la codificación a ISO-8859-1
            ->setErrorCorrectionLevel(new \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow())
            ->setSize(350)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new \Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin())
            ->setForegroundColor(new \Endroid\QrCode\Color\Color(0, 29, 35))
            ->setBackgroundColor(new \Endroid\QrCode\Color\Color(255, 255, 255));

        // Crear el logo genérico
        $logo = \Endroid\QrCode\Logo\Logo::create(__DIR__ . '/../public/build/img/index/logo.png')
            ->setResizeToWidth(65);
        $resultado = $writer->write($qrCode, $logo, null);
        $qrImage = $resultado->getString();
        $qrBase64 = base64_encode($qrImage);
        //Buscamos el usuario en staff
        $iduser = $_SESSION['id_user'];
        $paramsCheckStaffIdExiste  = array(
            'servicio' => 'consulta',
            'accion' => 'CheckStaffIdExiste',
            'tipoRespuesta' => 'json',
            'iduser'=> $iduser
        );
        $CheckStaffIdExiste = makeApiRequest($paramsCheckStaffIdExiste );
        if (!empty($CheckStaffIdExiste['info'])) {
            $_SESSION['staff'] = true;
        } else {
            $_SESSION['staff'] = false;
        }
        $router->render('index/profile', ['qrCode' => $qrBase64, 'staff' => $_SESSION['staff']]);
    }

    public static function registraraevento()
    {
        
        $iduser = $_SESSION['id_user'] ?? $_POST['id_user'];
        $idevento = $_POST['idevento'];

        $paramsSelectUserEnEvento = array(
            'servicio' => 'consulta',
            'accion' => 'SelectUserEnEvento',
            'tipoRespuesta' => 'json',
            'id_usuario' => $iduser,
            'token_evento' => $idevento
        );
        $SelectUserEnEvento = makeApiRequest($paramsSelectUserEnEvento);
        if (!empty($SelectUserEnEvento["info"])) {
            $response = array("success" => false, "message" => "Ya estas registrado en el evento");
            echo json_encode($response);
            exit();
        } else {

            $paramsInsertUserToEvento = array(
                'servicio' => 'crea',
                'accion' => 'InsertUserToEvento',
                'tipoRespuesta' => 'json',
                'token_evento' => $idevento,
                'id_usuario' => $iduser
            );
            $InsertUserToEvento = makeApiRequest($paramsInsertUserToEvento);
            $success = $InsertUserToEvento['info'][0]['Success'];

            if ($success) {
                // Obtener los valores de los arrays recibidos
                $arrayEventos = $_POST['eventosSeleccionados'];
                $arraySubeventos = $_POST['subeventosSeleccionados'];
                // Decodificar los JSON en arrays
                $arrayEventosDecodificado = json_decode($arrayEventos);
                $arraySubeventosDecodificado = json_decode($arraySubeventos);

                // Verificar si los arrays tienen la misma longitud
                if (count($arrayEventosDecodificado) === count($arraySubeventosDecodificado)) {
                    $longitud = count($arrayEventosDecodificado);
                    // Iterar sobre los elementos de los arrays en paralelo
                    for ($i = 0; $i < $longitud; $i++) {
                        $evento = $arrayEventosDecodificado[$i];
                        $subevento = $arraySubeventosDecodificado[$i];
                        if($subevento!='none'){
                            $paramsInsertUserTosubEvento = array(
                                'servicio' => 'crea',
                                'accion' => 'InsertUserTosubEvento',
                                'tipoRespuesta' => 'json',
                                'token_evento' => $subevento,
                                'id_usuario' => $iduser,
                            );
                            $InsertUserTosubEvento = makeApiRequest($paramsInsertUserTosubEvento);
                            $success = $InsertUserTosubEvento['info'][0]['Success'];
                            if (!$success) {
                                $response = array("success" => false, "message" => "No hubo un problema");
                                exit(json_encode($response));
                            }
                        }
                    }
                } else {
                    $response = array("success" => false, "message" => "No se pudo registrar al evento");
                    exit(json_encode($response));
                }
                // Éxito: realizar acciones adicionales
                $response = array("success" => true, "message" => "Acabas de registrarte al evento");
                exit(json_encode($response));
            } else {
                $response = array("success" => false, "message" => "No se pudo registrar al evento");
                exit(json_encode($response));
            }
            exit();
        }
    }

}
