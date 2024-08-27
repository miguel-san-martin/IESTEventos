<?php 
function makeApiRequest($params) {
    // URL de la API
    $url = 'https://sie.iest.edu.mx/api/proyecto-iest-alumnos/api.php';

    // Codificar los parámetros en la URL
    $queryString = http_build_query($params);

    // URL completa con los parámetros
    $fullUrl = $url . '?' . $queryString;
    $response = file_get_contents($fullUrl);
    if ($response === false) {
        // Manejar el error en caso de que la solicitud falle
        echo "Error al realizar la solicitud a la API.";
        return null;
    } else {
        // Decodificar la respuesta JSON a un array asociativo
        $data = json_decode($response, true);
        if ($data === null) {
            // Manejar el error en caso de que la decodificación del JSON falle
            echo "Error al decodificar la respuesta JSON de la API.";
            return null;
        } else {
            return $data;
        }
}

}

?>