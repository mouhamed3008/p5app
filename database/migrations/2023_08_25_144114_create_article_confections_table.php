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
        Schema::disableForeignKeyConstraints();

        Schema::create('article_confections', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 255);
            $table->integer('quantiteStock');
            $table->float('prix');
            $table->string('reference', 255);
            $table->binary('photo');
            $table->foreignId('categorie_id')->constrained('categories');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_confections');
    }
};
