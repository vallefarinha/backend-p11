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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
<<<<<<< HEAD
            $table->string('slug');
=======
            $table->string('slug')->unique();
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5
            $table->text('description');
            $table->tinyInteger('stock')->unsigned();
            $table->double('weight');
            $table->double('price_product');
            $table->double('discounted_price_product');
<<<<<<< HEAD
            $table->enum('status',['Active', 'Inactive'])->default('Active');
            $table->enum('category',['Brincos', 'Colares', 'Pulseiras', 'Anéis', 'Casa']);
=======
            $table->enum('category',['Colares', 'Brincos', 'Pulseiras', 'Anéis', 'Casa']);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};