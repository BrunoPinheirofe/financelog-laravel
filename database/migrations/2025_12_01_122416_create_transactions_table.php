<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignIdFor(User::class)->constrained()->onDelete('');
            $table->decimal('amount', 15, 2);
            $table->enum('type', ['income', 'expense']);
            $table->boolean('paid')->default(false);

            $table->boolean('is_installment')->default(false); // É parcelado?
            $table->uuid('installment_group_id')->nullable()->index(); // O elo de ligação
            $table->integer('installment_number')->nullable(); // Ex: 1
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
