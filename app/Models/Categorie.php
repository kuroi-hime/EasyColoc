<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Colocation;

class Categorie extends Model
{
    /** @use HasFactory<\Database\Factories\CategorieFactory> */
    use HasFactory;
    protected $primaryKey = 'id_categorie';
    protected $fillable = [
        'nom_categorie',
        'colocation_id',
    ];

    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }

    public function depenses(){
        return $this->hasMany(Depense::class, 'categorie_id', 'id_categorie');
        // ajouter le créateur de chaque dépense
    }
}
