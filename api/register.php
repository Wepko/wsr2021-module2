<?php 

  include('core/systeam.php');
  include('model/users.php');

  function route($method, $paramsUrl) {
    if ($method === 'POST' && empty($paramsUrl)) {
      $err = array();

      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $phone = $_POST['phone'];
      $document_number = $_POST['document_number'];
      $password = $_POST['password'];

      if (!(isset($first_name) && validStr($first_name, 2, 12))) {
        $err['first_name'] = 'Ощибка: Поле не существует или слишком короткое название Имени';
      }

      if ( !(isset($last_name) && validStr($last_name, 5, 15))) {
        $err['last_name'] = 'Ощибка: Поле не существует или слишком короткое название Фамилии';
      }

      if ( !(isset($phone) && validStr($phone, 5, 10))) {
        $err['phone'] = 'Ощибка: Поле не существует или слишком короткое название для телефона';
      }

      if ( !(isset($document_number) && mb_strlen($document_number) == 10)) {
        $err['document_number'] = 'Ощибка: Поле не существует или слишком короткое название';
      } 

      if ( !(isset($password) && validStr($password, 6, 12)))  {
        $err['password'] = 'Ощибка: Поле не существует или слишком короткое название';
      }

      if (empty($err)) {
        header('HTTP/1.1 204 Not Content');
        header('Content-Type: application/json');
        $today = date("Y-m-d H:i:s");
        $token = substr(bin2hex(random_bytes(128)), 0, 128);
        registerUser($first_name, $last_name, $phone, $document_number, $password, $token, $today, null);
      } else {
        header('HTTP/1.0 422 Error');
        header('Content-Type: application/json');
        echo json_encode(array(
            "error" => array(
                "code" => 422,
                "message" => "Validation error",
                "errors" => $err
            )
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
