<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index()
    {
        // Ambil semua resep + relasi user, like, komentar
        $resep = Resep::with(['user', 'likes', 'komentar.user'])->latest()->get();

        // Kirim ke view resources/views/feed.blade.php
        return view('feed', compact('resep'));
    }
}
