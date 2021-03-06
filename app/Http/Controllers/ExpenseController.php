<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Imports\ExpenseImport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = $this->getExpenses();
        return view('welcome', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:3',
            'entry_date' => 'required|date_format:Y-m-d H:i:s',
            'amount' => 'required|numeric',
        ]);

        $expense = new Expense();
        $expense->name = $validate['name'];
        $expense->entry_date = $validate['entry_date'];
        $expense->amount = $validate['amount'];
        $expense->save();

        return response()->json($this->getExpenses());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $validate = $request->validate([
            'name' => 'required|min:3',
            'entry_date' => 'required|date_format:Y-m-d H:i:s',
            'amount' => 'required|numeric',
        ]);

        $expense->update([
            'name' => $validate['name'],
            'entry_date' => $validate['entry_date'],
            'amount' => $validate['amount'],
        ]);

        return response()->json($expense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Expense $expense
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
    }

    public function getCsvRowCount(Request $request)
    {
        $validate = $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $count = (new ExpenseImport)->toCollection($validate['file'])->shift()->count();

        return response()->json([
            'rows' => $count,
        ]);
    }

    public function import(Request $request)
    {
        $validate = $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        Excel::import(new ExpenseImport, $validate['file']);
        return response()->json($this->getExpenses());
    }

    private function getExpenses()
    {
        $data = Expense::orderBy('entry_date', 'desc')->paginate(100);

        $data->setCollection(
            collect($data->items())->groupBy(function ($entry) {
                return Carbon::parse(
                    Carbon::createFromTimeString($entry['entry_date'])->format('Y-m-d')
                )->toDateString();
            })
        );

        return $data;
    }
}
