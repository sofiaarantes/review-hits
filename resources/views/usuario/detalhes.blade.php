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
                    </span> Detalhes da Música
                </h3>
            </div>

            <!-- Card da música -->
            <div class="row">
              <div class="col-12 grid-margin">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">Título</th>
                      <th class="text-center">Álbum</th>
                      <th class="text-center">Ano de Lançamento</th>
                      <th class="text-center">Gênero</th>
                      <th class="text-center">Artista</th>
                      <th class="text-center">Avaliar</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr class="text-center">
                        <td>{{ $musica->titulo }}</td>
                        <td>{{ $musica->album }}</td>
                        <td>{{ $musica->ano_lancamento }}</td>
                        <td>{{ $musica->genero->nome_genero ?? 'Sem gênero' }}</td>
                        <td>{{ $musica->artista->nome_artista ?? 'Sem artista' }}</td>
                        <td>
                          <a href="{{ route('avaliacoes.show', $musica->id) }}" class="btn btn-gradient-primary">Avaliar Música</a>
                        </td>
                      </tr>
                  </tbody>
                </table>

                <!-- Avaliações -->
                <h5 class="mt-4 mb-2">Avaliações</h5>
                @forelse($musica->avaliacoes as $avaliacao)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $avaliacao->usuario->profile_photo_path 
                                                ? asset('storage/' . $avaliacao->usuario->profile_photo_path) 
                                                : asset('dist/assets/images/foto_padrao.jpg') }}" 
                                        alt="Foto de perfil" class="rounded-circle me-2"
                                        style="width:40px; height:40px; object-fit:cover;">
                                    <span class="fw-bold">{{ $avaliacao->usuario->name ?? 'Anônimo' }}</span>
                                </div>
                                <span class="badge bg-gradient-primary" style="font-size: 0.9rem;">
                                    Nota: {{ $avaliacao->nota ?? '---' }}
                                </span>
                            </div>
                            <p class="mb-2">
                                {{ $avaliacao->comentario ?? 'Sem comentário' }}
                            </p>
                            <p class="text-muted mb-0">
                                🎵 Avaliou: <strong>{{ $musica->titulo }}</strong>
                            </p>
                            <small class="text-muted">{{ $avaliacao->created_at->format('d M, Y H:i') }}</small>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Nenhuma avaliação encontrada.</p>
                @endforelse
              </div>
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