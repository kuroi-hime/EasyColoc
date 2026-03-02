<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_banned',
        'reputation',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function colocations()
    {
        return $this->belongsToMany(
            Colocation::class,
            'colocations_users', // table pivot
            'user_id',           // clé étrangère sur ce modèle
            'colocation_id'      // clé étrangère sur le modèle lié
        )
        ->withPivot('role', 'joined_at', 'left_at')
        ->withTimestamps();
    }

    public function activeColocation(){
        return $this->colocations()
                    ->where('status_colocation', 'active')
                    ->wherePivot('left_at', null); // N'a pas encore quitter la colocation
    }

    public function partTheorique(){
        // 1. On récupère l'instance de la colocation active
        $coloc = $this->activeColocation->first();
        
        if (!$coloc) {
            return ['avancé_aux_autres' => 0, 'dettes_aux_autres' => 0, 'solde' => 0];
        }

        $depenses = $coloc->depenses;
        $deja_paye = 0;
        $a_payer = 0;

        foreach($depenses as $depense){
            $nbrMembre = $coloc->users
                              ->where('pivot.left_at', null)
                              ->where($depense->created_at, '>', 'pivot.joined_at')
                              ->count();
                              
            $partIndividuelle = $nbrMembre == 0 ? 0:($depense->montant_depense / $nbrMembre);

            // 2. Logique de répartition
            if ($depense->creator_id != $this->id_user) {
                // C'est la dépense d'un autre : je dois ma part
                $a_payer += $partIndividuelle;
            } else {
                // C'est ma dépense : j'ai avancé le total, mais ma part réelle est $partIndividuelle
                // Mon "crédit" envers la colocation est : Total payé - Ma propre part
                $deja_paye += ($depense->montant_depense - $partIndividuelle);
            }
        }

        return [
            'avancé_aux_autres' => $deja_paye,
            'dettes_aux_autres' => $a_payer,
            'solde' => $deja_paye - $a_payer
        ];

    }
}