<?php
namespace App\DTO\Record;

class SelectRecord
{
    public $from;
    public $to;

    public function __construct($from,$to)
    {
        $this->from = $from;
        $this->to = $to;
    }
}
