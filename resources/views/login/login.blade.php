<!DOCTYPE html>
<html lang="pt-br" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>EBPIPA - Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/logo-pipa.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('/fonts/boxicons.css') }}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/pages/page-auth.css') }}" />
    <!-- Vendors CSS -->

    <script src="{{ asset('/js/helpers.js') }}"></script>
    <script src="{{ asset('/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                @if (session('mensagem'))
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('mensagem') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                </span>
                                <img src="{{ asset('img/logo-pipa.png') }}" width="15%" />
                                <span class="app-brand-text demo text-body fw-bolder">ebpipa</span>
                            </a>
                        </div>
                        <h4 class="mb-2">Bem vindo ao ebpipa</h4>
                        <p class="mb-2">Por favor entre na sua conta</p>
                        @error('error')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                        <form id="formAuthentication" class="mb-3" action="{{ route('login.logar') }}"
                            method="post">
                            @csrf
                            @if (old('cnpj'))
                                <div class="form-check form-check-inline mb-3">
                                    <input name="radio_pessoa" class="form-check-input" type="radio" value="fisica"
                                        name="pessoa" id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1"> Pessoa Fisica </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="radio_pessoa" class="form-check-input" checked type="radio"
                                        value="juridica" name="pessoa" id="defaultRadio2" />
                                    <label class="form-check-label" for="defaultRadio2"> Pessoa Juridica </label>
                                </div>
                                <div id="divcpf" style="display: none" class="mb-3">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf"
                                        value="" placeholder="Entre com seu CPF" autofocus />
                                </div>
                                <div id="divcnpj" class="mb-3">
                                    <label for="cnpj" class="form-label">Cnpj</label>
                                    <input type="text" class="form-control" id="cnpj" name="cnpj"
                                        value="{{ old('cnpj') }}" placeholder="Entre com seu CNPJ" autofocus />
                                </div>
                            @else
                                <div class="form-check form-check-inline mb-3">
                                    <input name="radio_pessoa" class="form-check-input" checked type="radio"
                                        value="fisica" name="pessoa" id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1"> Pessoa Fisica </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="radio_pessoa" class="form-check-input" type="radio"
                                        value="juridica" name="pessoa" id="defaultRadio2" />
                                    <label class="form-check-label" for="defaultRadio2"> Pessoa Juridica </label>
                                </div>
                                <div id="divcpf" class="mb-3">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf"
                                        value="{{ old('cpf') }}" placeholder="Entre com seu CPF" autofocus />
                                </div>
                                <div id="divcnpj" style="display: none" class="mb-3">
                                    <label for="cnpj" class="form-label">Cnpj</label>
                                    <input type="text" class="form-control" id="cnpj" name="cnpj"
                                        value="" placeholder="Entre com seu CNPJ" autofocus />
                                </div>
                            @endif

                            @error('cpf')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Senha</label>
                                    {{-- <a href="auth-forgot-password-basic.html">
                                        <small>Esqueceu a senha?</small>
                                    </a> --}}
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                @error('password')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Lembrar-me </label>
                  </div>
                </div> --}}
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Entrar</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Novo aqui?</span>
                            <a href="{{ route('login.cadastro') }}">
                                <span>Cadastrar-se</span>
                            </a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
        <script src="{{ asset('/js/jquery.js') }}"></script>
        <script src="{{ asset('/js/popper.js') }}"></script>
        <script></script>
    </div>
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/js/cleave.js') }}"></script>
    <script src="{{ asset('/js/login.js') }}"></script>
    <script src="{{ asset('/js/mascaras.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/buttons.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->

</body>

</html>
