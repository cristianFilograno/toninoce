<?php

namespace App\Http\Controllers;

use App\Models\Contatto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContattoController extends Controller
{
    public function index(): View
    {
        return view('contatti.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'telefono' => 'nullable|string|max:50',
            'oggetto'  => 'nullable|string|max:255',
            'messaggio'=> 'required|string|max:5000',
        ], [
            'nome.required'      => __('Il nome è obbligatorio.'),
            'email.required'     => __('L\'email è obbligatoria.'),
            'email.email'        => __('Inserisci un\'email valida.'),
            'messaggio.required' => __('Il messaggio è obbligatorio.'),
        ]);

        Contatto::create($validated);

        return redirect()
            ->route('contatti', ['locale' => app()->getLocale()])
            ->with('success', __('Messaggio inviato con successo! Ti risponderemo al più presto.'));
    }
}
