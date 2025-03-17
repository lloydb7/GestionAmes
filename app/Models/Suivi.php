<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suivi extends Model
{
    use HasFactory;

    protected $fillable = [
        'ame_id', 'user_id', 'date_appel', 'defis', 'venu_eglise', 
        'date_venu_eglise', 'formation_initiale', 'date_debut_formation',
        'etat_formation', 'assiste_famille_impact', 'date_famille_impact', 
        'niveau_engagement'
    ];

    public function ame()
    {
        return $this->belongsTo(Ame::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

