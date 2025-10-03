<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;

class ArtistaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artistas = Artista::all();
        return view('administrador/artistas/home', compact('artistas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador/artistas/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome_artista' => 'required|string|max:100',
        ]);

        Artista::create([
            'nome_artista' => $request->nome_artista,
        ]);

        return redirect()->route('artistas.index')
                 ->with('success', 'Artista cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($Artista_id)
    {
        $artista = \App\Models\Artista::findOrFail($Artista_id);

        return view('administrador/artistas/edit', compact('artista'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $artista_id)
    {
        $request->validate([
            'nome_artista' => 'required|string|max:100',
        ]);

        $artista = \App\Models\Artista::findOrFail($artista_id);
        $artista->update([
            'nome_artista' => $request->nome_artista,
        ]);

        return redirect()->route('artistas.index', $artista_id)
            ->with('success', 'Artista atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($artista_id)
    {
        $artistas = Artista::all();
        $artista = Artista::findOrFail($artista_id);
        $artista->delete();

        return redirect()->route('artistas.index', compact('artistas'))
            ->with('success', 'Artista excluído com sucesso!');
    }
}
