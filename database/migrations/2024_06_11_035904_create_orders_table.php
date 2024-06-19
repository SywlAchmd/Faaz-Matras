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
            // $table->foreignId('menu_id')->constrained()->nullOnDelete();
            $table->string('customer_name');
            $table->integer('table_number')->nullable();
            $table->enum('order_type', ['dine_in', 'take_away'])->default('dine_in');
            // $table->enum('payment_type', ['cash', 'e-wallet', 'online?'])->default('cash');
            $table->enum('payment_type', ['cash', 'e-wallet'])->default('cash');
            $table->integer('payment_amount')->nullable();
            $table->json('items');
            $table->integer('gross_amount'); 
            $table->enum('status', ['pending', 'in progress','completed'])->default('pending');
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
