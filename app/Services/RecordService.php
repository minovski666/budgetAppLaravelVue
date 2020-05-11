<?php


namespace App\Services;


use App\DTO\Record\CreateRecord;
use App\DTO\Record\DeleteRecord;
use App\Repositories\Record\RecordRepository;
use App\Record;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RecordService
{
    public $recordRepository;

    public function __construct(RecordRepository $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }

    public function store(CreateRecord $dto)
    {
        $record = new Record();
        $record->cost = $dto->cost;
        $record->select = $dto->select;
        $record->name = $dto->name;

        $record->save();
//        $this->userRepository->create([
//           User::NAME => $dto->name,
//           User::EMAIL => $dto->email
//        ]);
    }

    public function getIncome()
    {
        $records = Record::all()->where('select', '=', 1)->where('created_at', '>=', Carbon::now()->subMonth()->toDateTimeString())->sum('cost');
        return $records;
    }

    public function getExpense()
    {
        $records = Record::all()->where('select', '=', 2)->where('created_at', '>=', Carbon::now()->subMonth()->toDateTimeString())->sum('cost');
        return $records;
    }

    public function getBalance()
    {
        $incomes = Record::all()->where('select', '=', 1)->where('created_at', '>=', Carbon::now()->subMonth()->toDateTimeString())->sum('cost');
        $expense = Record::all()->where('select', '=', 2)->where('created_at', '>=', Carbon::now()->subMonth()->toDateTimeString())->sum('cost');

        return $incomes - $expense;
    }

    public function destroyRecord(DeleteRecord $dto)
    {
        $record = new Record();
        $record->id = $dto->id;
        $this->recordRepository->deleteRecord($record->id);
    }
}
