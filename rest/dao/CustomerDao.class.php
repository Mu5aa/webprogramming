<?php
require_once __DIR__ . '/BaseDao.class.php';


class CustomerDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("Customers");
    }


    // custom function, which is not present in BaseDao
    // query_unique -> returns only 1 result if multiple are present
    function getUserByFirstNameAndLastName($customer_name, $customer_surname)
    {
        return $this->query_unique("SELECT * FROM Customers WHERE customer_name = :customer_name AND customer_surname = :customer_surname", ["customer_name" => $customer_name, "customer_surname" => $customer_surname]);
    }
}
?>
