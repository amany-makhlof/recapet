<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // or Hash::make('password')
            'remember_token' => null,
        ];
    }

    public function withWallet(float $balance = 0)
    {
        return $this->afterCreating(function (User $user) use ($balance) {
            $user->wallet()->save(new Wallet(['balance' => $balance]));
        });
    }
}
