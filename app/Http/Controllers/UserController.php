<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();

        if ($user->id != $id) {
            abort(403, 'Acesso negado.');
        }

        $avaliacoes = Avaliacao::with('musica.artista')
            ->where('usuario_id', $user->id)
            ->get();

        return view('usuario/verPerfil', compact('user', 'avaliacoes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user_id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user_id,
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = \App\Models\User::findOrFail($user_id);

        // Upload da foto de perfil, se enviada
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'profile_photo_path' => $user->profile_photo_path, // mantém a foto atual se não trocar
        ]);

        return redirect()->route('users.edit', $user->id)
             ->with('success', 'Perfil atualizado com sucesso!');
    }
}
