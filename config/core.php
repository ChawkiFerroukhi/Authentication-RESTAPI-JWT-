<?php


    error_reporting(E_ALL);

    date_default_timezone_set('europe/paris');

    $key = "example_key";
    $issued_at = time();
    $expiration_time = $issued_at + (60 * 60); // valid for one hour
    $issuer = "http://localhost:8080/AuthenticationRESTAPI/";

?>