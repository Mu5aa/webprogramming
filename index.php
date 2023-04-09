<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');
require 'vendor/autoload.php';

Flight::register('db', 'PDO', 
array('mysql:host=localhost;dbname=rentacar','root',''));


Flight::route('GET /api/users', function(){
  $users = Flight::db()->query('SELECT * FROM Customers', PDO::FETCH_ASSOC)->fetchAll();
  var_dump($users);
  Flight::json($users);
  });




Flight::start();

?>

