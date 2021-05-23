<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'checked',
        'description',
        'interest',
        'date_of_birth',
        'email',
        'account',
        'credit_card_type',
        'credit_card_number',
        'credit_card_name',
        'credit_card_expiration_date',
    ];

    /**
     * @return HasOne
     */
    public function creditCard(): HasOne
    {
        return $this->hasOne(CreditCard::class);
    }
}
