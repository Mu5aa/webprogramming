<?php
Flight::route('GET /api/users', function () {
    Flight::json(Flight::userService()->get_all());
});


Flight::route('GET /api/users/@customer_id', function ($customer_id) {
    Flight::json(Flight::userService()->get_by_customer_id($customer_id));
});


Flight::route('GET /api/users/@firstName/@lastName', function ($customer_name, $customer_surname) {
    Flight::json(Flight::userService()->getUserByFirstNameAndLastName($customer_name, $customer_surname));
});


Flight::route('POST /api/users', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->add($data));
});


Flight::route('PUT /api/users/@customer_id', function ($customer_id) {
    $data = Flight::request()->data->getData();
    Flight::userService()->update($customer_id, $data);
    Flight::json(Flight::userService()->get_by_customer_id($customer_id));
});


Flight::route('DELETE /api/users/@customer_id', function ($customer_id) {
    Flight::userService()->delete($customer_id);
});


?>
