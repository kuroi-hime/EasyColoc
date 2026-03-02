<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusInvitation;

class Invitation extends Model
{
    /** @use HasFactory<\Database\Factories\InvitationFactory> */
    use HasFactory;
    protected $primaryKey = 'id_invitation';
    protected $fillable = [
        'status_invitation',
        'email',
        'token',
        'expires_at',
        'colocation_id',
    ];

    protected $casts = [
        'status_invitation' => StatusInvitation::class,
        'expires_at'        => 'datetime',
    ];

    public function colocation(){
        return $this->belongsTo(Colocation::class, 'colocation_id', 'id_colocation');
    }
}
