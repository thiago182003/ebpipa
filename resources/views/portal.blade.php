<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EBpipa - Sistema de Credenciamento de Pipeiros</title>

    <meta name="description" content="Sistema de Gerenciamento para Operação Carro Pipa" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('/img/logo-pipa.png')}}" />

    <!-- Fonts and Core CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" />
    
    <!-- JS Helpers -->
    <script src="{{ asset('/js/helpers.js') }}"></script>
    <script src="{{ asset('/js/config.js') }}"></script>
</head>

<body>
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light mt-3">
            <div class="container-fluid">
                <div class="app-brand demo">
                    <div class="app-brand-link d-flex align-items-center">
                        <img src="{{ asset('/img/logo-pipa.png') }}" width="60" alt="Logo" />
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">EBPIPA</span>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item me-2 d-flex align-items-center">
                            <a class="btn btn-pipa rounded-pill me-2" href="{{ route('forms.show') }}">Ouvidoria</a>
                            <a class="btn btn-pipa rounded-pill" href="{{ route('login.login') }}">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-pipa rounded-pill" href="{{ route('login.cadastro') }}">Cadastrar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Centralized Content -->
        <div class="container d-flex flex-column justify-content-center align-items-center text-center">
            <div class="row">
                <div class="col-12">
                    <img src="{{ asset('/img/fundo.jpg') }}" class="img-fluid" alt="Imagem de fundo">
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('/js/jquery.js') }}"></script>
    <script src="{{ asset('/js/popper.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/js/menu.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/dashboards-analytics.js') }}"></script>
</body>

</html>
