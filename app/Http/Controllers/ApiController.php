<?php
// Datos
$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InJleWVzc2FuY2hlem1pZ3VlbDIwMDlAZ21haWwuY29tIn0.8IVqj1F-B02VHKO8ubPnu-43-C-aEMGeSg8EqrwZ0A4';
$dni = $_REQUEST['dni'];

// Iniciar llamada a API
$curl = curl_init();

// Buscar ruc sunat
curl_setopt_array($curl, array(
  // para user api versión 2
  //CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
  // para user api versión 1
  //CURLOPT_URL => 'https://api.sunat.dev/ruc/'. $ruc.'?apikey=' . $token,
  CURLOPT_URL => 'https://dniruc.apisperu.com/api/v1/dni/' . $dni.'?token='.$token,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_CUSTOMREQUEST => 'GET',
  /*CURLOPT_HTTPHEADER => array(
    'Referer: http://apis.net.pe/api-ruc',
    'Authorization: Bearer ' . $token
  ),*/
));

$response = curl_exec($curl);
echo $response;