<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('userId');
            $table->string('userName', 50)->unique();
            $table->string('password');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
