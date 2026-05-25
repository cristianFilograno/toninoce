<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Progetto extends Model
{
    use HasTranslations;

    protected $table = 'progetti';

    protected $fillable = [
        'titolo',
        'descrizione',
        'luogo',
        'anno',
        'slug',
        'categoria_id',
        'foto_copertina',
        'galleria',
        'pubblicato',
        'ordine',
        'importo_lavori',
        'allegati',
    ];

    public array $translatable = ['titolo', 'descrizione', 'luogo'];

    protected $casts = [
        'pubblicato'     => 'boolean',
        'ordine'         => 'integer',
        'galleria'       => 'array',
        'importo_lavori' => 'integer',
        'allegati'       => 'array',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function getFotoCopertina(): ?string
    {
        if (!$this->foto_copertina) return null;
        return Storage::disk('public')->url($this->foto_copertina);
    }

    public function getGalleriaUrls(): array
    {
        if (!$this->galleria) return [];
        return array_map(fn($path) => Storage::disk('public')->url($path), $this->galleria);
    }

    /**
     * Restituisce un array di ['url', 'nome', 'tipo'] per ogni allegato.
     */
    public function getAllegati(): array
    {
        if (!$this->allegati) return [];

        return array_map(function (string $path) {
            $nome = basename($path);
            $ext  = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
            $tipo = match ($ext) {
                'pdf'        => 'pdf',
                'xls', 'xlsx' => 'excel',
                default       => 'file',
            };

            return [
                'url'  => Storage::disk('public')->url($path),
                'nome' => $nome,
                'tipo' => $tipo,
                'ext'  => strtoupper($ext),
            ];
        }, $this->allegati);
    }

    public function scopePubblicati($query)
    {
        return $query->where('pubblicato', true)->orderBy('ordine');
    }
}
