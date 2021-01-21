<?php
  include_once('core/db.php');

  function flightsByIata($iata) {
    $sql = "SELECT flights.id as flight_id, flight_code, from_id, to_id, time_from, time_to, cost, airports.iata FROM `flights` 
    JOIN airports on flights.from_id = airports.id 
    WHERE airports.iata = :iata 
    ORDER BY `flights`.`id` ASC";
    $param = ['iata' => $iata];
    $query = dbQuery($sql, $param);
    $res = $query->fetchAll();
    return $res === false ? null : $res;
  }

  function flightsByAirport($id) {
    $sql = "SELECT city, name as airport, iata FROM airports WHERE id = :id";
    $param = ['id' => $id];
    $query = dbQuery($sql, $param);
    $res = $query->fetch();
    return $res === false ? null : $res;
  }

  function createFlights($from_to) {

    $all_flights = flightsByIata($from_to);
    $flights = [];

    
    
    foreach ($all_flights as $key => $flights_obj) {
      $from = flightsByAirport($flights_obj['from_id']);
      $from['time'] = $flights_obj['time_from'];
      $from['date'] = Date('d-m-y'); 

      $to = flightsByAirport($flights_obj['to_id']);
      $to['time'] = $flights_obj['time_to'];
      $to['date'] = Date('d-m-y'); 
      $dateTime['asdf'] = 'fasd';

      $obj_flights['flight_id'] = $flights_obj['flight_id'];
      $obj_flights['flight_code'] = $flights_obj['flight_code'];
      $obj_flights['from'] = $from;
      $obj_flights['to'] = $to;
      $obj_flights['cost'] = $flights_obj['cost'];
      $obj_flights['availability'] = 156;
     
      array_push($flights, $obj_flights);
    }

    return $flights;
  }







