@extends('layouts.defaultop')

@section('content')
    
    <form id="formAccountSettings" enctype="multipart/form-data" method="post" action="{{ route('anexos.salvar') }}">
        @csrf
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Cadastro /</span> Anexos</h4>

        <div class="row">

            <div class="card mb-3">
                <h5 class="card-header">Anexos</h5>

                <div class="card-body">
                    <div class="row">
                            
                        <div class="mb-2 col-md-12">
                            <table class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Documento</th>
                                        <th class="col">Upload</th>
                                        <th class="col-1">Ver</th>
                                        <th class="col-1">Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Requerimento de Credenciamento
                                        </td>
                                        <td>
                                            @if (@!$anexos->requerimento_credenciamento)
                                                <input class="form-control form-control-sm" type="file"
                                                    id="requerimento_credenciamento"
                                                    name="requerimento_credenciamento"
                                                    value="{{ @$anexos->requerimento_credenciamento }}" />
                                            @endif
                                        </td>
                                        @if (@$anexos->requerimento_credenciamento)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$anexos->requerimento_credenciamento") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-outline-danger remover"
                                                    data-arquivo="requerimento_credenciamento"
                                                    data-nome="edital"><i
                                                        class='bx bx-x'></i>
                                                </button>
                                            </td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            Declaração de Conhecimento das Informações para Cumprimento das Obrigações
                                        </td>
                                        <td>
                                            @if (@!$anexos->conhecimento_das_informacoes)
                                                <input class="form-control form-control-sm" type="file"
                                                    id="conhecimento_das_informacoes"
                                                    name="conhecimento_das_informacoes"
                                                    value="{{ @$anexos->conhecimento_das_informacoes }}" />
                                            @endif
                                        </td>
                                        @if (@$anexos->conhecimento_das_informacoes)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$anexos->conhecimento_das_informacoes") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-outline-danger remover"
                                                    data-arquivo="conhecimento_das_informacoes"
                                                    data-nome="edital"><i
                                                        class='bx bx-x'></i>
                                                </button>
                                            </td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            Termo de Declaração e Responsabilidade das condições de trafegabilidade do Veículo a ser credenciado
                                        </td>
                                        <td>
                                            @if (@!$anexos->condicao_do_veiculo)
                                                <input class="form-control form-control-sm" type="file"
                                                    id="condicao_do_veiculo"
                                                    name="condicao_do_veiculo"
                                                    value="{{ @$anexos->condicao_do_veiculo }}" />
                                            @endif
                                        </td>
                                        @if (@$anexos->condicao_do_veiculo)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$anexos->condicao_do_veiculo") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-outline-danger remover"
                                                    data-arquivo="condicao_do_veiculo"
                                                    data-nome="edital"><i
                                                        class='bx bx-x'></i>
                                                </button>
                                            </td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            Modelo de autorização para exposição de dados
                                        </td>
                                        <td>
                                            @if (@!$anexos->exposicao_dados)
                                                <input class="form-control form-control-sm" type="file"
                                                    id="exposicao_dados"
                                                    name="exposicao_dados"
                                                    value="{{ @$anexos->exposicao_dados }}" />
                                            @endif
                                        </td>
                                        @if (@$anexos->exposicao_dados)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$anexos->exposicao_dados") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-outline-danger remover"
                                                    data-arquivo="exposicao_dados"
                                                    data-nome="edital"><i
                                                        class='bx bx-x'></i>
                                                </button>
                                            </td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            Declaração de trabalho de menor
                                        </td>
                                        <td>
                                            @if (@!$anexos->trabalho_de_menor)
                                                <input class="form-control form-control-sm" type="file"
                                                    id="trabalho_de_menor"
                                                    name="trabalho_de_menor"
                                                    value="{{ @$anexos->trabalho_de_menor }}" />
                                            @endif
                                        </td>
                                        @if (@$anexos->trabalho_de_menor)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$anexos->trabalho_de_menor") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-outline-danger remover"
                                                    data-arquivo="trabalho_de_menor"
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
                    $.post('{{ route('anexo.deletarArquivo') }}', {
                        arquivo: $(this).data('arquivo'),
                    }).done(function(response) {
                        location.reload();
                    });
                }
            });

            const allowedMimeTypes = [
                'application/msword', 
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 
                'application/vnd.oasis.opendocument.text',
                'application/vnd.oasis.opendocument.text-template',
                'application/rtf',
                'text/plain',
            ];

            $('input[type="file"]').on('change', function(event) {
                const file = event.target.files[0];
                if (file && !allowedMimeTypes.includes(file.type)) {
                    alert('Formato de arquivo não permitido!');
                    $(this).val(''); // Limpa o campo de upload
                }
            });
        </script>
    @endsection
