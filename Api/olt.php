<?php

function fetchFromApi($url) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function getInfoOnt() {
    $url = 'https://vivi.gifguild.my.id/api/vivi-vivinet-olt?req=getONT';
    return fetchFromApi($url);
}

function getDetailOnt($ont) {
    // $parts = explode("olt|", $name);
    // $ont = isset($parts[1]) ? $parts[1] : null;
    $url = 'https://vivi.gifguild.my.id/api/vivi-vivinet-olt?req=getONT&ont='.$ont;
    return fetchFromApi($url);
}

?>