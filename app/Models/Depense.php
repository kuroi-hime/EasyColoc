<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    /** @use HasFactory<\Database\Factories\DepenseFactory> */
    use HasFactory;
    protected $primaryKey = 'id_depense';
    protected $fillable = [
        'titre_depense',
        'montant_depense',
        'date_depense',
    ];
}
