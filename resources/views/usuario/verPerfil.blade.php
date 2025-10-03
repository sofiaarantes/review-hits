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

    <!-- Mensagem de sucesso -->
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- Mensagem de erro -->
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
          <i class="mdi mdi-account"></i>
        </span> Editar Perfil
      </h3>
    </div>

    <!-- Card de edição de perfil -->
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Informações do Perfil</h4>
            <form action="{{ route('users.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="row">
                <div class="col-md-3 text-center">
                  <img src="{{ $user->profile_photo_path 
                              ? asset('storage/' . $user->profile_photo_path) 
                              : asset('dist/assets/images/foto_padrao.jpg') }}" 
                       class="rounded-circle mb-3" width="120" height="120" alt="Foto de perfil">
                  <input type="file" name="profile_photo" class="form-control">
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                  </div>
                  <button type="submit" class="btn btn-gradient-primary">Salvar Alterações</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Card de avaliações -->
    <div class="row mt-4">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="card-title mb-0">Suas Avaliações</h4>
              <a href="{{ route('avaliacoes.suasAvaliacoes') }}" class="btn btn-gradient-primary btn-sm">
                Editar Avaliações
              </a>
            </div>
            <div class="table-responsive">
              @if($avaliacoes->count() > 0)
              <table class="table table-hover">
                <thead>
                  <tr class="text-center">
                    <th>Nota</th>
                    <th>Comentário</th>
                    <th>Música</th>
                    <th>Criado em</th>
                    <th>Atualizado em</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($avaliacoes as $avaliacao)
                  <tr class="text-center">
                    <td>{{ $avaliacao->nota }}</td>
                    <td>{{ $avaliacao->comentario }}</td>
                    <td>{{ $avaliacao->musica->titulo }}</td>
                    <td>{{ $avaliacao->created_at->format('d/m/Y') }}</td>
                    <td>{{ $avaliacao->updated_at->format('d/m/Y') }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @else
                <p class="text-center text-muted">Nenhuma avaliação cadastrada.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
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