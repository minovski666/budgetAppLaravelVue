<?php
namespace App\DTO\Record;

class DeleteRecord
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
