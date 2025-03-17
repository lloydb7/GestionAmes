<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entretien extends Model
{
    use HasFactory;

    protected $fillable = [
        'ame_id', 'user_id', 'date_entretien', 'defis', 'resume', 'evaluation','numero_entretien'
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
