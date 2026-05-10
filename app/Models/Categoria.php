<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Categoria extends Model
{
    use HasTranslations;

    protected $table = 'categorie';

    protected $fillable = [
        'nome',
        'slug',
        'tipo',
        'ordine',
        'attiva',
    ];

    public array $translatable = ['nome'];

    protected $casts = [
        'attiva' => 'boolean',
        'ordine' => 'integer',
    ];

    // Relazioni
    public function progetti(): HasMany
    {
        return $this->hasMany(Progetto::class);
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class);
    }

    // Scope per tipo
    public function scopePerProgetti($query)
    {
        return $query->where('tipo', 'progetto')->where('attiva', true)->orderBy('ordine');
    }

    public function scopePerDownload($query)
    {
        return $query->where('tipo', 'download')->where('attiva', true)->orderBy('ordine');
    }
}
