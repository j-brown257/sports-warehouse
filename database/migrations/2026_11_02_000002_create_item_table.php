<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item', function (Blueprint $table) {
            $table->id('itemId');
            $table->string('itemName', 150);
            $table->string('brand', 100)->nullable();
            $table->foreignId('categoryId')->constrained('category', 'categoryId');
            $table->decimal('price', 10, 2);
            $table->decimal('salePrice', 10, 2)->nullable();
            $table->string('description', 2000)->nullable();
            $table->string('photo')->nullable();
            $table->boolean('featured')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item');
    }
};
