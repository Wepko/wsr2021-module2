<?php

  include('core/db.php');

  function registerUser($first_name,  $last_name,  $phone,  $document_number, $password, $api_token, $created_at, $updated_at) {
    $params = [
      'first_name' => $first_name,
      'last_name' => $last_name,
      'phone' => $phone,
      'document_number' => $document_number,
      'password' => $password,
      'api_token' => $api_token, 
      'created_at' => $created_at,
      'updated_at' => $updated_at
    ];

    $sql = "INSERT users (first_name, last_name, phone, document_number, password, api_token, created_at, updated_at) VALUES (:first_name, :last_name, :phone, :document_number, :password, :api_token, :created_at, :updated_at)";
    dbQuery($sql, $params);
    return true;
  }

  function loginUser($phone, $password) {
    $sql = "SELECT api_token FROM users WHERE phone = :phone AND password = :password";
    $query = dbQuery($sql, ['phone' => $phone, 'password' => $password]);
    $user = $query->fetch();
    return $user === false ? null : $user;
  }




