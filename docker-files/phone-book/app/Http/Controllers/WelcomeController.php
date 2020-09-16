<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookEntry;

class WelcomeController extends Controller
{
    public function index()
    {
        $entries = BookEntry::all();
        return view('welcome', [
            'entries' => $entries,
        ]);
    }
}
