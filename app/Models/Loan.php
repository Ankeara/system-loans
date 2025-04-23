<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loans';

    protected $fillable = [
        'id_client', 'currency', 'loan_Amount_Riel', 'interest_Rate_Riel', 'payment_Amount_Riel',
        'loan_Amount_Baht', 'interest_Rate_Baht', 'payment_Amount_Baht',
        'loan_Amount_Dollar', 'interest_Rate_Dollar', 'payment_Amount_Dollar',
        'loan_Term', 'start_Date', 'end_Date', 'status', 'picture', 'video'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client'); // Correct!
    }


    public function payments()
    {
        return $this->hasMany(Payment::class, 'id_loan');
    }

    public function returnLoan()
    {
        return $this->hasOne(ReturnLoan::class, 'id_loan');
    }

    public function profit()
    {
        return $this->hasOne(Profit::class, 'id_loan');
    }

    public function endPaid()
    {
        return $this->hasOne(EndLoan::class, 'id_loan');
    }
}
