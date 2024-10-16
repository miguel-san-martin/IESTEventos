<?php

namespace Controllers;

use Model\estudiante;
use Model\lugares;
use Model\divisiones;
use MVC\Router;
use DateTime;

require '../includes/makeApiRequest.php';

class CoordinadorController{
    public static function index(Router $router)
    {
        $auth=$_SESSION['auth']??false;
        $tipo=$_SESSION['tipo']??0;
        if(!$auth ||$tipo!=5){
            header("Location: https://sie.iest.edu.mx/IESTEventos/");
        } else {
            $resultado = 0;
            $carrera = $_SESSION['carrera']??NULL;
            /* CONEXIÓN CON API */
            $params = array(
                'servicio' => 'consulta',
                'accion' => 'SelectAllLugares',
                'tipoRespuesta' => 'json'
            );
            /* RESPUESTA DE API */
            $locaciones=makeApiRequest($params);
            $params = array(
                'servicio' => 'consulta',
                'accion' => 'SelectAllEstudiantesbyCarrera',
                'tipoRespuesta' => 'json',
                'carrera'=> 2
            );
            /* RESPUESTA DE API */
            $alumnosirregulares=makeApiRequest($params);

            $params = array(
                'servicio' => 'consulta',
                'accion' => 'SelectAllEstudios',
                'tipoRespuesta' => 'json'
            );
            /* RESPUESTA DE API */
            $estudios=makeApiRequest($params);
            
            $router->render('vistas/coordinador/index', [
                "lugares" => $locaciones,
                "estudiantes" => $alumnosirregulares,
                "divisiones" => $estudios,
                "estudiosu" => $estudios,
            ]);
        }
    }
    public static function lugares()
    {
        $params = array(
            'servicio' => 'consulta',
            'accion' => 'SelectAllLugares',
            'tipoRespuesta' => 'json'
        );
        /* RESPUESTA DE API */
        $lugares=makeApiRequest($params);
        echo json_encode($lugares); 
 
    }
    public static function eventos()
    {
        require '../includes/makeApiRequest.php';
        $params = array(
            'servicio' => 'consulta',
            'accion' => 'SelectAllInfoEventos',
            'tipoRespuesta' => 'json'
        );
        /* RESPUESTA DE API */
        $lugares=makeApiRequest($params);
        echo json_encode($lugares);
        
    }
    public static function semestre(Router $router)
    {
        $auth=$_SESSION['auth']??false;
        $tipo=$_SESSION['tipo']??0;
        if(!$auth ||$tipo!=5){
            header("Location: https://sie.iest.edu.mx/IESTEventos/");
        }
        $router->render('vistas/coordinador/semestre', []);
    }

