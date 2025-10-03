<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Musica;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvaliacaoController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Avaliacao::with(['musica', 'user']);

        // Filtro por ID do usuário (opcional)
        if ($request->filled('usuario_id')) {
            $query->where('usuario_id', $request->usuario_id);
        }

        $avaliacoes = $query->get();

        return view('dashboard', compact('avaliacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nota' => 'required|numeric|between:0,5',
            'comentario' => 'nullable|string',
            'usuario_id' => 'required|exists:users,id',
            'musica_id' => 'required|exists:musicas,id',
        ]);

        Avaliacao::create([
            'nota' => $request->nota,
            'comentario' => $request->comentario,
            'usuario_id' => $request->usuario_id,
            'musica_id' => $request->musica_id,
        ]);

        return redirect()->route('musicas.show', $request->musica_id)
                 ->with('success', 'Avaliação cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($musica_id)
    {
        $usuario_id = Auth::user()->id;
        $musica = \App\Models\Musica::findOrFail($musica_id);
        return view('usuario/avaliar_musica', compact('usuario_id', 'musica'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($avaliacao_id)
    {
        $avaliacao = \App\Models\Avaliacao::findOrFail($avaliacao_id);

        return view('usuario/editar_avaliacao', compact('avaliacao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $avaliacao_id)
    {
        $request->validate([
            'nota' => 'required|string|max:100',
            'comentario' => 'nullable|string|max:150',
            'usuario_id' => 'required|exists:users,id',
            'musica_id' => 'required|exists:musicas,id',
        ]);

        $musica = \App\Models\Avaliacao::findOrFail($avaliacao_id);
        $musica->update([
            'nota' => $request->nota,
            'comentario' => $request->comentario,
            'usuario_id' => $request->usuario_id,
            'musica_id' => $request->musica_id,
        ]);

        return redirect()->route('avaliacoes.suasAvaliacoes')
            ->with('success', 'Avaliação atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($avaliacao_id)
    {
        $avaliacoes = Avaliacao::findOrFail($avaliacao_id);
        $avaliacoes->delete();


        $usuarios = User::where('tipo_usuario', 1)->get();

        if (Auth::user()->tipo_usuario == 1) {
            return redirect()->route('avaliacoes.suasAvaliacoes', compact('avaliacoes'))
                ->with('success', 'Avaliação excluída com sucesso!');
        } elseif (Auth::user()->tipo_usuario == 2) {
            return redirect()->route('dashboard', compact('avaliacoes', 'usuarios'))
                ->with('success', 'Avaliação excluída com sucesso!');
        } else {
            Auth::logout();
            return redirect('/login');
        }
    }

    public function suasAvaliacoes()
    {
        $userId = Auth::user()->id;
        $avaliacoes = Avaliacao::with('musica.artista')
            ->where('usuario_id', $userId)
            ->get();
        return view('usuario/suasAvaliacoes', compact('avaliacoes'));
    }
}
