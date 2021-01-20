<?php 
  include_once('core/db.php');
  function searchAirports($query) {
    $sql = "SELECT name, iata FROM airports WHERE city like :query or name like :query or iata like :query";
    $query = dbQuery($sql, ['query' => "%$query%"]);
    $airports = $query->fetchAll();
    return $airports === false ? null : $airports;
  }

