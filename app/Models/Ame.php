<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ame extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nom', 'prenom', 'sexe', 'age', 'adresse', 'telephone',
    'priere_du_salut', 'invitation_temple', 'invitation_fi',
    'user_id', 'famille_impact_id', 'date_premier_contact'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function familleImpact()
    {
        return $this->belongsTo(FamilleImpact::class, 'famille_impact_id');
    }

    public function suivi()
    {
        return $this->hasOne(Suivi::class);
    }
}
