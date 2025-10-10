<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    use HasFactory;

    protected $fillable = ['isi'];
    

    public function resep()
    {
        return $this->belongsTo(resep::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class); 
    }
}
