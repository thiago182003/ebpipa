@extends('layouts.defaultop');

@section('content')
    @include('componentes.mensagem')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light"> Cadastro /</span> Operadores
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-2 col-md-3">
                    <input id="pesquisa" name='pesquisa' class="form-control form-control-sm" value="" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    {{-- <h5 class="card-header">Credenciamentos para análise</h5> --}}
                    <div class="card-body">
                        <div class="card-body">
                            {{-- <form id="formAccountSettings" method="post" action="{{ route('pipeiro.salvar') }}"> --}}
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <table id="tb-analise" class="table table-sm table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="col">Nome</th>
                                                <th class="col-2">om</th>
                                                <th class="col-1">Editar</th>
                                                <th class="col-1">Senha</th>
                                                <th class="col-1">Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($operadores as $op)
                                                <tr>
                                                    <td>{{ @$op->nome }}</td>
                                                    <td>{{ @$op->om->sigla }}</td>
                                                    <td>
                                                        <a href="{{ route('op.editar', @$op->id) }}"
                                                            class="btn btn-sm btn-icon btn-outline-primary">
                                                            <span class="tf-icons bx bx-edit"></span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button data-nome={{ $op->nome }} data-id={{ $op->id }}
                                                            class="btn btn-sm btn-icon btn-outline-primary resetar">
                                                            <span class="tf-icons bx bxs-key"></span>
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button data-id={{ @$op->id }} data-nome="{{ @$op->nome }}"
                                                            class="btn btn-sm btn-icon btn-outline-danger remover">
                                                            <i class='bx bx-x'></i>
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
                        <a href="{{ route('op.novo') }}" type="submit" class="btn btn-success btn-novo-now"><i
                                class='bx bx-plus'></i>
                            Novo</a>
                    </div>
                </div>
            </div>


        </div>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script>
            $(".resetar").on("click", function(e) {
                e.preventDefault();

                if (confirm('Deseja resetar a senha de ' + $(this).data('nome'))) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.post('{{ route('op.resetarsenha') }}', {
                        id: $(this).data('id'),
                    }).done(function(response) {
                        alert("senha resetada com sucesso.")
                        location.reload();
                    });
                }
            });

            $("#pesquisa").keyup(function(key) {
                let b = $("#pesquisa").val();
                pesquisaTabela("tb-analise", b);
            });

            function pesquisaTabela(nomeTabela, pesquisa) {
                $('#' + nomeTabela + ' tbody').find('tr').each(function(indexTr, valueTr) {
                    $(this).find('td').each(function(indexTd, valueTd) {
                        if (indexTd === 0) {
                            if ($(valueTd).html().search(new RegExp(pesquisa, "i")) === -1) {
                                $(valueTd).parent().hide();
                            } else {
                                $(valueTd).parent().show();
                            }
                        }
                    });
                });
            }

 //           $(".remover").on("click", function(e) {
 //               e.preventDefault();
 //               if (confirm('Deseja remover o ' + $(this).data('nome'))) {
 //                   $.ajaxSetup({
 //                       headers: {
 //                           'X-CSRF-TOKEN': '{{ csrf_token() }}'
 //                       }
 //                   });
 //                   $.post('{{ route('op.deletar') }}', {
 //                       id: $(this).data('id'),
 //                   }).done(function(response) {
 //                       location.reload();
 //                   });



 //               }


 //            });
        </script>
    @endsection
