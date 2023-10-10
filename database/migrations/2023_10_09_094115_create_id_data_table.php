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
        Schema::create('id_data', function (Blueprint $table) {
            $table->id();
            $table->string('director')->nullable();
            $table->string('title')->nullable();
            $table->string('valid_from')->nullable();
            $table->string('valid_until')->nullable();
            $table->text('logo')->nullable();
            $table->text('bg')->nullable();
            $table->boolean('use')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('id_data');
    }
};
