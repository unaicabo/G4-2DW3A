<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

use App\Models\Partida;

class ProfileController extends Controller
{
    public function index()
    {
        return view('index');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $usuario = Auth::user();
        $usuario->best;
        $usuario->last_game;

        // Coge el ultimo tiempo
        if (isset($usuario->last_game->tiempo)) {

            // Convierte el campo 'tiempo' de 'partida' en una variable int
            $seg = (int)$usuario->last_game->tiempo;

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
            $tiempo_last = $hours . "h " . $minutes . "m " . $seconds . "s";
            $usuario->last_game->tiempo = $tiempo_last;
        } else {
            $tiempo_last = null;
        }

        // Coge el mejor tiempo
        if (isset($usuario->best->tiempo)) {
            // Convierte el campo 'tiempo' de 'partida' en una variable int
            $seg = (int)$usuario->best->tiempo;

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

            $tiempo_best = $hours . "h " . $minutes . "m " . $seconds . "s";

            $usuario->best->tiempo = $tiempo_best;

        } else {
            $tiempo_best = null;
        }

        return view('profile.edit', [
            'user' => $request->user(),
            'tiempo_last'=> $tiempo_last,
            'tiempo_best'=> $tiempo_best,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        if ($request->foto) {
            // $originalName = $request->foto->getClientOriginalName();
            // $path = 'Fotos-Perfil/'.$originalName;

            // Storage::disk('public')->put($path, file_get_contents($request->foto));

            // $request->user()->foto = $request->foto->getClientOriginalName();


            // $filename = time(). '.'.$request->foto->extension();
            $filename = $request->foto->getClientOriginalName();
            $request->foto->storeAs(('public\Fotos-Perfil'), $filename);

            $request->user()->foto = $filename;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $partidas_user = Partida::where('user_id', $user->id)->get();
        foreach ($partidas_user as $partida) {
            $partida->delete();
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function admin()
    {
        if (Auth::user()->rol != 'admin') {
            return Redirect::to('/');
        }
        return view('admin');
    }
}
