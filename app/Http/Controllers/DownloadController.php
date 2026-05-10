<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Download;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public function index(string $locale): \Illuminate\View\View
    {
        // Categorie con i loro download
        $categorie = Categoria::perDownload()
            ->with(['downloads' => function ($q) {
                $q->pubblici()->orderBy('ordine');
            }])
            ->get()
            ->filter(fn ($cat) => $cat->downloads->count() > 0);

        // Download senza categoria (mostrati in fondo)
        $senzaCategoria = Download::pubblici()
            ->whereNull('categoria_id')
            ->orderBy('ordine')
            ->get();

        return view('downloads.index', compact('categorie', 'senzaCategoria'));
    }

    public function scarica(string $locale, Download $download): StreamedResponse|\Illuminate\Http\RedirectResponse
    {
        if (!$download->pubblico) {
            abort(403);
        }

        if (!Storage::disk('public')->exists($download->file_path)) {
            abort(404);
        }

        return Storage::disk('public')->download($download->file_path, $download->file_nome);
    }
}
