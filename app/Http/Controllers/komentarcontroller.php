<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate(['isi' => 'required|string|max:500']);

        Komentar::create([
            'user_id' => Auth::id(),
            'resep_id' => $id,
            'isi' => $request->isi,
        ]);

        return back();
    }

    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);
        if ($komentar->user_id === Auth::id()) {
            $komentar->delete();
            return response()->json(['message' => 'Komentar dihapus']);
        }
        return response()->json(['message' => 'Tidak diizinkan'], 403);
    }
}
