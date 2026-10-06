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
        Schema::create('professions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('primary_ability', 255);
            $table->string('hit_points_die', 255);
            $table->string('hit_points_at_level_1', 255);
            $table->text('armor_training');
            $table->text('starting_equipment');
            $table->text('description');
            $table->tinyInteger('number_of_proficiencies')->default(2);
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professions');
    }
};
