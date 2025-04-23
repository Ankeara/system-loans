<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndLoan extends Model
{
    use HasFactory;

    protected $table = 'end_loan'; // Since table name is different from default Laravel naming

    protected $fillable = [
        'id_loan', 'status'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'id_loan');
    }
}