<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class SufficientBalance implements Rule
{
    protected $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function passes($attribute, $value)
    {
        $user = Auth::user();
        $transactionFee = $this->calculateFee($this->amount);
        return $user && $user->wallet->balance >= ($this->amount + $transactionFee);
    }

    public function message()
    {
        return 'Insufficient balance including transaction fees.';
    }

    protected function calculateFee(float $amount): float
    {
        return ($amount > 25) ? (2.5 + 0.10 * $amount) : 0;
    }
}
