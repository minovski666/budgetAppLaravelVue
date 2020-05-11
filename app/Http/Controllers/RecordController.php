<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\DeleteRequest;
use App\Record;
use App\Services\RecordService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecordController extends Controller
{
   public $recordService;

   public function __construct(RecordService $recordService)
   {
       $this->recordService = $recordService;
   }
    public function index()
    {
        $records = Record::all()->where('created_at', '>=', Carbon::now()->subMonth()->toDateTimeString());
        return view('records.index', compact('records'));
    }

    public function getRecords()
    {
        $records = Record::all()->where('created_at', '>=', Carbon::now()->subMonth()->toDateTimeString());
        return $records;
    }

    public function store(CreateRequest $requestFromDto)
    {
        $this->recordService->store($requestFromDto->convertToDto());

        return 'Success';
    }

    public function create()
    {
        return view('records.create');
    }

    public function allIncomes(){
       return $this->recordService->getIncome();
    }

    public function allExpenses(){
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
}
