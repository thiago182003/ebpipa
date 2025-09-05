@extends('layouts.defaultop')

@section('content')
    
    <form id="formAccountSettings" method="post" action="{{ route('op.alterarsenha') }}">
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
                        <div class="mb-2 col-md-4">
                            <label for="senhaantiga" class="form-label">senha antiga</label>
                            <input  class="form-control form-control-sm" type="password" name="senhaantiga"
                                id="senhaantiga" value="" />
                        </div>
                        <div class="mb-2 col-md-4">
                            <label for="novasenha" class="form-label">nova senha</label>
                            <input  class="form-control form-control-sm" type="password" name="novasenha"
                                id="novasenha" value="" />
                        </div>
                        <div class="mb-2 col-md-4">
                            <label for="senhaconfirma" class="form-label">Repita a nova senha</label>
                            <input  class="form-control form-control-sm" type="password" name="senhaconfirma"
                                id="senhaconfirma" value="" />
                        </div>
                        
                    </div>
                    <div class="mt-2 save-now">
                        <button type="submit" class="btn btn-primary btn-save-now"><i class='bx bx-save'></i>
                            Salvar</button>
                    </div>
                </div>
            </div>
        
        </div>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script>
        </script>
    @endsection
