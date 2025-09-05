@extends('layouts.defaultop')

@section('content')
    @include('componentes.mensagem')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Credenciamentos Pendentes
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">Buscar Pipeiros</h5>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" id="buscar">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-2 col-md-5">
                                            <input id="pesquisa" name='pesquisa' class="form-control form-control-sm"
                                                placeholder="digite o cpf ou o nome" autofocus />
                                        </div>
                                        <div class="mb-2 col-md-2">
                                            <button type="submit"
                                                class="form-control btn btn-primary btn-sm">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <table id="tb-analise" class="table table-sm table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="col-2">CPF</th>
                                                <th>Nome</th>
                                                <th class="col-1">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-detalhes" tabindex="-1" aria-labelledby="modal-detalhes-label"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-detalhes-label">Detalhes do Pipeiro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Os detalhes do pipeiro serão carregados aqui via AJAX -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script>
            $("#buscar").submit(function(e) {
                e.preventDefault();
                let pesquisa = $('#pesquisa').val().trim(); // Remove espaços em branco

                if (!pesquisa) {
                    $('#pesquisa').focus();
                    return;
                }

                // Envia a requisição AJAX
                $.ajax({
                    url: "{{ route('operador.buscarpipeiro') }}", // Rota para buscar pipeiros
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}', // Token CSRF para segurança
                        pesquisa: pesquisa
                    },
                    success: function(response) {
                        // Limpa a tabela antes de carregar os novos dados
                        $("#tb-analise tbody").empty();
                        if (response.pipeiros && response.pipeiros.length > 0) {
                            // Itera sobre os resultados e adiciona à tabela
                            response.pipeiros.forEach(function(pipeiro) {
                                $("#tb-analise tbody").append(`
                            <tr>
                                <td>${pipeiro.cpf}</td>
                                <td>${pipeiro.nome}</td>
                                <td>
                                    <button class="btn btn-sm btn-icon btn-outline-primary ver-detalhes" data-id="${pipeiro.id}" data-nome="${pipeiro.nome}">
                                        <span class="tf-icons bx bx-search"></span>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-outline-primary resetar" data-id="${pipeiro.id}" data-nome="${pipeiro.nome}">
                                        <span class="tf-icons bx bx-key"></span>
                                    </button>
                                </td>
                            </tr>
                        `);
                            });

                            // Adiciona evento para o botão "Ver Detalhes"
                            $(".ver-detalhes").on("click", function() {
                                let id = $(this).data('id');
                                carregarDetalhesPipeiro(id);
                            });

                            

                            // Adiciona evento para o botão "Resetar Senha"
                            $(".resetar").on("click", function(e) {
                                e.preventDefault();
                                if (confirm('Deseja resetar a senha de ' + $(this).data('nome'))) {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    });
                                    $.post('{{ route('credenciamento.resetarsenha') }}', {
                                        id: $(this).data('id'),
                                        tipo: $(this).data('tipo'),
                                    }).done(function(response) {
                                        alert("Senha alterada com sucesso.");
                                    });
                                }
                            });
                        } else {
                            // Caso não haja resultados
                            $("#tb-analise tbody").append(`
                        <tr>
                            <td colspan="3" class="text-center">Nenhum resultado encontrado.</td>
                        </tr>
                    `);
                        }
                        $('#pesquisa').focus();
                    },
                    error: function(xhr) {
                        console.error("Erro ao buscar pipeiros:", xhr.responseText);
                        alert("Ocorreu um erro ao buscar os pipeiros. Tente novamente.");
                    }
                });
            });

            function carregarDetalhesPipeiro(id) {
                $.ajax({
                    url: `/op/pipeiro/${id}/detalhes`, // Ajuste a rota conforme necessário
                    method: "GET",
                    success: function(response) {
                        // Preenche o modal com os dados do pipeiro
                        console.log(response)
                        $("#modal-detalhes .modal-body").html(`
                    <p><strong>Nome:</strong> ${response.nome}</p>
                    <p><strong>CPF:</strong> ${response.cpf}</p>
                    <p><strong>Credenciamentos:</strong></p>
                    <table id="tb-credenciamentos" class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="col-1">Cred.</th>
                                <th>Edital</th>
                                <th class="col-3">Status</th>
                                <th class="col-1">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${response.credenciamentos.map(credenciamento => {
                            // Verifica se o edital pertence à mesma OM do usuário logado
                            let mesmaOm = credenciamento.edital.id_om === {{ auth('operador')->user()->id_om }};
                            return `
                                                <tr>
                                                    <td>${credenciamento.id}</td>
                                                    <td>${credenciamento.edital.nome}</td>
                                                    <td>${credenciamento.cred_status}</td>
                                                    <td>
                                                        ${mesmaOm ? `
                                            <button class="btn btn-sm btn-icon btn-outline-primary ver-credenciamento" data-id="${credenciamento.id}">
                                                <span class="tf-icons bx bx-search"></span>
                                            </button>
                                        ` : ''}
                                                    </td>
                                                </tr>
                                            `;
                        }).join('')}
                        </tbody>
                `);
                        // Abre o modal
                        $("#modal-detalhes").modal('show');

                        $(".ver-credenciamento").on("click", function() {
                                let id = $(this).data('id');
                                const baseCredUrl = "{{ url('op/cred') }}";
                                window.location.href = baseCredUrl + '/' + id;
                            });
                    },
                    error: function(xhr) {
                        console.error("Erro ao carregar detalhes do pipeiro:", xhr.responseText);
                        alert("Ocorreu um erro ao carregar os detalhes do pipeiro.");
                    }
                });
            }
        </script>
    @endsection
