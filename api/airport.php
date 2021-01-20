<?php 

  include('core/systeam.php');
  include('model/airports.php');

  function route($method, $paramsUrl) {
    if ($method === 'GET' && empty($paramsUrl)) {
      $query = $_GET['query'];
      if (isset($query) && !empty($query)) {
        header('HTTP/1.0 200 Ok');
        header('Content-Type: application/json');

        $airports = searchAirports($query);

        echo json_encode([
          "data" => [
            "items" => $airports
          ]   
        ]);
      } else {
        header('HTTP/1.0 200 Ok');
        header('Content-Type: application/json');
        echo json_encode([
          "data" => [
            "items" => []
          ]   
        ]);
      }

      return true;
    }

      // Возвращаем ошибку
    header('HTTP/1.0 404 Not Found');
    header('Content-Type: application/json');
    echo json_encode(array(
      'error' => 'Error: 404 Not Found >> Такого api не сучществует'
    ));
  }
