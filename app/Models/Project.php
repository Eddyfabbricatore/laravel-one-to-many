<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    // Relazione con la tabella technology
    // La funzione deve essere al singolare perchè un progetto ha una sola tecnologia
    // A questa funzione accederò come proprietà della classe Project
    public function technology(){
        return $this->belongsTo(Technology::class);
    }

    protected $fillable = [
        'name',
        'technology_id',
        'image',
        'image_original_name',
        'slug',
        'description',
        'date'
    ];
}
