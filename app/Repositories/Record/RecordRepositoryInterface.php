<?php


namespace App\Repositories\Record;


interface RecordRepositoryInterface
{
    public function storingRecord();

    public function deleteRecord($id);
}
