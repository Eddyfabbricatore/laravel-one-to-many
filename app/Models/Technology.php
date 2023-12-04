<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Technology extends Model
{
    use HasFactory;

    // Relazione con la tabella projects
    // Creo una funzione col nome della tabella e all'interno definisco l'appartenenza
    // Ogni tecnologia ha tanti progetti
    // A questa funzione accederò come proprietà della classe Technology
    public function projects(){
        return $this->hasMany(Project::class);
    }

    protected $fillable = [
        'name',
        'slug'
    ];
}
