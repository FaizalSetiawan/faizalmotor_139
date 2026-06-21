<?php

namespace App\Http\Controllers;

class LocaleController extends Controller
{
    public function __invoke(string $locale)
    {
        abort_unless(in_array($locale, ['id', 'en'], true), 404);

        session(['locale' => $locale]);

        return redirect()->back();
    }
}
