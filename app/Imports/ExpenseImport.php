<?php

namespace App\Imports;

use App\Expense;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class ExpenseImport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Expense([
            'name' => $row['label'],
            'entry_date' => $row['date'],
            'amount' => $row['value'],
        ]);
    }

    public function chunkSize()
    {
        return 100;
    }
}
