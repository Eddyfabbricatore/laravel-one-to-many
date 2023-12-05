<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    // Relazione con la tabella type
    // La funzione deve essere al singolare perchè un progetto ha una sola tipologia
    // A questa funzione accederò come proprietà della classe Project
    public function type(){
        return $this->belongsTo(Type::class);
    }

    protected $fillable = [
        'name',
        'type_id',
        'image',
        'image_original_name',
        'slug',
        'description',
        'date'
    ];
}
