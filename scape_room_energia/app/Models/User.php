<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Partida;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function partidas()
    {
        return $this->hasMany(Partida::class);
    }
    public function best()
    {
        return $this->hasOne(Partida::class)->orderBy('tiempo', 'asc')->limit(1);
    }

    public function partidas_ordenadas()
    {
        return $this->hasMany(Partida::class)->orderBy('tiempo', 'asc');
    }

    public function last_game()
    {
        return $this->hasOne(Partida::class)->orderBy('created_at', 'desc')->limit(1);
    }


}
