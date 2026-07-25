<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $locales = ['it', 'en'];

        // Pagine statiche con prefisso lingua
        $routes = ['chi-siamo', 'progetti', 'download', 'contatti'];

        $urls = [];

        // Home (senza prefisso lingua)
        $urls[] = [
            'loc'        => route('home'),
            'changefreq' => 'monthly',
            'priority'   => '1.0',
        ];

        // Pagine statiche in ogni lingua
        foreach ($routes as $name) {
            foreach ($locales as $locale) {
                $urls[] = [
                    'loc'        => route($name, ['locale' => $locale]),
                    'changefreq' => 'monthly',
                    'priority'   => $name === 'progetti' ? '0.9' : '0.7',
                ];
            }
        }

        // Pagine dei singoli progetti pubblicati, in ogni lingua
        $progetti = Progetto::pubblicati()->get(['slug', 'updated_at']);
        foreach ($progetti as $progetto) {
            foreach ($locales as $locale) {
                $urls[] = [
                    'loc'        => route('progetto.show', ['locale' => $locale, 'slug' => $progetto->slug]),
                    'lastmod'    => optional($progetto->updated_at)->toAtomString(),
                    'changefreq' => 'yearly',
                    'priority'   => '0.6',
                ];
            }
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
