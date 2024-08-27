<?php

namespace Controllers;

use MVC\Router;
use DateTime;
require '../includes/makeApiRequest.php';


class StaffUserController
{
    public static function getEventosforstaff(){
        
        $iduser=$_SESSION['id_user'];
        /* API APLICADA */
        $paramsSelectEventosForStaff = array(
            'servicio' => 'consulta',
            'accion' => 'SelectEventosForStaff',
            'tipoRespuesta' => 'json',
            'iduser' => $iduser
        );
        $SelectEventosForStaff = makeApiRequest($paramsSelectEventosForStaff);
        echo json_encode($SelectEventosForStaff['info']);
    }
    public static function verifyQr(){
        
        $eventoid=$_POST['evento'];
        $iestcode=$_POST['iestcode'];
        $eventoPadre=$_POST['eventoPadre'];
        $iduser=$_SESSION['id_user'];
        $paramsVerifyRegistroEvento = array(
            'servicio' => 'consulta',
            'accion' => 'VerifyRegistroEvento',
            'tipoRespuesta' => 'json',
            'token' => $eventoPadre,
            'evento_id' => $eventoid,
            'iestcode' => $iestcode,
        );
        $VerifyRegistroEvento = makeApiRequest($paramsVerifyRegistroEvento);
        $Success = $VerifyRegistroEvento['info'][0]['Success'];
        $datauser = $VerifyRegistroEvento['info'];
        if($Success){
            $response = array("success" => true, "message" => "Usuario esta registrado","body"=>$datauser);
            exit(json_encode($response));
        }else{
            $response = array("success" => false, "message" => "El usuario no esta registrado al evento");
            exit(json_encode($response));
        }


        
    }
    public static function ingresarAsistencia(){
        
        $iduser=$_POST['iduser'];
        $eventoToken=$_POST['eventoToken'];

        /* API APLICADA */
        $paramsVerifyUserInAsistencias = array(
            'servicio' => 'consulta',
            'accion' => 'VerifyUserInAsistencias',
            'tipoRespuesta' => 'json',
            'iduser' => $iduser,
            'token_evento' => $eventoToken
        );
        $VerifyUserInAsistencias = makeApiRequest($paramsVerifyUserInAsistencias);
        if(!empty($VerifyUserInAsistencias['info'])){
            //El qr fue escaneado al evento
            $response = array("success" => false, "message" => "El IestCode ya fue escaneado en este evento");
            echo json_encode($response);
        }else{
            //El qr no ha sido escaneado
            /* API APLICADA */
            $paramsInsertUserToAsistencias = array(
                'servicio' => 'crea',
                'accion' => 'InsertUsertoAsistencias',
                'tipoRespuesta' => 'json',
                'iduser' => $iduser,
                'token_evento' => $eventoToken
            );

            $InsertUserToAsistencias = makeApiRequest($paramsInsertUserToAsistencias);
            $Success = $InsertUserToAsistencias['info'][0]['Success']??false;
            if ($Success) {
                // Éxito: realizar acciones adicionales
                $response = array("success" => true, "message" => "Asistencia Válida");
                exit(json_encode($response));
            } else {
                // Error: realizar acciones adicionales
                $response = array("success" => false, "message" => "Ocurrio un problema para agregar la asistencia");
                exit(json_encode($response));
            }
        }
    }
}