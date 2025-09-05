@extends('layouts.defaultop')
@push('styles')
    <link rel="stylesheet" href="{{ asset('/css/jquery.dataTables.min.css') }}" />
@endpush
@section('content')
    @include('componentes.mensagem')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Credenciamentos PF
        </h4>
        <div class="row">
            @foreach (['analise' => $credsAnalise, 'corrigidos' => $credsCorrigidos, 'correcao' => $credsCorrecao, 'aprovados' => $credsAprovados] as $titulo => $creds)
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">{{ ucfirst($titulo) }}</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb-{{ $titulo }}" class="table table-sm table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-2">Data</th>
                                        <th class="col-1">Inscrição</th>
                                        <th>CPF</th>
                                        <th>Nome</th>
                                        <th class="col-1">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($creds as $cred)
                                        <tr>
                                            <td>{{ $cred->data_envio ?? '' }}</td>
                                            <td>{{ $cred->pipeiro->id ?? '' }}</td>
                                            <td>{{ $cred->pipeiro->cpf ?? '' }}</td>
                                            <td>{{ $cred->pipeiro->nome ?? '' }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ url('op/cred/'.$cred->id) }}" class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Analisar Credenciamento">
                                                        <span class="tf-icons bx bx-edit"></span>
                                                    </a>
                                                    <span class="mx-1">|</span>
                                                    {{-- Divisão entre botões --}}
                                                    @if($cred->status == 3 || $cred->status == 4)
                                                        <div class="border-start px-1">
                                                            <a href="{{ route('operador.aprovar', $cred->id) }}" 
                                                                class="btn btn-sm btn-icon btn-outline-success" 
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Aprovar Credenciamento">
                                                                <span class="tf-icons bx bx-check"></span>
                                                            </a>
                                                        </div>
                                                        <span class="mx-1">|</span>
                                                    @endif
                                                
                                                    <div class="border-start px-1">
                                                        <a href="#" class="btn btn-sm btn-icon btn-outline-info resetar" data-bs-toggle="tooltip" data-bs-placement="top" data-id="{{ $cred->pipeiro->id }}" data-nome="{{ $cred->pipeiro->nome }}" title="Resetar Senha">
                                                            <span class="tf-icons bx bx-key"></span>
                                                        </a>
                                                    </div>

                                                    <div class="border-start px-1">
                                                        <a href="#" class="btn btn-sm btn-icon btn-outline-danger descredenciar" data-bs-toggle="tooltip" data-bs-placement="top" data-id="{{ $cred->id }}" data-nome="{{ $cred->pipeiro->nome }}" title="Descredenciar">
                                                            <span class="tf-icons bx bx-x"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        @push('scripts')
            <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                        new bootstrap.Tooltip(tooltipTriggerEl)
                    })
                });


                $(document).ready(function() {
                    $('#tb-analise').DataTable({
                        paging: true, // Habilita paginação
                        pageLength: 20, // Define o número de registros por página
                        lengthChange: false, // Oculta a opção de alterar a quantidade de registros por página
                        ordering: true, // Permite ordenar colunas
                        language: {
                            url: "{{ asset('/json/Portuguese-Brasil.json') }}" 
                        }
                    });
                    
                    $('#tb-corrigidos').DataTable({
                        paging: true, // Habilita paginação
                        pageLength: 20, // Define o número de registros por página
                        lengthChange: false, // Oculta a opção de alterar a quantidade de registros por página
                        ordering: true, // Permite ordenar colunas
                        language: {
                            url: "{{ asset('/json/Portuguese-Brasil.json') }}" 
                        }
                    });

                    $('#tb-correcao').DataTable({
                        paging: true, // Habilita paginação
                        pageLength: 20, // Define o número de registros por página
                        lengthChange: false, // Oculta a opção de alterar a quantidade de registros por página
                        ordering: true, // Permite ordenar colunas
                        language: {
                            url: "{{ asset('/json/Portuguese-Brasil.json') }}" 
                        }
                    });
                    
                    $('#tb-aprovados').DataTable({
                        paging: true,
                        pageLength: 20,
                        lengthChange: false,
                        ordering: true,
                        language: {
                            url: "{{ asset('/json/Portuguese-Brasil.json') }}" 
                        }
                    });
                });

                $(".resetar").on("click", function(e) {
                    e.preventDefault();
                    if (confirm('Deseja resetar a senha de ' + $(this).data('nome'))) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': '{{csrf_token()}}'
                            }
                        });
                        $.post('{{ route('credenciamento.resetarsenha') }}', {
                            id: $(this).data('id'),
                            tipo: 1,
                        }).done(function(response) {
                            alert("senha alterada com sucesso.");
                        });
                    }
                });


                $(".descredenciar").on("click", function(e) {
                    e.preventDefault();
                    if (confirm('Deseja descredenciar ' + $(this).data('nome'))) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': '{{csrf_token()}}'
                            }
                        });
                        $.post('{{ route('credenciamento.descredenciar') }}', {
                            id: $(this).data('id'),
                        }).done(function(response) {
                            alert("descredenciado");
                            location.reload();
                        }).fail(function(error){
                            alert(error);
                        });
                    }
                });
            </script>
        @endpush
    @endsection