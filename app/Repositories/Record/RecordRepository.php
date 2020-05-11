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

    public function betweenDate($from, $to)
    {
        $startDate = date('Y-m-d', strtotime($from));
        $endDate = date('Y-m-d', strtotime($to));
        return $this->model::whereDate('created_at', '>', $startDate)->whereDate('created_at', '<', $endDate)->get();
    }

    public function betweenDateBalance($from, $to)
    {
        $startDate = date('Y-m-d', strtotime($from));
        $endDate = date('Y-m-d', strtotime($to));
        return $this->model::whereDate('created_at', '>', $startDate)->whereDate('created_at', '<', $endDate)->get();
    }

    public function getIncomeFilter($from, $to)
    {
        $startDate = date('Y-m-d', strtotime($from));
        $endDate = date('Y-m-d', strtotime($to));
        return $this->model::where('select', '=', 1)->whereDate('created_at', '>', $startDate)->whereDate('created_at', '<', $endDate)->sum('cost');

    }

    public function getExpenseFilter($from, $to)
    {
        $startDate = date('Y-m-d', strtotime($from));
        $endDate = date('Y-m-d', strtotime($to));
        return $this->model::where('select', '=', 2)->whereDate('created_at', '>', $startDate)->whereDate('created_at', '<', $endDate)->sum('cost');
    }

    public function getBalanceFilter($from, $to)
    {
        return $this->getIncomeFilter($from, $to) - $this->getExpenseFilter($from, $to);
    }
}
