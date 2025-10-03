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
          <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Pesquisar avaliações da música..."> 
              </div>
            </form>
          </div>
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
              <a href="#" class="nav-link">
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
                  <span class="text-secondary text-small">Administrador</span>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Editar Avaliações</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('musicas.index') }}">
                <span class="menu-title">Editar Músicas</span>
                <i class="mdi mdi-music menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('artistas.index') }}">
                <span class="menu-title">Editar Artistas</span>
                <i class="mdi mdi-account menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('generos.index') }}">
                <span class="menu-title">Editar Gêneros</span>
                <i class="mdi mdi-pencil menu-icon"></i>
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
                  <i class="mdi mdi-home"></i>
                </span> Gerenciar Artistas
              </h3>
            </div> 
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <h4 class="card-title">Artistas</h4>
                      <a href="{{ route('artistas.create') }}" class="btn btn-primary btn-sm">
                          Cadastrar Artista
                      </a>
                    </div>
                    <div class="table-responsive">
                      @if($artistas->count() > 0)
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Cadastrado em</th>
                            <th class="text-center">Última atualização</th>
                            <th class="text-center">Ações</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($artistas as $artista)
                            <tr class="text-center">
                              <td>{{ $artista->nome_artista }}</td>
                              <td>{{ $artista->created_at->format('d M, Y') }}</td>
                              <td>{{ $artista->updated_at->format('d M, Y') }}</td>
                              <td>
                                <div class="d-flex justify-content-end gap-2">
                                  <a href="{{ route('artistas.edit', $artista->id) }}" class="btn btn-warning btn-sm" style="background-color:#cd9ff8;">Editar</a>
                                  <form action="{{ route('artistas.destroy', $artista->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Tem certeza que deseja excluir este artista?')">
                                        Excluir
                                    </button>
                                  </form><t></t><t></t>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      @else
                          <p class="text-center text-muted">Nenhum artista cadastrado.</p>
                      @endif
                    </div>
                  </div>
                </div>
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