<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id('categoryId');
            $table->string('categoryName', 50)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
