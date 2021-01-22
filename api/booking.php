<?php 

  include('core/systeam.php');
  include('model/bookings.php');

  function route($method, $paramsUrl) {
    if ($method === 'POST' && empty($paramsUrl)) {
      $err = [];
      $data = json_decode(file_get_contents("php://input"), true);
      if (!isset($data)) {
        $err[0] = ['Нету данных'];
      } else {

        foreach ($data['passengers'] as $key => $value) {
  
          $first_name = $value['first_name'];
          $last_name = $value['last_name'];
          $document_number = $value['document_number'];
          $birth_date = $value['birth_date'];
  
          if (!(isset($first_name) && validStr($first_name, 2, 22))) {
            $err[$key]['first_name'] = 'Ощибка: Поле не существует или слишком короткое название Имени';
          }
  
          if ( !(isset($last_name) && validStr($last_name, 5, 22))) {
            $err[$key]['last_name'] = 'Ощибка: Поле не существует или слишком короткое название Фамилии';
          }
    
          if ( !(isset($document_number) && mb_strlen($document_number) == 10)) {
            $err[$key]['document_number'] = 'Ощибка: Поле не существует или слишком короткое название';
          }
            
          if ( !(isset($birth_date))) {
            $err[$key]['birth_date'] = 'Ощибка: Поле не существует или неверная дата';
          } 
    
        }
  
        if (empty($err)) {
          header('HTTP/1.1 201 Created');
          header('Content-Type: application/json');
          echo json_encode([
            "data" => [
              "code" => "QSASD" 
            ]
          ]);
        } else {
          header('HTTP/1.1 422 Validation error');
          header('Content-Type: application/json');
  
          echo json_encode([
            "error" => [
              "code" => 422,
              "message" => "Validation error",
              "errors" => $err
            ]
          ]);
        }
      }

      return true;
    }

    if ($method === 'GET' && count($paramsUrl) === 1) {
      $code = $paramsUrl[0];
  
      $bookings = bookingCode($code);

      $flights = [
        createBookingsFlights($bookings['flight_from']),
        createBookingsFlights($bookings['flight_back'])
      ];
    
    
      if (isset($bookings)) {

        header('HTTP/1.0 200 Ok');
        header('Content-Type: application/json');
        $data = [
          "code" => $bookings['code'],
          "cost" => 40000,
          "flights" => $flights,
          "passengers" => pessengersByBookings($bookings['id'])
        ];
  
        echo json_encode($data);
      } else {
        header('HTTP/1.0 404 Not Found');
        header('Content-Type: application/json');
        echo json_encode(array(
          'error' => 'Error: 404 Not Found >> Такого code нет'
        ));
      }
      
      return true;
    
    }

    if ($method === 'GET' && count($paramsUrl) === 2 && $paramsUrl[1] === 'seat') {
      $code = $paramsUrl[0];
      $booking = bookingCode($code);
      
      $occupied_from = createPlacePecenger($booking['id'], 'place_from');
      $occupied_back = createPlacePecenger($booking['id'], 'place_back');

      if (isset($occupied_from) && isset($occupied_back)) {
        header('HTTP/1.0 200 Ok');
        header('Content-Type: application/json');
        $data = [
          "occupied_from" => $occupied_from,
          "occupied_back" => $occupied_back
        ];

        echo json_encode($data);
      } else  {
        header('Content-Type: application/json');
        echo json_encode(array(
          'error' => 'Error: no corect'
        ));
      }


      return true;
    }

    if ($method === 'PATCH' && count($paramsUrl) === 2 && $paramsUrl[1] === 'seat') {
      
      return true;
    }

      // Возвращаем ошибку
    header('HTTP/1.0 404 Not Found');
    header('Content-Type: application/json');
    echo json_encode(array(
      'error' => 'Error: 404 Not Found >> Такого api не сучществует'
    ));
  }
