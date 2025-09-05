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
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Analisar Credenciamento (Empresa)</h4>

        <div class="row">

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col-md-4">
                            <label for="address" class="form-label">Edital</label>
                            <input disabled class="form-control form-control-sm" type="text" name="edital"
                                id="edital" value="{{ @$edital->nome }}" />
                        </div>
                    </div>

                </div>
            </div>

            <div class="card mb-3">
                <h5 class="card-header">Detalhes do Perfil</h5>

                <div class="card-body">
                    <div class="row">

                        <div class="mb-2 col-md-3">
                            <label for="cpf" class="form-label">CNPJ</label>
                            <input disabled class="form-control form-control-sm" type="text" name="cnpjemp"
                                id="cnpjemp" value="{{ $empresa->cnpj }}" />
                                <input disabled class="form-control form-control-sm" type="hidden" name="cnpj"
                                id="cnpj" value="{{ $empresa->cnpj }}" />
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="firstName" class="form-label">Razão Social</label>
                            <input disabled class="form-control form-control-sm" type="text" id="razaosocial"
                                name="razaosocial" value="{{ $empresa->razaosocial }}" />
                            <input type="hidden" id="id" name='id' value="{{ $empresa->id }}">
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="firstName" class="form-label">Nome</label>
                            <input disabled class="form-control form-control-sm" type="text" id="nome"
                                name="nome" value="{{ $empresa->nome }}" />

                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input disabled class="form-control form-control-sm" type="text" id="email"
                                name="email" value="{{ $empresa->email }}" placeholder="john.doe@example.com" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label class="form-label" for="phoneNumber">Telefone/Whatsapp</label>
                            <input disabled type="text" id="telefone" name="telefone"
                                class="form-control form-control-sm" placeholder="(xx) xxxx-xxxxx"
                                value="{{ $empresa->telefone }}" />
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
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$endereco->comprovanteresidencia") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-success aceitar" data-tipo="endereco"
                                                    data-arquivo="comprovanteresidencia"
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
                <h5 class="card-header">Representante Legal</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label for="cep" class="form-label">Nome</label>
                            <input class="form-control form-control-sm" disabled type="text"
                                id="nome_representante" name="nome_representante"
                                value="{{ @$empresa->nome_representante }}" />
                        </div>
                        <div class="mb-2 col-md-3">
                            <label for="telefone_representante" @required(true)
                                class="form-label">Telefone</label>
                            <input class="form-control form-control-sm telefone" disabled type="text"
                                id="telefone_representante" name="telefone_representante"
                                value="{{ @$empresa->telefone_representante }}" />
                        </div>

                        <div class="mb-2 col-md-12">
                            <table class="table table-sm table-bordered ">
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
                                        <td><strong>02. Documento do representante</strong></td>
                                        @if (@$empresa->doc_representante)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$empresa->doc_representante") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-success aceitar" data-tipo="empresa"
                                                    data-arquivo="doc_representante"
                                                    data-nome="Comprovate de Residência"><i class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="empresa"
                                                    data-arquivo="doc_representante"
                                                    data-nome="Comprovate de Residência"><i class='bx bx-x'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <script>
                                                    document.write(carregarStatus('{{ $empresa->doc_representante_status }}',
                                                        '{{ $endereco->comprovanteresidencia_obs }}'));
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
                                        <td><strong>03. Comprovante de dados bancário</strong></td>
                                        @if (@$dadosbancarios->doc_comprovante)
                                            <td>
                                                <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                    href="{{ url("storage/$dadosbancarios->doc_comprovante") }}">
                                                    <i class='bx bx-file'></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-success aceitar" data-tipo="dadosbancarios"
                                                    data-arquivo="doc_comprovante"
                                                    data-nome="Comprovante de Dados Bancário"><i class='bx bx-check'></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="dadosbancarios"
                                                    data-arquivo="doc_comprovante"
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
                                            <td>
                                                <strong>
                                                    04. Declaração de conhecimento das informações para cumprimento das obrigações
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
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_cico"
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
                                                    05. Declaração de trabalho de menor
                                                </strong>
                                            </td>
                                            @if (@$empresa->doc_emp_tdm)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$empresa->doc_emp_tdm") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_tdm"
                                                        data-nome="Declaração de trabalho de menor (Anexo E)"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_tdm"
                                                        data-nome="Declaração de trabalho de menor (Anexo E)"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $empresa->doc_emp_tdm_status }}'));
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
                                                    06. Modelo de autorização para exposição de dados
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
                                                        data-nome="Modelo de autorização para exposição de dados (Anexo H)"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_maed"
                                                        data-nome="Modelo de autorização para exposição de dados (Anexo H)"><i
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
                                                    07. Documento de constituição da empresa
                                                </strong>
                                            </td>
                                            @if (@$empresa->doc_emp_ccmei)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$empresa->doc_emp_ccmei") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_ccmei"
                                                        data-nome="Documento de Constituição da Empresa"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_ccmei"
                                                        data-nome="Documento de Constituição da Empresa"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $empresa->doc_emp_ccmei_status }}'));
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
                                                    08. Cartão de Inscrição no Cadastro Nacional de Pessoa Juridica - CNPJ
                                                </strong>
                                            </td>
                                            @if (@$empresa->doc_emp_cicnpj)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$empresa->doc_emp_cicnpj") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_cicnpj"
                                                        data-nome="Cartão de inscrição no Cadastro Nacional de Pessoa Juridica - CNPJ"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_cicnpj"
                                                        data-nome="Cartão de inscrição no Cadastro Nacional de Pessoa Juridica - CNPJ"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $empresa->doc_emp_cicnpj_status }}'));
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
                                                    09. Certidão de inscrição no cadastro de contribuintes estadual ou municipal, correspondente a sede do interessado
                                                </strong>
                                            </td>
                                            @if (@$empresa->doc_emp_ciccem)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$empresa->doc_emp_ciccem") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_ciccem"
                                                        data-nome="Cartão de inscrição no Cadastro Nacional de Pessoa Juridica - CNPJ"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_ciccem"
                                                        data-nome="Cartão de inscrição no Cadastro Nacional de Pessoa Juridica - CNPJ"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $empresa->doc_emp_ciccem_status }}'));
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
                                                    10. Certidão de regularidade para com a fazenda federal
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
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_cndf"
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
                                                    11. Certidão de regularidade para com a fazenda estadual
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
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_cnde"
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
                                                    12. Certidão de regularidade para com a fazenda municipal
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
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_cndm"
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
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>
                                                    13. Certidão de regularidade relativa as contribuições para a seguridade social
                                                </strong>
                                            </td>
                                            @if (@$empresa->doc_emp_crrcss)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$empresa->doc_emp_crrcss") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_crrcss"
                                                        data-nome="Certidão de regularidade relativa as contribuições para a Seguridade Social"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_crrcss"
                                                        data-nome="Certidão de regularidade relativa as contribuições para a Seguridade Social"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $empresa->doc_emp_crrcss_status }}'));
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
                                                    14. Certidão de regularidade com referência às contribuições para o FGTS
                                                </strong>
                                            </td>
                                            </td>
                                            @if (@$empresa->doc_emp_crrc)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$empresa->doc_emp_crrc") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_crrc"
                                                        data-nome="Certidão de regularidade com referência às contribuições para o FGTS"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_crrc"
                                                        data-nome="Certidão de regularidade com referência às contribuições para o FGTS"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $empresa->doc_emp_crrc_status }}'));
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
                                                    15. Certidão de inexistência de débitos inadimplidos perante a justiça do trabalho
                                                </strong>
                                            </td>
                                            @if (@$empresa->doc_emp_cidijt)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$empresa->doc_emp_cidijt") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_cidijt"
                                                        data-nome="Certidão de inexistência de débitos inadimplidos perante a justiça do trabalho"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_cidijt"
                                                        data-nome="Certidão de inexistência de débitos inadimplidos perante a justiça do trabalho"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $empresa->doc_emp_cidijt_status }}'));
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
                                                    16. Certificado de Registro no Sistema de Cadastramento Unificado de Fornecedores (SICAF)
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
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_sicaf" data-nome="SICAF"><i
                                                            class='bx bx-x'></i>
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
                                                    17. Alvará de licença de funcionamento
                                                </strong>
                                            </td>
                                            @if (@$empresa->doc_emp_alf)
                                                <td>
                                                    <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                        href="{{ url("storage/$empresa->doc_emp_alf") }}">
                                                        <i class='bx bx-file'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-success aceitar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_alf"
                                                        data-nome="Alvará de licença de funcionamento"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="empresa"
                                                        data-arquivo="doc_emp_alf"
                                                        data-nome="Alvará de licença de funcionamento"><i
                                                            class='bx bx-x'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <script>
                                                        document.write(carregarStatus('{{ $empresa->doc_emp_alf_status }}'));
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
                                                    18. Atestado de capacidade técnica
                                                </strong>
                                            </td>
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
                                                        data-nome="Atestado de Capacidade Técnica"><i
                                                            class='bx bx-check'></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="credenciamento"
                                                        data-arquivo="doc_act"
                                                        data-nome="Atestado de Capacidade Técnica"><i class='bx bx-x'></i>
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

            {{-- <div class="card mb-3">
                <h5 class="card-header">Motoristas</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col-md-12">
                            <table class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-2">cpf</th>
                                        <th>Nome</th>
                                        <th class="col-1">Pendências</th>
                                        <th class="col-1">Ver</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (@$motoristas as $mot)
                                        @if (is_null($mot->credenciamento))
                                            @continue
                                        @endif
                                        <tr>
                                            <td>{{ $mot->cpf }}</td>
                                            <td>{{ $mot->nome }}</td>
                                            <td></td>
                                            <td>
                                                <a href="{{ route('operador.cred', @$mot->credenciamento->id) }}"
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
                </div>
            </div> --}}
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
                } else if (tipo == "empresa") {
                    id = {{ @$empresa->id }}
                }
                // console.log("id = " + id);
                // console.log("tipo = " + $(this).data("tipo"));
                // console.log("arquivo = " + $(this).data("arquivo"));
                // console.log("cred id = " + {{ $credenciamento->id }});
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
                } else if (tipo == "empresa") {
                    id = {{ @$empresa->id }}
                }
                // console.log("id = " + id);
                // console.log("tipo = " + $(this).data("tipo"));
                // console.log("arquivo = " + $(this).data("arquivo"));
                // console.log("cred id = " + {{ $credenciamento->id }});
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
