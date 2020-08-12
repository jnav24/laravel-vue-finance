<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'name',
        'entry_date',
        'amount',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
