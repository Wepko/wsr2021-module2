<?php

  include_once('core/db.php');

  function bookingCode($query) {
    $sql = "SELECT id, code, flight_from, flight_back FROM bookings WHERE code = :query ";
    $query = dbQuery($sql, ['query' => $query]);
    $airports = $query->fetch();
    return $airports === false ? null : $airports;
  }

  function bookingFlights($query) {
    $sql = "SELECT * FROM `module2`.`flights` WHERE `id` = :query";
    $query = dbQuery($sql, ['query' => $query]);
    $obj = $query->fetch();
    return $obj === false ? null : $obj;
  }

  function flightsByAirport($id) {
    $sql = "SELECT city, name as airport, iata FROM airports WHERE id = :id";
    $param = ['id' => $id];
    $query = dbQuery($sql, $param);
    $res = $query->fetch();
    return $res === false ? null : $res;
  }

  function pessengersByBookings($id) {
    $sql = "SELECT id, booking_id, first_name, last_name, birth_date, document_number, place_from, place_back  FROM `passengers` WHERE booking_id = :id";
    $param = ['id' => $id];
    $query = dbQuery($sql, $param);
    $res = $query->fetchAll();
    return $res === false ? null : $res;
  }

  function createBookingsFlights($fligth) {
    
    $fligth = bookingFlights($fligth);


    $from = flightsByAirport($fligth['from_id']);
    $from['time'] = $fligth['time_from'];
    $from['date'] = Date('d-m-y'); 

    $to = flightsByAirport($fligth['to_id']);
    $to['time'] = $fligth['time_to'];
    $to['date'] = Date('d-m-y'); 



      $res = [
        'flight_id' => $fligth['id'],
        'flight_code' => $fligth['flight_code'],
        'from' => $from,
        'to' => $to,
        'cost' => $fligth['cost'],
        'availability' => '56'
      ];

    return $res;
  }


