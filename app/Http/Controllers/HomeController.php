<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home');
    }

    public function setLocale(string $locale): RedirectResponse
    {
        if (!in_array($locale, ['it', 'en'])) {
            $locale = 'it';
        }

        session(['locale' => $locale]);
        app()->setLocale($locale);

        // noindex: /lingua è una rotta tecnica di redirect, non deve stare nei risultati Google
        return redirect()
            ->route('chi-siamo', ['locale' => $locale])
            ->header('X-Robots-Tag', 'noindex');
    }
}
