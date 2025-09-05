@extends('layouts.default')

@section('content')
    
    <form id="formAuthentication" method="post" action="{{ route('pipeiro.alterarsenha') }}">
        @csrf
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Alterar Senha</h4>

        <div class="row">

            @if (session('status'))
                <div>{{ session('status') }}</div>
            @endif
        
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card mb-3">
                <h5 class="card-header">Alterar senha</h5>

                <div class="card-body">
                    <div class="row">
                        {{-- <div class="mb-2 col-md-4">
                            <label for="senhaantiga" class="form-label">senha antiga</label>
                            <input  class="form-control form-control-sm" type="password" name="senhaantiga"
                                id="senhaantiga" autofocus  />
                        </div> --}}
                        <div class="mb-2 col-md-4">
                            <label for="novasenha" class="form-label">nova senha</label>
                            <input  class="form-control form-control-sm" type="password" onkeyup="pinta()" name="novasenha"
                                id="novasenha" value="" autofocus required/>
                        </div>
                        <div class="mb-2 col-md-4">
                            <label for="senhaconfirma" class="form-label">Repita a nova senha</label>
                            <input  class="form-control form-control-sm" type="password" name="senhaconfirma"
                                id="senhaconfirma" value="" required/>
                        </div>
                        
                    </div>
                    <div class="mt-2 save-now">
                        <button type="submit" class="btn btn-primary btn-save-now"><i class='bx bx-save'></i>
                            Salvar</button>
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
                </div>
            </div>
        
        </div>
        <script src="{{ asset('js/jquery.js') }}"></script>
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

            pass = $('#novasenha').val() ?? "";
            if (!validarSenhaForte(pass)) {
                $('#novasenha').focus();
                e.preventDefault();
                return false;
            }else if($('#novasenha').val() != $('#senhaconfirma').val()){
                $('#senhaconfirma').focus();
                alert("As senha devem ser iguais");
                e.preventDefault();
                return false;
            }
        })

        function pinta() {

            const senhaInput = document.getElementById('novasenha');
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
    @endsection
