<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function change_language(Request $request)
    {
        $language = $request->idioma;
        // App::setLocale($language);

        session(['language' => $language]);

        return redirect()->route('home');
    }
}
