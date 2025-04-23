<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnLoan extends Model
{
    use HasFactory;

    protected $table = 'return_loan';

    protected $fillable = [
        'id_loan', 'day_left', 'money_left', 'more_money', 'start_Date', 'status_return' // Updated field name to match DB
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'id_loan');
    }

    public function client()
    {
        return $this->belongsTo(Loan::class, 'id_client');
    }
}
