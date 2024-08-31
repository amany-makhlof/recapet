<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'recipient_user_id' => User::factory(),
            'type' => $this->faker->word,
            'amount' => $this->faker->randomFloat(2, 1, 100),
            'transaction_fee' => $this->faker->randomFloat(2, 0, 10),
        ];
    }
}
