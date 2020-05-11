<?php


namespace App\Services;


use App\DTO\Record\CreateRecord;
use App\DTO\Record\DeleteRecord;
use App\DTO\Record\SelectRecord;
use App\Repositories\Record\RecordRepository;
use App\Record;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        $records = Record::where('select', '=', 1)->where( DB::raw('MONTH(created_at)'), '=', date('n') )->sum('cost');
        return $records;
    }

    public function getExpense()
    {
        $records = Record::where('select', '=', 2)->where( DB::raw('MONTH(created_at)'), '=', date('n') )->sum('cost');
        return $records;
    }

    public function getBalance()
    {
        $incomes = $this->getIncome();
        $expense = $this->getExpense();

        return $incomes - $expense;
    }

    public function destroyRecord(DeleteRecord $dto)
    {
        $record = new Record();
        $record->id = $dto->id;
        $this->recordRepository->deleteRecord($record->id);
    }

    public function getSelectedRange(SelectRecord $dto)
    {
        $record = new Record();
        $record->from = $dto->from;
        $record->to = $dto->to;
        return $this->recordRepository->betweenDate($record->from, $record->to);
    }

    public function filteredIncome(SelectRecord $dto)
    {
        $record = new Record();
        $record->from = $dto->from;
        $record->to = $dto->to;
        return $this->recordRepository->getIncomeFilter($record->from, $record->to);
    }

    public function filteredExpense(SelectRecord $dto)
    {
        $record = new Record();
        $record->from = $dto->from;
        $record->to = $dto->to;
        return $this->recordRepository->getExpenseFilter($record->from, $record->to);
    }

    public function filtredBalance(SelectRecord $dto)
    {
        $filtredIncome = $this->filteredIncome($dto);
        $filtredExpense = $this->filteredExpense($dto);

        return $filtredIncome - $filtredExpense;
    }
}