    public static function crearevento()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            date_default_timezone_set('America/Mexico_City');
            //Recibimos los datos para crear el evento
            $banner1F = $_FILES['banner1'];//Imagen primaria
            $extension = pathinfo($banner1F['name'], PATHINFO_EXTENSION);
            $banner1 = uniqid() . '.' . $extension;
            $banner2F = $_FILES['banner2'];//Imagen Secundaria
            $extension = pathinfo($banner2F['name'], PATHINFO_EXTENSION);
            $banner2 = uniqid() . '.' . $extension;
            $contacto_responsable = $_POST['contacto_responsable'];//Responsable del evento
            $descripcion = $_POST['descripcion'];//Descripcion del evento
            $fechahorafin =$_POST['fechahorafin']; // Obtener el valor de fechahorafin desde el formulario
            $fechahorafin =DateTime::createFromFormat('D M d Y H:i:s e+', $fechahorafin);
            // Formatea el objeto DateTime a formato ISO 8601
            $fechahorafin = $fechahorafin->format('Y-m-d\TH:i:s');
            // Crear un objeto DateTime usando el formato especificado
            $fechahoraini = $_POST['fechahoraini'];//fechahora ini del evento
            $fechahoraini = DateTime::createFromFormat('D M d Y H:i:s e+', $fechahoraini);
            // Formatea el objeto DateTime a formato ISO 8601
            $fechahoraini = $fechahoraini->format('Y-m-d\TH:i:s');
            $categoria=$_POST['categoria'];//Categoria del evento
            $nombre = $_POST['nombre'];//Nombre del evento
            $anio_actual = date("Y");//Año actual para crear carpeta del evento
            $token = uniqid();//Token para el evento
            $nombre_responsable = $_POST['nombre_responsable'];//Resposanle del evento
            $modalidad = $_POST['modalidad'];//Modalidad del evento
            $id_alta = $_POST['id_alta'];//Usuario id quien esta dando de alta
            $divisiones = $_POST['divisiones'];
            $array = explode(",", str_replace(array("[", "]"), "", $divisiones));
            $divisiones = implode(",", $array);
            $dirigido = $_POST['dirigido'];
            $array = explode(",", str_replace(array("[", "]"), "", $dirigido));
            $dirigido = implode(",", $array);
            $niveldivision=$_POST['division'];
            switch ($modalidad) {
                case 'Presencial':
                    //Se obtiene el lugar
                    $lugar=$_POST['lugar'];//valor puede ser nuevo o existente
                    if($lugar=='nuevo'){
                        //El lugar de evento es nuevo, se tendra que crear junto con el evento.
                        $lugar_cupo_max = $_POST['lugar_cupo_max'];
                        $lugar_direccion = $_POST['lugar_direccion'];
                        $lugar_nombre = $_POST['lugar_nombre'];
                        $paramsInfoEventosNuevoLugar  = array(
                            'servicio' => 'crea',
                            'accion' => 'InsertInfoEventoNuevoLugar',
                            'tipoRespuesta' => 'json',
                            'lugar_nombre' => $lugar_nombre,
                            'lugar_direccion' => $lugar_direccion,
                            'lugar_cupo_max' => $lugar_cupo_max,
                            'nombre' => $nombre,
                            'descripcion' => $descripcion,
                            'dirigido' => $dirigido,
                            'divisiones' => $divisiones,
                            'contacto_responsable' => $contacto_responsable,
                            'nombre_responsable' => $nombre_responsable,
                            'fechahoraini' => $fechahoraini,
                            'fechahorafin' => $fechahorafin,
                            'banner1' => $banner1,
                            'banner2' => $banner2,
                            'modalidad' => $modalidad,
                            'id_alta' => $id_alta,
                            'token' => $token,
                            'categoria' => $categoria,
                            'niveldivision' => $niveldivision
                        );
                        $InfoEventosNuevoLugar = makeApiRequest($paramsInfoEventosNuevoLugar);
                        $success = $InfoEventosNuevoLugar['info'][0]['Success'];
                        $evento_id = $InfoEventosNuevoLugar['info'][0]['EventoID'];
                        if ($success) {
                            $carpetaImagenes = "build/img/Eventos/$token/";
                            if (!is_dir($carpetaImagenes)) {
                                mkdir($carpetaImagenes, 0777, true);
                            }
                            move_uploaded_file($banner1F['tmp_name'], $carpetaImagenes . $banner1);
                            move_uploaded_file($banner2F['tmp_name'], $carpetaImagenes . $banner2);
                            break;
                            
                        } else {
                            echo json_encode(array('success' => false, 'message' => 'No se pudo crear')); exit();
                        }
                    }else{
                        // Establecer los parámetros del Stored Procedure
                        $params = array(
                            'servicio' => 'crea',
                            'accion' => 'InsertInfoEventoLugarExistente',
                            // 'tipoRespuesta' => 'json',
                            'categoria' => $categoria,
                            'token' => $token,
                            'nombre' => $nombre,
                            'descripcion' => $descripcion,
                            'dirigido' => $dirigido,
                            'divisiones' => $divisiones,
                            'contacto_responsable' => $contacto_responsable,
                            'nombre_responsable' => $nombre_responsable,
                            'fechahoraini' => $fechahoraini,
                            'fechahorafin' => $fechahorafin,
                            'banner1' => $banner1,
                            'banner2' => $banner2,
                            'modalidad' => $modalidad,
                            'id_alta' => $id_alta,
                            'niveldivision' => $niveldivision,
                            'lugar' => $lugar
                        );

                        $evento = makeApiRequest($params);
                        $success = $evento['info'][0]['Success'];
                        $evento_id = $evento['info'][0]['EventoID'];

                        if ($success) {
                            $carpetaImagenes = "build/img/Eventos/$token/";
                            if (!is_dir($carpetaImagenes)) {
                                mkdir($carpetaImagenes, 0777, true);
                            }
                            move_uploaded_file($banner1F['tmp_name'], $carpetaImagenes . $banner1);
                            move_uploaded_file($banner2F['tmp_name'], $carpetaImagenes . $banner2);
                            break;
                        } else {
                            echo json_encode(array('success' => false, 'message' => 'No se pudo crear el evento')); exit();
                        }
                    }
                    break;
                case 'Virtual':
                    $virtual_descripcion = $_POST['virtual_descripcion'];
                    $virtual_link = $_POST['virtual_link'];
                    $virtual_plataformas = $_POST['virtual_plataformas'];
                    $paramsInsertEventoVirtual  = array(
                        'servicio' => 'crea',
                        'accion' => 'InsertEventoVirtual',
                        'tipoRespuesta' => 'json',
                        'redsocial' => $virtual_plataformas,
                        'virtual_descripcion' => $virtual_descripcion,
                        'virtual_link' => $virtual_link,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'dirigido' => $dirigido,
                        'divisiones' => $divisiones,
                        'contacto_responsable' => $contacto_responsable,
                        'nombre_responsable' => $nombre_responsable,
                        'fechahoraini' => $fechahoraini,
                        'fechahorafin' => $fechahorafin,
                        'banner1' => $banner1,
                        'banner2' => $banner2,
                        'modalidad' => $modalidad,
                        'id_alta' => $id_alta,
                        'token' => $token,
                        'categoria' => $categoria,
                        'niveldivision' => $niveldivision
                    );
                    $InsertEventoVirtual = makeApiRequest($paramsInsertEventoVirtual);
                    $success = $InsertEventoVirtual['info'][0]['Success'];
                    $evento_id = $InsertEventoVirtual['info'][0]['EventoID'];

                    if ($success) {
                        $carpetaImagenes = "build/img/Eventos/$token/";
                        if (!is_dir($carpetaImagenes)) {
                            mkdir($carpetaImagenes, 0777, true);
                        }
                        move_uploaded_file($banner1F['tmp_name'], $carpetaImagenes . $banner1);
                        move_uploaded_file($banner2F['tmp_name'], $carpetaImagenes . $banner2);
                        break;
                    } else {
                        echo json_encode(array('success' => false, 'message' => 'No se pudo crear el evento')); exit();
                    }
            }
            //Procedimiento para crear subeventos
            $dias=$_POST['dias'];
            $fechas=$_POST['fechas'];
            $fechasArray = explode(',', $fechas);
            $dia=0;
            $nombreevento=$nombre;
            foreach ($fechasArray as $index => $fecha) {
                $dia++;
                $nombre=$nombreevento.' - Dia '.$dia;
                $token=uniqid();
                $paramsInsertNewDays  = array(
                    'servicio' => 'crea',
                    'accion' => 'InsertNewDays',
                    'tipoRespuesta' => 'json',
                    'evento_info' => $evento_id,
                    'token' => $token,
                    'nombre' => $nombre,
                    'fecha' => $fecha
                );
                $InsertNewDays = makeApiRequest($paramsInsertNewDays);
                $success = $InsertNewDays['info'][0]['Success'];

                if (!$success) {
                    $response = array("success" => false, "message" => "Ocurrio un error");
                    exit(json_encode($response));
                }
            }
        }
        $response = array("success" => true, "message" => "Se creo Correctamente el evento");
        exit(json_encode($response));   
    }
    //RevisionEventos 
    public static function revisionEventos()
    {
        
        $userid=$_POST['iduser']??$_SESSION['id_user'];

        /* API APLICADA */
        $paramsSelectEventosbyCreador = array(
            'servicio' => 'consulta',
            'accion' => 'SelectEventosbyCreador',
            'tipoRespuesta' => 'json',
            'idcreador' => $userid
        );
        $SelectEventosbyCreador = makeApiRequest($paramsSelectEventosbyCreador);
        $response = array(); 
        // Recorrer la información de eventos obtenida
        foreach ($SelectEventosbyCreador['info'] as $evento) {
            // Si el estatus del evento es '1', agregarlo a la respuesta
            if ($evento['estatusid'] < '5') {
                $response[] = $evento; 
            }
        }
        echo json_encode($response);
    }
    //
    public static function eventospublicados()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $userid=$_POST['iduser']??$_SESSION['id_user'];
            $paramsSelectEventosbyCreador = array(
                'servicio' => 'consulta',
                'accion' => 'SelectEventosbyCreador',
                'tipoRespuesta' => 'json',
                'idcreador' => $userid
            );
            $SelectEventosbyCreador = makeApiRequest($paramsSelectEventosbyCreador);
            $response = array(); 
            foreach ($SelectEventosbyCreador['info'] as $evento) {
                if ($evento['estatusid'] == '6') {
                    $response[] = $evento; 
                }
            }
            echo json_encode($response);
        }
    }
    public static function editarevento(Router $router)
    {
        
        $auth=$_SESSION['auth']??false;
        $tipo=$_SESSION['tipo']??0;
        if(!$auth ||$tipo!=5){
            header("Location: https://sie.iest.edu.mx/IESTEventos/");
        } else {
            $id_Evento = $_GET['id'] ?? null;
            if ($id_Evento === null||$id_Evento =='') {
                header('Location: coordinador');
            }
            $resultado = 0;

            /* API APLICADA */
            $paramsSelectInfoEventobyToken = array(
                'servicio' => 'consulta',
                'accion' => 'SelectInfoEventobyToken',
                'tipoRespuesta' => 'json',
                'token' => $id_Evento
            );
            $SelectInfoEventobyToken = makeApiRequest($paramsSelectInfoEventobyToken);

            $params = array(
                'servicio' => 'consulta',
                'accion' => 'SelectAllEstudios',
                'tipoRespuesta' => 'json'
            );
            $estudios=makeApiRequest($params);
            $estudios2=makeApiRequest($params);
            
            $paramsLocaciones  = array(
                'servicio' => 'consulta',
                'accion' => 'SelectAllLugares',
                'tipoRespuesta' => 'json'
            );
            $locaciones=makeApiRequest($paramsLocaciones);
            
            $router->render(
                'vistas/coordinador/editarevento',
                [
                    "eventoselecc" => $SelectInfoEventobyToken,
                    "lugares" => $locaciones,
                    "divisiones" => $estudios,
                    "divisiones2" => $estudios2
                ]
            );
        }
    }
    public static function actualizarEvento()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $idevento = $_POST['idevento'];
            $contacto_responsable = $_POST['contacto_responsable'];
            $nombre_responsable = $_POST['nombre_responsable'];
            $descripcion = $_POST['descripcion'];
            $fechahorafin = $_POST['fechahorafin'];
            $fechahorafin =DateTime::createFromFormat('D M d Y H:i:s e+', $fechahorafin);
            // Formatea el objeto DateTime a formato ISO 8601
            $fechahorafin = $fechahorafin->format('Y-m-d\TH:i:s');
            $fechahoraini = $_POST['fechahoraini'];
            $fechahoraini = DateTime::createFromFormat('D M d Y H:i:s e+', $fechahoraini);
            // Formatea el objeto DateTime a formato ISO 8601
            $fechahoraini = $fechahoraini->format('Y-m-d\TH:i:s');
            $nombre = $_POST['nombre'];
            $categoria=$_POST['categoria'];
            $dirigido = $_POST['dirigido'];
            $divisiones = $_POST['divisiones'];
            $division=$_POST['division'];
            $modalidad = $_POST['modalidad'];
            $array = explode(",", str_replace(array("[", "]"), "", $divisiones));
            $divisiones = implode(",", $array);
            $dirigido = $_POST['dirigido'];
            $array = explode(",", str_replace(array("[", "]"), "", $dirigido));
            $dirigido = implode(",", $array);
            $estatus=$_POST['estatus']??1;
            switch (strtolower($modalidad)) {
                case 'virtual':
                    $idvirtual = $_POST['virtual_id'];
                    $redsocial = $_POST['virtual_plataformas'];
                    $informacion = $_POST['virtual_descripcion'];
                    $link = $_POST['virtual_link'];

                    /* API APLICADA */
                    $paramsUpdateInfoEventoVirtual = array(
                        'servicio' => 'actualiza',
                        'accion' => 'UpdateInfoEventoVirtual',
                        'tipoRespuesta' => 'json',
                        'idvirtual' => $idvirtual,
                        'redsocial' => $redsocial,
                        'informacion' => $informacion,
                        'link' => $link,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'dirigido' => $dirigido,
                        'divisiones' => $divisiones,
                        'division' => $division,
                        'contacto_responsable' => $contacto_responsable,
                        'nombre_responsable' => $nombre_responsable,
                        'fechahoraini' => $fechahoraini,
                        'fechahorafin' => $fechahorafin,
                        'categoria' => $categoria,
                        'idevento' => $idevento,
                        'estatus' => $estatus
                    );
                    $UpdateInfoEventoVirtual = makeApiRequest($paramsUpdateInfoEventoVirtual);
                    $success = $UpdateInfoEventoVirtual['info'][0]['Success'];

                    if ($success) {
                        echo json_encode(array('success' => true, 'message' => 'Se actualizó correctamente el evento'));
                    } else {
                        echo json_encode(array('success' => false, 'message' => 'No se logró actualizar el evento'));exit();
                    }
                    break;
                case 'presencial':
                    $lugar_id = $_POST['lugar_id'];
                    
                    /* API APLICADA */
                    $paramsUpdateInfoEventoPresencial = array(
                        'servicio' => 'actualiza',
                        'accion' => 'UpdateInfoEventoPresencial',
                        'tipoRespuesta' => 'json',
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'dirigido' => $dirigido,
                        'divisiones' => $divisiones,
                        'division' => $division,
                        'contacto_responsable' => $contacto_responsable,
                        'nombre_responsable' => $nombre_responsable,
                        'fechahoraini' => $fechahoraini,
                        'fechahorafin' => $fechahorafin,
                        'categoria' => $categoria,
                        'idevento' => $idevento,
                        'estatus' => $estatus,
                        'lugar_id' => $lugar_id
                    );
                    $UpdateInfoEventoPresencial = makeApiRequest($paramsUpdateInfoEventoPresencial);
                    $success = $UpdateInfoEventoPresencial['info'][0]['Success'];

                    if ($success) {
                        echo json_encode(array('success' => true, 'message' => 'Se actualizó correctamente el evento'));
                    } else {
                        echo json_encode(array('success' => false, 'message' => 'No se logró actualizar el evento'));
                        exit();
                    }
                    break;
            }
            $img1 = $_FILES['banner1'] ?? null;
            $img2 = $_FILES['banner2'] ?? null;
            $tokenEvento=$_POST['token'];
            $banner1=$_POST['banner1viejo'];
            $banner2=$_POST['banner2viejo'];
            if ($img1) {
                $imagenborrar = "build/img/eventos/$tokenEvento/$banner1";
                unlink($imagenborrar);
                $carpetaImagenes = "build/img/Eventos/$tokenEvento/";
                $extension = pathinfo($img1['name'], PATHINFO_EXTENSION);
                $nombrebanner = uniqid() . '.' . $extension;
                move_uploaded_file($img1['tmp_name'], $carpetaImagenes . $nombrebanner);
                $bannertipo='principal';

                /* API APLICADA */
                $paramsUpdateImagenEvento = array(
                    'servicio' => 'actualiza',
                    'accion' => 'UpdateImagenEvento',
                    'tipoRespuesta' => 'json',
                    'nombreimagen' => $nombrebanner,
                    'idevento' => $idevento,
                    'bannertipo' => $bannertipo
                );
                $UpdateImagenEvento = makeApiRequest($paramsUpdateImagenEvento);
            }
            if ($img2) {
                $imagenborrar = "build/img/eventos/$tokenEvento/$banner2";
                unlink($imagenborrar);
                $carpetaImagenes = "build/img/eventos/$tokenEvento/";
                $extension = pathinfo($img2['name'], PATHINFO_EXTENSION);
                $nombrebanner = uniqid() . '.' . $extension;
                move_uploaded_file($img2['tmp_name'], $carpetaImagenes . $nombrebanner);
                $bannertipo='secundario';

                /* API APLICADA */
                $paramsUpdateImagenEvento = array(
                    'servicio' => 'actualiza',
                    'accion' => 'UpdateImagenEvento',
                    'tipoRespuesta' => 'json',
                    'nombreimagen' => $nombrebanner,
                    'idevento' => $idevento,
                    'bannertipo' => $bannertipo
                );
                $UpdateImagenEvento = makeApiRequest($paramsUpdateImagenEvento);

            }
        }
    }

    public static function staff()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $evento = $_POST['evento'];
            $paramsInsertUsertoStaff = array(
                'servicio' => 'crea',
                'accion' => 'InsertUsertoStaff',
                'tipoRespuesta' => 'json',
                'idusuario' => $id,
                'idevento' => $evento
            );
            $InsertUsertoStaff = makeApiRequest($paramsInsertUsertoStaff);

            $success = $InsertUsertoStaff['info'][0]['Success'];
            
            if ($success) {
                // Éxito: realizar acciones adicionales
                $response = array("success" => true, "message" => "Se registro el usuario al Staff");
                exit(json_encode($response));
            } else {
                // Error: realizar acciones adicionales
                $response = array("success" => false, "message" => "No se pudo registrar al staff");
                exit(json_encode($response));
            }

        }
    }
    public static function usuarioenstaff()
    {
        $id = $_GET['id'];
        $evento = $_GET['evento'];
        $paramsGetStaffUser = array(
            'servicio' => 'consulta',
            'accion' => 'GetStaffUser',
            'tipoRespuesta' => 'json',
            'iduser' => $id,
            'evento' => $evento
        );
        $GetStaffUser = makeApiRequest($paramsGetStaffUser);
        if (!empty($GetStaffUser['info'])) {
            $response = array("success" => true, "message" => "Si es staff");
            exit(json_encode($response));
        } else {
            $response = array("success" => false, "message" => "No es staff");
            exit(json_encode($response));
        }        
    }
