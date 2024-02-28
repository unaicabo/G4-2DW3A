<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tiempo',
        'errores',
        'dificultad',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
