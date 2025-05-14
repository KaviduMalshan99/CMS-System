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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('contact_number');
            $table->enum('inquiry_source', ['phone', 'whatsapp', 'email','Platform']);
            $table->text('description');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable(); // Foreign key to users table
            $table->string('status')->default('New'); // Example: pending, resolved, closed
            $table->timestamps();

            $table->foreign('assigned_to_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
