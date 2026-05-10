<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contatto extends Model
{
    protected $table = 'contatti';

    protected $fillable = [
        'nome',
        'email',
        'telefono',
        'oggetto',
        'messaggio',
        'letto',
        'letto_at',
    ];

    protected $casts = [
        'letto'    => 'boolean',
        'letto_at' => 'datetime',
    ];

    // Scope
    public function scopeNonLetti($query)
    {
        return $query->where('letto', false);
    }
}
