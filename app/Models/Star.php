<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    use HasFactory;
    
    protected $fillable = ['nom', 'prenom', 'sexe', 'contact', 'email', 'responsabilite_eglise'];

    public function ames()
    {
        return $this->hasMany(Ame::class);
    }
}
