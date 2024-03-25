<?php
use App\Models\OrderDetail;
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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
<<<<<<<< HEAD:database/migrations/2024_02_27_142152_create_carts_table.php
            $table->integer('quantity')->default(0);
            $table->enum('status',['Processing', 'Cancelled', 'Confirmed', 'Shipping', 'Delivered'])->default('Processing');
            $table->double('subtotal_cart');
            $table->double('total_cart');
========
            $table->tinyInteger('quantity');
            $table->double('subtotal_cart');
            $table->double('total_cart');
            $table->enum('status',['Processing', 'Confirmed', 'Shipping', 'Delivered', 'Cancelled'])->default('Processing');
>>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5:database/migrations/2024_02_28_141913_create_carts_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};