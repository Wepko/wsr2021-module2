<?php 

  include('core/systeam.php');
  include('model/users.php');

  function route($method, $paramsUrl) {
    if ($method === 'POST' && empty($paramsUrl)) {
      $err = array();

      $phone = $_POST['phone'];
      $password = $_POST['password'];



      if ( !(isset($phone) && validStr($phone, 5, 10))) {
        $err['phone'] = 'Ощибка: Поле не существует или слишком короткое название для телефона';
      }

      if ( !(isset($password) && validStr($password, 6, 12)))  {
        $err['password'] = 'Ощибка: Поле не существует или слишком короткое название';
      }

      if (empty($err)) {
        $user = loginUser($phone, $password);
        if (isset($user)) {
          header('HTTP/1.1 200 Ok');
          header('Content-Type: application/json');

          echo json_encode(array(
            "data" => [
              "token" => $user['api_token']
            ]         
          ));
        } else {
          header('HTTP/1.1 401 Unauthorized');
          header('Content-Type: application/json');
          echo json_encode(array(
            "error" => [
              "code" => 401,
              "message" => "Unauthorized",
              "errors" => [
                "phone" => [ "phone or password incorrect"]
              ]
            ]
          ));
          
        }

      } else {
        header('HTTP/1.0 422 Validation error');
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
