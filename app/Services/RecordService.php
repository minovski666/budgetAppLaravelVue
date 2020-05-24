<?php


namespace App\Services;


use App\DTO\Record\CreateRecord;
use App\DTO\Record\DeleteRecord;
use App\DTO\Record\SearchRecord;
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

    public function getAllRecords()
    {
        return $this->recordRepository->showAllRecords();
    }

    public function store(CreateRecord $dto)
    {
        $record = new Record();
        $record->cost = $dto->cost;
        $record->select = $dto->select;
        $record->name = $dto->name;
        $args = ['cost' => $record->cost, 'select' => $record->select, 'name' => $record->name];
        $this->recordRepository->storingRecord($args);
    }

    public function getIncome()
    {
        return $this->recordRepository->showIncomeMonth();
    }

    public function getExpense()
    {
        return $this->recordRepository->showExpenseMonth();
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

    public function getSearchIncome(SearchRecord $dto)
    {
        $record = new Record();
        $record->search = $dto->search;
        return $this->recordRepository->showSearchResultsIncome($record->search);
    }

    public function getSearchExpense(SearchRecord $dto)
    {
        $record = new Record();
        $record->search = $dto->search;
        return $this->recordRepository->showSearchResultsExpense($record->search);
    }

    public function getSearchBalance(SearchRecord $dto)
    {
        $income = $this->getSearchIncome($dto);
        $expense = $this->getSearchExpense($dto);
        return $income - $expense;
    }

    public function getSearchResults($search)
    {
        return $this->recordRepository->showSearchResults($search);
    }
}
