<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\callback;

class PartidaController extends Controller
{
    public function rankings() {
        $best = null;
        if (Auth::user() != null && Auth::user()->best != null) {
            $best = Auth::user()->best;
            // Convierte el campo 'tiempo' de 'partida' en una variable int
            $seg = (int)$best -> tiempo;

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

            $best -> tiempo = $tiempo;

            $posicion = 1;
            $partidas = Partida::orderBy('tiempo','asc')->get();
            foreach ($partidas as $partida) {
                if ($partida->user_id == Auth::user()->id) {
                    break;
                }
                $posicion++;
            }
            $best->posicion = $posicion;
        }
        return view("rankings",compact('best'));
    }

    public function rankings_pagina($pagina) {
        $partidas = Partida::orderBy('tiempo','asc')->paginate(6,['*'],'page',$pagina);

        foreach ($partidas as $partida) {
            $partida->user;
            // Convierte el campo 'tiempo' de 'partida' en una variable int
            $seg = (int)$partida -> tiempo;

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

            $partida -> tiempo = $tiempo;
        }
        return $partidas;
    }

    public function rankings_dificultad($dificultad,$pagina) {
        $partidas = Partida::orderBy('tiempo','asc')->where('dificultad', $dificultad)->paginate(6,['*'],'page',$pagina);
        foreach ($partidas as $partida) {
            $partida->user;
            // Convierte el campo 'tiempo' de 'partida' en una variable int
            $seg = (int)$partida -> tiempo;

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

            $partida -> tiempo = $tiempo;
        }
        return $partidas;
    }

    public function store(Request $request) {
        if (Auth::user() == null) {
            return json_encode(['error' => 'No estás logueado']);
        }
        $partida = new Partida();
        $partida->user_id = Auth::user()->id;

        $dificultad = $request->dificultad;
        $tiempo = $request->tiempo;
        switch ($request->dificultad) {
            case 'F':
                $dificultad = 'Facil';
                $tiempo = 7200 - $request->tiempo;
                break;
            case 'N':
                $dificultad = 'Media';
                $tiempo = 3600 - $request->tiempo;
                break;
            case 'D':
                $dificultad = 'Dificil';
                $tiempo = 1800 - $request->tiempo;
                break;
            case 'H':
                $dificultad = 'Heroe';
                $tiempo = 60 - $request->tiempo;
                break;

            default:
                # code...
                break;
        }

        $partida->tiempo = $tiempo;
        // $partida->tiempo = $request->tiempo;
        $partida->errores = $request->errores;
        $partida->dificultad = $dificultad;
        $partida->save();
        return $partida;
    }
}
