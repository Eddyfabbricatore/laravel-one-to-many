<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;

    // Relazione con la tabella projects
    // Creo una funzione col nome della tabella e all'interno definisco l'appartenenza
    // Ogni tipologia ha tanti progetti
    // A questa funzione accederò come proprietà della classe Type
    public function projects(){
        return $this->hasMany(Project::class);
    }

    protected $fillable = [
        'name',
        'slug'
    ];
}
