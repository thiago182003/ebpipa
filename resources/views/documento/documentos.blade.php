@extends('layouts.defaultop');

@section('content')
    @include('componentes.mensagem')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">    Cadastro /</span> Documentos
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">Documentos</h5>
                    <div class="card-body">
                        <div class="card-body">
                            {{-- <form id="formAccountSettings" method="post" action="{{ route('pipeiro.salvar') }}"> --}}
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <table id="tb-analise" class="table table-sm table-bordered">
                                        <thead>
                                            <tr> 
                                                <th class="col-3">Nome</th>
                                                <th class="col">Descrição</th>
                                                <th class="col-1">Ver</th>
                                                <th class="col-1">Editar</th>
                                                <th class="col-1">Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($docs as $documento)
                                                
                                                <tr>
                                            
                                                    <td>{{ @$documento->nome }}</td>
                                                    <td>{{ @$documento->descricao }}</td>
                                                    <td>
                                                        @if($documento->link)
                                                            <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                                href="{{ url("storage/$documento->link") }}">
                                                                <i class='bx bx-file'></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('documento.editar', @$documento->id) }}"
                                                            class="btn btn-sm btn-icon btn-outline-primary">
                                                            <span class="tf-icons bx bx-edit"></span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-icon btn-outline-danger remover"
                                                            data-arquivo="documento"
                                                            data-nome="arquivo"><i
                                                                class='bx bx-x'></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- </form> --}}
                        </div>
                        <!-- /Account -->
                    </div>
                    <div class="mt-2 save-now">
                        <a href="{{ route('documento.novo')}}" type="submit" class="btn btn-success btn-novo-now"><i class='bx bx-plus'></i>
                            Novo</a>
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
                    $.post('{{ route('documento.deletarDocumento') }}', {
                        id: {{ @$documento->id ?? '0' }},
                    }).done(function(response) {
                        location.reload();
                    });
                }
            });

        </script>
    @endsection
