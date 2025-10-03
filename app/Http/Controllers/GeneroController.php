<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generos = Genero::all();
        return view('administrador/generos/home', compact('generos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador/generos/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome_genero' => 'required|string|max:100',
        ]);

        Genero::create([
            'nome_genero' => $request->nome_genero,
        ]);

        return redirect()->route('generos.index')
                 ->with('success', 'Gênero cadastrado com sucesso!');
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
    public function edit($genero_id)
    {
        $genero = \App\Models\Genero::findOrFail($genero_id);

        return view('administrador/generos/edit', compact('genero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $genero_id)
    {
        $request->validate([
            'nome_genero' => 'required|string|max:100',
        ]);

        $genero = \App\Models\Genero::findOrFail($genero_id);
        $genero->update([
            'nome_genero' => $request->nome_genero,
        ]);

        return redirect()->route('generos.index', $genero_id)
            ->with('success', 'Gênero atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($genero_id)
    {
        $generos = Genero::all();
        \App\Models\Musica::where('genero_id', $genero_id)->delete();
        $genero = Genero::findOrFail($genero_id);
        $genero->delete();

        return redirect()->route('generos.index', compact('generos'))
            ->with('success', 'Gênero excluído com sucesso!');
    }
}
