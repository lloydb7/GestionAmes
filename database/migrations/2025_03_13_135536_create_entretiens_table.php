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
        Schema::create('entretiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ame_id')->constrained('ames')->onDelete('cascade'); // Âme concernée
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Évangéliste (STAR)
            $table->date('date_entretien'); // Date de l’entretien
            $table->integer('numero_entretien')->after('ame_id')->default(1);
            $table->text('defis')->nullable(); // Défis de l’âme
            $table->text('resume')->nullable(); // Résumé ou recommandation
            $table->enum('evaluation', ['faible engagement', 'moyen engagement', 'fort engagement', 'très fort engagement']);
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
        Schema::dropIfExists('entretiens');
    }
};
