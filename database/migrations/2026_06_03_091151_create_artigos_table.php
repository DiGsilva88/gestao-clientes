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
        Schema::create('artigos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao', 255);
            $table->string('caracteristicas')->nullable();
            $table->decimal('preco', 8, 2)->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

              //criar a relação entre artigos e categorias
              $table->foreignId('categoria_id')
              ->constrained('categorias')//constrained() é um atalho para criar uma chave estrangeira que referencia a tabela 'categorias' e a coluna 'id'
              ->onUpdate('cascade')
              ->onDelete('cascade'); //quando a categoria for atualizada ou apagada, os artigos relacionados também serão atualizados ou deletados
    
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artigos');
    }
};
