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
        Schema::create('ames', function (Blueprint $table) {
            $table->id();
            $table->date('date_premier_contact');
            $table->string('nom');
            $table->string('prenom');
            $table->enum('sexe', ['Masculin', 'Féminin']);
            $table->integer('age');
            $table->string('adresse');
            $table->string('telephone')->nullable();
            $table->boolean('priere_du_salut')->default(false);
            $table->boolean('invitation_temple')->default(false);
            $table->boolean('invitation_fi')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('famille_impact_id')->nullable()->constrained()->onDelete('set null');
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
        Schema::dropIfExists('ames');
    }
};
