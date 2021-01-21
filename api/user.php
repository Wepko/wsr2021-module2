<?php 

  include('core/systeam.php');
  include('model/users.php');

  function route($method, $paramsUrl, $api_name) {
    if ($method === 'GET' && empty($paramsUrl) && $api_name == 'booking') {

      print_r('user Booking');
     

      return true;
    }

    if ($method === 'GET' && empty($paramsUrl) && empty($api_name)) {

      print_r('user');
     

      return true;
    }


      // Возвращаем ошибку
    header('HTTP/1.0 404 Not Found');
    header('Content-Type: application/json');
    echo json_encode(array(
      'error' => 'Error: 404 Not Found >> Такого api не сучществует'
    ));
  }
