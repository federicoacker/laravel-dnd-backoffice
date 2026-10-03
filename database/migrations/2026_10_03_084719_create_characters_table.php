<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->tinyInteger('level')->default(1);
            $table->foreignId('background_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('species_id')->nullable()->constrained()->onDelete('set null');
            $table->unsignedBigInteger('profession_id')->nullable();
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('set null');
            $table->text('backstory')->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('strength')->default(10);
            $table->tinyInteger('dexterity')->default(10);
            $table->tinyInteger('constitution')->default(10);
            $table->tinyInteger('intellect')->default(10);
            $table->tinyInteger('wisdom')->default(10);
            $table->tinyInteger('charisma')->default(10);
            $table->text('inventory');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
