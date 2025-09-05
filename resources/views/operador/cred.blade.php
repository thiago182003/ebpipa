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
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Analisar Credenciamento</h4>

        <div class="row">

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col-md-4">
                            <label for="edital" class="form-label">Edital</label>
                            <input disabled class="form-control form-control-sm" type="text" name="edital"
                                id="edital" value="{{ @$edital->nome }}" />
                        </div>
                        <div class="mb-2 col-md-4">
                            <label for="estado" class="form-label">Estado</label>
                            <input disabled class="form-control form-control-sm" type="text" name="estado"
                                id="estado" value="{{ $estado->nome }}" />
                        </div>
                        <div class="mb-2 col-md-4">
                            <label for="municipio" class="form-label">Municipio Desejado</label>
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
                            <input class="form-control form-control-sm" type="hidden" name="cpf" id="cpf"
                                value="{{ $pipeiro->cpf }}" />
                            <input disabled class="form-control form-control-sm" type="text" name="cpfpip"
                                id="cpfpip" value="{{ $pipeiro->cpf }}" />
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="nome" class="form-label">Nome Completo</label>
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
                            <label for="estadocivil" class="form-label">Estado Civil</label>
                            <input disabled id="estadocivil" name='estadocivil' class="form-control form-control-sm"
                                value="{{ $pipeiro->estadocivil }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label class="form-label" for="telefone">Telefone/Whatsapp</label>
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
                                id="estadores" value="{{ @$endereco->estado->nome }}" />
                        </div>
                        <div class="mb-2 col-md-12">
                            <table class="table table-sm table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Documento</th>
                                        {{-- <th class="col-1">Ações</th>
                                        <th class="col-1">Status</th> --}}
                                        <th class="col-1">Ver</th>
                                        <th class="col-1">Aceitar</th>
                                        <th class="col-1">Negar</th>
                                        <th class="col-1">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>01. Comprovante de residência</strong></td>
                                        @if (@$endereco->comprovanteresidencia)
                                            {{-- <td>
                                                <div class="d-flex align-items-center">
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$endereco->comprovanteresidencia") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                    <span class="mx-1">|</span>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="endereco" data-arquivo="comprovanteresidencia"
                                                        data-nome="Comprovate de Residência"><i class='bx bx-check'></i>
                                                    </button>
                                                    <span class="mx-1">|</span>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="endereco"
                                                        data-arquivo="comprovanteresidencia"
                                                        data-nome="Comprovate de Residência"><i class='bx bx-x'></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $endereco->comprovanteresidencia_status }}',
                                                        '{{ $endereco->comprovanteresidencia_obs }}'));
                                                </script>
                                            </td> --}}
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$endereco->comprovanteresidencia") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-success aceitar"
                                                    data-tipo="endereco" data-arquivo="comprovanteresidencia"
                                                    data-nome="Comprovate de Residência"><i class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="endereco"
                                                    data-arquivo="comprovanteresidencia"
                                                    data-nome="Comprovate de Residência"><i class='bx bx-x'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $endereco->comprovanteresidencia_status }}',
                                                        '{{ $endereco->comprovanteresidencia_obs }}'));
                                                </script>
                                            </td>
                                        @else
                                            <td></td>
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
                                        <td><strong>02. Carteira Nacional de Habilitação (CNH)</strong></td>
                                        @if (@$pipeiro->cnhfrente)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$pipeiro->cnhfrente") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-success aceitar"
                                                    data-tipo="pipeiro" data-arquivo="cnhfrente"
                                                    data-nome="Carteira Nacional de habilitação"><i
                                                        class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="pipeiro"
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
                                        <td><strong>03. Certificado de Registro e Licenciamento Veicular (CRLV)</strong>
                                        </td>
                                        @if (@$veiculo->doc_crlv)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$veiculo->doc_crlv") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-success aceitar"
                                                    data-tipo="veiculo" data-arquivo="doc_crlv" data-nome="CRLV"><i
                                                        class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="veiculo"
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
                                            <td></td>
                                        @endif
                                    </tr>
                                    <x-verifica-documento :objeto=$veiculo numero="04"
                                        descricao="Laudo de aferição de volume do tanque" tipo="veiculo"
                                        documento="doc_lav" />
                                    {{-- <tr>
                                        <td><strong>04. Laudo de aferição de volume do tanque</strong></td>
                                        @if (@$veiculo->doc_lav)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$veiculo->doc_lav") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-success aceitar"
                                                    data-tipo="veiculo" data-arquivo="doc_lav"
                                                    data-nome="LAUDO DE AFERIÇÃO DE VOLUME DO TANQUE"><i
                                                        class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="veiculo"
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
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="veiculo"
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
                                        @endif
                                    </tr> --}}
                                    <x-verifica-documento :objeto=$veiculo numero="05" descricao="Foto do caminhão"
                                        tipo="veiculo" documento="veiculo_img" />
                                    {{-- <tr>
                                        <td><strong>05. Foto do caminhão</strong></td>
                                        @if (@$veiculo->veiculo_img)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$veiculo->veiculo_img") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-success aceitar"
                                                    data-tipo="veiculo" data-arquivo="veiculo_img"
                                                    data-nome="Foto do Caminhão"><i class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="veiculo"
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
                                            <td></td>
                                        @endif
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <h5 class="card-header">Dados Bancários</h5>
                <div class="card-body">
                    <input type="hidden" id="id_dadosbancarios" name="id_dadosbancarios"
                        value="{{ @$dadosbancarios->id }}" />
                    <div class="row">
                        <div class="mb-2 col-md-3">
                            <label for="banco" class="form-label">Banco</label>
                            <input disabled class="form-control form-control-sm" type="text" id="banco"
                                name="banco" value="{{ @$dadosbancarios->dadosbanco->nome }}" />
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
                                        <th>Documento</th>
                                        <th class="col-1">Ver</th>
                                        <th class="col-1">Aceitar</th>
                                        <th class="col-1">Negar</th>
                                        <th class="col-1">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>06. Comprovante de dados bancários</strong></td>
                                        @if (@$dadosbancarios->doc_comprovante)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$dadosbancarios->doc_comprovante") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-success aceitar"
                                                    data-tipo="dadosbancarios" data-arquivo="doc_comprovante"
                                                    data-nome="Comprovante de Dados Bancário"><i class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-danger negar"
                                                    data-tipo="dadosbancarios" data-arquivo="doc_comprovante"
                                                    data-nome="Comprovante de Dados Bancário"><i class='bx bx-x'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ @$dadosbancarios->doc_comprovante_status }}'));
                                                </script>
                                            </td>
                                        @else
                                            <td></td>
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
                                            <td><strong>07. Requerimento de credenciamento</strong></td>
                                            @if (@$credenciamento->doc_reqcred)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_reqcred") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_reqcred"
                                                        data-nome="Requerimento de Credenciamento"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_reqcred"
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
                                                    08. Declaração de conhecimento das informações para cumprimento das
                                                    obrigações
                                                </strong>
                                            </td>

                                            @if (@$credenciamento->doc_cico)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cico") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cico"
                                                        data-nome="Declaração de Conhecimento das Informações para Cumprimento das Obrigações"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cico"
                                                        data-nome="Declaração de Conhecimento das Informações para Cumprimento das Obrigações"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_cico_status }}'));
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
                                                    09. Termo de declaração e responsabilidade das condições de
                                                    trafegabilidade do veículo a ser credenciado
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
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_drctvc"
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
                                                    10. Modelo de autorização para exposição de dados
                                                </strong>
                                            </td>

                                            @if (@$credenciamento->doc_maed)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_maed") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_maed"
                                                        data-nome="Declaração de Conhecimento das Informações para Cumprimento das Obrigações"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_maed"
                                                        data-nome="Termo de Declaração e Responsabilidade das condições de trafegabilidade do Veículo a ser credenciado (Anexo F)"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_maed_status }}'));
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
                                                    11. Comprovante de Inscrição como Contribuinte Individual da Previdência
                                                    Social (CNIS)
                                                </strong>
                                            </td>
                                            @if (@$credenciamento->doc_cicips)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cicips") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cicips"
                                                        data-nome="Comprovante de Inscrição como Contribuinte Individual da Previdência Social"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cicips"
                                                        data-nome="Comprovante de Inscrição como Contribuinte Individual da Previdência Social"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_cicips_status }}'));
                                                    </script>
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td><strong>12. Certidão de quitação eleitoral</strong></td>
                                            @if (@$credenciamento->doc_cqe)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cqe") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cqe"
                                                        data-nome="Certidão de Quitação Eleitoral"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cqe"
                                                        data-nome="Certidão de Quitação Eleitoral"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_cqe_status }}'));
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
                                                    13. Certidão de quitação com o serviço militar (para o sexo masculino)
                                                </strong>
                                            </td>
                                            @if (@$credenciamento->doc_cqsm)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cqsm") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cqsm"
                                                        data-nome="Certidão de Quitação com o Serviço Militar"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cqsm"
                                                        data-nome="Certidão de Quitação com o Serviço Militar"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_cqsm_status }}'));
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
                                                    14. Certificado de Registro no Sistema de Cadastramento Unificado de
                                                    Fornecedores (SICAF)
                                                </strong>
                                            </td>

                                            @if (@$credenciamento->doc_sicaf)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_sicaf") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_sicaf"
                                                        data-nome="SICAF"><i class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_sicaf"
                                                        data-nome="SICAF"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_sicaf_status }}'));
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
                                                    15. Comprovante de situação cadastral no CPF
                                                </strong>
                                            </td>
                                            @if (@$credenciamento->doc_ciscc)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_ciscc") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_ciscc"
                                                        data-nome="Comprovante de situação cadastral no CPF">
                                                        <i class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button
                                                        class="btn
                                                        btn-sm btn-danger btn-icon negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_ciscc"
                                                        data-nome="Comprovante de situação cadastral no CPF"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_ciscc_status }}'));
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
                                                    16. Certidão de regularidade para com a fazenda federal
                                                </strong>
                                            </td>
                                            @if (@$credenciamento->doc_cndf)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cndf") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cndf"
                                                        data-nome="Certidão Negativa de Débitos Federais"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cndf"
                                                        data-nome="Certidão Negativa de Débitos Federais"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_cndf_status }}'));
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
                                                    17. Certidão de regularidade para com a fazenda estadual
                                                </strong>
                                            </td>
                                            @if (@$credenciamento->doc_cnde)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cnde") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cnde"
                                                        data-nome="Certidão Negativa de Débitos Estaduais"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cnde"
                                                        data-nome="Certidão Negativa de Débitos Estaduais"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_cnde_status }}'));
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
                                                    18. Certidão de regularidade para com a fazenda municipal
                                                </strong>
                                            </td>
                                            @if (@$credenciamento->doc_cndm)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cndm") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cndm"
                                                        data-nome="Certidão Negativa de Débitos Municipais"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cndm"
                                                        data-nome="Certidão Negativa de Débitos Municipais"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_cndm_status }}'));
                                                    </script>
                                                </td>
                                            @else
                                                <td colspan="3">
                                                    <button class="btn btn-sm btn-icon btn-primary upload"
                                                        data-tipo="credenciamento" data-arquivo="doc_cndm"
                                                        data-nome="Certidão Negativa de Débitos Municipais"><i
                                                            class='bx bx-upload'></i>
                                                    </button>
                                                    <input style="display: none" class="form-control form-control-sm"
                                                        type="file" accept="application/pdf" id="doc_cndm"
                                                        name="doc_cndm" value="" />
                                                    <label for="doc_cndm" id="lb_cndm"></label>
                                                </td>
                                                {{-- <td></td>
                                                <td></td> --}}
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>
                                                    19. Certidão de inexistência de débitos trabalhistas
                                                </strong>
                                            </td>
                                            @if (@$credenciamento->doc_cidt)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_cidt") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cidt"
                                                        data-nome="Certidão de Inexistência de Débitos Trabalhistas"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_cidt"
                                                        data-nome="Certidão de Inexistência de Débitos Trabalhistas"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_cidt_status }}'));
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
                                                    20. Registro ou Inscrição junto à Agência Nacional de Transporte
                                                    Terrestre (ANTT)
                                                </strong>
                                            </td>
                                            {{-- </td> --}}
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
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_antt"
                                                        data-nome="ANTT"><i class='bx bx-x'></i>
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
                                            <td><strong>21. Laudo da vigilância sanitária</strong></td>
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
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_lvs"
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
                                            <td><strong>22. Contrato de locação do veículo</strong></td>
                                            @if (@$veiculo->doc_cl)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$veiculo->doc_cl") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="veiculo" data-arquivo="doc_cl"
                                                        data-nome="Contrato de locação do veículo"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="veiculo" data-arquivo="doc_cl"
                                                        data-nome="Contrato de locação do veículo"><i class='bx bx-x'></i>
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
                                        <tr>
                                            <td><strong>23. Atestado de capacidade técnica</strong></td>
                                            @if (@$credenciamento->doc_act)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$credenciamento->doc_act") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar"
                                                        data-tipo="credenciamento" data-arquivo="doc_act"
                                                        data-nome="Contrato de locação do veículo"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar"
                                                        data-tipo="credenciamento" data-arquivo="doc_act"
                                                        data-nome="Contrato de locação do veículo"><i class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $credenciamento->doc_act_status }}'));
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
                    <div class="row">
                        <div class="mt-2 save-now">
                            {{-- <a 
                                class="btn btn-sm btn-icon btn-outline-success">
                                <span class="tf-icons bx bx-check"></span>
                            </a> --}}
                            <a href="{{ route('operador.aprovar', @$credenciamento->id) }}" type="button"
                                class="btn btn-now btn-aprovar-now aprovar"><i class='bx bx-save'></i>
                                Aprovar</a>
                        </div>
                        <div class="ml-10 save-now">
                            <button type="button" class="btn btn-now btn-baixar-now baixararquivos"><i
                                    class='bx bx-download'></i>
                                baixar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
{{--             
            @if ($documentosEdital)
                <div class="card mb-3">
                    <h5 class="card-header">Documentos Extras</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-2 col-md-12">
                                <div class="">
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
                                            @foreach ($documentosEdital as $doc)
                                                <tr>
                                                    <td><strong>{{ $doc->documento->nome }}</strong></td>
                                                    @if (@$doc->doc_candidato->arquivo)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                                href="{{ url("storage/".$doc->doc_candidato->arquivo) }}">
                                                                <i class='bx bx-file'></i>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-icon btn-success aceitar"
                                                                data-tipo="extra" data-arquivo="doc_act"
                                                                data-nome="{{$doc->documento->nome}}"><i
                                                                    class='bx bx-check'></i>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-icon btn-danger negar"
                                                                data-tipo="credenciamento" data-arquivo="doc_act"
                                                                data-nome="{{$doc->documento->nome}}"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <script>
                                                                document.write(carregarStatus('{{ $doc->doc_candidato->status }}'));
                                                            </script>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif --}}

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
                                                <td>{{ @$log->data_alteracao }}</td>
                                                <td>{{ @$log->alterado_por_tipo . ': ' . @$log->alteradoPor()->nome }}</td>
                                                <td>{{ @$log->status_anterior }}</td>
                                                <td>{{ @$log->novo_status }}</td>
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
            $(".aprovar").on("click", function(e) {
                alert("aprovar");
            });
            $(".baixararquivos").on("click", function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.post('{{ route('op.baixararquivos') }}', {
                    id: {{ $pipeiro->id }},
                    credenciamento: {{ $credenciamento->id }},
                    edital: {{ $edital->id }}
                }).done(function(response) {

                    // // Criar um link temporário para download
                    // var downloadLink = document.createElement('a');
                    // downloadLink.href = response.zipFilePath;  // Caminho do arquivo ZIP retornado pela resposta
                    // downloadLink.download = response.arquivonome;  // Definir o nome do arquivo para o download
                    // document.body.appendChild(downloadLink);
                    // downloadLink.click();  // Aciona o download
                    // document.body.removeChild(downloadLink);  // Remove o link após o uso

                    // Cria um link temporário com a URL de download
                    //  console.log(response.downloadUrl);
                    //  return false;
                    var downloadLink = document.createElement('a');
                    downloadLink.href = response.downloadUrl; // URL de download retornada pelo servidor
                    downloadLink.click(); // Inicia o download
                }).fail(function(response) {
                    alert("Erro ao baixar o arquivo.");
                });
            });
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

            $(".upload").on("click", function(e) {
                e.preventDefault();
                let arquivo = $(this).data("arquivo");
                $("#" + arquivo).click();
            });
        </script>
    @endsection
