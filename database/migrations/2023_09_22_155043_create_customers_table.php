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
        Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100); // Limiting the name to 100 characters
        $table->string('phone', 20)->unique(); // Limiting phone to 20 characters
        $table->string('email', 100)->unique(); // Limiting email to 100 characters
        $table->string('company_name', 255); // Adjust length as needed
        $table->string('address', 255); // Adjust length as needed
        $table->string('delivery_address', 255)->nullable(); // Adjust length as needed
        $table->string('contact_person', 100)->nullable(); // Adjust length as needed
        $table->string('contact_number', 20)->nullable(); // Adjust length as needed
        $table->string('gst_number', 20); // Assuming GST numbers are alphanumeric with a fixed length
        $table->softDeletes();
        $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
