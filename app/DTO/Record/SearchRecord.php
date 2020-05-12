<?php


namespace App\DTO\Record;


class SearchRecord
{
    public $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

}
