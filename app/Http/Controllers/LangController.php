<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function set($lang, Request $request)
    {
        $arr_lang = ['en', 'ar'];
        if (!in_array($lang, $arr_lang)) {
            $lang = 'en';
        }
        $request->session()->put('lang', $lang);
        return back();
    }
}
