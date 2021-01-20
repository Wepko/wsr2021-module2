<?php 

/* "flights_to": [
  {
      "flight_id": 2,
      "flight_code": "FP1200",
      "from": {
          "city": "Kazan",
          "airport": "Kazan",
          "iata": "KZN",
          "date": "2020-10-01",
          "time": "12:00"
      },
      "to": {
          "city": "Moscow",
          "airport": "Sheremetyevo",
          "iata": "SVO",
          "date": "2020-10-01",
          "time": "13:35"
      },
      "cost": 9500,
      "availability": 156
  },
  {
      "flight_id": 14,
      "flight_code": "FP 1201",
      "from": {
          "city": "Kazan",
          "airport": "Kazan",
          "iata": "KZN",
          "date": "2020-10-01",
          "time": "08:35"
      },
      "to": {
          "city": "Moscow",
          "airport": "Sheremetyevo",
          "iata": "SVO",
          "date": "2020-10-01",
          "time": "10:05"
      },
      "cost": 10500,
      "availability": 156
  }
],
"flights_back": [
  {
      "flight_id": 1,
      "flight_code": "FP 2100",
      "from": {
          "city": "Moscow",
          "airport": "Sheremetyevo",
          "iata": "SVO",
          "date": "2020-10-10",
          "time": "08:35"
      },
      "to": {
          "city": "Kazan",
          "airport": "Kazan",
          "iata": "KZN",
          "date": "2020-10-10",
          "time": "10:05"
      },
      "cost": 10500,
      "availability": 156
  },
  {
      "flight_id": 13,
      "flight_code": "FP 2101",
      "from": {
          "city": "Moscow",
          "airport": "Sheremetyevo",
          "iata": "SVO",
          "date": "2020-10-10",
          "time": "12:00"
      },
      "to": {
          "city": "Kazan",
          "airport": "Kazan",
          "iata": "KZN",
          "date": "2020-10-10",
          "time": "13:35"
      },
      "cost": 12500,
      "availability": 156
  }
]
} */
/* 
SELECT flights.id, flight_code, from_id, to_id, time_from, time_to, cost, airports.city, airports.name, airports.iata FROM `flights` 
JOIN airports on flights.from_id = airports.id

ORDER BY `flights`.`id` ASC */