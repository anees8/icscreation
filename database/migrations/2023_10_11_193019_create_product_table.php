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
        Schema::create('product', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->string('name'); // Product name
            $table->text('description')->nullable(); // Product description (nullable)
            $table->decimal('price', 10, 2); // Product price with 10 digits and 2 decimal places
            $table->integer('stock'); // Product stock quantity
            $table->integer('quantity'); // Numeric field to store the quantity, e.g., 13 for "13 packs"
            $table->string('uom'); // String field to store the unit of measurement (UOM), e.g., "pack"
            $table->integer('hsnCode');
            $table->enum('status', ['active', 'inactive'])->default('active'); // An enumeration field for product status
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
