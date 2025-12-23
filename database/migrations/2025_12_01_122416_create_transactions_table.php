<?php

use App\Models\Account;
use App\Models\User;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Account::class)->constrained()->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->enum('type', ['income', 'expense']);
            $table->enum('method', ['cash', 'credit_card', 'debit_card', 'bank_transfer', 'pix', 'boleto', 'other']);
            $table->boolean('paid')->default(false);
            $table->foreignIdFor(Account::class)->constrained()->cascadeOnDelete();
            $table->boolean('is_installment')->default(false); // É parcelado?
            $table->integer('total_installments')->nullable(); // Ex: 12
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
