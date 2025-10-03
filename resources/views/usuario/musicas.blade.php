<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Review Hits</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/public-datepicker/public-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.png') }}" />
  </head>
  <body>
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}"><img src="{{ asset('dist/assets/images/logo.png') }}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img src="{{ asset('dist/assets/images/logo-mini.svg') }}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="{{ Auth::user()->profile_photo_path 
                        ? asset('storage/' . Auth::user()->profile_photo_path) 
                        : asset('dist/assets/images/foto_padrao.jpg') }}" 
                    alt="Foto do perfil" class="rounded-circle">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-logout me-2 text-primary"></i>
                  <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="submit" class="dropdown-item">Sair</button>
                  </form> 
                </a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="{{ route('users.edit', Auth::user()->id )}}" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{ Auth::user()->profile_photo_path 
                        ? asset('storage/' . Auth::user()->profile_photo_path) 
                        : asset('dist/assets/images/foto_padrao.jpg') }}" 
                    alt="Foto do perfil" class="rounded-circle">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                  <span class="text-secondary text-small">Editar perfil</span>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Explorar Avaliações</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('musicas.index') }}">
                <span class="menu-title">Músicas</span>
                <i class="mdi mdi-music menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('avaliacoes.suasAvaliacoes') }}">
                <span class="menu-title">Ver suas avaliações</span>
                <i class="mdi mdi-account menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <!-- Formulário oculto para logout -->
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>

              <!-- Link de logout -->
              <a class="nav-link" href="#" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <span class="menu-title">Sair</span>
                  <i class="mdi mdi-logout menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-music"></i>
                </span> Explorar Músicas
              </h3>
            </div>
            <form method="GET" action="{{ route('musicas.index') }}" class="row mb-4 g-2">
              <div class="col-md-2">
                <input type="text" name="search" class="form-control" 
                      placeholder="Título..."
                      value="{{ request('search') }}">
              </div>
              <div class="col-md-2">
                <input type="text" name="album" class="form-control" 
                      placeholder="Álbum..."
                      value="{{ request('album') }}">
              </div>
              <div class="col-md-2">
                <input type="number" name="ano_lancamento" class="form-control"
                      placeholder="Ano..."
                      value="{{ request('ano_lancamento') }}">
              </div>
              <div class="col-md-2">
                <select name="genero_id" class="form-select">
                  <option value="">Gênero</option>
                  @foreach($generos as $genero)
                    <option value="{{ $genero->id }}" {{ request('genero_id') == $genero->id ? 'selected' : '' }}>
                      {{ $genero->nome_genero }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <select name="artista_id" class="form-select">
                  <option value="">Artista</option>
                  @foreach($artistas as $artista)
                    <option value="{{ $artista->id }}" {{ request('artista_id') == $artista->id ? 'selected' : '' }}>
                      {{ $artista->nome_artista }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-gradient-primary w-100">Filtrar</button>
              </div>
            </form>
            <div class="row">
              @forelse($musicas as $musica)
                <div class="col-md-4 mb-4">
                  <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                      <h5 class="card-title text-primary">{{ $musica->titulo }}</h5>
                      <p class="card-text">
                        <strong>Artista:</strong> {{ $musica->artista->nome_artista }}<br>
                        <strong>Álbum:</strong> {{ $musica->album ?? 'Não informado' }}<br>
                        <strong>Lançamento:</strong> {{ $musica->ano_lancamento ?? '---' }}<br>
                        <strong>Nota Média:</strong> 
                        {{ $musica->avaliacoes_avg_nota ? number_format($musica->avaliacoes_avg_nota, 1, ',', '.') : 'Sem avaliações' }}
                      </p>

                      <div class="mt-auto d-flex justify-content-between">
                        <a href="{{ route('musicas.show', $musica->id) }}" class="btn btn-sm btn-gradient-primary">
                          Ver Detalhes
                        </a>
                        <a href="{{ route('avaliacoes.show', $musica->id) }}">
                          <input type="hidden" name="musica_id" value="{{ $musica->id }}">
                          <button type="submit" class="btn btn-sm btn-outline-success">Avaliar</button>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @empty
                <p class="text-center text-muted">Nenhuma música encontrada.</p>
              @endforelse
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('dist/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('dist/assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('dist/assets/vendors/public-datepicker/public-datepicker.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('dist/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('dist/assets/js/misc.js') }}"></script>
    <script src="ass{{ asset('dist/assets/js/settings.js') }}ets"></script>
    <script src="{{ asset('dist/assets/js/todolist.js') }}"></script>
    <script src="{{ asset('dist/assets/js/jquery.cookie.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('dist/assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->
  </body>
</html>