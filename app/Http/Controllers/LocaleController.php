<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    function localeSwitch(Request $request)
    {
        $language = $request->input('locale');

        session()->put('locale', $language);

        return redirect()->back()->with(['locale_switched' => $language]);
    }
}
