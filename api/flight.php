<?php 

  include('core/systeam.php');
  include('model/flights.php');

  function route($method, $paramsUrl) {
    if ($method === 'GET' && empty($paramsUrl)) {

      

      return true;
    }

      // Возвращаем ошибку
    header('HTTP/1.0 404 Not Found');
    header('Content-Type: application/json');
    echo json_encode(array(
      'error' => 'Error: 404 Not Found >> Такого api не сучществует'
    ));
  }
