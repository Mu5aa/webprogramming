<?php
class BaseService
{
    protected $dao;


    public function __construct($dao)
    {
        $this->dao = $dao;
    }


    public function get_all()
    {
        return $this->dao->get_all();
    }


    public function get_by_customer_id($customer_id)
    {
        return $this->dao->get_by_customer_id($customer_id);
    }


    public function add($entity)
    {
        return $this->dao->add($entity);
    }


    public function update($entity, $customer_id)
    {
        return $this->dao->update($entity, $customer_id);
    }


    public function delete($customer_id)
    {
        return $this->dao->delete($customer_id);
    }
}
?>
