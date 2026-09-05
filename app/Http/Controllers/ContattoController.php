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
        // Anti-spam honeypot: se il campo nascosto "website" è compilato è un bot.
        // Fingiamo il successo senza salvare nulla, per non insospettire il bot.
        if ($request->filled('website')) {
            return redirect()
                ->route('contatti', ['locale' => app()->getLocale()])
                ->with('success', __('Messaggio inviato con successo! Ti risponderemo al più presto.'));
        }

        $validated = $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'telefono' => 'nullable|string|max:50',
            'oggetto'  => 'nullable|string|max:255',
            'messaggio'=> 'required|string|max:5000',
            'privacy'  => 'accepted',
        ], [
            'nome.required'      => __('Il nome è obbligatorio.'),
            'email.required'     => __('L\'email è obbligatoria.'),
            'email.email'        => __('Inserisci un\'email valida.'),
            'messaggio.required' => __('Il messaggio è obbligatorio.'),
            'privacy.accepted'   => __('Devi accettare l\'informativa sulla privacy.'),
        ]);

        // Rimuoviamo il campo consenso: non va salvato tra i dati del messaggio
        unset($validated['privacy']);

        Contatto::create($validated);

        return redirect()
            ->route('contatti', ['locale' => app()->getLocale()])
            ->with('success', __('Messaggio inviato con successo! Ti risponderemo al più presto.'));
    }
}
