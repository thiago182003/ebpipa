@extends('layouts.defaultop')

@section('content')
    
    <form id="formAccountSettings" enctype="multipart/form-data" method="post" action="{{ route('edital.salvar') }}">
        @csrf
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Cadastro /</span> Edital</h4>

        <div class="row">

            <div class="card mb-3">
                <h5 class="card-header">Detalhes do Edital</h5>

                <div class="card-body">
                    <div class="row">

                        <div class="mb-2 col-md-6">
                            <label for="nome" class="form-label">Nome</label>
                            <input  class="form-control form-control-sm" type="hidden" name="id"
                                id="id" value="{{ @$edital->id }}" />
                            <input  class="form-control form-control-sm" type="text" name="nome"
                                id="nome" value="{{ @$edital->nome }}" />
                        </div>
                        
                        <div class="mb-2 col-md-6">
                            <label for="om_pai" class="form-label">Om</label>
                            <select  id="id_om" name='id_om'
                                class="select2 form-select form-select-sm">
                                <option value="">Selecione...</option>
                                @foreach ($oms as $m)
                                    <option {{ $m->id == @$edital->id_om ? 'selected' : '' }}
                                        value={{ $m->id }}>{{ $m->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-2 col-md-12">
                            <table class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Documento</th>
                                        <th class="col-4">Upload</th>
                                        <th class="col-1">Ver</th>
                                        <th class="col-1">Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            PDF do Edital
                                        </td>
                                        <td>
                                            @if (@!$edital->documento)
                                                <input class="form-control form-control-sm" type="file"
                                                    accept="application/pdf" id="documento"
                                                    name="documento"
                                                    value="{{ @$edital->documento }}" />
                                            @endif
                                        </td>
                                        @if (@$edital->documento)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$edital->documento") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-outline-danger remover"
                                                    data-arquivo="documento"
                                                    data-nome="edital"><i
                                                        class='bx bx-x'></i>
                                                </button>
                                            </td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mb-2 col-md-4">
                            <label for="om_pai" class="form-label">Status</label>
                            <select  id="status" name='status'
                                class="select2 form-select form-select-sm">
                                <option value="">Selecione...</option>
                                <option value="1">Ativo</option>
                                <option value="2">Inativo</option>
                            </select>
                        </div>

                        {{-- <div class="mb-2 col-md-4">
                            <label for="nome" class="form-label">Inicio do 1º Quadrimestre</label>
                            <input  class="form-control form-control-sm" type="date" name="dtini1quad"
                                id="dtini1quad" value="{{ @$edital->dtini1quad }}" />
                        </div>

                        <div class="mb-2 col-md-4">
                            <label for="nome" class="form-label">Fim do 1º Quadrimestre</label>
                            <input  class="form-control form-control-sm" type="date" name="dtfim1quad"
                                id="dtfim1quad" value="{{ @$edital->dtfim1quad }}" />
                        </div>

                        <div class="mb-2 col-md-4">
                            <label for="nome" class="form-label">Inicio do 2º Quadrimestre</label>
                            <input  class="form-control form-control-sm" type="date" name="dtini2quad"
                                id="dtini2quad" value="{{ @$edital->dtini2quad }}" />
                        </div>

                        <div class="mb-2 col-md-4">
                            <label for="nome" class="form-label">Fim do 2º Quadrimestre</label>
                            <input  class="form-control form-control-sm" type="date" name="dtfim2quad"
                                id="dtfim2quad" value="{{ @$edital->dtfim2quad }}" />
                        </div>

                        <div class="mb-2 col-md-4">
                            <label for="nome" class="form-label">Inicio do 3º Quadrimestre</label>
                            <input  class="form-control form-control-sm" type="date" name="dtini3quad"
                                id="dtini3quad" value="{{ @$edital->dtini3quad }}" />
                        </div>

                        <div class="mb-2 col-md-4">
                            <label for="nome" class="form-label">Fim do 3º Quadrimestre</label>
                            <input  class="form-control form-control-sm" type="date" name="dtfim3quad"
                                id="dtfim3quad" value="{{ @$edital->dtfim3quad }}" />
                        </div> --}}
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
            $(".remover").on("click", function(e) {
                e.preventDefault();
                if (confirm('Deseja remover o ' + $(this).data('nome'))) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        }
                    });
                    $.post('{{ route('edital.deletarArquivo') }}', {
                        id: {{ @$edital->id ?? '0' }},
                    }).done(function(response) {
                        location.reload();
                    });
                }
            });
        </script>
    @endsection
