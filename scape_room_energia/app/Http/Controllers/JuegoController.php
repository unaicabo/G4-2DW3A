<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Partida;
use Illuminate\Support\Facades\Auth;

class JuegoController extends Controller
{
    public function index(Request $request) {
        $dificultad = $request->dificultad;
        return view("juegos.juego",compact('dificultad'));
    }
    public function juego1() {
        return view("juegos.roca");
    }
    public function juego2() {
        return view("juegos.almacen");
    }
    public function juego3() {
        return view("juegos.salaControl");
    }
    public function juego4() {
        return view("juegos.aerogenerador");
    }
    public function juego4_2() {
        return view("juegos.motor");
    }
    public function juegoPerdido()
    {
        return view("juegos.juegoPerdido");
    }
    public function finalJuego() {
        $user = Auth::user();

        $last_game = Partida::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();

        // Convierte el campo 'tiempo' de 'partida' en una variable int
        $seg = (int)$last_game -> tiempo;

        $hours = 0;

        $minutes = 0;

        $seconds = 0;

        $cont = 0;

        $seconds = $seg % 60;

        $cont = $seconds;

        while ($cont < $seg) {

            $minutes = $minutes + 1;

            $cont = $cont + 60;

            if ($minutes >= 60) {

                $hours = $hours + 1;

                $minutes = $minutes - 60;

            }

        }

        $tiempo = $hours."h ".$minutes."m ".$seconds."s";

        $last_game -> tiempo = $tiempo;

        //posicion en el ranking
        $posicion = 1;

        $partidas = Partida::orderBy('tiempo','asc')->get();

        foreach ($partidas as $partida) {

            if ($partida->user_id == Auth::user()->id) {

                break;

            }

            $posicion++;

        }


        return view("juegos.finalJuego", compact('last_game', 'posicion'));
    }



}
