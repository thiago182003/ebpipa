@extends('layouts.defaultop')

@section('content')
    
    <form id="formAccountSettings" method="post" action="{{ route('om.salvar') }}">
        @csrf
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Cadastro /</span> OM</h4>

        <div class="row">

            <div class="card mb-3">
                <h5 class="card-header">Detalhes do Perfil</h5>

                <div class="card-body">
                    <div class="row">

                        <div class="mb-2 col-md-6">
                            <label for="nome" class="form-label">Nome</label>
                            <input  class="form-control form-control-sm" type="hidden" name="id"
                                id="id" value="{{ @$om->id }}" />
                            <input  class="form-control form-control-sm" type="text" name="nome"
                                id="nome" value="{{ @$om->nome }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="sigla" class="form-label">Sigla</label>
                            <input  class="form-control form-control-sm" type="text" id="sigla"
                                name="sigla" value="{{ @$om->sigla }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="om_pai" class="form-label">Subordinação</label>
                            <select  id="id_om" name='id_om'
                                class="select2 form-select form-select-sm">
                                <option value="">Selecione...</option>
                                @foreach ($oms as $m)
                                    <option {{ $m->id == @$om->id_om ? 'selected' : '' }}
                                        value={{ $m->id }}>{{ $m->nome }}</option>
                                @endforeach
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
        <script>

        </script>
    @endsection
