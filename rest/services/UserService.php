<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/CustomerDao.class.php";


class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new CustomerDao);
    }


    function getUserByFirstNameAndLastName($customer_name, $customer_surname)
    {
        return $this->dao->getUserByFirstNameAndLastName($customer_name, $customer_surname);
    }
}
?>
