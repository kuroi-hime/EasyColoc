<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\UserRole;
use App\Models\Categorie;

class Colocation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_colocation';

    protected $fillable = [
        'nom_colocation',
        'status_colocation',
        'description_colocation',
    ];

    // Relation Many-to-Many correctement configurée
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'colocations_users',  // nom exact de la table pivot
            'colocation_id',      // clé étrangère sur ce modèle
            'user_id'             // clé étrangère sur le modèle lié
        )
        ->withPivot('role', 'joined_at', 'left_at')
        ->withTimestamps();
    }

    // Méthode owner pour récupérer le propriétaire
    public function owner()
    {
        return $this->users()
                    ->wherePivot('role', UserRole::Owner->value)
                    // order by is_banned
                    ->limit(1);
    }

    // Méthode pour récupérer les catégories
    public function categories(){
        return $this->hasMany(Categorie::class, 'colocation_id', 'id_colocation');
    }

    public function depenses(){
        return $this->hasManyThrough(Depense::class, Categorie::class, 
                    'colocation_id', // Clé étrangère sur la table catégories
                    'categorie_id',  // Clé étrangère sur la table depenses
                    'id_colocation', // Clé locale sur la table colocations
                    'id_categorie'   // Clé locale sur la table catégories
                    )->with('creator', 'categorie');
    }

    public function calculerBalances(){
        $membres = $this->users;
        // $nbMembres = $membres->count();
        // $totalDepenses = $this->depenses->sum('montant_depense');
        
        // Part que chacun devrait avoir payé théoriquement
        $partTheorique = $nbMembres > 0 ? $totalDepenses / $nbMembres : 0;

        $balances = [];

        foreach ($membres as $user) {
            // Somme de ce que CET utilisateur a réellement payé
            $dejaPaye = $this->depenses->where('creator_id', $user->id)->sum('montant_depense');
            
            // Balance = Ce qu'il a payé - Ce qu'il doit (sa part)
            $balances[$user->id] = [
                'nom' => $user->name,
                'balance' => $dejaPaye - $partTheorique
            ];
        }

        return $balances;
    }
    
}