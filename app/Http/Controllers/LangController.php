<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    public function change(Request $request)
    {
        $request->validate([
            'lang' => 'required|in:en,ar', // only allow these languages
        ]);

        Session::put('locale', $request->lang);
        app()->setLocale($request->lang);

        return redirect()->back();
    }
}
