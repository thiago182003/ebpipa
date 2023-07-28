@extends('layouts.defaultop');

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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administração /</span> Analisar Credenciamento</h4>

        <div class="row">

            <div class="card mb-4">
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

            <div class="card mb-4">
                <h5 class="card-header">Detalhes do Perfil</h5>

                <div class="card-body">
                    <div class="row">

                        <div class="mb-2 col-md-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input disabled class="form-control form-control-sm" type="text" name="cpf"
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

            <div class="card mb-4">
                <h5 class="card-header">Endereço</h5>
                <div class="card-body">
                    <div class="row">

                        <div class="mb-2 col-md-3">
                            <label for="cep" class="form-label">Cep</label>
                            <input disabled class="form-control form-control-sm" type="text" id="cep"
                                name="cep" value="{{ @$endereco->cep }}" />
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="logradouro" class="form-label">Logradouro</label>
                            <input disabled class="form-control form-control-sm" type="text" id="logradouro"
                                name="logradouro" value="{{ @$endereco->logradouro }}" />
                        </div>
                        <div class="mb-2 col-md-2">
                            <label for="numero" class="form-label">N°</label>
                            <input disabled class="form-control form-control-sm" type="text" name="numero"
                                id="numero" value="{{ @$endereco->numero }}" />
                        </div>
                        <div class="mb- 3 col-md-3">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input disabled class="form-control form-control-sm" type="text" name="bairro"
                                id="bairro" value="{{ @$endereco->bairro }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input disabled class="form-control form-control-sm" type="text" name="cidade"
                                id="cidade" value="{{ @$endereco->cidade }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label class="form-label" for="estadores">Estado</label>
                            <input disabled class="form-control form-control-sm" type="text" name="estadores"
                                id="estadores" value="{{ @$endereco->estado }}" />
                        </div>
                        <div class="mb-2 col-md-12">
                            <table class="table table-sm table-bordered ">
                                <thead>
                                    <tr>
                                        <th class="col-1">Status</th>
                                        <th>Documento</th>
                                        <th class="col-1">Ver</th>
                                        <th class="col-1">Aceitar</th>
                                        <th class="col-1">Negar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <script>
                                                document.write(carregarStatus('{{ $endereco->comprovanteresidencia_status }}',
                                                    '{{ $endereco->comprovanteresidencia_obs }}'));
                                            </script>
                                        </td>
                                        <td>01. Comprovante de residência</td>
                                        @if (@$endereco->comprovanteresidencia)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                    href="{{ url("storage/$endereco->comprovanteresidencia") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-success aceitar" data-tipo="endereco"
                                                    data-arquivo="comprovanteresidencia"
                                                    data-nome="Comprovate de Residência"><i class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger negar" data-tipo="endereco"
                                                    data-arquivo="comprovanteresidencia"
                                                    data-nome="Comprovate de Residência"><i class='bx bx-x'></i>
                                                </button>
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

            <div class="card mb-4">
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
                                        <th class="col-1">Status</th>
                                        <th>Documento</th>
                                        <th class="col-1">Ver</th>
                                        <th class="col-1">Aceitar</th>
                                        <th class="col-1">Negar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <script>
                                                document.write(carregarStatus('{{ $pipeiro->cnhfrente_status }}'));
                                            </script>
                                        </td>
                                        <td>02. Carteira Nacional de habilitação</td>
                                        @if (@$pipeiro->cnhfrente)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                    href="{{ url("storage/$pipeiro->cnhfrente") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-success aceitar" data-tipo="pipeiro"
                                                    data-arquivo="cnhfrente"
                                                    data-nome="Carteira Nacional de habilitação"><i
                                                        class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger negar" data-tipo="pipeiro"
                                                    data-arquivo="cnhfrente"
                                                    data-nome="Carteira Nacional de habilitação"><i class='bx bx-x'></i>
                                                </button>
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

            <div class="card mb-4">
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
                                        <th class="col-1">Status</th>
                                        <th>Documento</th>
                                        <th class="col-1">Ver</th>
                                        <th class="col-1">Aceitar</th>
                                        <th class="col-1">Negar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{-- aqui --}}
                                            <script>
                                                document.write(carregarStatus('{{ $veiculo->doc_crlv_status }}'));
                                            </script>
                                        </td>
                                        <td>03. CERTIFICADO DE REGISTRO E LICENCIAMENTO VEICULAR (CRLV)</td>
                                        @if (@$veiculo->doc_crlv)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                    href="{{ url("storage/$veiculo->doc_crlv") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-success aceitar" data-tipo="veiculo"
                                                    data-arquivo="doc_crlv" data-nome="CRLV"><i class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger negar" data-tipo="veiculo"
                                                    data-arquivo="doc_crlv" data-nome="CRLV"><i class='bx bx-x'></i>
                                                </button>
                                            </td>
                                        @else
                                            <td></td>

                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            <script>
                                                document.write(carregarStatus('{{ $veiculo->doc_lav_status }}'));
                                            </script>
                                        </td>
                                        <td>04. LAUDO DE AFERIÇÃO DE VOLUME DO TANQUE</td>
                                        @if (@$veiculo->doc_lav)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                    href="{{ url("storage/$veiculo->doc_lav") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-success aceitar" data-tipo="veiculo"
                                                    data-arquivo="doc_lav"
                                                    data-nome="LAUDO DE AFERIÇÃO DE VOLUME DO TANQUE"><i
                                                        class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger negar" data-tipo="veiculo"
                                                    data-arquivo="doc_lav"
                                                    data-nome="LAUDO DE AFERIÇÃO DE VOLUME DO TANQUE"><i
                                                        class='bx bx-x'></i>
                                                </button>
                                            </td>
                                        @else
                                            <td></td>
                                            <td></td>

                                            <td></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            <script>
                                                document.write(carregarStatus('{{ $veiculo->veiculo_img_status }}'));
                                            </script>
                                        </td>
                                        <td>05. Foto do Caminhão</td>
                                        @if (@$veiculo->veiculo_img)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                    href="{{ url("storage/$veiculo->veiculo_img") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-success aceitar" data-tipo="veiculo"
                                                    data-arquivo="veiculo_img" data-nome="Foto do Caminhão"><i
                                                        class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger negar" data-tipo="veiculo"
                                                    data-arquivo="veiculo_img" data-nome="Foto do Caminhão"><i
                                                        class='bx bx-x'></i>
                                                </button>
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

            <div class="card mb-4">
                <h5 class="card-header">Dados Bancários</h5>
                <div class="card-body">
                    <input type="hidden" id="id_dadosbancarios" name="id_dadosbancarios"
                        value="{{ @$dadosbancarios->id }}" />
                    <div class="row">
                        <div class="mb-2 col-md-3">
                            <label for="banco" class="form-label">Banco</label>
                            <input disabled class="form-control form-control-sm" type="text" id="banco"
                                name="banco" value="{{ @$dadosbancarios->banco }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="agencia" class="form-label">Agencia</label>
                            <input disabled class="form-control form-control-sm" type="text" id="agencia"
                                name="agencia" value="{{ @$dadosbancarios->agencia }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="conta" class="form-label">Conta</label>
                            <input disabled class="form-control form-control-sm" type="text" name="conta"
                                id="conta" value="{{ @$dadosbancarios->conta }}" />
                        </div>
                        <div class="mb-2 col-md-12">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-1">Status</th>
                                        <th>Documento</th>
                                        <th class="col-1">Ver</th>
                                        <th class="col-1">Aceitar</th>
                                        <th class="col-1">Negar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <script>
                                                document.write(carregarStatus('{{ @$dadosbancarios->doc_comprovante_status }}'));
                                            </script>
                                        </td>
                                        <td>06. Comprovante de Dados Bancário</td>
                                        @if (@$dadosbancarios->doc_comprovante)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                    href="{{ url("storage/$dadosbancarios->doc_comprovante") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-success aceitar" data-tipo="dadosbancarios"
                                                    data-arquivo="doc_comprovante"
                                                    data-nome="Comprovante de Dados Bancário"><i class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger negar" data-tipo="dadosbancarios"
                                                    data-arquivo="doc_comprovante"
                                                    data-nome="Comprovante de Dados Bancário"><i class='bx bx-x'></i>
                                                </button>
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

            <div class="card mb-4">
                <h5 class="card-header">Documentos Necessários</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col-md-12">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col-1">Status</th>
                                            <th>Documento</th>
                                            <th class="1">Ver</th>
                                            <th class="1">Aceitar</th>
                                            <th class="1">Negar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_reqcred_status }}'));
                                                </script>
                                            </td>
                                            <td><strong>07. Requerimento de Credenciamento (Anexo C)</strong></td>
                                            @if ($credenciamento->doc_reqcred)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_reqcred") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_reqcred"
                                                        data-nome="Requerimento de Credenciamento"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_reqcred"
                                                        data-nome="Requerimento de Credenciamento"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>

                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_cico_status }}'));
                                                </script>
                                            </td>
                                            <td>
                                                <strong>
                                                    08. Declaração de Conhecimento das Informações para Cumprimento
                                                    das Obrigações (Anexo D)
                                                </strong>
                                            </td>

                                            @if (@$credenciamento->doc_cico)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cico") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cico"
                                                        data-nome="Declaração de Conhecimento das Informações para Cumprimento das Obrigações"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_cico"
                                                        data-nome="Declaração de Conhecimento das Informações para Cumprimento das Obrigações"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>

                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_drctvc_status }}'));
                                                </script>
                                            </td>
                                            <td>
                                                <strong>
                                                    09. Termo de Declaração e Responsabilidade das condições de
                                                    trafegabilidade do Veículo a ser credenciado (Anexo F)
                                                </strong>
                                            </td>

                                            @if (@$credenciamento->doc_drctvc)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_drctvc") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_drctvc"
                                                        data-nome="Declaração de Conhecimento das Informações para Cumprimento das Obrigações"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_drctvc"
                                                        data-nome="Termo de Declaração e Responsabilidade das condições de trafegabilidade do Veículo a ser credenciado (Anexo F)"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>

                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_maed_status }}'));
                                                </script>
                                            </td>
                                            <td>
                                                <strong>
                                                    10. Modelo de autorização para exposição de dados (Anexo H)
                                                </strong>
                                            </td>

                                            @if (@$credenciamento->doc_maed)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_maed") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_maed"
                                                        data-nome="Declaração de Conhecimento das Informações para Cumprimento das Obrigações"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_maed"
                                                        data-nome="Termo de Declaração e Responsabilidade das condições de trafegabilidade do Veículo a ser credenciado (Anexo F)"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>

                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_cicips_status }}'));
                                                </script>
                                            </td>
                                            <td>
                                                <strong>
                                                    11. Comprovante de Inscrição como Contribuinte Individual da Previdência
                                                    Social (CNIS)
                                                </strong>
                                            </td>
                                            @if (@$credenciamento->doc_cicips)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cicips") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cicips"
                                                        data-nome="Comprovante de Inscrição como Contribuinte Individual da Previdência Social"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_cicips"
                                                        data-nome="Comprovante de Inscrição como Contribuinte Individual da Previdência Social"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>

                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_cqe_status }}'));
                                                </script>
                                            </td>
                                            <td><strong>12. Certidão de Quitação Eleitoral</strong></td>

                                            @if (@$credenciamento->doc_cqe)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cqe") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cqe"
                                                        data-nome="Certidão de Quitação Eleitoral"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_cqe"
                                                        data-nome="Certidão de Quitação Eleitoral"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_cqsm_status }}'));
                                                </script>
                                            </td>
                                            <td>
                                                <strong>
                                                    13. Certidão de Quitação com o Serviço Militar (para o sexo masculino)
                                                </strong>
                                            </td>

                                            @if (@$credenciamento->doc_cqsm)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cqsm") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cqsm"
                                                        data-nome="Certidão de Quitação com o Serviço Militar"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_cqsm"
                                                        data-nome="Certidão de Quitação com o Serviço Militar"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_sicaf_status }}'));
                                                </script>
                                            </td>
                                            <td>
                                                <strong>
                                                    14. Certificado de Registro no Sistema de Cadastramento
                                                    Unificado de Fornecedores (SICAF)
                                                </strong>
                                            </td>

                                            @if (@$credenciamento->doc_sicaf)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_sicaf") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_sicaf"
                                                        data-nome="SICAF"><i class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_sicaf" data-nome="SICAF"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_ciscc_status }}'));
                                                </script>
                                            </td>
                                            <td>
                                                <strong>
                                                    15. Comprovante de Inscrição e Situação Cadastral no CPF
                                                </strong>
                                            </td>

                                            @if (@$credenciamento->doc_ciscc)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_ciscc") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_ciscc"
                                                        data-nome="Comprovante de Inscrição e Situação Cadastral no CPF">
                                                        <i class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button
                                                        class="btn
                                                        btn-sm btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_ciscc"
                                                        data-nome="Comprovante de Inscrição e Situação Cadastral no CPF"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        {{-- <tr>
                                            <td><strong>Comprovante de Inscrição Estadual ou Municipal</strong></td>

                                            @if (@$credenciamento->doc_ciem)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/{$credenciamento->doc_ciem}") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_reqcred"
                                                        data-nome="Requerimento de Credenciamento"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_reqcred"
                                                        data-nome="Requerimento de Credenciamento"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr> --}}
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_cndf_status }}'));
                                                </script>
                                            </td>
                                            <td>
                                                <strong>
                                                    16. Certidão de Regularidade para com a Fazenda Federal
                                                </strong>
                                            </td>

                                            @if (@$credenciamento->doc_cndf)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cndf") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cndf"
                                                        data-nome="Certidão Negativa de Débitos Federais"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_cndf"
                                                        data-nome="Certidão Negativa de Débitos Federais"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_cnde_status }}'));
                                                </script>
                                            </td>
                                            <td>
                                                <strong>
                                                    17. Certidão de Regularidade para com a Fazenda Estadual
                                                </strong>
                                            </td>

                                            @if (@$credenciamento->doc_cnde)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cnde") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cnde"
                                                        data-nome="Certidão Negativa de Débitos Estaduais"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_cnde"
                                                        data-nome="Certidão Negativa de Débitos Estaduais"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_cndm_status }}'));
                                                </script>
                                            </td>
                                            <td>
                                                <strong>
                                                    18. Certidão de Regularidade para com a Fazenda Municipal
                                                </strong>
                                            </td>
                                            @if (@$credenciamento->doc_cndm)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cndm") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cndm"
                                                        data-nome="Certidão Negativa de Débitos Municipais"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_cndm"
                                                        data-nome="Certidão Negativa de Débitos Municipais"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_cidt_status }}'));
                                                </script>
                                            </td>
                                            <td>
                                                <strong>
                                                    19. Certidão de Inexistência de Débitos Trabalhistas
                                                </strong>
                                            </td>
                                            @if (@$credenciamento->doc_cidt)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cidt") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cidt"
                                                        data-nome="Certidão de Inexistência de Débitos Trabalhistas"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_cidt"
                                                        data-nome="Certidão de Inexistência de Débitos Trabalhistas"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_antt_status }}'));
                                                </script>
                                            </td>
                                            <td>
                                                <strong>
                                                    20. Registro ou Inscrição junto à Agência Nacional de Transporte
                                                    Terrestre (ANTT)
                                                </strong>
                                            </td>

                                            </td>
                                            @if (@$credenciamento->doc_antt)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_antt") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_antt"
                                                        data-nome="ANTT"><i class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_antt" data-nome="ANTT"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $credenciamento->doc_lvs_status }}'));
                                                </script>
                                            </td>
                                            <td><strong>21. Laudo da Vigilância Sanitária</strong></td>
                                            @if (@$credenciamento->doc_lvs)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_lvs") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_lvs"
                                                        data-nome="Laudo da Vigilância Sanitária"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_lvs"
                                                        data-nome="Laudo da Vigilância Sanitária"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        {{-- <tr>
                                            <td><strong>Atestado de Capacidade Técnica</strong></td>

                                            @if (@$credenciamento->doc_act)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/{$credenciamento->doc_act}") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_reqcred"
                                                        data-nome="Requerimento de Credenciamento"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_reqcred"
                                                        data-nome="Requerimento de Credenciamento"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr> --}}
                                        <tr>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $veiculo->doc_cl_status }}'));
                                                </script>
                                            </td>
                                            <td><strong>22. Contrato de Locação</strong></td>

                                            @if (@$veiculo->doc_cl)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-primary"
                                                        href="{{ url("storage/$veiculo->doc_cl") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success aceitar" data-tipo="veiculo"
                                                        data-arquivo="doc_cl" data-nome="Contrato de Locação"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger negar" data-tipo="veiculo"
                                                        data-arquivo="doc_cl" data-nome="Contrato de Locação"><i
                                                            class='bx bx-x'></i>
                                                    </button>
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
