<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'amount' => $this->faker->randomFloat(2, 1, 10000),
            'type' => $this->faker->randomElement(['income', 'expense']),
            'method' => $this->faker->randomElement(['cash', 'credit_card', 'debit_card', 'bank_transfer', 'pix', 'boleto', 'other']),
            'paid' => $this->faker->boolean(),
            'account_id' => Account::factory(),
            'create_at' => $this->faker->date(),
        ];
    }
}
