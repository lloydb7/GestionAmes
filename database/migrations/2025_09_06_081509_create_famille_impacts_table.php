<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('famille_impacts', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('pilote1_nom');
            $table->string('pilote1_tel');
            $table->string('pilote2_nom')->nullable();
            $table->string('pilote2_tel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('famille_impacts');
    }
};
