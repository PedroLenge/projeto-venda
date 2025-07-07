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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('image')->nullable();
            $table->string('descricao');
            $table->string('categoria');
            $table->foreignId('funcionario_id')->constrained('funcionarios')->onDelete('cascade');
            $table->timestamps();
            

            //$table->bigInteger('id_funcionario')->unsigned();
            //$table->foreign('id_funcionario')->references('id')->on('funcionarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
