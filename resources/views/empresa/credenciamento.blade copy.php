@extends('layouts.defaultemp');

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administração /</span> Credenciamento</h4>
        @include('componentes.mensagem')
        <form id="formAccountSettings" method="post" enctype="multipart/form-data" action="{{ route('empresa.credenciar') }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        {{-- <h5 class="card-header">Edital</h5> --}}
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="mb-2 col-md-6">
                                    <label for="address" class="form-label">Edital</label>
                                    {{-- <select @required(true) id="id_edital" name='id_edital' class="select2 form-select"> --}}
                                    <select @required(true) id="id_edital" name='id_edital'
                                        class="select2 form-select form-select-sm">
                                        <option value="">Selecione...</option>
                                        @foreach ($editais as $ed)
                                            @if ($ed->id == @$credenciamento->id_edital)
                                                <option value={{ $ed->id }} selected>{{ $ed->nome }}</option>
                                            @else
                                                <option value={{ $ed->id }}>{{ $ed->nome }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-2 col-md-12">
                                    <h2>Credenciamento Operação Carro Pipa</h2>
                                    <p>O Comando da 7ª Região Militar torna público a convocação para credenciamento de
                                        interessados na prestação de serviços de coleta, transporte e Distribuição de Água
                                        Potável no contexto do Programa Emergencial de Distribuição de Água Potável no
                                        semiárido brasileiro (Operação Carro-Pipa), em conformidade com as condições e
                                        exigências estabelecidas no Edital xxx/7ªRM presente em sua integra no seguinte
                                        link: <a href="#">Edital xxx</a>
                                    </p>
                                    <p><b>Observações importantes:</b></p>
                                    <ul>
                                        <li>
                                            <p>O(a) interessado(a) que preencher os requisitos exigidos neste Edital, no que
                                                a ele(a) for aplicável, será considerado(a) habilitado(a), mas o direito ao
                                                exercício da prestação dos serviços ficará condicionado à ocorrência de
                                                assinatura do correspondente contrato de credenciamento, após a realização
                                                de sorteio para definição de ganhadores dos LOTES disponíveis;</p>
                                        </li>
                                        <li>
                                            <p>Todos os anexos exigidos deverão está LEGÍVEIS, caso contrário o interessado
                                                será passível de inabilitação para as próximas fases;</p>
                                        </li>
                                        <li>
                                            <p>Leia atentamente as informações contidas nos diversos campos que se seguem,
                                                para o adequado preenchimento.</p>
                                        </li>
                                        <li>
                                            <p>É de extrema importância o preenchimento de todos os campos, principalmente
                                                os dados para contato, pois através desses serão passadas informações
                                                referente as etapas do Credenciamento, como também atividades para Prestação
                                                de Contas.</p>
                                        </li>
                                    </ul>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="ciente" name="ciente" />
                                        {{-- <input @required(true) class="form-check-input" type="checkbox" id="ciente"
                                        name="ciente" /> --}}
                                        <label class="form-check-label" required for="ciente"> <b>Declaro estar ciente</b>
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="card mb-4">
                        <h5 class="card-header">Detalhes do Perfil</h5>
                        <!-- Account -->
                        {{-- <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                @if ($empresa->img)
                                    <img src="{{ url("storage/{$empresa->img}") }}" alt="user-avatar"
                                        class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                @else
                                    <img src="/img/avatars/user.png" alt="user-avatar" class="d-block rounded"
                                        height="100" width="100" id="uploadedAvatar" />
                                @endif
                                <div class="button-wrapper">
                                    <label for="imagem_empresa" class="btn btn-sm btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Carregar nova Foto</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="imagem_empresa" name="imagem_empresa"
                                            class="account-file-input" hidden accept="image/png, image/jpeg" />
                                    </label>
                                    <button type="button"
                                        class="btn btn-sm btn-outline-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">resetar foto</span>
                                    </button>

                                    <p class="text-muted mb-0">Permitido formatos JPG, GIF or PNG.</p>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <hr class="my-0" /> --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-2 col-md-3">
                                    <label for="cnpj" class="form-label">CNPJ</label>
                                    <input class="form-control form-control-sm" type="text" name="cnpj" id="cnpj"
                                        value="{{ $empresa->cnpj }}" />
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label for="firstName" class="form-label">Razão Social</label>
                                    <input class="form-control form-control-sm" type="text" id="razaosocial"
                                        name="razaosocial" value="{{ $empresa->razaosocial }}" />
                                    <input type="hidden" id="id" name='id' value="{{ $empresa->id }}">
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control form-control-sm" type="email" id="email" name="email"
                                        value="{{ $empresa->email }}" placeholder="john.doe@example.com" />
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label for="firstName" class="form-label">Nome Fatasia</label>
                                    <input class="form-control form-control-sm" type="text" id="nome" name="nome"
                                        value="{{ $empresa->nome }}" />

                                </div>

                                <div class="mb-2 col-md-3">
                                    <label class="form-label" for="phoneNumber">Telefone/Whatsapp</label>
                                    <div class="input-group input-group-merge">
                                        {{-- <span class="input-group-text">BR (+55)</span> --}}
                                        <input type="text" id="telefone" name="telefone"
                                            class="form-control form-control-sm" placeholder="(xx) xxxx-xxxxx"
                                            value="{{ $empresa->telefone }}" />
                                    </div>
                                </div>

                                {{-- <div class="mb-2 col-md-3">
                                    <label for="genero" class="form-label">Genero</label>
                                    <select id="genero" name='genero' class="select2 form-select form-select-sm">
                                        <option value="">Selecione...</option>
                                        @foreach ($genero as $gen => $x)
                                            @if ($x == $empresa->genero)
                                                <option value={{ $x }} selected>{{ $gen }}</option>
                                            @else
                                                <option value={{ $x }}>{{ $gen }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                        <!-- /Account -->
                    </div>

                    <div class="card mb-4">
                        <h5 class="card-header">Endereço</h5>
                        <div class="card-body">
                            <div class="row">
                                <input class="form-control" type="hidden" name="id_endereco" id="id_endereco"
                                    value="{{ @$endereco->id }}" />
                                <div class="mb-2 col-md-3">
                                    <label for="cep" class="form-label">Cep</label>
                                    <input class="form-control form-control-sm" type="text" id="cep" name="cep"
                                        value="{{ @$endereco->cep }}" />
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label for="logradouro" class="form-label">Logradouro</label>
                                    <input class="form-control form-control-sm" type="text" id="logradouro"
                                        name="logradouro" value="{{ @$endereco->logradouro }}" />
                                </div>
                                <div class="mb-2 col-md-2">
                                    <label for="numero" class="form-label">N°</label>
                                    <input class="form-control form-control-sm" type="text" name="numero"
                                        id="numero" value="{{ @$endereco->numero }}" />
                                </div>
                                <div class="mb- 3 col-md-3">
                                    <label for="bairro" class="form-label">Bairro</label>
                                    <input class="form-control form-control-sm" type="text" name="bairro"
                                        id="bairro" value="{{ @$endereco->bairro }}" />
                                    {{-- <select id="bairro" name='bairro' class="select2 form-select">
                      <option value="">Selecione...</option>
                    </select> --}}
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input class="form-control form-control-sm" type="text" name="cidade"
                                        id="cidade" value="{{ @$endereco->cidade }}" />
                                    {{-- <select id="cidade" name='cidade' class="select2 form-select">
                      <option value="">Selecione...</option>
                    </select> --}}
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label class="form-label" for="estadores">Estado</label>
                                    <input class="form-control form-control-sm" type="text" name="estadores"
                                        id="estadores" value="{{ @$endereco->estado }}" />
                                    {{-- <select id="estadores" name='estadores' class="select2 form-select">
                      <option value="">Selecione...</option>
                    </select> --}}
                                </div>
                                <div class="mb-2 col-md-12">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th class="col-4">Upload</th>
                                                <th class="col-1">Ver</th>
                                                <th class="col-1">Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label class="form-label" for="comprovanteresidencia">Comprovante de
                                                        residência</label>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm" type="file"
                                                        accept="application/pdf" id="comprovanteresidencia"
                                                        name="comprovanteresidencia"
                                                        value="{{ @$endereco->comprovanteresidencia }}" />
                                                </td>
                                                @if (@$endereco->comprovanteresidencia)
                                                    <td>
                                                        <a target="_blank" class="btn btn-sm btn-primary"
                                                            href="{{ url("storage/$endereco->comprovanteresidencia") }}">
                                                            <i class='bx bx-file'></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-danger remover"
                                                            data-tipo="endereco" data-arquivo="comprovanteresidencia"
                                                            data-nome="Comprovante de residência"><i class='bx bx-x'></i>
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
                        </div>
                    </div>

                    <div class="card mb-4">
                        <h5 class="card-header">Representante Legal</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-2 col-md-6">
                                    <label for="cep" class="form-label">Nome</label>
                                    <input class="form-control form-control-sm" type="text" id="nome_representante"
                                        name="nome_representante" value="{{ @$empresa->nome_representante }}" />
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="telefone_representante" class="form-label">Telefone</label>
                                    <input class="form-control form-control-sm" type="text"
                                        id="telefone_representante" name="telefone_representante"
                                        value="{{ @$endereco->telefone_representante }}" />
                                </div>

                                <div class="mb-2 col-md-12">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th class="col-4">Upload</th>
                                                <th class="col-1">Ver</th>
                                                <th class="col-1">Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label class="form-label" for="comprovanteresidencia">Documento do
                                                        Representante</label>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm" type="file"
                                                        accept="application/pdf" id="comprovanteresidencia"
                                                        name="comprovanteresidencia"
                                                        value="{{ @$endereco->comprovanteresidencia }}" />
                                                </td>
                                                @if (@$endereco->comprovanteresidencia)
                                                    <td>
                                                        <a target="_blank" class="btn btn-sm btn-primary"
                                                            href="{{ url("storage/$endereco->comprovanteresidencia") }}">
                                                            <i class='bx bx-file'></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-danger remover"
                                                            data-tipo="endereco" data-arquivo="comprovanteresidencia"
                                                            data-nome="Comprovante de residência"><i class='bx bx-x'></i>
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
                                    <input class="form-control form-control-sm" type="text" id="banco"
                                        name="banco" value="{{ @$dadosbancarios->banco }}" />
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="agencia" class="form-label">Agencia</label>
                                    <input class="form-control form-control-sm" type="text" id="agencia"
                                        name="agencia" value="{{ @$dadosbancarios->agencia }}" />
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="conta" class="form-label">Conta</label>
                                    <input class="form-control form-control-sm" type="text" name="conta"
                                        id="conta" value="{{ @$dadosbancarios->conta }}" />
                                </div>
                                <div class="mb-2 col-md-12">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th class="col-4">Upload</th>
                                                <th class="col-1">Ver</th>
                                                <th class="col-1">Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label class="form-label" for="doc_comprovante">Comprovante de Dados
                                                        Bancário</label>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm" type="file"
                                                        accept="application/pdf" id="doc_comprovante"
                                                        name="doc_comprovante"
                                                        value="{{ @$dadosbancarios->doc_comprovante }}" />
                                                </td>
                                                @if (@$dadosbancarios->doc_comprovante)
                                                    <td>
                                                        <a target="_blank" class="btn btn-sm btn-primary"
                                                            href="{{ url("storage/$dadosbancarios->doc_comprovante") }}">
                                                            <i class='bx bx-file'></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-danger remover"
                                                            data-tipo="dadosbancarios" data-arquivo="doc_comprovante"
                                                            data-nome="Comprovante de Dados Bancário"><i
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
                                <label>*Extrato bancário ou digitalização do cartão, contendo os dados do número de agência
                                    e conta, devendo ser vinculado ao CNPJ da empresa Credenciante, em caso de Pessoa
                                    Jurídica e ao CPF, no caso do Credenciante ser Pessoa Física.</label>
                            </div>


                        </div>
                        <!-- /Account -->
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id_credenciamento" id="id_credenciamento"
                                    value="{{ @$credenciamento->id }}">
                                <div class="mb-2 col-md-6">
                                    <label for="address" class="form-label">Estado</label>
                                    {{-- <select @required(true) id="estado" name='estado' class="select2 form-select"> --}}
                                    <select @required(true) id="estado" name='estado'
                                        class="select2 form-select form-select-sm">
                                        <option value="">Selecione...</option>
                                        @foreach ($estados as $estado)
                                            <option {{ $estado->id == @$credenciamento->id_estado ? 'selected' : '' }}
                                                value={{ $estado->id }}>{{ $estado->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label for="address" class="form-label">Municipio Desejado</label>
                                    {{-- <select @required(true) id="municipio" name='municipio' class="select2 form-select"> --}}
                                    <select @required(true) id="municipio" name='municipio'
                                        class="select2 form-select form-select-sm">
                                        <option value="">Selecione...</option>
                                        @foreach ($municipios as $municipio)
                                            <option
                                                {{ $municipio->id == @$credenciamento->id_municipio ? 'selected' : '' }}
                                                value={{ $municipio->id }}>{{ $municipio->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card mb-4">
                        <h5 class="card-header">Dados do Motorista</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-2 col-md-3">
                                    <label for="cnhnumero" class="form-label">Numero CNH</label>
                                    <input class="form-control form-control-sm" type="text" id="cnhnumero"
                                        name="cnhnumero" value="{{ @$empresa->cnhnumero }}" />
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="cnhdata" class="form-label">Data de Vencimento</label>
                                    <input class="form-control form-control-sm" type="text" id="cnhdata"
                                        name="cnhdata" value="{{ @$empresa->cnhdata }}" />
                                </div>
                                <div class="mb-2 col-md-3 ">
                                    <label for="cnhcateg" class="form-label">Categoria</label>
                                    <input class="form-control form-control-sm" type="text" name="cnhcateg"
                                        id="cnhcateg" value="{{ @$empresa->cnhcateg }}" />
                                </div>
                                <div class="mb-2 col-md-12">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th class="col-4">Upload</th>
                                                <th class="col-1">Ver</th>
                                                <th class="col-1">Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label class="form-label" for="cnhfrente">Arquivo da CNH</label>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm" type="file"
                                                        accept="application/pdf" id="cnhfrente" name="cnhfrente"
                                                        value="{{ @$empresa->cnhfrente }}" />
                                                </td>
                                                @if (@$empresa->cnhfrente)
                                                    <td>
                                                        <a target="_blank" class="btn btn-sm btn-primary"
                                                            href="{{ url("storage/$empresa->cnhfrente") }}">
                                                            <i class='bx bx-file'></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-danger remover"
                                                            data-tipo="empresa" data-arquivo="cnhfrente"
                                                            data-nome="Arquivo da CNH"><i class='bx bx-x'></i>
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
                                    <input class="form-control form-control-sm" type="text" id="placa"
                                        name="placa" value="{{ @$veiculo->placa }}" />
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="marca" class="form-label">Marca/Modelo</label>
                                    <input class="form-control form-control-sm" type="text" id="marca"
                                        name="marca" value="{{ @$veiculo->marca }}" />
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="ano" class="form-label">Ano de Fabricação</label>
                                    <input class="form-control form-control-sm" type="text" name="ano"
                                        id="ano" value="{{ @$veiculo->ano }}" />
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="chassi" class="form-label">Chassi</label>
                                    <input class="form-control form-control-sm" type="text" name="chassi"
                                        id="chassi" value="{{ @$veiculo->chassi }}" />
                                </div>
                                <div class="mb-2 col-md-12">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th class="col-4">Upload</th>
                                                <th class="col-1">Ver</th>
                                                <th class="col-1">Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">O CRLV está no nome do motorista?
                                                    <div class="form-check form-check-inline">
                                                        <input name="proprio" class="form-check-input form-check-input-sm"
                                                            type="radio" value="1" id="rd-sim"
                                                            @if (@$veiculo) @checked($veiculo->proprio == 1) /> @endif
                                                            <label class="form-check-label " for="rd-sim"> Sim </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input name="proprio" class="form-check-input" type="radio"
                                                            value="0"
                                                            id="rd-nao"@if (@$veiculo) @checked($veiculo->proprio == 0) @endif />
                                                        <label class="form-check-label" for="rd-nao"> Não </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label class="form-label" for="doc_crlv">Certificado de Registro e
                                                        Licenciamento
                                                        Veicular (CRLV)</label>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm" type="file"
                                                        accept="application/pdf" id="doc_crlv" name="doc_crlv"
                                                        value="{{ @$veiculo->doc_crlv }}" />
                                                </td>
                                                @if (@$veiculo->doc_crlv)
                                                    <td>
                                                        <a target="_blank" class="btn btn-sm btn-primary"
                                                            href="{{ url("storage/$veiculo->doc_crlv") }}">
                                                            <i class='bx bx-file'></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-danger remover"
                                                            data-tipo="veiculo" data-arquivo="doc_crlv"
                                                            data-nome="CRLV"><i class='bx bx-x'></i>
                                                        </button>
                                                    </td>
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label class="form-label" for="doc_lav">Laudo de Aferição de Volume
                                                        do Tanque</label>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm" type="file"
                                                        accept="application/pdf" id="doc_lav" name="doc_lav"
                                                        value="{{ @$veiculo->doc_lav }}" />
                                                </td>
                                                @if (@$veiculo->doc_lav)
                                                    <td>
                                                        <a target="_blank" class="btn btn-sm btn-primary"
                                                            href="{{ url("storage/$veiculo->doc_lav") }}">
                                                            <i class='bx bx-file'></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-danger remover"
                                                            data-tipo="veiculo" data-arquivo="doc_lav"
                                                            data-nome="Laudo de Aferição de Volume do Tanque"><i
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
                                                    <label class="form-label" for="veiculo_img">Foto do Caminhão</label>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm" type="file"
                                                        accept="application/pdf" id="veiculo_img" name="veiculo_img"
                                                        value="{{ @$veiculo->veiculo_img }}" />
                                                </td>
                                                @if (@$veiculo->veiculo_img)
                                                    <td>
                                                        <a target="_blank" class="btn btn-sm btn-primary"
                                                            href="{{ url("storage/$veiculo->veiculo_img") }}">
                                                            <i class='bx bx-file'></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-danger remover"
                                                            data-tipo="veiculo" data-arquivo="veiculo_img"
                                                            data-nome="Foto do Caminhão"><i class='bx bx-x'></i>
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
                        </div>
                    </div>



                    <div class="card mb-4">
                        <h5 class="card-header">Documentos Necessários</h5>
                        <div class="card-body">

                            <div class="row">
                                <div class="mb-2 col-md-12">
                                    <p>*Todos os arquivos deverão ser digitados e em PDF, sem emendas ou rasuras, datado e
                                        assinado pelo interessado ou por seu representante legal.</p>
                                </div>
                                <div class="mb-2 col-md-12">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th>Modelo</th>
                                                    <th class="col-4">Upload</th>
                                                    <th>Ver</th>
                                                    <th>Excluir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>Requerimento de Credenciamento (anexo c)</strong></td>
                                                    <td><a href="/docs/modelo_de_requerimento_anexo_c_.pdf"
                                                            target="_blank">baixar</a></td>
                                                    <td>
                                                        <input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_reqcred" name="doc_reqcred"
                                                            value="" />

                                                    </td>
                                                    @if (@$credenciamento->doc_reqcred)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/$credenciamento->doc_reqcred") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_reqcred"
                                                                data-nome="Requerimento de Credenciamento"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Declaração de Conhecimento das Informações para Cumprimento
                                                            das Obrigações (anexo d)</strong></td>
                                                    <td><a target="_blank"
                                                            href="/docs/modelo_de_declaracao_sobre_informacoes_anexo_d_.pdf">baixar</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_cico" name="doc_cico"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_cico)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_cico}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_cico"
                                                                data-nome="Declaração de Conhecimento das Informações para Cumprimento das Obrigações"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Termo de Declaração e Responsabilidade das condições de
                                                            trafegabilidade do Veículo a ser credenciado (Anexo F)</strong>
                                                    </td>
                                                    <td><a target="_blank" href="#">baixar</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_drctvc" name="doc_drctvc"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_drctvc)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_drctvc}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_drctvc"
                                                                data-nome="ermo de Declaração e Responsabilidade das condições de
                                                                trafegabilidade do Veículo a ser credenciado (Anexo F)"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Modelo de autorização para exposição de dados (Anexo
                                                            H)</strong></td>
                                                    <td><a target="_blank" href="#">baixar</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_cnis" name="doc_cnis"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_cnis)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_cnis}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_cnis"
                                                                data-nome="Modelo de autorização para exposição de dados (Anexo H)"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Comprovante de Inscrição como Contribuinte Individual da
                                                            Previdência Social</strong></td>
                                                    <td><a target="_blank"
                                                            href="https://cnisnet.inss.gov.br/cnisinternet/faces/pages/perfil.xhtml">link</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_cicips" name="doc_cicips"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_cicips)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_cicips}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_cicips"
                                                                data-nome="Comprovante de Inscrição como Contribuinte Individual da
                                                                Previdência Social"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Certidão de Inscrição como Contribuinte Individual da
                                                            Previdência Social (CNIS)</strong></td>
                                                    <td><a target="_blank" href="#">baixar</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_maed" name="doc_maed"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_maed)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_maed}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_maed"
                                                                data-nome="Certidão de Inscrição como Contribuinte Individual da Previdência Social (CNIS)"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Certidão de Quitação Eleitoral</strong></td>
                                                    <td><a target="_blank"
                                                            href="https://www.tse.jus.br/servicos-eleitorais/certidoes/certidao-de-quitacao-eleitoral">link</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_cqe" name="doc_cqe"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_cqe)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_cqe}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_cqe"
                                                                data-nome="Certidão de Quitação Eleitoral"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Certidão de Quitação com o Serviço Militar (para o sexo
                                                            masculino)</strong></td>
                                                    <td><a target="_blank"
                                                            href="https://alistamento.eb.mil.br/lista-servicos">link</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_cqsm" name="doc_cqsm"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_cqsm)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_cqsm}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_cqsm"
                                                                data-nome="Certidão de Quitação com o Serviço Militar"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Certificado de Registro no Sistema de Cadastramento
                                                            Unificado de Fornecedores (SICAF)</strong></td>
                                                    <td><a target="_blank"
                                                            href="https://www3.comprasnet.gov.br/sicaf-web/public/pages/consultas/consultarCRC.jsf">link</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_sicaf" name="doc_sicaf"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_sicaf)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_sicaf}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_sicaf"
                                                                data-nome="SICAF"><i class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Comprovante de Inscrição e Situação Cadastral no
                                                            CPF</strong></td>
                                                    <td><a target="_blank"
                                                            href="https://servicos.receita.fazenda.gov.br/servicos/cpf/consultasituacao/consultapublica.asp">link</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_ciscc" name="doc_ciscc"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_ciscc)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_ciscc}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_ciscc"
                                                                data-nome="Comprovante de Inscrição e Situação Cadastral no
                                                                CPF"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                {{-- <tr>
                                                    <td><strong>Comprovante de Inscrição Estadual ou Municipal
                                                            (tirar)</strong></td>
                                                    <td>inserir</td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_ciem" name="doc_ciem"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_ciem)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_ciem}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_ciem"
                                                                data-nome="Comprovante de Inscrição Estadual ou Municipal"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr> --}}
                                                <tr>
                                                    <td><strong>Certidão Negativa de Débitos Federais</strong></td>
                                                    <td><a target="_blank"
                                                            href="https://solucoes.receita.fazenda.gov.br/Servicos/certidaointernet/PJ/Emitir">link</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_cndf" name="doc_cndf"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_cndf)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_cndf}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_cndf"
                                                                data-nome="Certidão Negativa de Débitos Federais"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Certidão Negativa de Débitos Estaduais</strong></td>
                                                    <td><a target="_blank"
                                                            href="https://internet-consultapublica.apps.sefaz.ce.gov.br/certidaonegativa/preparar-consultar">link</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_cnde" name="doc_cnde"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_cnde)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_cnde}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_cnde"
                                                                data-nome="Certidão Negativa de Débitos Estaduais"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Certidão Negativa de Débitos Municipais *</strong></td>
                                                    <td>inserir</td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_cndm" name="doc_cndm"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_cndm)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_cndm}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_cndm"
                                                                data-nome="Certidão Negativa de Débitos Municipais"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Certidão de Inexistência de Débitos Trabalhistas</strong>
                                                    </td>
                                                    <td><a target="_blank"
                                                            href="https://www.tst.jus.br/certidao1">link</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_cidt" name="doc_cidt"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_cidt)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_cidt}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_cidt"
                                                                data-nome="Certidão de Inexistência de Débitos Trabalhistas"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Registro ou Inscrição junto à Agência Nacional de Transporte
                                                            Terrestre (ANTT)</strong></td>
                                                    <td><a target="_blank"
                                                            href="https://rntrcdigital.antt.gov.br/">link</a>
                                                    </td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_antt" name="doc_antt"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_antt)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_antt}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_antt"
                                                                data-nome="Registro ou Inscrição junto à Agência Nacional de Transporte
                                                                Terrestre (ANTT)"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><strong>Laudo da Vigilância Sanitária</strong></td>
                                                    <td>inserir</td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_lvs" name="doc_lvs"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_lvs)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_lvs}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_lvs"
                                                                data-nome="Laudo da Vigilância Sanitária"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                {{-- <tr>
                                                    <td><strong>Atestado de Capacidade Técnica (so juridica)</strong></td>
                                                    <td>inserir</td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_act" name="doc_act"
                                                            value="" />
                                                    </td>
                                                    @if (@$credenciamento->doc_act)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$credenciamento->doc_act}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="credenciamento" data-arquivo="doc_act"
                                                                data-nome="Atestado de Capacidade Técnica"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr> --}}
                                                <tr>
                                                    <td><strong>Contrato de Locação</strong></td>
                                                    <td>inserir</td>
                                                    <td><input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="doc_cl" name="doc_cl"
                                                            value="" />
                                                    </td>
                                                    @if (@$veiculo->doc_cl)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/{$veiculo->doc_cl}") }}">
                                                                <i class='bx bx-file'></i> </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="veiculo" data-arquivo="doc_cl"
                                                                data-nome="Contrato de Locação"><i class='bx bx-x'></i>
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
                            </div>
                        </div>
                        <!-- /Account -->
                    </div>

                    <div class="card mb-4">
                        <h5 class="card-header">Termos de Aceite</h5>
                        <div class="card-body">
                            <div class="mb-2 col-md-12">
                                <h4>Autorização de Exposição de Dados*</h4>
                                <p>
                                    Autorizo a 7ª região militar a expor meus dados como: <b>NOME COMPLETO, CPF,
                                        IDENTIDADE, CONTA CORRENTE E AGÊNCIA, CNPJ, NOME DA EMPRESA E </b> relativos à
                                    atividade da Operação Carro-Pipa no âmbito dos municípios do estado do Ceará. Os dados
                                    serão expostos por motivo de contratação direta em caráter emergencial em diário oficial
                                    da união, jornais, documentos do exército brasileiro, sítios eletrônicos, cartas,
                                    notificações e redes sociais, para atender art. 37 da Constituição Federal de 1988.
                                </p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="autorizo" name="autorizo" />
                                    {{-- <input @required(true) class="form-check-input" type="checkbox" id="autorizo"
                                        name="autorizo" /> --}}
                                    <label class="form-check-label" for="autorizo"> <b>Autorizo</b> </label>
                                </div>
                            </div>
                            <div class="mb-2 col-md-12">
                                <h4>Declaração de Informações Prestadas*</h4>
                                <p>
                                    Declaro, para fins de direito, sob as penas da lei, que as informações prestadas e
                                    documentos que apresento neste processo de credenciamento, são <b>VERDADEIROS</b> e
                                    <b>AUTÊNTICOS.</b>
                                </p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="aceite" name="aceite" />
                                    {{-- <input @required(true) class="form-check-input" type="checkbox" id="aceite"
                                        name="aceite" /> --}}
                                    <label class="form-check-label" for="aceite"> <b>Eu Aceito</b> </label>
                                </div>
                            </div>
                        </div>
                        <!-- /Account -->
                    </div>
                    <div class="mt-2 save-now">
                        <button type="submit" class="btn btn-primary btn-save-now"><i class='bx bx-save'></i>
                            Salvar</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script>
        $(".remover").on("click", function(e) {
            e.preventDefault();
            let tipo = $(this).data("tipo");
            let id = 0;
            if (tipo == "credenciamento") {
                id = {{ @$credenciamento->id }};
            } else if (tipo == "endereco") {
                id = {{ @$endereco->id }};
            } else if (tipo == "dadosbancarios") {
                id = {{ @$dadosbancarios->id }};
            } else if (tipo == "veiculo") {
                id = {{ @$veiculo->id }};
            }
            if (confirm('Deseja remover o ' + $(this).data('nome'))) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post('{{ route('credenciamento.deletarArquivo') }}', {
                    id: id,
                    tipo: $(this).data("tipo"),
                    arquivo: $(this).data("arquivo")
                }).done(function(response) {
                    location.reload();
                });
            }
        });
    </script>
@endsection
