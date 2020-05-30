<?php
namespace App\DTO\Record;

class EditRecord
{
    public $id;
    public $cost;
    public $select;
    public $_token;
    public $name;

    public function __construct($id, $_token,$cost,$select, $name)
    {
        $this->id = $id;
        $this->_token = $_token;
        $this->cost = $cost;
        $this->select = $select;
        $this->name = $name;
    }
}
