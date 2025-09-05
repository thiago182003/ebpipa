@extends('layouts.defaultop')

@section('content')
    
    <form id="formAccountSettings" method="post" action="{{ route('op.salvar') }}">
        @csrf
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Cadastro /</span> Operador</h4>

        <div class="row">

            <div class="card mb-3">
                <h5 class="card-header">Detalhes do Perfil</h5>

                <div class="card-body">
                    <div class="row">

                        <div class="mb-2 col-md-6">
                            <label for="nome" class="form-label">Nome</label>
                            <input  class="form-control form-control-sm" type="hidden" name="id"
                                id="id" value="{{ @$op->id }}" required />
                            <input  class="form-control form-control-sm" type="text" name="nome"
                                id="nome" value="{{ @$op->nome }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="nomeguerra" class="form-label">Nome de Guerra</label>
                            <input  class="form-control form-control-sm" type="text" id="nomeguerra"
                                name="nomeguerra" value="{{ @$op->nomeguerra }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input  class="form-control form-control-sm" type="text" id="cpf"
                                name="cpf" value="{{ @$op->cpf }}" />
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="om_pai" class="form-label">OM</label>
                            <select  id="id_om" name='id_om'
                                class="select2 form-select form-select-sm">
                                <option value="">Selecione...</option>
                                @foreach ($oms as $m)
                                    <option {{ $m->id == @$op->id_om ? 'selected' : '' }}
                                        value={{ $m->id }}>{{ $m->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="email" class="form-label">Email</label>
                            <input  class="form-control form-control-sm" type="text" id="email"
                                name="email" value="{{ @$op->email }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="om_pai" class="form-label">Posto/Grad</label>
                            <select  id="id_pg" name='id_pg'
                                class="select2 form-select form-select-sm">
                                <option value="">Selecione...</option>
                                @foreach ($pgs as $pg)
                                    <option {{ $pg->id == @$op->id_pg ? 'selected' : '' }}
                                        value={{ $pg->id }}>{{ $pg->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="om_pai" class="form-label">nivel</label>
                            <select id="nivel" name='nivel'
                                class="select2 form-select form-select-sm">
                                <option value="">Selecione...</option>
                                <option {{@$op->nivel == 0?'selected':''}} value="0">administrador geral</option>
                                <option {{@$op->nivel == 1?'selected':''}} value="1">administrador om</option>
                                <option {{@$op->nivel == 2?'selected':''}} value="2">operador</option>
                            </select>
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
    @endsection
