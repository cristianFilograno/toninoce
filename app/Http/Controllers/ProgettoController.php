<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Progetto;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgettoController extends Controller
{
    public function index(Request $request): View
    {
        $categorie = Categoria::perProgetti()->get();

        $query = Progetto::pubblicati()->with('categoria');

        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        if ($request->filled('anno')) {
            $query->where('anno', $request->anno);
        }

        $progetti = $query->paginate(15);

        $anni = Progetto::pubblicati()
            ->whereNotNull('anno')
            ->distinct()
            ->orderByDesc('anno')
            ->pluck('anno');

        return view('progetti.index', compact('progetti', 'categorie', 'anni'));
    }

    public function show(string $locale, string $slug): View
    {
        $progetto = Progetto::pubblicati()
            ->where('slug', $slug)
            ->with('categoria')
            ->firstOrFail();

        return view('progetti.show', compact('progetto'));
    }
}
