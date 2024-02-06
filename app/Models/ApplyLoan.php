<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyLoan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'loan_amount',
        'monthly_income',
        'purpose_loan',
        'loan_year',
        'full_name',
        'email',
        'phone_number',
        'marital_status',
        'date_birth',
        'number_dependents',
        'house_no',
        'street',
        'province',
        'city',
        'country',
    ];
}
