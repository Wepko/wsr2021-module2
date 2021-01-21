<?php 

  include('core/systeam.php');
  include('model/flights.php');

  function route($method, $paramsUrl) {
    if ($method === 'GET' && empty($paramsUrl)) {

      $err = []; 

      $from = $_GET['from'];
      $to = $_GET['to'];
      $date1 = $_GET['date1'];
      $date2 = $_GET['date2'];
      $passengers = $_GET['passengers'];


      $flights_to = createFlights($to);
      $flights_back = createFlights($from);
      if (!empty($flights_to) && !empty($flights_back)) {
        header('HTTP/1.0 200 Ok');
        header('Content-Type: application/json');


        echo json_encode($data = [
          "flights_to" =>  $flights_to,
          "flights_back" => $flights_back
        ]);
      } else {
        header('HTTP/1.0 422 Validation error');
        header('Content-Type: application/json');

        echo json_encode(array(
          "error" => [
            "code" => 422,
            "message" => "Validation error",
            "errors" => ['Неверно введены данные from или to']
          ]
        ));
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
