@extends('layouts.default');

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administração /</span> Credenciamento</h4>
        @if (@$credenciamento->status == 3)
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="alert alert-warning" role="alert"><i class='bx bx-error'></i>Seu
                    Credenciamento
                    está sendo análisado. Em breve Retorne para maiores informações<i class='bx bx-error'></i>
                </div>
            </div>
        @elseif(@$credenciamento->status == 1)
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="alert alert-success" role="alert"><i class='bx bx-error'></i>Seu
                    Seu credenciamento foi aprovado. Baixe seu Comprovante de Credenciamento aqui<i class='bx bx-error'></i>
                </div>
            </div>
        @else
            @include('componentes.mensagem')
            <form id="formAccountSettings" method="post" enctype="multipart/form-data"
                action="{{ route('pipeiro.credenciar') }}">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="mb-2 col-md-6">
                                        <label for="address" class="form-label">Edital</label>
                                        <select @required(true) id="id_edital" name='id_edital'
                                            class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($editais as $ed)
                                                <option {{ $ed->id == @$credenciamento->id_edital ? 'selected' : '' }}
                                                    value={{ $ed->id }}>{{ $ed->nome }}</option>
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
                                        <h2>Credenciamento Operação Carro Pipa - Edital 001.2023/7ª RM</h2>
                                        <p>O Comando da 7ª Região Militar torna público a convocação para credenciamento de
                                            interessados na prestação de serviços de coleta, transporte e Distribuição de
                                            Água Potável no contexto do Programa Emergencial de Distribuição de Água Potável
                                            no semiárido brasileiro (Operação Carro-Pipa), em conformidade com as condições
                                            e exigências estabelecidas no Edital de Credenciamento 001/2023 da 7ªRM presente
                                            em sua integra no seguinte link: <a
                                                href="https://7rm.eb.mil.br/index.php/programas/765-propipa">Edital de
                                                Credenciamento
                                                001/2023</a>
                                        </p>
                                        <p><b>Observações importantes:</b></p>
                                        <ul>
                                            <li>
                                                <p>O interessado que preencher os requisitos exigidos neste Edital, no
                                                    que a ele for aplicável, será considerado habilitado, mas o
                                                    direito ao exercício da prestação dos serviços ficará condicionado à
                                                    ocorrência de assinatura do correspondente contrato de credenciamento,
                                                    após a realização de sorteio para definição de ganhadores dos LOTES
                                                    disponíveis;</p>
                                            </li>
                                            <li>
                                                <p>Todos os anexos exigidos deverão estar assinados digitalmente em arquivo
                                                    PDF, caso contrário o interessado será passível de inabilitação para as
                                                    próximas fases;</p>
                                            </li>
                                            <li>
                                                <p>Leia atentamente as informações contidas nos diversos campos que se
                                                    seguem para o adequado preenchimento.</p>
                                            </li>
                                            <li>
                                                <p>É de extrema importância o preenchimento de todos os campos,
                                                    principalmente os dados para contato, pois através desses serão passadas
                                                    informações referentes às etapas do Credenciamento, como também
                                                    atividades para Prestação de Contas.</p>
                                            </li>
                                        </ul>
                                        <div class="form-check">
                                            {{-- <input class="form-check-input" type="checkbox" id="ciente" name="ciente" /> --}}
                                            <input @required(true) class="form-check-input" type="checkbox" id="ciente"
                                                name="ciente" />
                                            <label class="form-check-label" required for="ciente"> <b>Declaro estar
                                                    ciente</b>
                                            </label>
                                        </div>
                                    </div>

                                </div>

                            </div>
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
                            <h5 class="card-header">Detalhes do Perfil</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-2 col-md-3">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input class="form-control form-control-sm" type="text" name="cpf"
                                            id="cpf" value="{{ $pipeiro->cpf }}" disabled />
                                    </div>
                                    <div class="mb-2 col-md-6">
                                        <label for="firstName" class="form-label">Nome Completo</label>
                                        <input class="form-control form-control-sm" @required(true) type="text"
                                            id="nome" name="nome" value="{{ $pipeiro->nome }}" />
                                        <input type="hidden" id="id" name='id' value="{{ $pipeiro->id }}">
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control form-control-sm" required type="email" id="email"
                                            name="email" value="{{ $pipeiro->email }}"
                                            placeholder="john.doe@example.com" />
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="organization" class="form-label">Estado Civil</label>
                                        <select id="estadocivil" name='estadocivil'
                                            class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($estadocivil as $estado => $x)
                                                <option {{ $x == $pipeiro->estadocivil ? 'selected' : '' }}
                                                    value={{ $x }}>{{ $estado }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label class="form-label" for="phoneNumber">Telefone/Whatsapp</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="telefone" name="telefone"
                                                class="form-control form-control-sm telefone"
                                                placeholder="(xx) xxxx-xxxxx" @required(true)
                                                value="{{ $pipeiro->telefone }}" />
                                        </div>
                                    </div>

                                    <div class="mb-2 col-md-3">
                                        <label for="raca" class="form-label">Raça</label>
                                        <select id="raca" name='raca' class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($raca as $r => $x)
                                                <option {{ $x == $pipeiro->raca ? 'selected' : '' }}
                                                    value={{ $x }}>{{ $r }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="escolaridade" class="form-label">Escolaridade</label>
                                        <select id="escolaridade" name='escolaridade'
                                            class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($escolaridade as $esc => $x)
                                                <option {{ $x == $pipeiro->escolaridade ? 'selected' : '' }}
                                                    value={{ $x }}>{{ $esc }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="genero" class="form-label">Genero</label>
                                        <select id="genero" required name='genero'
                                            class="select2 form-select form-select-sm">
                                            <option value="0">Selecione...</option>
                                            @foreach ($genero as $gen => $x)
                                                <option {{ $x == $pipeiro->genero ? 'selected' : '' }}
                                                    value={{ $x }}>{{ $gen }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <h5 class="card-header">Endereço</h5>
                            <div class="card-body">
                                <div class="row">
                                    <input class="form-control" type="hidden" name="id_endereco" id="id_endereco"
                                        value="{{ @$endereco->id }}" />
                                    <div class="mb-2 col-md-3">
                                        <label for="cep" class="form-label">Cep</label>
                                        <input class="form-control form-control-sm" type="text" id="cep"
                                            name="cep" value="{{ @$endereco->cep }}" />
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
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input class="form-control form-control-sm" type="text" name="cidade"
                                            id="cidade" value="{{ @$endereco->cidade }}" />
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label class="form-label" for="estadores">Estado</label>
                                        {{-- <input class="form-control form-control-sm" type="text" name="estadores"
                                            id="estadores" value="{{ @$endereco->estado }}" /> --}}
                                        <select id="estadores" name='estadores'
                                            class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($todosestados as $estado)
                                                <option {{ $estado->id == @$endereco->estado ? 'selected' : '' }}
                                                    value="{{ $estado->id }}">{{ $estado->nome }}</option>
                                            @endforeach
                                        </select>
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
                                                        <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                            data-bs-placement='right' data-bs-html='true'
                                                            data-bs-original-title="Comprovante de residência de titularidade do requerente. Caso não possuir tal comprovante
                                                            no nome do requerente, anexar à declaração de residência em arquivo PDF e assinado
                                                            digitalmente, conforme modelo disponibilizado na página da 7ª Região Militar.">
                                                            01. Comprovante de residência
                                                            <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if (!$endereco->comprovanteresidencia)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="comprovanteresidencia"
                                                                name="comprovanteresidencia"
                                                                value="{{ @$endereco->comprovanteresidencia }}" />
                                                        @endif
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
                                                                data-nome="Comprovante de residência"><i
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
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <h5 class="card-header">Dados do Motorista</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-2 col-md-3">
                                        <label for="cnhnumero" class="form-label">Numero CNH</label>
                                        <input class="form-control form-control-sm cnh" minlength="11" maxlength="11"
                                            type="text" id="cnhnumero" name="cnhnumero"
                                            value="{{ @$pipeiro->cnhnumero }}" />
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="cnhdata" class="form-label">Data de Vencimento</label>
                                        <input class="form-control form-control-sm" type="date" id="cnhdata"
                                            name="cnhdata" value="{{ @$pipeiro->cnhdata }}" />
                                    </div>
                                    <div class="mb-2 col-md-3 ">
                                        <label for="cnhcateg" class="form-label">Categoria</label>
                                        <select name="cnhcateg" id="cnhcateg"
                                            class="select2 form-select form-select-sm">
                                            <option @if (@$pipeiro->cnhcateg == 'C') selected @endif value="C">C
                                            </option>
                                            <option @if (@$pipeiro->cnhcateg == 'D') selected @endif value="D">D
                                            </option>
                                            <option @if (@$pipeiro->cnhcateg == 'E') selected @endif value="E">E
                                            </option>
                                        </select>
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
                                                        <label class="form-label" for="cnhfrente">
                                                            <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                                data-bs-placement='right' data-bs-html='true'
                                                                data-bs-original-title="A CNH deverá constar no campo observações: EAR (Exerce Atividade Remunerada).">
                                                                02. Arquivo da Carteira Nacional de Habilitação
                                                                <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                            </span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        @if (!@$pipeiro->cnhfrente)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="cnhfrente" name="cnhfrente"
                                                                value="{{ @$pipeiro->cnhfrente }}" />
                                                        @endif
                                                    </td>
                                                    @if (@$pipeiro->cnhfrente)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/$pipeiro->cnhfrente") }}">
                                                                <i class='bx bx-file'></i>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="pipeiro" data-arquivo="cnhfrente"
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
                                            id="chassi" value="{{ @$veiculo->chassi }}" minlength="12"
                                            maxlength="17" />
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
                                                            <input name="proprio"
                                                                class="form-check-input form-check-input-sm"
                                                                type="radio" value="1" id="rd-sim"
                                                                @if (@$veiculo) @checked($veiculo->proprio == 1) /> @endif
                                                                <label class="form-check-label " for="rd-sim"> Sim
                                                            </label>
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
                                                        <label class="form-label" for="doc_crlv">
                                                            <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                                data-bs-placement='right' data-bs-html='true'
                                                                data-bs-original-title="Deverá constar, nos campos CATEGORIA e CARROCERIA, as modalidades “aluguel” e “tanque” respectivamente.">
                                                                03. Certificado de Registro e Licenciamento Veicular (CRLV)
                                                                <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                            </span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        @if (!@$veiculo->doc_crlv)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_crlv" name="doc_crlv"
                                                                value="{{ @$veiculo->doc_crlv }}" />
                                                        @endif
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
                                                        <label class="form-label" for="doc_lav">
                                                            <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                                data-bs-placement='right' data-bs-html='true'
                                                                data-bs-original-title="O laudo de capacidade volumétrica do tanque do caminhão deverá ser expedido por órgão público ou por empresa por este credenciada e deverá possuir QR Code ou outro meio eficaz de averiguar a autenticidade, bem como deve constar o número de um lacre posicionado pela instituição que fez a aferição.">
                                                                04. Laudo de Aferição de Volume do Tanque
                                                                <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                            </span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        @if (!@$veiculo->doc_lav)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_lav" name="doc_lav"
                                                                value="{{ @$veiculo->doc_lav }}" />
                                                        @endif
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
                                                        <label class="form-label" for="">
                                                            <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                                data-bs-placement='right' data-bs-html='true'
                                                                data-bs-original-title="Fotografia colorida, obrigatório aparecer a placa frontal e a lateral do veiculo.">
                                                                05. Foto do caminhão <a style="color:rgb(72, 120, 209)"
                                                                    onclick="window.open('{{ asset('img/foto-exemplo.jpg') }}','foto-exemplo','width=600,height=400')">(Foto
                                                                    de
                                                                    Exemplo - clique aqui)</a>
                                                                <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                            </span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        @if (!@$veiculo->veiculo_img)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="veiculo_img"
                                                                name="veiculo_img"
                                                                value="{{ @$veiculo->veiculo_img }}" />
                                                        @endif
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
                            <h5 class="card-header">Dados Bancários</h5>
                            <div class="card-body">
                                <input type="hidden" id="id_dadosbancarios" name="id_dadosbancarios"
                                    value="{{ @$dadosbancarios->id }}" />
                                <div class="row">
                                    <div class="mb-2 col-md-3">
                                        <label for="banco" class="form-label">Banco</label>
                                        {{-- <input class="form-control form-control-sm" type="text" id="banco"
                                            name="banco" value="{{ @$dadosbancarios->banco }}" /> --}}
                                        <select @required(true) id="banco" name='banco'
                                            class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($bancos as $banco)
                                                <option {{ $banco->id == @$dadosbancarios->banco ? 'selected' : '' }}
                                                    value={{ $banco->id }}>{{ $banco->nome }}
                                                    ({{ str_pad($banco->codigo, 3, '0', STR_PAD_LEFT) }})
                                                </option>
                                            @endforeach
                                        </select>
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
                                                        <label class="form-label" for="doc_comprovante">
                                                            <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                                data-bs-placement='right' data-bs-html='true'
                                                                data-bs-original-title="Será necessário fornecer apenas o extrato da conta corrente do requerente, que deve conter as informações do Banco, Agência e número da conta. Não serão aceitas Contas Salário, Contas Poupança ou contas com limite de movimentação para o recebimento dos créditos relacionados à prestação dos serviços. Não enviar foto do cartão, nem do CVV">
                                                                06. Comprovante de Dados Bancário
                                                                <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                            </span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        @if (!@$dadosbancarios->doc_comprovante)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_comprovante"
                                                                name="doc_comprovante"
                                                                value="{{ @$dadosbancarios->doc_comprovante }}" />
                                                        @endif
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

                                </div>


                            </div>
                            <!-- /Account -->
                        </div>

                        <div class="card mb-4">
                            <h5 class="card-header">Documentos Necessários</h5>
                            <div class="card-body">

                                <div class="row">
                                    <div class="mb-2 col-md-12">
                                        <p style="color: #ff3e1d">Todos os arquivos devem estar no formato PDF.</p>
                                        <p style="color: #ff3e1d"> Os documentos de 01 ao 04 devem estar assinados
                                            digitalmente.</p>
                                    </div>
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
                                                    <td><strong>07. Requerimento de Credenciamento (Anexo C)</strong>
                                                    </td>
                                                    <td><a href="/docs/modelo_anexo_c.doc" target="_blank">baixar</a>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_reqcred)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_reqcred"
                                                                name="doc_reqcred" value="" />
                                                        @endif

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
                                                    <td><strong>08. Declaração de Conhecimento das Informações para
                                                            Cumprimento
                                                            das Obrigações (Anexo D)</strong></td>
                                                    <td><a target="_blank" href="/docs/modelo_anexo_d.doc">baixar</a>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_cico)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_cico" name="doc_cico"
                                                                value="" />
                                                        @endif
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
                                                    <td>
                                                        <strong>
                                                            09. Termo de Declaração e Responsabilidade das condições de
                                                            trafegabilidade do Veículo a ser credenciado (Anexo F)
                                                        </strong>
                                                    </td>
                                                    <td><a target="_blank" href="/docs/modelo_anexo_f.doc">baixar</a>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_drctvc)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_drctvc"
                                                                name="doc_drctvc" value="" />
                                                        @endif
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
                                                                data-nome="Termo de Declaração e Responsabilidade das condições de
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
                                                    <td>
                                                        <strong>
                                                            10. Modelo de autorização para exposição de dados (Anexo H)
                                                        </strong>
                                                    </td>
                                                    <td><a target="_blank" href="/docs/modelo_anexo_h.doc">baixar</a>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_maed)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_maed" name="doc_maed"
                                                                value="" />
                                                        @endif
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
                                                    <td>
                                                        <strong>
                                                            11. Comprovante de Inscrição como Contribuinte Individual da
                                                            Previdência
                                                            Social (CNIS)
                                                        </strong>
                                                    </td>
                                                    <td><a target="_blank"
                                                            href="https://cnisnet.inss.gov.br/cnisinternet/faces/pages/perfil.xhtml">link</a>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_cicips)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_cicips"
                                                                name="doc_cicips" value="" />
                                                        @endif
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
                                                                Previdência Social (CNIS)"><i
                                                                    class='bx bx-x'></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                {{-- <tr>
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
                                                    </tr> --}}
                                                <tr>
                                                    <td><strong>12. Certidão de Quitação Eleitoral</strong></td>
                                                    <td><a target="_blank"
                                                            href="https://www.tse.jus.br/servicos-eleitorais/certidoes/certidao-de-quitacao-eleitoral">link</a>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_cqe)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_cqe" name="doc_cqe"
                                                                value="" />
                                                        @endif
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
                                                    <td>
                                                        <strong>
                                                            13. Certidão de Quitação com o Serviço Militar (para o sexo
                                                            masculino)
                                                        </strong>
                                                    </td>
                                                    <td><a target="_blank"
                                                            href="https://alistamento.eb.mil.br/lista-servicos">link</a>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_cqsm)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_cqsm" name="doc_cqsm"
                                                                value="" />
                                                        @endif
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
                                                    <td>
                                                        <strong>
                                                            14. Certificado de Registro no Sistema de Cadastramento
                                                            Unificado de Fornecedores (SICAF)
                                                        </strong>
                                                    </td>
                                                    <td><a target="_blank"
                                                            href="https://www3.comprasnet.gov.br/sicaf-web/public/pages/consultas/consultarCRC.jsf">link</a>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_sicaf)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_sicaf" name="doc_sicaf"
                                                                value="" />
                                                        @endif
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
                                                    <td>
                                                        <strong>
                                                            15. Comprovante de Inscrição e Situação Cadastral no CPF
                                                        </strong>
                                                    </td>
                                                    <td><a target="_blank"
                                                            href="https://servicos.receita.fazenda.gov.br/servicos/cpf/consultasituacao/consultapublica.asp">link</a>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_ciscc)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_ciscc" name="doc_ciscc"
                                                                value="" />
                                                        @endif
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
                                                    <td>
                                                        <strong>
                                                            16. Certidão de Regularidade para com a Fazenda Federal
                                                        </strong>
                                                    </td>
                                                    <td><a target="_blank"
                                                            href="https://solucoes.receita.fazenda.gov.br/servicos/certidaointernet/pj/emitir">link</a>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_cndf)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_cndf" name="doc_cndf"
                                                                value="" />
                                                        @endif
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
                                                                data-nome=" Certidão de Regularidade para com a Fazenda Federal"><i
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
                                                        <strong>
                                                            17. Certidão de Regularidade para com a Fazenda Estadual
                                                        </strong>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_cnde)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_cnde" name="doc_cnde"
                                                                value="" />
                                                        @endif
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
                                                                data-nome="Certidão de Regularidade para com a Fazenda Estadual"><i
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
                                                        <strong>
                                                            18. Certidão de Regularidade para com a Fazenda Municipal
                                                        </strong>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_cndm)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_cndm" name="doc_cndm"
                                                                value="" />
                                                        @endif
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
                                                                data-nome=" Certidão de Regularidade para com a Fazenda Municipal"><i
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
                                                        <strong>
                                                            19. Certidão de Inexistência de Débitos Trabalhistas
                                                        </strong>
                                                    </td>
                                                    <td><a target="_blank"
                                                            href="https://www.tst.jus.br/certidao1">link</a>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_cidt)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_cidt" name="doc_cidt"
                                                                value="" />
                                                        @endif
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
                                                    <td>
                                                        <strong>
                                                            <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                                data-bs-placement='right' data-bs-html='true'
                                                                data-bs-original-title="Em caso de caminhão alugado deverá constar no campo TACs AUXILIARES o nome do requerente.">
                                                                20. Registro ou Inscrição junto à Agência Nacional de
                                                                Transporte
                                                                Terrestre (ANTT)
                                                                <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                            </span>
                                                        </strong>
                                                    </td>
                                                    <td><a target="_blank"
                                                            href="https://rntrcdigital.antt.gov.br/">link</a>
                                                    </td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_antt)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_antt" name="doc_antt"
                                                                value="" />
                                                        @endif
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
                                                    <td>
                                                        <strong>
                                                            <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                                data-bs-placement='right' data-bs-html='true'
                                                                data-bs-original-title="O laudo da Vigilância Sanitária deverá ser expedido pelo Município pleiteado ao credenciamento
                                                                para transportar água potável. Em caso de credenciamento para os municípios do Estado de
                                                                Alagoas, o laudo deverá ser expedido pela Gerência de Vigilância Sanitária do Estado de Alagoas –
                                                                GVISA/AL.">
                                                                21. Laudo da Vigilância Sanitária
                                                                <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                            </span>
                                                        </strong>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_lvs)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_lvs" name="doc_lvs"
                                                                value="" />
                                                        @endif
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
                                                    <td>
                                                        <strong>
                                                            <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                                data-bs-placement='right' data-bs-html='true'
                                                                data-bs-original-title="Em caso do interessado não ser o proprietário do caminhão, deverá ser apresentado contrato de locação do veículo, a depender da relação jurídica que exista entre as partes, registrado em cartório entre o proprietário e possuidor temporário do veículo.
                                                                O prazo de vigência do contrato de locação do veículo deverá ser no mínimo entre a data do Requerimento de Credenciamento (Anexo C) até o dia 31 de dezembro de 2024.   
                                                                O contrato de locação do veículo deverá ser digitalizado e anexado em arquivo PDF.">
                                                                22. Contrato de Locação
                                                                <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                            </span>
                                                        </strong>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        @if (!@$credenciamento->doc_cl)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_cl" name="doc_cl"
                                                                value="" />
                                                        @endif
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
                            <div class="mb-3 col-md-12">
                                <h4>Declaração de que não exerce cargo público, conforme consta no item 4.3.1 do Edital
                                    001/2023 </h4>
                                <p>
                                    É vedado a participação de agentes públicos, assim considerados os agentes políticos
                                    (os detentores de mandatos eletivos, casos, dentre outros, de Prefeito,
                                    Vice-Prefeito e Vereador) e os agentes administrativos (os servidores públicos
                                    civis, os servidores militares na ativa ou em Prestação de Tarefa por Tempo
                                    Determinado (PTTC) e os empregados públicos).
                                </p>
                                <div class="form-check">
                                    <input @required(true) class="form-check-input" type="checkbox" id="cargopublico"
                                        name="cargopublico" />
                                    <label class="form-check-label" for="cargopublico"> <b>Declaro que não exerço
                                            cargo
                                            público</b> </label>
                                </div>
                            </div>
                            <div class="mb-3 col-md-12">
                                <h4>Autorização de Exposição de Dados*</h4>
                                <p>
                                    Autorizo a 7ª região militar a expor meus dados como: NOME COMPLETO, CPF,
                                    IDENTIDADE, CONTA CORRENTE E AGÊNCIA, CNPJ, NOME DA EMPRESA E OUTROS relativos à
                                    atividade da Operação Carro-Pipa no âmbito dos municípios do estado do Pernambuco ou
                                    Alagoas. Os dados serão expostos por motivo de contratação direta em caráter
                                    emergencial em diário oficial da união, jornais, documentos do exército brasileiro,
                                    sítios eletrônicos, cartas, notificações e redes sociais, para atender art. 37 da
                                    Constituição Federal de 1988.
                                </p>
                                <div class="form-check">
                                    <input @required(true) class="form-check-input" type="checkbox" id="autorizo"
                                        name="autorizo" />
                                    <label class="form-check-label" for="autorizo"> <b>Autorizo</b> </label>
                                </div>
                            </div>
                            <div class="mb-3 col-md-12">
                                <h4>Declaração de Informações Prestadas*</h4>
                                <p>
                                    Declaro, para fins de direito, sob as penas da lei, que as informações prestadas e
                                    documentos que apresento neste processo de credenciamento, são <b>VERDADEIROS</b> e
                                    <b>AUTÊNTICOS.</b>
                                </p>
                                <div class="form-check">
                                    <input @required(true) class="form-check-input" type="checkbox" id="aceite"
                                        name="aceite" />
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
    @endif
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script>
        document.getElementById('cnhdata').addEventListener('focusout', function() {
            let datavencimento = moment(this.value);
            let dataAtual = moment();
            if (dataAtual.isAfter(datavencimento, 'dat')) {
                alert("Data Inválida");
                $("#cnhdata").val("").focus();
            }
        });
        $('#estado').on('change', function() {
            var estadoId = this.value;
            var municipioSelect = document.getElementById('municipio');

            // Limpa as opções atuais do segundo select
            municipioSelect.innerHTML = '<option value="">Selecione...</option>';

            // Filtra as opções do segundo select com base na seleção do primeiro select
            var municipios = {!! json_encode($municipios) !!};
            var filteredMunicipios = municipios.filter(function(municipio) {
                return municipio.id_estado == estadoId;
            });

            // Adiciona as novas opções ao segundo select
            filteredMunicipios.forEach(function(municipio) {
                var option = document.createElement('option');
                option.value = municipio.id;
                option.textContent = municipio.nome;
                municipioSelect.appendChild(option);
            });

        });
        $(".remover").on("click", function(e) {
            e.preventDefault();
            let tipo = $(this).data("tipo");
            let id = 0;
            if (tipo == "credenciamento") {
                id = {{ @$credenciamento->id ?? '0' }};
            } else if (tipo == "endereco") {
                id = {{ @$endereco->id ?? '0' }};
            } else if (tipo == "dadosbancarios") {
                id = {{ @$dadosbancarios->id ?? '0' }};
            } else if (tipo == "veiculo") {
                id = {{ @$veiculo->id ?? '0' }};
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
    @foreach ($pendencias as $pendencia)
        <script></script>
    @endforeach
@endsection
