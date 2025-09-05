@extends('layouts.defaultemp')
@push('styles')
    <link rel="stylesheet" href="{{ asset('/css/jquery.dataTables.min.css') }}" />
@endpush
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('componentes.mensagem')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Cadastro /</span> Credenciamentos
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <table id="tb-analise" class="table table-sm table-bordered">
                                        <thead>
                                            <tr> 
                                                <th class="col-1">Numero</th>
                                                <th class="col">Edital</th>
                                                <th class="col-2">Om</th>
                                                <th class="col-2">Status</th>
                                                <th class="col-1">Enviar</th>
                                                <th class="col-1">Editar</th>
                                                <th class="col-1">Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($creds as $c)
                                                <tr>
                                                    <td>{{ @$c->id }}</td>
                                                    <td>{{ @$c->edital->nome }}</td>
                                                    <td>{{ @$c->om->sigla }}</td>
                                                    @if(@$c->status == "Corrigido")
                                                        <td ><span class="badge bg-label-primary me-2">{{ @$c->status }}</span></td>
                                                    @elseif(@$c->status == "Aguardando Envio")
                                                        <td ><span class="badge bg-label-warning me-2">{{ @$c->status }}</span></td>
                                                    @elseif(@$c->status == "Em Correção")
                                                        <td ><span class="badge bg-label-danger me-2">{{ @$c->status }}</span></td>
                                                    @elseif(@$c->status == "Documentação Aprovada")
                                                        <td ><span class="badge bg-label-success me-2">{{ @$c->status }}</span></td>
                                                    @else
                                                        <td><span class="badge bg-label-secondary me-2">{{ @$c->status }}</span></td>
                                                    @endif
                                                    <td>
                                                        <button data-status="{{@$c->status}}" data-id="{{@$c->id}}" data-nome="{{$c}}"
                                                            class="btn btn-sm btn-icon btn-outline-success enviar">
                                                            <span class="tf-icons bx bx-send"></span>
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('empresa.credenciamento', ['id'=>@$c->id]) }}"
                                                            class="btn btn-sm btn-icon btn-outline-primary">
                                                            <span class="tf-icons bx bx-edit"></span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('empresa.credenciamento', @$c->id) }}"
                                                            class="btn btn-sm btn-icon btn-outline-danger">
                                                            <span class="tf-icons bx bx-x"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 save-now">
                        <a href="{{ route('empresa.novocredenciamento')}}" type="submit" class="btn btn-success btn-novo-now"><i class='bx bx-plus'></i>
                            Novo</a>
                    </div>
                </div>
            </div>


        </div>
        @push('scripts')
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>     
        <script>
            $(".remover").on("click", function(e) {
                e.preventDefault();
                let id = $(this).data("id");
                let status = $(this).data("status");
                if (["Em Correção", "Corrigido", "Documentação aprovada", "Para Análise"].includes(status)) {
                    alert("Esse credenciamento não pode ser excluído. Falar com a administração.");
                    return false;
                }
                if (confirm(`Deseja remover o ${$(this).data('nome')}?`)) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post('/credenciamento/deletarcredenciamento', { id: id }).done(function () {
                        location.reload();
                    });
                }
            });

            

            $(".enviar").on("click", function(e) {
                e.preventDefault();
                let id = $(this).data("id");
                let status = $(this).data("status");
                if (["Para Análise", "Em correção", "Corrigido", "Documentação Aprovada"].includes(status)) {
                        alert(`A documentação está com status: ${status}.`);
                        return false;
                }
                if (confirm('Deseja enviar o credenciamento para análise?')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post('{{ route('empresa.enviarCredenciamento') }}', {
                        id: id,
                    }).done(function(response) {
                        resposta = "Precisa preencher os campos:";
                        if(response !== ""){
                            response.forEach(e => {
                                resposta += "\n" + e;
                            });
                            alert(resposta);
                        }else{
                            location.reload();
                        }
                    });
                }
            });

            $('#tb-analise').DataTable({
                paging: true, // Habilita paginação
                pageLength: 20, // Define o número de registros por página
                lengthChange: false, // Oculta a opção de alterar a quantidade de registros por página
                ordering: true, // Permite ordenar colunas
                language: {
                    url: languageUrl 
                }
            });
        </script>
        @endpush
    @endsection
