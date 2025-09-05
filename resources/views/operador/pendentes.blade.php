@extends('layouts.defaultop')

@section('content')
    @include('componentes.mensagem')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Credenciamentos Pendentes
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-2 col-md-3">
                    <input  id="pesquisa" name='pesquisa' class="form-control form-control-sm"
                        value="" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">Pipeiros sem Credenciamentos</h5>
                    <div class="card-body">
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <table id="tb-analise" class="table table-sm table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="col-1">Inscrição</th>
                                                <th class="col-2">CPF</th>
                                                <th>Nome</th>
                                                <th class="col-1">Resetar senha</th>
                                                {{-- <th class="col-1">Aprovar</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pipeiros as $pip)
                                                <tr>
                                                    
                                                    <td>{{ @$pip->id }}</td>
                                                    <td>{{ @$pip->cpf }}</td>
                                                    <td>{{ @$pip->nome }}</td>
                                                    
                                                    <td>
                                                        <button class="btn btn-sm btn-icon btn-outline-info resetar" data-tipo=1 data-id="{{@$pip->id}}" data-nome="{{ @$pip->nome }}">
                                                            <span class="tf-icons bx bx-key"></span>
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

                </div>
            </div>
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">Empresas sem Credenciamentos</h5>
                    <div class="card-body">
                        <div class="card-body">
                            {{-- <form id="formAccountSettings" method="post" action="{{ route('pipeiro.salvar') }}"> --}}
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <table id="tb-analise" class="table table-sm table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="col-1">Inscrição</th>
                                                <th class="col-2">CPF/CNPJ</th>
                                                <th>Nome</th>
                                                <th class="col-1">Resetar senha</th>
                                                {{-- <th class="col-1">Aprovar</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($empresas as $emp)
                                                <tr>
                                                    <td>{{ @$emp->id }}</td>
                                                    <td>{{ @$emp->cnpj }}</td>
                                                    <td>{{ @$emp->razaosocial }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-icon btn-outline-info resetar" data-tipo=2 data-id="{{@$emp->id}}" data-nome="{{ @$emp->razaosocial }}">
                                                            <span class="tf-icons bx bx-key"></span>
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

                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">Credenciamentos incompletos</h5>
                    <div class="card-body">
                        <div class="card-body">
                            {{-- <form id="formAccountSettings" method="post" action="{{ route('pipeiro.salvar') }}"> --}}
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <table id="tb-analise" class="table table-sm table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="col-1">Inscrição</th>
                                                <th class="col-2">CPF/CNPJ</th>
                                                <th>Nome</th>
                                                <th class="col-1">Resetar senha</th>
                                                <th class="col-1">Ver</th>
                                                {{-- <th class="col-1">Aprovar</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($creds as $cred)
                                                <tr>
                                                    {{-- {{ dd($cred) }} --}}
                                                    @if (!is_null($cred->id_pipeiro))
                                                        <td>{{ @$cred->pipeiro->id }}</td>
                                                        <td>{{ @$cred->pipeiro->cpf }}</td>
                                                        <td>{{ @$cred->pipeiro->nome }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-icon btn-outline-info resetar" data-tipo=1 data-id="{{@$cred->pipeiro->id}}" data-nome="{{ @$cred->pipeiro->nome }}">
                                                                <span class="tf-icons bx bx-key"></span>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td>{{ @$cred->empresa->id }}</td>
                                                        <td>{{ @$cred->empresa->cnpj }}</td>
                                                        <td>{{ @$cred->empresa->razaosocial }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-icon btn-outline-info resetar" data-tipo=2 data-id="{{@$cred->empresa->id}}" data-nome="{{ @$cred->empresa->razaosocial }}">
                                                                <span class="tf-icons bx bx-key"></span>
                                                            </button>
                                                        </td>
                                                    @endif
                                                    
                                                    <td>
                                                        <a href="{{ route('operador.cred', @$cred->id) }}"
                                                            class="btn btn-sm btn-icon btn-outline-primary">
                                                            <span class="tf-icons bx bx-edit"></span>
                                                        </a>
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

                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script>
            $(".resetar").on("click", function(e) {
                e.preventDefault();
                if (confirm('Deseja resetar a senha de ' + $(this).data('nome'))) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        }
                    });
                    $.post('{{ route('credenciamento.resetarsenha') }}', {
                        id: $(this).data('id'),
                        tipo: $(this).data('tipo'),
                    }).done(function(response) {
                        alert("senha alterada com sucesso.");
                    });
                }
            });

            $("#pesquisa").keyup(function(key){
                let b = $("#pesquisa").val();
                pesquisaTabela("tb-analise",b);
                pesquisaTabela("tb-correcao",b);
                pesquisaTabela("tb-aprovados",b);
            });

            function pesquisaTabela(nomeTabela, pesquisa){
                pesquisa = pesquisa.toLowerCase();
                $('#'+nomeTabela+' tbody').find('tr').each(function (indexTr, valueTr) {
                    $(this).find('td').each(function (indexTd, valueTd) {
                        if (indexTd === 2) {
                            if ($(valueTd).html().toLowerCase().indexOf(pesquisa) === -1) {
                                $(valueTd).parent().hide();
                            } else {
                                $(valueTd).parent().show();
                            }
                        }
                    });
                });
            }

        </script>
    @endsection
