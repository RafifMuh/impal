<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use illuminate\support\Facades\auth;

class KomentarController extends Controller
{
    public function store(Request $request, $Id)
    {
        $request->validate(['isi' => 'required|string|max:500']);

        Komentar::create([
            'user_id' => auth()->id(),
            'resep_id' => $Id,
            'isi' => $request->isi,
        ]);

        return response()->json(['message' => 'Komentar berhasil ditambahkan']);
    }

    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);
        if ($komentar->user_id === auth()->id()) {
            $komentar->delete();
            return response()->json(['message' => 'Komentar dihapus']);
        }
        return response()->json(['message' => 'Tidak diizinkan'], 403);
    }
}
