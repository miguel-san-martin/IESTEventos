<?php 


    if (!function_exists('makeApiRequest')) {
        function makeApiRequest($params) {
            // URL de la API
            $url = 'http://localhost/api/proyecto-iest-alumnos/api.php';
            // echo "PARAMS";
            // print_r($params);
            $params['tipoRespuesta']="json";
            // Codificar los parámetros en la URL
            $queryString = http_build_query($params);
            // echo "QUERY";
            // print_r($queryString);
        
            // URL completa con los parámetros
            $fullUrl = $url . '?' . $queryString;
            // echo "FULLURL:";
            // echo $fullUrl; 
            $response = file_get_contents($fullUrl);
            // echo "RESPONSE";
            // var_dump($response);
            if ($response === false) {
                // Manejar el error en caso de que la solicitud falle
                echo "Error al realizar la solicitud a la API.";
                return null;
            } else {
                // Decodificar la respuesta JSON a un array asociativo
                $data = json_decode($response, true);
                // echo "DATA";
                // print_r($data);
                if ($data === null) {
                    // Manejar el error en caso de que la decodificación del JSON falle
                    echo "Error al decodificar la respuesta JSON de la API.";
     /*                var_dump($params);
                    var_dump($response); */
                    return null;
                } else {
                    return $data;
                }
        }
        
        }
    }

?>