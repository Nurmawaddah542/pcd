<?php
function scanNominal()
{
    $url = 'http://localhost:5000/scan';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);

    if ($response === false) {
        return ["error" => "Tidak dapat terhubung ke API"];
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ["error" => "Format JSON tidak valid: " . json_last_error_msg()];
    }

    return $data;
}

header('Content-Type: application/json');
echo json_encode(scanNominal());
?>