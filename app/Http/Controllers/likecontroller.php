<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Resep;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle($id)
    {
        $resep = Resep::findOrFail($id);

        $like = Like::where('user_id', Auth::id())
                    ->where('resep_id', $resep->id)
                    ->first();

        if ($like) {
            $like->delete(); 
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'resep_id' => $resep->id,
            ]);
        }

        return back();
    }
}
