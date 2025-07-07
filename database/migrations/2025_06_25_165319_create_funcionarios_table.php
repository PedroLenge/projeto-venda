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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('funcao');
            $table->string('data_contrato');
            $table->string('n_bilhete');
            $table->string('email');
            $table->string('telefone');
            $table->string('senha');
            $table->string('endereco');
            $table->timestamps();
        });
        App\Models\Funcionario::create([
                'nome'=>'Administrador',
                'email'=>'geral@gmail.com',
                'funcao'=>'Gerente',
                'telefone'=>'927075922',
                'endereco'=>'Benguela',
                'data_contrato'=>'2025-06-01',
                'n_bilhete'=>'0000000000ZE000',
                'senha'=>bcrypt('123Admin'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
