<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    use HasFactory;

    protected $table = 'profit';

    protected $fillable = [
        'id_loan', 'profit_Riel', 'profit_Dollar', 'profit_Baht'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'id_loan');
    }
}
