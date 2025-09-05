@extends('layouts.defaultop')

@section('content')
    
    <form id="formAccountSettings" method="post" enctype="multipart/form-data" action="{{ route('documento.salvar') }}">
        @csrf
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Cadastro /</span> Documentos</h4>

        <div class="row">

            <div class="card mb-3">
                <h5 class="card-header">Detalhes do documento</h5>

                <div class="card-body">
                    <div class="row">

                        <div class="mb-2 col-md-12">
                            <label for="nome" class="form-label">Nome</label>
                            <input  class="form-control form-control-sm" type="hidden" name="id"
                                id="id" value="{{ @$documento->id }}" />
                            <input  class="form-control form-control-sm" type="text" name="nome"
                                id="nome" value="{{ @$documento->nome }}" />
                        </div>
                        <div class="mb-2 col-md-12">
                            <label for="sigla" class="form-label">Descrição</label>
                            <input  class="form-control form-control-sm" type="text" id="descricao"
                                name="descricao" value="{{ @$documento->descricao }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label class="form-label">Tipo de Candidato</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="pipeiro" {{@$documento->pessoa_fisica?'checked="true"':''}} name="pipeiro" value="pipeiro">
                                    <label class="form-check-label" for="pipeiro">Pipeiro</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="empresa" name="empresa" {{@$documento->pessoa_juridica?'checked="true"':''}} value="empresa">
                                    <label class="form-check-label" for="empresa">Empresa</label>
                                </div>
                            </div>
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
                                            Caso haja um modelo para download
                                        </td>
                                        <td>
                                            @if (@!$documento->link)
                                                <input class="form-control form-control-sm" type="file"
                                                    accept="application/pdf" id="link"
                                                    name="link"
                                                    value="{{ @$documento->link }}" />
                                            @endif
                                        </td>
                                        @if (@$documento->link)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$documento->link") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-outline-danger remover"
                                                    data-arquivo="documento"
                                                    data-nome="arquivo"><i
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
                    $.post('{{ route('documento.deletarArquivo') }}', {
                        id: {{ @$documento->id ?? '0' }},
                    }).done(function(response) {
                        location.reload();
                    });
                }
            });
        </script>
    @endsection
