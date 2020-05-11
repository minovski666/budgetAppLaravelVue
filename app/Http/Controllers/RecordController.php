<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\SelectRequest;
use App\Record;
use App\Services\RecordService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    public $recordService;

    public function __construct(RecordService $recordService)
    {
        $this->recordService = $recordService;
    }

    public function index()
    {
        $records = Record::where('created_at', '>=', Carbon::now()->subMonth()->toDateTimeString())->get();
        return view('records.index', compact('records'));
    }

    public function getRecords()
    {
        $records = Record::where( DB::raw('MONTH(created_at)'), '=', date('n') )->get();
        return $records;
    }

    public function store(CreateRequest $requestFromDto)
    {
        $this->recordService->store($requestFromDto->convertToDto());

        return 'Success';
    }

    public function showFilters()
    {
        return view('records.filters');
    }

    public function allIncomes()
    {
        return $this->recordService->getIncome();
    }

    public function allExpenses()
    {
        return $this->recordService->getExpense();
    }

    public function balance()
    {
        return [
            'income' => $this->allIncomes(),
            'expense' => $this->allExpenses(),
            'balance' => $this->recordService->getBalance()
        ];
    }

    public function destroy(DeleteRequest $delReq)
    {
        $this->recordService->destroyRecord($delReq->convertToDto());

        return 'Deleted successful';
    }

    public function select(SelectRequest $selReq)
    {
        return $this->recordService->getSelectedRange($selReq->convertToDto());
    }

    public function selectBalance(SelectRequest $selReq)
    {
        return [
            'income' => $this->recordService->filteredIncome($selReq->convertToDto()),
            'expense' => $this->recordService->filteredExpense($selReq->convertToDto()),
            'balance' => $this->recordService->filtredBalance($selReq->convertToDto())
        ];
    }
}