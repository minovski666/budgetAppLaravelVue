<?php


namespace App\Repositories\Record;


interface RecordRepositoryInterface
{
    public function storingRecord($args);

    public function editingRecord($args);

    public function deleteRecord($id);

    public function showAllRecords();

    public function betweenDate($from, $to);

    public function betweenDateBalance($from, $to);

    public function getIncomeFilter($from, $to);

    public function getExpenseFilter($from, $to);

    public function getBalanceFilter($from, $to);

    public function showIncomeMonth();

    public function showExpenseMonth();

    public function showSearchResults($search);

    public function showSearchResultsIncome($search);

    public function showSearchResultsExpense($search);
}
