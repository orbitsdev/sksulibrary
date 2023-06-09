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
        Schema::create('user_information', function (Blueprint $table) {
            $table->id();
            $table->text('id_number')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('sex')->nullable();
            $table->string('contact_number')->nullable();
            $table->text('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->text('state')->nullable();
            $table->text('postal_code')->nullable();
            $table->foreignId('campus_id')->nullable();
            $table->foreignId('course_id')->nullable();
            $table->text('barcode')->nullable();
            $table->text('status')->nullable();
            $table->string('year')->nullable();
            $table->text('profile')->nullable();
            $table->text('school_id')->nullable();
            $table->text('two_by_two')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_information');
    }
};
