<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $request->validate([
            'locale' => 'required|in:en,es',
        ]);

        App::setLocale($request->locale);

        return back();
    }
}
