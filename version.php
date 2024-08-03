<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $packageName = $_POST['package'];

    // URL de la API de pub.dev
    $apiUrl = 'https://pub.dev/api/packages/' . $packageName;

    // Utilizar cURL para realizar la solicitud HTTP
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decodificar la respuesta JSON
    $data = json_decode($response, true);

    // Manejar posibles errores en la respuesta
    if (isset($data['error'])) {
        echo json_encode(['error' => $data['error']['message']]);
    } else {
        // Obtener la versión
        $version = $data['latest']['version'] ?? 'No se encontró la versión';

        echo json_encode(['version' => $version]);
    }

} else {
    // Manejar caso de acceso directo (opcional)
    echo "Acceso no válido. Utiliza el formulario.";
}

?>