<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDetails extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'clientid',
        'number_of_payment',
        'first_payment_date',
        'last_payment_date',
        'loan_amount',
        'created_at',
        'updated_at'
    ];
}
