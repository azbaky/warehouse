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
        Schema::table('brokers', function (Blueprint $table) {
            //

            $table->string('phone_number', 15)->nullable()->after('email');
            $table->string('address')->nullable()->after('phone_number');
            $table->enum('customer_type', ['customer', 'member_custoer'])->after('address');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brokers', function (Blueprint $table) {
            //
        });
    }
};
