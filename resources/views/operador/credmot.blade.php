@extends('layouts.defaultop')

@section('content')
    <script>
        function carregarStatus(status, msg = "") {
            switch (status) {
                case "1":
                    return "<span class='badge badge-center rounded-pill bg-success'><i class='bx bx-check'></i></span>";
                case "99":
                    return "<span data-bs-toggle='tooltip' data-bs-offset='0,4' data-bs-placement='right' data-bs-html='true' data-bs-original-title='" +
                        msg +
                        "''  ><span class='badge badge-center rounded-pill bg-danger'><i class='bx bx-pie-chart-alt'></i></span></span>";
                default:
                    return "<span class='badge badge-center rounded-pill bg-warning'><i class='bx bx-pie-chart-alt'></i></span>";
            }
        }
    </script>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Analisar Credenciamento (Motorista)</h4>

        <div class="row">

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col-md-4">
                            <label for="address" class="form-label">Edital</label>
                            <input disabled class="form-control form-control-sm" type="text" name="edital"
                                id="edital" value="{{ @$edital->nome }}" />
                        </div>
                        <div class="mb-2 col-md-4">
                            <label for="address" class="form-label">Estado</label>
                            <input disabled class="form-control form-control-sm" type="text" name="estado"
                                id="estado" value="{{ $estado->nome }}" />
                        </div>
                        <div class="mb-2 col-md-4">
                            <label for="address" class="form-label">Municipio Desejado</label>
                            <input disabled class="form-control form-control-sm" type="text" name="municipio"
                                id="municipio" value="{{ $municipio->nome }}" />
                        </div>
                    </div>

                </div>
            </div>

            <div class="card mb-3">
                <h5 class="card-header">Detalhes do Perfil</h5>

                <div class="card-body">
                    <div class="row">

                        <div class="mb-2 col-md-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input disabled class="form-control form-control-sm" type="text" name="cpfmot"
                                id="cpfmot" value="{{ $pipeiro->cpf }}" />
                            <input disabled class="form-control form-control-sm" type="hidden" name="cpf"
                                id="cpf" value="{{ $pipeiro->cpf }}" />
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="firstName" class="form-label">Nome Completo</label>
                            <input disabled class="form-control form-control-sm" type="text" id="nome"
                                name="nome" value="{{ $pipeiro->nome }}" />
                            <input type="hidden" id="id" name='id' value="{{ $pipeiro->id }}">
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input disabled class="form-control form-control-sm" type="text" id="email"
                                name="email" value="{{ $pipeiro->email }}" placeholder="john.doe@example.com" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="organization" class="form-label">Estado Civil</label>
                            <input disabled id="estadocivil" name='estadocivil' class="form-control form-control-sm"
                                value="{{ $pipeiro->estadocivil }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label class="form-label" for="phoneNumber">Telefone/Whatsapp</label>
                            <input disabled type="text" id="telefone" name="telefone"
                                class="form-control form-control-sm" placeholder="(xx) xxxx-xxxxx"
                                value="{{ $pipeiro->telefone }}" />
                        </div>

                        <div class="mb-2 col-md-3">
                            <label for="raca" class="form-label">Raça</label>
                            <input disabled id="raca" name='raca' class="form-control form-control-sm"
                                value="{{ $pipeiro->raca }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="escolaridade" class="form-label">Escolaridade</label>
                            <input disabled id="escolaridade" name='escolaridade' class="form-control form-control-sm"
                                value="{{ $pipeiro->escolaridade }}">

                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <h5 class="card-header">Dados do Motorista</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col-md-3">
                            <label for="cnhnumero" class="form-label">Numero CNH</label>
                            <input disabled class="form-control form-control-sm" type="text" id="cnhnumero"
                                name="cnhnumero" value="{{ @$pipeiro->cnhnumero }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="cnhdata" class="form-label">Data de Vencimento</label>
                            <input disabled class="form-control form-control-sm" type="text" id="cnhdata"
                                name="cnhdata" value="{{ @$pipeiro->cnhdata }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="cnhcateg" class="form-label">Categoria</label>
                            <input disabled class="form-control form-control-sm" type="text" name="cnhcateg"
                                id="cnhcateg" value="{{ @$pipeiro->cnhcateg }}" />
                        </div>
                        <div class="mb-2 col-md-12">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Documento</th>
                                        <th class="col-1">Ver</th>
                                        <th class="col-1">Aceitar</th>
                                        <th class="col-1">Negar</th>
                                        <th class="col-1">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>
                                                01. Carteira Nacional de habilitação (CNH)
                                            </strong>
                                        </td>
                                        @if (@$pipeiro->cnhfrente)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-icon btn-primary"
                                                    href="{{ url("storage/$pipeiro->cnhfrente") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-icon btn-success aceitar" data-tipo="pipeiro"
                                                    data-arquivo="cnhfrente"
                                                    data-nome="Carteira Nacional de habilitação"><i
                                                        class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-icon btn-danger negar" data-tipo="pipeiro"
                                                    data-arquivo="cnhfrente"
                                                    data-nome="Carteira Nacional de habilitação"><i class='bx bx-x'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $pipeiro->cnhfrente_status }}'));
                                                </script>
                                            </td>
                                        @else
                                            <td></td>

                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Account -->
            </div>

            <div class="card mb-3">
                <h5 class="card-header">Dados do Veículo</h5>
                <div class="card-body">
                    <input type="hidden" id="id_veiculo" name="id_veiculo" value="{{ @$veiculo->id }}" />
                    <div class="row">
                        <div class="mb-2 col-md-3">
                            <label for="placa" class="form-label">Placa</label>
                            <input disabled class="form-control form-control-sm" type="text" id="placa"
                                name="placa" value="{{ @$veiculo->placa }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="marca" class="form-label">Marca/Modelo</label>
                            <input disabled class="form-control form-control-sm" type="text" id="marca"
                                name="marca" value="{{ @$veiculo->marca }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="ano" class="form-label">Ano de Fabricação</label>
                            <input disabled class="form-control form-control-sm" type="text" name="ano"
                                id="ano" value="{{ @$veiculo->ano }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="chassi" class="form-label">Chassi</label>
                            <input disabled class="form-control form-control-sm" type="text" name="chassi"
                                id="chassi" value="{{ @$veiculo->chassi }}" />
                        </div>
                        <div class="mb-2 col-md-12">
                            <table class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Documento</th>
                                        <th class="col-1">Ver</th>
                                        <th class="col-1">Aceitar</th>
                                        <th class="col-1">Negar</th>
                                        <th class="col-1">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>
                                                02. Certificado de Registro e Licenciamento Veicular (CRLV)
                                            </strong>
                                        </td>
                                        @if (@$veiculo->doc_crlv)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-icon btn-primary"
                                                    href="{{ url("storage/$veiculo->doc_crlv") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-icon btn-success aceitar" data-tipo="veiculo"
                                                    data-arquivo="doc_crlv" data-nome="CRLV"><i class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-icon btn-danger negar" data-tipo="veiculo"
                                                    data-arquivo="doc_crlv" data-nome="CRLV"><i class='bx bx-x'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $veiculo->doc_crlv_status }}'));
                                                </script>
                                            </td>
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                03. Laudo de aferição de volume do tanque
                                            </strong>
                                        </td>
                                        @if (@$veiculo->doc_lav)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-icon btn-primary"
                                                    href="{{ url("storage/$veiculo->doc_lav") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-icon btn-success aceitar" data-tipo="veiculo"
                                                    data-arquivo="doc_lav"
                                                    data-nome="Laudo de aferição de volume do tanque"><i
                                                        class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-icon btn-danger negar" data-tipo="veiculo"
                                                    data-arquivo="doc_lav"
                                                    data-nome="LAUDO DE AFERIÇÃO DE VOLUME DO TANQUE"><i
                                                        class='bx bx-x'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $veiculo->doc_lav_status }}'));
                                                </script>
                                            </td>
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                04. Foto do caminhão
                                            </strong>
                                        </td>
                                        @if (@$veiculo->veiculo_img)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-icon btn-primary"
                                                    href="{{ url("storage/$veiculo->veiculo_img") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-icon btn-success aceitar" data-tipo="veiculo"
                                                    data-arquivo="veiculo_img" data-nome="Foto do Caminhão"><i
                                                        class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-icon btn-danger negar" data-tipo="veiculo"
                                                    data-arquivo="veiculo_img" data-nome="Foto do Caminhão"><i
                                                        class='bx bx-x'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $veiculo->veiculo_img_status }}'));
                                                </script>
                                            </td>
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <h5 class="card-header">Documentos Necessários</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col-md-12">
                            <div class="">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th class="1">Ver</th>
                                            <th class="1">Aceitar</th>
                                            <th class="1">Negar</th>
                                            <th class="col-1">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>05. Requerimento de Credenciamento</strong></td>
                                            @if ($credenciamento->doc_reqcred)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_reqcred") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_reqcred"
                                                        data-nome="Requerimento de Credenciamento"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-icon btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_reqcred"
                                                        data-nome="Requerimento de Credenciamento"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_reqcred_status }}'));
                                                    </script>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>
                                                    06. Termo de declaração e responsabilidade das condições de trafegabilidade do veículo a ser credenciado
                                                </strong>
                                            </td>
                                            @if (@$credenciamento->doc_drctvc)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_drctvc") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_drctvc"
                                                        data-nome="Declaração de Conhecimento das Informações para Cumprimento das Obrigações"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_drctvc"
                                                        data-nome="Termo de Declaração e Responsabilidade das condições de trafegabilidade do Veículo a ser credenciado (Anexo F)"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_drctvc_status }}'));
                                                    </script>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>
                                                    07. Registro ou Inscrição junto à Agência Nacional de Transporte Terrestre (ANTT)
                                                </strong>
                                            </td>

                                            </td>
                                            @if (@$credenciamento->doc_antt)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_antt") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_antt"
                                                        data-nome="ANTT"><i class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_antt" data-nome="ANTT"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_antt_status }}'));
                                                    </script>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>
                                                    08. Laudo da vigilância sanitária
                                                </strong>
                                            </td>
                                            @if (@$credenciamento->doc_lvs)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_lvs") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_lvs"
                                                        data-nome="Laudo da Vigilância Sanitária"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_lvs"
                                                        data-nome="Laudo da Vigilância Sanitária"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_lvs_status }}'));
                                                    </script>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td><strong>09. Contrato de locação do veículo</strong></td>
                                            @if (@$veiculo->doc_cl)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$veiculo->doc_cl") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar" data-tipo="veiculo"
                                                        data-arquivo="doc_cl" data-nome="Contrato de locação do veículo"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="veiculo"
                                                        data-arquivo="doc_cl" data-nome="Contrato de locação do veículo"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $veiculo->doc_cl_status }}'));
                                                    </script>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <h5 class="card-header">Logs de Status</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col-md-12">
                            <div class="">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="2">data</th>
                                            <th>Usuario</th>
                                            <th class="1">Status Anterior</th>
                                            <th class="1">Status Novo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($credenciamento->logs as $log)
                                            <tr>
                                                <td>{{$log->data_alteracao}}</td>
                                                <td>{{$log->alterado_por_tipo . ": " . $log->alteradoPor()->nome }}</td>
                                                <td>{{$log->status_anterior}}</td>
                                                <td>{{$log->novo_status}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script>
            $(".aceitar").on("click", function(e) {
                e.preventDefault();
                let tipo = $(this).data("tipo");
                let id = 0;
                if (tipo == "credenciamento") {
                    id = {{ @$credenciamento->id }};
                } else if (tipo == "endereco") {
                    id = {{ @$endereco->id }};
                } else if (tipo == "dadosbancarios") {
                    id = {{ @$dadosbancarios->id ? $dadosbancarios->id : '0' }};
                } else if (tipo == "pipeiro") {
                    id = {{ @$pipeiro->id }}
                } else if (tipo == "veiculo") {
                    id = {{ @$veiculo->id }};
                }
                if (confirm('Deseja confirmar o ' + $(this).data('nome'))) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.post('{{ route('operador.alterarsitarquivo') }}', {
                        id: id,
                        tipo: $(this).data("tipo"),
                        arquivo: $(this).data("arquivo"),
                        status: '1',
                        credenciamento: {{ $credenciamento->id }}
                    }).done(function(response) {
                        location.reload();
                    });
                }
            });

            $(".negar").on("click", function(e) {
                e.preventDefault();
                let tipo = $(this).data("tipo");
                let id = 0;
                if (tipo == "credenciamento") {
                    id = {{ @$credenciamento->id ? $credenciamento->id : '0' }};
                } else if (tipo == "endereco") {
                    id = {{ @$endereco->id }};
                } else if (tipo == "dadosbancarios") {
                    id = {{ @$dadosbancarios->id ? $dadosbancarios->id : '0' }};
                } else if (tipo == "pipeiro") {
                    id = {{ @$pipeiro->id }}
                } else if (tipo == "veiculo") {
                    id = {{ @$veiculo->id }};
                }
                if (confirm('Deseja recusar o ' + $(this).data('nome'))) {
                    let obs = prompt("Digite o motivo");
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.post('{{ route('operador.alterarsitarquivo') }}', {
                        id: id,
                        tipo: $(this).data("tipo"),
                        arquivo: $(this).data("arquivo"),
                        status: '99',
                        obs: obs,
                        credenciamento: {{ $credenciamento->id }}
                    }).done(function(response) {
                        location.reload();
                    });
                }
            });
        </script>
    @endsection
