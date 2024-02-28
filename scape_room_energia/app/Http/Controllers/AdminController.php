<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function partidas()
    {
        $partidas = Partida::paginate(10);
        foreach ($partidas as $partida) {
            $partida->usuario = User::find($partida->user_id);
        }
        return view('admin.partidas', compact('partidas'));
    }

    public function usuarios()
    {
        $usuarios = User::paginate(10);
        return view('admin.usuarios', compact('usuarios'));
    }

    public function changeRol(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users');
        }

        $adminUsers = User::where('rol', 'admin')->get();
        if (count($adminUsers) == 1 && $user->rol == 'admin') {
            return redirect()->route('admin.users');
        }

        if ($user->rol == 'admin') {
            $user->rol = 'player';
        } else {
            $user->rol = 'admin';
        }
        $user->save();
        return redirect()->route('admin.users');
    }

    public function deleteUser(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users');
        }

        $adminUsers = User::where('rol', 'admin')->get();
        if (count($adminUsers) == 1 && $user->rol == 'admin') {
            return redirect()->route('admin.users');
        }

        //borrar partidas
        $partidas = Partida::where('user_id', $id)->get();
        foreach ($partidas as $partida) {
            $partida->delete();
        }

        $user->delete();
        return redirect()->route('admin.users');
    }

    public function deletePartida(Request $request)
    {
        $id = $request->id;
        $partida = Partida::find($id);
        $partida->delete();
        return redirect()->route('admin.partidas');
    }
}
