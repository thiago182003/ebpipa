@extends('layouts.defaultop')

@section('content')
    
    <form id="formAccountSettings" method="post" action="{{ route('municipio.salvar') }}">
        @csrf
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Cadastro /</span> Municipio</h4>

        <div class="row">

            <div class="card mb-3">
                <h5 class="card-header">Detalhes do Municipio</h5>

                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label for="nome" class="form-label">Nome</label>
                            <input  class="form-control form-control-sm" type="hidden" name="id"
                                id="id" value="{{ @$municipio->id }}" />
                            <input  class="form-control form-control-sm" type="text" name="nome"
                                id="nome" value="{{ @$municipio->nome }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="sigla" class="form-label">Estado</label>
                            <select  id="id_estado" name='id_estado'
                                class="select2 form-select form-select-sm">
                                <option value="">Selecione...</option>
                                @foreach ($estados as $e)
                                    <option {{ $e->id == @$municipio->id_estado ? 'selected' : '' }}
                                        value={{ $e->id }}>{{ $e->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="om_pai" class="form-label">OM</label>
                            <select  id="id_om" name='id_om'
                                class="select2 form-select form-select-sm">
                                <option value="">Selecione...</option>
                                @foreach ($oms as $m)
                                    <option {{ $m->id == @$municipio->id_om ? 'selected' : '' }}
                                        value={{ $m->id }}>{{ $m->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2 col-md-3">
                            <label for="om_pai" class="form-label">Status</label>
                            <select  id="status" name='status'
                                class="select2 form-select form-select-sm">
                                <option value="">Selecione...</option>
                                <option value="1" {{@$municipio->status == "1"?'selected':''}}>Ativo</option>
                                <option value="2" {{@$municipio->status == "2"?'selected':''}}>Inativo</option>
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
