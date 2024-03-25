<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Sanctum\Sanctum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
<<<<<<< HEAD
            $table->string('address');
            $table->string('phone');
            $table->string('password');
            $table->enum('usertype',['Admin', 'User'])->default('User');
            $table->rememberToken();
=======
            $table->string('password');
            $table->rememberToken();
            $table->string('phone', 30);
            $table->text('address');
            $table->unsignedBigInteger('rol_id');
            $table->foreign('rol_id')->references('id')->on('rols');
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5
            $table->timestamps();
        });

        // Sanctum::createTokensCanExpire();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};