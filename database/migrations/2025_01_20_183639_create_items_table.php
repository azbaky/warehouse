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
        Schema::create('items', function (Blueprint $table) {
            $table->id(); 
            $table->string('name', 255); 
            $table->text('description')->nullable(); 
            $table->unsignedBigInteger('category_id'); 
            $table->integer('quantity'); 
            $table->decimal('unit_price', 10, 2);
            $table->integer('reorder_level'); 
            $table->string('barcode', 255)->nullable();
            
            $table->timestamps();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
