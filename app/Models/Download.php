<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Download extends Model
{
    use HasTranslations;

    protected $table = 'downloads';

    protected $fillable = [
        'titolo',
        'descrizione',
        'categoria_id',
        'file_path',
        'file_nome',
        'file_tipo',
        'file_dimensione',
        'pubblico',
        'ordine',
    ];

    public array $translatable = ['titolo', 'descrizione'];

    protected $casts = [
        'pubblico'        => 'boolean',
        'ordine'          => 'integer',
        'file_dimensione' => 'integer',
    ];

    // Relazioni
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    // Icona in base al tipo di file
    public function getIcona(): string
    {
        return match(strtolower($this->file_tipo)) {
            'pdf'                          => 'heroicon-o-document-text',
            'docx', 'doc'                  => 'heroicon-o-document',
            'xlsx', 'xls'                  => 'heroicon-o-table-cells',
            default                        => 'heroicon-o-paper-clip',
        };
    }

    // Colore badge in base al tipo
    public function getColore(): string
    {
        return match(strtolower($this->file_tipo)) {
            'pdf'         => 'danger',
            'docx', 'doc' => 'info',
            'xlsx', 'xls' => 'success',
            default       => 'gray',
        };
    }

    // Dimensione leggibile
    public function getDimensioneLeggibile(): string
    {
        if (!$this->file_dimensione) return '';
        $bytes = $this->file_dimensione;
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }

    // URL per il download
    public function getUrlDownload(): string
    {
        return Storage::url($this->file_path);
    }

    // Scope
    public function scopePubblici($query)
    {
        return $query->where('pubblico', true)->orderBy('ordine');
    }
}
