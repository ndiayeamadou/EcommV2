<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function switchLang($lang)
    {
        // Check if language is supported
        if (in_array($lang, ['en', 'fr'])) {
            //App::setLocale($lang);
            Session::put('locale', $lang);
        }
        
        return redirect()->back();
        //return back();
    }
}
