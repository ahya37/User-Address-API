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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('label')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address_line');
            $table->string('postal_code');
            $table->string('city');
            $table->string('province');
            $table->string('country')->default('Indonesia');
            $table->char('is_default')->default('Y');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
