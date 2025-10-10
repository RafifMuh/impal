<?php

namespace App\Http\Controllers;

use App\Models\resep;
use Illuminate\Http\Request;

class resepcontroller extends Controller
{
    public function index()
    {
        $resep = resep::with(['user', 'likes', 'komentar'])->latest()->get();
        return view('feed', compact('resep'));
    }
}
