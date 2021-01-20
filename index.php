<?php
  $method = $_SERVER['REQUEST_METHOD'];
  $url = isset($_GET['q']) ? trim($_GET['q'], '/') : '';
  $urls = explode('/', $url);


  $api = $urls[0];
  $api_name = $urls[1];
  $params = array_slice($urls, 2);


  if (file_exists("api/$api_name.php")) {

    include_once("api/$api_name.php");
    route($method, $params);
  } else {

    header('HTTP/1.1 404 Not Found');
    header('Content-Type: application/json');
    echo json_encode(array(
      "error" => array(
        "code" => 404,
        "message" => "Error: Not Found 404",
        "errors" => [
          "systeam" => ["Ошибка URL адресса Примерная структура >> api/{{name}}"]
        ]
      )
    ));
  }

