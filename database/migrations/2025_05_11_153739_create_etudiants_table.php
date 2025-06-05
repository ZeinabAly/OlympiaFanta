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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->date('date_naissance');
            $table->string('ville');
            $table->string('quartier');
            $table->text('option')->nullable();
            $table->enum('genre', ['masculin', 'feminin']);
            $table->string('photo')->nullable();
            $table->longtext('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
