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
        Schema::create('suivis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ame_id')->constrained('ames')->onDelete('cascade'); // Âme suivie
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Évangéliste (STAR)
            $table->date('date_appel'); // Date de l’appel
            $table->text('defis')->nullable(); // Défis de l’âme
            $table->boolean('venu_eglise')->default(false);
            $table->date('date_venu_eglise')->nullable();
            $table->boolean('formation_initiale')->default(false);
            $table->date('date_debut_formation')->nullable();
            $table->enum('etat_formation', ['début', 'en cours', 'terminé'])->nullable();
            $table->boolean('assiste_famille_impact')->default(false);
            $table->date('date_famille_impact')->nullable();
            $table->enum('niveau_engagement', ['faible', 'moyen', 'engagé', 'très engagé']);
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
        Schema::table('suivis', function (Blueprint $table) {
            //
        });
    }
};
