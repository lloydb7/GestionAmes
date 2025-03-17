<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilleImpact extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'pilote1_nom', 'pilote1_tel', 'pilote2_nom', 'pilote2_tel'];

    public function ames()
    {
        return $this->hasMany(Ame::class);
    }
}