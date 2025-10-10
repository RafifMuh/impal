<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'resep_id'];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function resep()
    {
        return $this->belongsTo(user::class);
    }
}
