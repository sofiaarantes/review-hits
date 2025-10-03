<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\Genero;
use App\Models\Musica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Consulta base com relacionamentos e média de avaliações
        $query = Musica::with(['genero', 'artista']) 
               ->withAvg('avaliacoes', 'nota'); 

        // Filtros
        if ($request->filled('search')) {
            $query->where('titulo', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('genero_id')) {
            $query->where('genero_id', $request->genero_id);
        }
        if ($request->filled('artista_id')) {
            $query->where('artista_id', $request->artista_id);
        }
        if ($request->filled('album')) {
            $query->where('album', 'like', '%' . $request->album . '%');
        }
        if ($request->filled('ano_lancamento')) {
            $query->where('ano_lancamento', $request->ano_lancamento);
        }

        $musicas = $query->get();

        // Administrador
        $generos = Genero::all();
        $artistas = Artista::all();

        if (Auth::user()->tipo_usuario == 1) {
            return view('usuario/musicas', compact('musicas', 'generos', 'artistas'));
        } elseif (Auth::user()->tipo_usuario == 2) {
            return view('administrador/musicas/home', compact('musicas', 'generos', 'artistas'));
        } else {
            Auth::logout();
            return redirect('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $generos = Genero::all();
        $artistas = Artista::all();
        return view('administrador/musicas/create', compact('generos', 'artistas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:100',
            'album' => 'nullable|string|max:150',
            'ano_lancamento' => 'nullable|integer|min:0',
            'genero_id' => 'required|exists:generos,id',
            'artista_id' => 'required|exists:artistas,id',
        ]);

        Musica::create([
            'titulo' => $request->titulo,
            'album' => $request->album,
            'ano_lancamento' => $request->ano_lancamento,
            'genero_id' => $request->genero_id,
            'artista_id' => $request->artista_id,
        ]);

        return redirect()->route('musicas.index')
                 ->with('success', 'Música cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($musica_id)
    {
        $musica = Musica::with([
            'artista',
            'genero',
            'avaliacoes.usuario' 
        ])->findOrFail($musica_id);

        return view('usuario/detalhes', compact('musica'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($musica_id)
    {
        $generos = Genero::all();
        $artistas = Artista::all();
        $musica = \App\Models\Musica::findOrFail($musica_id);

        return view('administrador/musicas/edit', compact('musica','generos', 'artistas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $musica_id)
    {
        $request->validate([
            'titulo' => 'required|string|max:100',
            'album' => 'nullable|string|max:150',
            'ano_lancamento' => 'nullable|integer|min:0',
            'genero_id' => 'required|exists:generos,id',
            'artista_id' => 'required|exists:artistas,id',
        ]);

        $musica = \App\Models\Musica::findOrFail($musica_id);
        $musica->update([
            'titulo' => $request->titulo,
            'album' => $request->album,
            'ano_lancamento' => $request->ano_lancamento,
            'genero_id' => $request->genero_id,
            'artista_id' => $request->artista_id,
        ]);

        return redirect()->route('musicas.index', $musica_id)
            ->with('success', 'Música atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($musica_id)
    {
        $musicas = Musica::findOrFail($musica_id);
        $musicas->delete();

        return redirect()->route('musicas.index', compact('musicas'))
            ->with('success', 'Música excluída com sucesso!');
    }
}
