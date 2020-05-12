<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\SearchRequest;
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
        return view('records.index');
    }

    public function getRecords()
    {
        return $this->recordService->getAllRecords();
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

    public function searchResults($search)
    {
        return $this->recordService->getSearchResults($search);
    }

    public function searchBalance(SearchRequest $srcReq)
    {
        return [
            'income' => $this->recordService->getSearchIncome($srcReq->convertToDto()),
            'expense' => $this->recordService->getSearchExpense($srcReq->convertToDto()),
            'balance' => $this->recordService->getSearchBalance($srcReq->convertToDto())
        ];
    }
}
