<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.png') }}" />
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <h4>Novo por aqui?</h4>
                        <h6 class="font-weight-light">Registre-se facilmente!</h6>

                        <!-- FORM DE REGISTRO -->
                        <form class="pt-3" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Nome -->
                            <div class="form-group">
                                <input type="text" name="name" class="form-control form-control-lg" 
                                    placeholder="Nome" value="{{ old('name') }}" required autofocus>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-lg" 
                                    placeholder="Email" value="{{ old('email') }}" required autocomplete="username">
                            </div>

                            <!-- Senha -->
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg" 
                                    placeholder="Senha" required autocomplete="new-password">
                            </div>

                            <!-- Confirmar Senha -->
                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control form-control-lg" 
                                    placeholder="Confirme a Senha" required autocomplete="new-password">
                            </div>

                            <!-- Foto de Perfil (opcional) -->
                            <div class="form-group">
                                <label for="profile_photo">Foto de Perfil</label>
                                <input type="file" name="profile_photo" class="form-control form-control-lg">
                            </div>

                            <!-- Tipo de usuário oculto -->
                            <input type="hidden" name="tipo_usuario" value="1">

                            <!-- Botão de Registrar -->
                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" 
                                    class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                    CADASTRAR
                                </button>
                            </div>

                            <div class="text-center mt-4 font-weight-light">
                                Já possui uma conta? 
                                <a href="{{ route('login') }}" class="text-primary"> Login</a>
                            </div>
                        </form>
                        <!-- FIM FORM -->
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

<!-- JS -->
<script src="{{ asset('dist/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('dist/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('dist/assets/js/misc.js') }}"></script>
<script src="{{ asset('dist/assets/js/settings.js') }}"></script>
<script src="{{ asset('dist/assets/js/todolist.js') }}"></script>
<script src="{{ asset('dist/assets/js/jquery.cookie.js') }}"></script>

</body>
</html>
