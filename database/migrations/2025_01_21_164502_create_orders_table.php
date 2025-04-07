<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            
            $table->id();
            $table->decimal('total', 10, 2); 
            $table->enum('status', ['pending', 'completed', 'overdue']);
            $table->enum('payment_type', ['credit_card', 'paypal', 'bank_transfer']);
            $table->date('date'); 
            $table->foreignId('customer_id')->constrained('customers')->onDelete('restrict'); 
            $table->timestamps(); 
         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
