<?php

namespace Controllers;

use Endroid\QrCode\Color\Color;
require_once '../vendor/autoload.php'; //This is provisional
use MVC\Router;


class authController
{

    public static function login(Router $router)
    {
        require '../includes/makeApiRequest.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $pass = $_POST['password'];
            /* CONEXIÓN CON API */
            $params = array(
                'servicio' => 'consulta',
                'accion' => 'ExisteAlumno_v2',
                'tipoRespuesta' => 'json',
                'username' => $username,
                'password' => $pass,
            );
            /* RESPUESTA DE API */
            $userInfo = makeApiRequest($params);
            $error = $userInfo['info'][0]['error'];
            $mensaje = $userInfo['info'][0]['mensaje'];
            if (!$error) {
                $idiest = $userInfo['info'][0]['idIEST'];
                $nombre = $userInfo['info'][0]['nombreCompleto'];
                $foto = $userInfo['info'][0]['foto'];
                $correo = $userInfo['info'][0]['correo'];

                $iestcode=uniqid();
                $paramsExisteAlumno = array(
                    'servicio' => 'consulta',
                    'accion' => 'existeUsuario',
                    'tipoRespuesta' => 'json',
                    'id' => $idiest,
                    'nombre' => $nombre,
                    'iestcode' =>$iestcode
                );
                $existeUsuario = makeApiRequest($paramsExisteAlumno);
                
                $paramsSelectAllUsers = array(
                    'servicio' => 'consulta',
                    'accion' => 'SelectUserbyId',
                    'tipoRespuesta' => 'json',
                    'iduser'=> $idiest
                );
                $SelectAllUsers = makeApiRequest($paramsSelectAllUsers);
                $jerarquia = $SelectAllUsers['info'][0]['jerarquia'];
                $iestcode = $SelectAllUsers['info'][0]['iestcode'];
                session_destroy();
                if (session_status() == PHP_SESSION_ACTIVE) {
                } else {
                    /* DATOS DE SESIÓN ALMACENADOS */
                    session_start();
                    $_SESSION['auth'] = true;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['tipo'] = $jerarquia;
                    $_SESSION['id_user'] = $idiest;
                    $_SESSION['iestcode'] = $iestcode;
                    $_SESSION['fotografia'] = $foto;
                    $_SESSION['jerarquia'] = $jerarquia;
                    $_SESSION['mensaje'] = $mensaje;
                    $_SESSION['correo'] = $correo;
                }
                $response = array("success" => true, "message" => 'Ingresaste Sesión');
                exit(json_encode($response));
            } else {
                $response = array("success" => false, "message" => $mensaje);
                exit(json_encode($response));
            }
            exit();
        } else {
            if($_SESSION['auth']??false){
                header("Location: https://sie.iest.edu.mx/IESTEventos/");
            }
            $router->render('auth/login', []);
        }
    }

    public static function logout()
    {
        session_destroy();
        header("Location: https://sie.iest.edu.mx/IESTEventos/");
        
    }

    public static function usuariotipo()
    {
        
        /* VALIDAR SESIÓN INICIADA */
        $_SESSION['tipo'] = intval($_SESSION['tipo']);
        switch ($_SESSION['tipo']) {
            case 1:
                break;
            case 2:
                $id_user = $_SESSION['id_user'];
                header("Location: https://sie.iest.edu.mx/IESTEventos/");
                break;
            case 3:
                header('Location: DashboardRh');
                break;
            case 5:
                header('Location: Coordinador');
                break;
            case 6:
                header('Location: Vicerector');
                break;
            case 7:
                header('Location: AdminEventos');
                break;
            default:
                echo ('No nos intentes juaquiar :(');
                header('Location: /');
                break;
        }
    }
}