/*     public static function eliminarstaff()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $idevento = $_POST['evento'];
            $paramsDeleteUserFromStaff = array(
                'servicio' => 'elimina',
                'accion' => 'DeleteUserFromStaff',
                'tipoRespuesta' => 'json',
                'idusuario' => $id,
                'idevento' => $idevento
            );
            $DeleteUserFromStaff = makeApiRequest($paramsDeleteUserFromStaff);
            $success = $DeleteUserFromStaff['info'][0]['Success'];
            if ($success) {
                // Éxito: realizar acciones adicionales
                $response = array("success" => true, "message" => "Se elimino el usuario del staff");
                exit(json_encode($response));
            } else {
                // Error: realizar acciones adicionales
                $response = array("success" => false, "message" => "No se pudo eliminar el usuario del staff");
                exit(son_encode($response));
            }
        }
    } */
    //Subeventos
    public static function apisubeventos(){
        
        $id_SUBEvento = $_GET['id'];
        $paramsSelectAllSubeventobyToken = array(
            'servicio' => 'consulta',
            'accion' => 'SelectSubeventosbyEventoToken',
            'tipoRespuesta' => 'json',
            'token' => $id_SUBEvento
        );
        $SelectSubeventosbyEventoToken = makeApiRequest($paramsSelectAllSubeventobyToken);
        echo json_encode($SelectSubeventosbyEventoToken);
    }
    public static function subeventos(Router $router)
    {
        
        $auth=$_SESSION['auth']??false;
        $tipo=$_SESSION['tipo']??0;
        if(!$auth ||$tipo!=5){
            header("Location: https://sie.iest.edu.mx/IESTEventos/");
        }
        $id_Evento = $_GET['id'] ?? header('Location:/');
        $evento = $_GET['evento'];
        $paramsSelectAllEventosbyToken = array(
            'servicio' => 'consulta',
            'accion' => 'SelectAllEventosbyToken',
            'tipoRespuesta' => 'json',
            'token' => $id_Evento
        );
        $SelectAllEventosbyToken = makeApiRequest($paramsSelectAllEventosbyToken);
        $router->render('vistas/coordinador/subeventos', ["eventos" => $SelectAllEventosbyToken, "nombreevento" => $evento]);
    }
    public static function crearsubevento(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id_padre=$_POST['token'];
            $nombre_subevento=$_POST['nombre_subevento'];
            $lugar_subEvento=$_POST['lugar_subEvento'];
            $idSubevento=uniqid();
            $paramsInsertNewSubEvento = array(
                'servicio' => 'crea',
                'accion' => 'InsertNewSubEvento',
                'tipoRespuesta' => 'json',
                'idSubevento' => $idSubevento,
                'id_padre' => $id_padre,
                'nombre' => $nombre_subevento,
                'lugar' => $lugar_subEvento
            );
            $InsertNewSubEvento = makeApiRequest($paramsInsertNewSubEvento);
            $success = $InsertNewSubEvento['info'][0]['Success'];
            if($success){
                $response = array("success" => true, "message" =>$InsertNewSubEvento['info'][0]['Mensaje'] );
                exit(json_encode($response));
            }else{
                $response = array("success" => false, "message" => "Ocurrio algo inesperado...");
                exit(json_encode($response));
            }
        }
    }
    public static function actualizarsubevento(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $subeventoId=$_POST['subeventoId'];
            $nombre=$_POST['nombre'];
            $lugar=$_POST['lugar'];
            $paramsUpdateSubEventobyToken = array(
                'servicio' => 'actualiza',
                'accion' => 'UpdateSubEventobyToken',
                'tipoRespuesta' => 'json',
                'id' => $subeventoId,
                'nombre' => $nombre,
                'lugar' => $lugar
            );
            $UpdateSubEventobyToken = makeApiRequest($paramsUpdateSubEventobyToken);
            $success = $UpdateSubEventobyToken['info'][0]['Success'];
            if ($success) {
                $response = array("success" => true, "message" => "Se actualizo correctamente el subevento");
                exit(json_encode($response));
            } else {
                $response = array("success" => false, "message" => "Ocurrio algo inesperado");
                exit(json_encode($response));
            }
        }
    }
}