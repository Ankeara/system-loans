<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = ['id', 'full_Name', 'gender', 'phone_Number', 'address', 'card_ID', 'profile', 'created_at'];

    protected $dates = ['deleted_at'];

    public function loans()
    {
        return $this->hasMany(Loan::class, 'id_client');
    }

    public function loan()
    {
        return $this->hasOne(Loan::class);
    }

    public function client()
    {
        return $this->hasOneThrough(Client::class, Loan::class, 'id', 'id_client', 'id_loan');
    }

    public function endPaid()
    {
        return $this->hasOne(EndLoan::class, 'id_loan');
    }

}
