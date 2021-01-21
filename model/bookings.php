<?php

  include_once('core/db.php');

  function bookingCode($query) {
    $sql = "SELECT code, flight_from, flight_back FROM bookings WHERE code = :query ";
    $query = dbQuery($sql, ['query' => $query]);
    $airports = $query->fetch();
    return $airports === false ? null : $airports;
  }

  function bookingFlights($query) {
    $sql = "SELECT id as flight_id, flight_code, from_id as 'from', to_id as 'to' FROM flights WHERE id = :query ";
    $query = dbQuery($sql, ['query' => $query]);
    $obj = $query->fetch();
    return $obj === false ? null : $obj;
  }

  function bookingFlightsAirport($query) {
    $sql = "SELECT city, name as airport, iata FROM airports WHERE id = :query ";
    $query = dbQuery($sql, ['query' => $query]);
    $obj = $query->fetch();
    return $obj === false ? null : $obj;
  }

  $bookings = bookingCode('TESTA');
  $fligths_from = bookingFlights($bookings['flight_from']);
  $flight_back = bookingFlights($bookings['flight_back']);

  $from_fligths_from = bookingFlightsAirport($fligths_from['from']);
  $from_fligths_to = bookingFlightsAirport($fligths_from['to']);

  $from_fligths_from['date'] = '2020-10-01';
  $from_fligths_from['time'] =  '08:35';

  $from_fligths_to['date'] = '2020-10-01';
  $from_fligths_to['time'] = '10:05';

  $fligths_from['from'] = $from_fligths_from;
  $fligths_from['to'] = $from_fligths_to;
  
  print_r($fligths_from);
  $data = [
    "code" => $bookings['code'],
    "cost" => 40000,
    "flights" => []
  ];

  //$data['flights'] = 
/*   {
    "data": {
        "code": "АKIJF",
        "cost": 40000,
        "flights": [
            {
                "flight_id": 1,
                "flight_code": "FP2100",
                "from": {
                    "city": "Moscow",
                    "airport": "Sheremetyevo",
                    "iata": "SVO",
                    "date": "2020-10-01",
                    "time": "08:35"
                },
                "to": {
                    "city": "Kazan",
                    "airport": "Kazan",
                    "iata": "KZN",
                    "date": "2020-10-01",
                    "time": "10:05"
                },
                "cost": 10500,
                "availability": 56
            },
            {
                "flight_id": 2,
                "flight_code": "FP1200",
                "from": {
                    "city": "Kazan",
                    "airport": "Kazan",
                    "iata": "KZN",
                    "date": "2020-10-12",
                    "time": "12:00"
                },
                "to": {
                    "city": "Moscow",
                    "airport": "Sheremetyevo",
                    "iata": "SVO",
                    "date": "2020-10-12",
                    "time": "13:35"
                },
                "cost": 9500,
                "availability": 56
            }
        ],
        "passengers": [
            {
                "id": 1,
                "first_name": "Ivan",
                "last_name": "Ivanov",
                "birth_date": "1990-02-20",
                "document_number": "1234567890",
                "place_from": "7B",
                "place_back": null
            },
            {
                "id": 2,
                "first_name": "Ivan",
                "last_name": "Larin",
                "birth_date": "1990-03-20",
                "document_number": "1224567890",
                "place_from": null,
                "place_back": null
            }
        ]
    }
  } */