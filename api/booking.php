<?php 

  include('core/systeam.php');
  include('model/bookings.php');

  function route($method, $paramsUrl) {
    if ($method === 'POST' && empty($paramsUrl)) {
      $err = [];

      $data = json_decode(file_get_contents("php://input"), true);

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

      return true;
    }

      // Возвращаем ошибку
    header('HTTP/1.0 404 Not Found');
    header('Content-Type: application/json');
    echo json_encode(array(
      'error' => 'Error: 404 Not Found >> Такого api не сучществует'
    ));
  }
