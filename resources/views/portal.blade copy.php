<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ebpipa</title>

    <meta name="description" content="Sistema de Gerenciamento para Operação Carro Pipa" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/css/core.css') }}" class="template-customizer-core-css" />
    {{-- <link rel="stylesheet" href="{{ asset('/css/theme-default.css') }}" class="template-customizer-theme-css" /> --}}
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" />

    <!-- Vendors CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('/css/perfect-scrollbar.css') }}" /> --}}

    <!-- Helpers -->
    <script src="{{ asset('/js/helpers.js') }}"></script>
    <script src="{{ asset('/js/config.js') }}"></script>

</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light mt-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><span class="app-brand-text demo menu-text fw-bolder ms-2">Ebpipa</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Editais</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" class="btn rounded-pill btn-pipa" href="{{ route('login.login') }}">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" class="btn rounded-pill btn-pipa" href="{{ route('login.cadastro') }}">Cadastrar</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <div class="row mt-3">
            <img src="/img/fundo.jpg" />
        </div>

        <!-- <div class="row mt-2">
            <div class="col-md">
                <div class="row">
                    <h2 class="my-4 d-flex justify-content-center">Noticias</h2>
                    <div class="col-md-4 col-lg-4 mb-4">
                        <div class="card ">
                            <img class="card-img" style="border-bottom: 1px solid rgba(134, 133, 133, 0.534)"
                                src="{{ asset('img/noticias/lotesvagos.png') }}" alt="Card image cap">
                            <div class="featured-date mt-n4 ms-4 bg-white rounded w-px-50 shadow text-center p-1">
                                <h5 class="mb-0 text-dark">21</h5>
                                <span class="text-primary">Jun</span>
                            </div>
                            <div class="card-body">
                                <h5 class="text-truncate">Lotes Vagos</h5>
                                <div class="d-flex my-3">
                                    <p>Após nosso último sorteio, tivemos 2 lotes vagos. Confira aqui os próximos
                                        passos.</p>
                                    <a href="javascript:;" class="btn btn-primary ms-auto" role="button">Leia...</a>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="card-actions">
                                        <a href="javascript:;" class="text-muted me-3"><i class="bx bx-heart me-1"></i>
                                            236</a>
                                        <a href="javascript:;" class="text-muted"><i class="bx bx-message me-1"></i>
                                            12</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 mb-4">
                        <div class="card ">
                            <img class="card-img" style="border-bottom: 1px solid rgba(134, 133, 133, 0.534)"
                                src="{{ asset('img/noticias/suspensas.jpeg') }}" alt="Card image cap">
                            <div class="featured-date mt-n4 ms-4 bg-white rounded w-px-50 shadow text-center p-1">
                                <h5 class="mb-0 text-dark">30</h5>
                                <span class="text-primary">Jun</span>
                            </div>
                            <div class="card-body">
                                <h5 class="text-truncate">Cidades Suspensas</h5>
                                <div class="d-flex my-3">
                                    <p>A partir de agosto/23 5 cidades deixaraõ de fazer parte do programa...</p>
                                    <a href="javascript:;" class="btn btn-primary ms-auto" role="button">Join Now</a>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="card-actions">
                                        <a href="javascript:;" class="text-muted me-3"><i
                                                class="bx bx-heart me-1"></i>
                                            236</a>
                                        <a href="javascript:;" class="text-muted"><i class="bx bx-message me-1"></i>
                                            12</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 mb-4">
                        <div class="card ">
                            <img class="card-img" style="border-bottom: 1px solid rgba(134, 133, 133, 0.534)"
                                src="{{ asset('img/noticias/sorteio.jpeg') }}" alt="Card image cap">
                            <div class="featured-date mt-n4 ms-4 bg-white rounded w-px-50 shadow text-center p-1">
                                <h5 class="mb-0 text-dark">10</h5>
                                <span class="text-primary">Jul</span>
                            </div>
                            <div class="card-body">
                                <h5 class="text-truncate">Sorteio de Lotes</h5>
                                <div class="d-flex my-3">
                                    <p>Nosso próximo sorteio será realizado em</p>
                                    <a href="javascript:;" class="btn btn-primary ms-auto" role="button">Join
                                        Now</a>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="card-actions">
                                        <a href="javascript:;" class="text-muted me-3"><i
                                                class="bx bx-heart me-1"></i>
                                            236</a>
                                        <a href="javascript:;" class="text-muted"><i class="bx bx-message me-1"></i>
                                            12</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div> -->
    </div>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/js/jquery.js') }}"></script>
    <script src="{{ asset('/js/popper.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/js/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>