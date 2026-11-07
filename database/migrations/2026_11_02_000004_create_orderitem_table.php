<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orderitem', function (Blueprint $table) {
            $table->foreignId('itemId')->constrained('item', 'itemId');
            $table->foreignId('shoppingOrderId')->constrained('shoppingorder', 'shoppingOrderId');
            $table->unsignedInteger('quantity');
            $table->decimal('price', 8, 2);
            $table->primary(['itemId', 'shoppingOrderId']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orderitem');
    }
};
