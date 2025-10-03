<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request){
        if(Auth::user()->tipo_usuario == 1){
          $avaliacoes = Avaliacao::with(['musica', 'user'])->get();
          return view('dashboardUsuario', compact('avaliacoes'));
        }
        else if(Auth::user()->tipo_usuario == 2){
          $query = Avaliacao::with(['musica', 'usuario']);

          // Filtro por usuário (Administrador)
          if ($request->filled('usuario_id')) {
              $query->where('usuario_id', $request->usuario_id);
          }

          $avaliacoes = $query->get();

          $usuarios = User::where('tipo_usuario', 1)->get();
          return view('dashboardAdmin', compact('avaliacoes', 'usuarios'));
        }
        else{
          Auth::logout();
          return redirect('/login');
        }
    }
}
