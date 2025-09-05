<!DOCTYPE html>

<html lang="pt-br" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>EBPIPA - cadastrar</title>

    <meta name="description" content="" />

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
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <img src="{{ asset('img/logo-pipa.png') }}" width="15%" />
                                <span class="app-brand-text demo text-body fw-bolder">ebpipa</span>
                            </a>
                        </div>

                        <p class="mb-4">Faça seu cadastro e tenha acesso aos processos</p>
                        @error('error')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                        <form id="formAuthentication" class="mb-3" action="{{ route('login.cadastrar') }}"
                            method="post">
                            @csrf
                            @if (old('cnpj'))
                                <div class="form-check form-check-inline mb-3">
                                    <input name="radio_pessoa" class="form-check-input" type="radio" value="fisica"
                                        id="defaultRadio1" />
                                    <label class="form-check-label " for="defaultRadio1"> Pessoa Fisica </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="radio_pessoa" checked class="form-check-input" type="radio"
                                        value="juridica" id="defaultRadio2" />
                                    <label class="form-check-label" for="defaultRadio2"> Pessoa Juridica </label>
                                </div>
                                <div id="divcpf" style="display: none">
                                    <div class="mb-3">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf"
                                            value="{{ old('cpf') }}" placeholder="Entre com seu CPF" autofocus />
                                    </div>
                                    @error('cpf')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" id="nome" name="nome"
                                            value="{{ old('nome') }}" placeholder="Entre com seu nome completo" />
                                    </div>
                                    @error('nome')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div id="divcnpj" class="mb-3">
                                    <div class="mb-3">
                                        <label for="cnpj" class="form-label">Cnpj</label>
                                        <input type="text" class="form-control" id="cnpj" name="cnpj"
                                            value="{{ old('cnpj') }}" placeholder="Entre com seu CNPJ" autofocus />
                                    </div>
                                    @error('cnpj')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-3">
                                        <label for="razaosocial" class="form-label">Razão Social</label>
                                        <input type="text" class="form-control" value="{{ old('razaosocial') }}"
                                            id="razaosocial" name="razaosocial"
                                            placeholder="Entre com sua Razão Social" />
                                    </div>
                                </div>
                                @error('razaosocial')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            @else
                                <div class="form-check form-check-inline mb-3">
                                    <input name="radio_pessoa" class="form-check-input" type="radio"
                                        value="fisica" id="defaultRadio1" checked />
                                    <label class="form-check-label " for="defaultRadio1"> Pessoa Fisica </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="radio_pessoa" class="form-check-input" type="radio"
                                        value="juridica" id="defaultRadio2" />
                                    <label class="form-check-label" for="defaultRadio2"> Pessoa Juridica </label>
                                </div>
                                <div id="divcpf">
                                    <div class="mb-3">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf"
                                            value="{{ old('cpf') }}" placeholder="Entre com seu CPF" autofocus />
                                    </div>
                                    @error('cpf')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" id="nome" name="nome"
                                            value="{{ old('nome') }}" placeholder="Entre com seu nome completo" />
                                    </div>
                                    @error('nome')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div id="divcnpj" style="display: none" class="mb-3">
                                    <div class="mb-3">
                                        <label for="cnpj" class="form-label">Cnpj</label>
                                        <input type="text" class="form-control" id="cnpj" name="cnpj"
                                            value="{{ old('cnpj') }}" placeholder="Entre com seu CNPJ" autofocus />
                                    </div>
                                    @error('cnpj')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-3">
                                        <label for="razaosocial" class="form-label">Razão Social</label>
                                        <input type="text" class="form-control" value="{{ old('razaosocial') }}"
                                            id="razaosocial" name="razaosocial"
                                            placeholder="Entre com sua Razão Social" />
                                    </div>
                                </div>
                                @error('razaosocial')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            @endif

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email"
                                    value="{{ old('email') }}" name="email" placeholder="Entre com seu email" />
                            </div>
                            @error('email')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Senha</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" onkeyup="pinta()" class="form-control"
                                        name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">A senha deve conter ao menos 8 caracteres
                                    e:</label>
                                <ul>
                                    <li> <label id="maiusculaLabel" class="form-label">uma letra maiuscula</label>
                                    </li>
                                    <li> <label id="minusculaLabel" class="form-label">uma letra minuscula</label>
                                    </li>
                                    <li> <label id="numeroLabel" class="form-label">uma numero</label></li>
                                    <li> <label id="especialLabel" class="form-label">um caracter especial</label>
                                    </li>
                                    <li> <label id="comprimentoLabel" class="form-label">8 caracteres</label>
                                    </li>
                                </ul>
                            </div>
                            @error('password')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror

                            {{-- <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions"
                                        name="terms" />
                                    <label class="form-check-label" for="terms-conditions">
                                        Eu condordo com os
                                        <a href="javascript:void(0);">termos e politicas de privacidade</a>
                                    </label>
                                </div>
                            </div> --}}
                            <button class="btn btn-primary d-grid w-100" type="submit">Cadastrar</button>
                        </form>

                        <p class="text-center">
                            <span>Ja possui uma conta?</span>
                            <a href="{{ route('login.login') }}">
                                <span>Entre</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/jquery.js') }}"></script>

    <script>
        function validarSenhaForte(senha) {
            // Pelo menos 8 caracteres
            if (senha.length < 8) {
                return false;
            }
            // Pelo menos um número
            if (!/\d/.test(senha)) {
                return false;
            }
            // Pelo menos uma letra maiúscula
            if (!/[A-Z]/.test(senha)) {
                return false;
            }
            // Pelo menos uma letra minúscula
            if (!/[a-z]/.test(senha)) {
                return false;
            }
            // Pelo menos um caractere especial (não alfanumérico)
            if (!/[^a-zA-Z\d]/.test(senha)) {
                return false;
            }
            // Senha válida
            return true;
        }
        $('#formAuthentication').submit(function(e) {

            pass = $('#password').val() ?? "";
            if (!validarSenhaForte(pass)) {
                $('#password').focus();
                e.preventDefault();
                return false;
            }
        })

        function pinta() {

            const senhaInput = document.getElementById('password');
            const numeroLabel = document.getElementById('numeroLabel');
            const maiusculaLabel = document.getElementById('maiusculaLabel');
            const minusculaLabel = document.getElementById('minusculaLabel');
            const especialLabel = document.getElementById('especialLabel');
            const comprimentoLabel = document.getElementById('comprimentoLabel');
            const senha = senhaInput.value;

            // Pelo menos um número
            const regexNumero = /\d/;
            const temNumero = regexNumero.test(senha);

            // Pelo menos uma letra maiúscula
            const regexMaiuscula = /[A-Z]/;
            const temMaiuscula = regexMaiuscula.test(senha);

            const regexMinuscula = /[a-z]/;
            const temMinuscula = regexMinuscula.test(senha);

            // Pelo menos um caractere especial (não alfanumérico)
            const regexEspecial = /[^a-zA-Z\d]/;
            const temEspecial = regexEspecial.test(senha);

            const temComprimentoMinimo = senha.length >= 8;

            numeroLabel.textContent = temNumero ? 'Número ✅' : 'Número ❌';
            numeroLabel.style.color = temNumero ? 'green' : 'red';

            maiusculaLabel.textContent = temMaiuscula ? 'Maiúscula ✅' : 'Maiúscula ❌';
            maiusculaLabel.style.color = temMaiuscula ? 'green' : 'red';

            minusculaLabel.textContent = temMinuscula ? 'Minuscula ✅' : 'Minuscula ❌';
            minusculaLabel.style.color = temMinuscula ? 'green' : 'red';

            especialLabel.textContent = temEspecial ? 'Especial ✅' : 'Especial ❌';
            especialLabel.style.color = temEspecial ? 'green' : 'red';

            comprimentoLabel.textContent = temComprimentoMinimo ? '8 caracteres ✅' : '8 caracteres ❌';
            comprimentoLabel.style.color = temComprimentoMinimo ? 'green' : 'red';
        }
    </script>



    <script src="{{ asset('/js/popper.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/js/cleave.js') }}"></script>
    <script src="{{ asset('/js/cadastro.js') }}"></script>
    <script src="{{ asset('/js/mascaras.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script async defer src="{{ asset('/js/buttons.js') }}></script>
</body>

</html>
