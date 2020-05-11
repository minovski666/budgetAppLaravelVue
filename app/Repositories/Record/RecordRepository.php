<?php


namespace App\Repositories\Record;


use App\Repositories\BaseRepository;
use App\Record;

class RecordRepository extends BaseRepository implements RecordRepositoryInterface
{

    public $model;

    public function __construct(Record $record)
    {
        // set the model
        $this->model = $record;
    }

    public function storingRecord()
    {
        return 'test';
    }

    public function deleteRecord($id)
    {
        $record = $this->model::findOrFail($id);

        $record->delete();
    }
}
