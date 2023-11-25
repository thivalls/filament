<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('salary', 10, 2);
            $table->decimal('start_financing', 10, 2)->nullable();
            $table->decimal('end_financing', 10, 2)->nullable();
            $table->boolean('active')->default(true);
            $table->string('rg')->nullable();
            $table->string('cpf')->nullable();
            $table->string('addressDocument')->nullable();
            $table->string('salaryDocument')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
