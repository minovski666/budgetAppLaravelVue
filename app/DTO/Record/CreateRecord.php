<?php
namespace App\DTO\Record;

class CreateRecord
{
    public $cost;
    public $select;
    public $_token;
    public $name;

    public function __construct($_token,$cost,$select, $name)
    {
        $this->_token = $_token;
        $this->cost = $cost;
        $this->select = $select;
        $this->name = $name;
    }
}
