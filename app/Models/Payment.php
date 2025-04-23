<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_loan', 'payment_Amount', 'not_paid', 'payment_date', 'payment_Status'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'id_loan');
    }
}