@extends('layouts.defaultemp')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Empresa /</span> Adicionar Motorista</h4>
        @if ($mensagem != "")
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="alert alert-warning" role="alert"><i class='bx bx-error'></i>
                    {{$mensagem}}
                </div>
            </div>
        @else 
        @include('componentes.mensagem')
        <form id="form-credenciar" method="post" enctype="multipart/form-data"
            action="{{ route('empresa.salvarmotorista') }}">
            @csrf
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="mb-2 col-md-6">
                                    <label for="id_edital" class="form-label">Edital</label>
                                    <input type="hidden" name="input_id_edital" id="input_id_edital" value="{{@$credenciamento->id_edital}}">
                                    <select @required(true) id="id_edital" name='id_edital'
                                        class="select2 form-select form-select-sm" onchange="selecionaEdital()" @disabled(@$credenciamento->id_edital)>
                                        <option value="">Selecione...</option>
                                        @foreach ($editais as $ed)
                                            @if( $ed->credenciado == 1)
                                                <option {{ $ed->id == @$credenciamento->id_edital ? 'selected' : '' }}
                                                    value={{ $ed->id }}>{{ $ed->nome }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="descedital" class="card mb-3" @if(@$credenciamento->id_edital == '') style="display: none;" @endif>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-2 col-md-12">
                                    <h3>Credenciamento Operação Carro Pipa - <span id="nomeedital"></span></h3>
                                    <p>O Comando Militar do Nordeste através do <span id="escnome"></span> torna público a convocação para credenciamento de
                                        interessados na prestação de serviços de coleta, transporte e Distribuição de
                                        Água Potável no contexto do Programa Emergencial de Distribuição de Água Potável
                                        no semiárido brasileiro (Operação Carro-Pipa), em conformidade com as condições
                                        e exigências estabelecidas no Edital de credenciamento presente
                                        em sua integra no seguinte link: <a id="linkedital" target="_blank"
                                            href="https://7rm.eb.mil.br/index.php/programas/765-propipa">EDITAL</a>
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
                    

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id_credenciamento" id="id_credenciamento"
                                    value="{{ @$credenciamento->id }}">
                                    <input type="hidden" name="novo" id="novo"
                                        value="{{ @$novo }}">
                                <div class="mb-2 col-md-6">
                                    <label for="estado" class="form-label">Estado</label>
                                    {{-- <select @required(true) id="estado" name='estado' class="select2 form-select"> --}}
                                        <select @required(true) id="estado" name='estado'
                                        class="select2 form-select form-select-sm">
                                        <option value="">Selecione...</option>
                                    </select>
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label for="municipio" class="form-label">Municipio Desejado</label>
                                    {{-- <select @required(true) id="municipio" name='municipio' class="select2 form-select"> --}}
                                        <select @required(true) id="municipio" name='municipio'
                                        class="select2 form-select form-select-sm">
                                        <option value="">Selecione...</option>
                                        @if( @$credenciamento->id)
                                            @foreach ($municipios as $municipio)
                                                <option
                                                    {{ $municipio->id == @$credenciamento->id_municipio ? 'selected' : '' }} {{ (old("municipio") == $municipio->id ? "selected":"") }}
                                                    value={{ $municipio->id }}>{{ $municipio->nome }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card mb-3">
                        <h5 class="card-header">Detalhes do Perfil</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-2 col-md-3">
                                    <input type="hidden" id="id_pipeiro" name="id_pipeiro">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input class="form-control form-control-sm" type="text" required name="cpf"
                                        id="cpf" value="{{ @$pipeiro->cpf }}" />
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label for="firstName" class="form-label">Nome Completo</label>
                                    <input class="form-control form-control-sm" @required(true) type="text"
                                        id="nome" name="nome" value="{{ @$pipeiro->nome }}" />
                                    <input type="hidden" id="id" name='id' value="{{ @$pipeiro->id }}">
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control form-control-sm" required type="email" id="email"
                                        name="email" value="{{ @$pipeiro->email }}" placeholder="john.doe@example.com" />
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="organization" class="form-label">Estado Civil</label>
                                    <select id="estadocivil" name='estadocivil' class="select2 form-select form-select-sm">
                                        <option value="">Selecione...</option>
                                        @foreach ($estadocivil as $estado => $x)
                                            <option {{ $x == @$pipeiro->estadocivil ? 'selected' : '' }}
                                                value={{ $x }}>{{ $estado }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label class="form-label" for="phoneNumber">Telefone/Whatsapp</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="telefone" name="telefone"
                                            class="form-control form-control-sm telefone" placeholder="(xx) xxxx-xxxxx"
                                            @required(true) value="{{ @$pipeiro->telefone }}" />
                                    </div>
                                </div>

                                <div class="mb-2 col-md-3">
                                    <label for="raca" class="form-label">Etnia</label>
                                    <select id="raca" name='raca' class="select2 form-select form-select-sm">
                                        <option value="">Selecione...</option>
                                        @foreach ($raca as $r => $x)
                                            <option {{ $x == @$pipeiro->raca ? 'selected' : '' }}
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
                                            <option {{ $x == @$pipeiro->escolaridade ? 'selected' : '' }}
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
                                            <option {{ $x == @$pipeiro->genero ? 'selected' : '' }}
                                                value={{ $x }}>{{ $gen }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2 col-md-3">
                                    <label for="dtnascimento" class="form-label">Data Nascimento</label>
                                    <div class="input-group input-group-merge">
                                        <input type="date" id="dtnascimento" name="dtnascimento"
                                            class="form-control form-control-sm"
                                            placeholder="xx/xx/xxxx"
                                            value="{{ @$pipeiro->dtnascimento }}" />
                                    </div>
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
                                    <select name="cnhcateg" id="cnhcateg" class="select2 form-select form-select-sm">
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
                                                    
                                                        <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                            data-bs-placement='right' data-bs-html='true'
                                                            data-bs-original-title="A CNH deverá constar no campo observações: EAR (Exerce Atividade Remunerada).">
                                                            <strong>01. Carteira Nacional de Habilitação (CNH)</strong>
                                                            <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                        </span>
                                                    
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

                    <div class="card mb-3">
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
                                        id="chassi" value="{{ @$veiculo->chassi }}" minlength="12" maxlength="17" />
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
                                                <td colspan="4"><strong> O CRLV está no nome do motorista?</strong>
                                                    <div class="form-check form-check-inline">
                                                        <input name="proprio" class="form-check-input form-check-input-sm"
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
                                                    
                                                        <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                            data-bs-placement='right' data-bs-html='true'
                                                            data-bs-original-title="Deverá constar, nos campos CATEGORIA e CARROCERIA, as modalidades “aluguel” e “tanque” respectivamente.">
                                                            <strong>02. Certificado de Registro e Licenciamento Veicular (CRLV)</strong>
                                                            <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                        </span>
                                                    
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
                                                    
                                                        <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                            data-bs-placement='right' data-bs-html='true'
                                                            data-bs-original-title="O laudo de capacidade volumétrica do tanque do caminhão deverá ser expedido por órgão público ou por empresa por este credenciada e deverá possuir QR Code ou outro meio eficaz de averiguar a autenticidade, bem como deve constar o número de um lacre posicionado pela instituição que fez a aferição.">
                                                            <strong>03. Laudo de aferição de volume do tanque</strong>
                                                            <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                        </span>
                                                    
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
                                                    
                                                        <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                            data-bs-placement='right' data-bs-html='true'
                                                            data-bs-original-title="Fotografia colorida, obrigatório aparecer a placa frontal e a lateral do veiculo.">
                                                            <strong>04. Foto do caminhão</strong>
                                                            <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                        </span>
                                                    
                                                </td>
                                                <td>
                                                    @if (!@$veiculo->veiculo_img)
                                                        <input class="form-control form-control-sm" type="file"
                                                            accept="application/pdf" id="veiculo_img" name="veiculo_img"
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


                    <div class="card mb-3">
                        <h5 class="card-header">Documentos Necessários</h5>
                        <div class="card-body">

                            <div class="row">
                                <div class="mb-2 col-md-12">
                                    <p>*Todos os arquivos deverão ser digitados e em PDF, sem emendas ou rasuras, datado
                                        e
                                        assinado pelo interessado ou por seu representante legal.</p>
                                </div>
                                <div class="mb-2 col-md-12">
                                    <div class="">
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
                                                    <td><strong>05. Requerimento de credenciamento</strong>
                                                    </td>
                                                    <td><a id="requerimento_credenciamento" href="#" target="_blank">baixar</a>
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
                                                    <td>
                                                        <strong>
                                                            06. Termo de declaração e responsabilidade das condições de trafegabilidade do veículo a ser credenciado
                                                        </strong>
                                                    </td>
                                                    <td><a id="condicao_do_veiculo" target="_blank" href="#">baixar</a>
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
                                                            trafegabilidade do Veículo a ser credenciado"><i
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
                                                            07. Registro ou Inscrição junto à Agência Nacional de Transporte Terrestre (ANTT)
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
                                                                08. Laudo da vigilância sanitária
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
                                                <tr>
                                                    <td>
                                                        <strong>

                                                            <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                                data-bs-placement='right' data-bs-html='true'
                                                                data-bs-original-title="Em caso do interessado não ser o proprietário do caminhão, deverá ser apresentado Contrato de locação do veículo do veículo, a depender da relação jurídica que exista entre as partes, registrado em cartório entre o proprietário e possuidor temporário do veículo.<br>O prazo de vigência do Contrato de locação do veículo do veículo deverá ser no mínimo entre a data do Requerimento de Credenciamento (Anexo C) até o dia 31 de dezembro de 2024.">
                                                                09. Contrato de locação do veículo
                                                                <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                            </span>
                                                        </strong>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        @if (!@$veiculo->doc_cl)
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
                                                                data-nome="Contrato de locação do veículo"><i class='bx bx-x'></i>
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

                    <div class="card mb-3">
                        <h5 class="card-header">Termos de Aceite</h5>
                        <div class="card-body">
                            <div class="mb-3 col-md-12">
                                <h4>Declaração de que não exerce cargo público</h4>
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
                                    Autorizo o Comando Militar do Nordeste a expor meus dados como: NOME COMPLETO, CPF,
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

        var editais = {!! $editais !!};
        var municipios = [];
        var estados = [];
        var id_estado = {!! json_encode($credenciamento->id_estado ?? 0) !!};
        var id_municipio = {!! json_encode($credenciamento->id_municipio ?? 0) !!};
        document.getElementById('cnhdata').addEventListener('focusout', function() {
            let datavencimento = moment(this.value);
            let dataAtual = moment();
            if (dataAtual.isAfter(datavencimento, 'dat')) {
                alert("Data Inválida");
                $("#cnhdata").val("").focus();
            }
        });
       
        $('#id_edital').change();
        
        document.addEventListener("DOMContentLoaded", function() {
            var editais = {!! json_encode($editais) !!}; // Array completo de objetos de editais
            var inputIdEdital = document.getElementById("input_id_edital").value;
            var selectEdital = document.getElementById("id_edital");
            var iestado = document.getElementById("estado");
            var municipioSelect = document.getElementById('municipio');

            iestado.addEventListener('change', function() {
                
                var estadoId = this.value;
                // Limpa as opções atuais do select de municípios
                municipioSelect.innerHTML = '<option value="">Selecione...</option>';

                // Filtra as opções do segundo select com base no estado selecionado
                var filteredMunicipios = municipios.filter(function(municipio) {
                    return municipio.id_estado == estadoId;
                });

                // Adiciona as novas opções ao select de municípios
                filteredMunicipios.forEach(function(municipio) {
                    var option = document.createElement('option');
                    option.value = municipio.id;
                    option.textContent = municipio.nome;

                    // Se o ID do município atual for igual a idMunicipio, ele será selecionado
                    if (municipio.id == id_municipio) {
                        option.selected = true;
                    }
                    municipioSelect.appendChild(option);
                });
            });


            Array.from(selectEdital.options).forEach(option => {
                if (inputIdEdital) {
                    // Desabilita todas as opções, exceto a que corresponde ao inputIdEdital
                    option.disabled = option.value !== inputIdEdital;
                } else {
                    // Se inputIdEdital estiver vazio, desabilita opções onde edital.credenciado é 1
                    let edital = editais.find(ed => ed.id == option.value);
                    // option.disabled = edital && edital.credenciado == 1;
                }
            });
            $("#cpf").on("blur", function() {
                pesquisarCPF();
            });
                
        });

        function pesquisarCPF(){
            cpf = $("#cpf").val()
            cpf = cpf.replace(/\D/g, "");
            cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
            if(cpf!=""){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post('{{ route('empresa.pesquisaCPF') }}', {
                    cpf: cpf,
                }).done(function(response) {
                    if(response){
                        console.log(response)
                        $("#cpf").val(response.cpf);
                        $("#nome").val(response.nome);
                        $("#email").val(response.email);
                        $("#estadocivil").val(response.estadocivil);
                        $("#telefone").val(response.telefone);
                        $("#raca").val(response.raca);
                        $("#escolaridade").val(response.escolaridade);
                        $("#genero").val(response.genero);
                        $("#cnhnumero").val(response.cnhnumero);
                        $("#cnhdata").val(response.cnhdata);
                        $("#cnhcateg").val(response.cnhcateg);
                        $("#id_pipeiro").val(response.id);
                    }
                });
            }
        }
        // $('#estado').on('change', function() {
        //     // consolo.log("chamou");
        //     var estadoId = this.value;
        //     var municipioSelect = document.getElementById('municipio');

        //     // Limpa as opções atuais do segundo select
        //     municipioSelect.innerHTML = '<option value="">Selecione...</option>';

        //     // Filtra as opções do segundo select com base na seleção do primeiro select
        //     var municipios = {!! json_encode($municipios) !!};
            
        //     var filteredMunicipios = municipios.filter(function(municipio) {
        //         return municipio.id_estado == estadoId;
        //     });
        //     // console.log(filteredMunicipios);
        //     // Adiciona as novas opções ao segundo select
        //     filteredMunicipios.forEach(function(municipio) {
        //         var option = document.createElement('option');
        //         option.value = municipio.id;
        //         option.textContent = municipio.nome;
        //         municipioSelect.appendChild(option);
        //     });
        // });

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
            } else if (tipo == "empresa") {
                id = {{ @$empresa->id ?? '0' }};
            }
            if (confirm('Deseja remover o ' + $(this).data('nome'))) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post('{{ route('empresa.deletarArquivo') }}', {
                    id: id,
                    tipo: $(this).data("tipo"),
                    arquivo: $(this).data("arquivo")
                }).done(function(response) {
                    location.reload();
                });
            }
        });

        $('#form-credenciar').submit(function(e){
            var count = 0;
            var inputsFile = this.querySelectorAll('input[type="file"]');
            inputsFile.forEach(function(input) {
                if (input.files.length > 0) {
                    for (var i = 0; i < input.files.length; i++) {
                        var arquivo = input.files[i];
                        if(arquivo.size > 1024 * 1014 * 5){
                            count++;
                            var texto = input.parentNode.innerHTML.trim();
                            console.log(texto);
                            var msg = '<span class="msgarquivo">O arquivo é maior que 5mb</span>';
                            texto = texto.replace(msg,"");
                            console.log(texto);
                            input.parentNode.innerHTML = texto + msg;
                        }
                    }
                    if(count > 0){
                        e.preventDefault();
                        return false;
                    }
                }
            });
            console.log("ok");
        });

        function selecionaEdital(){
                var select = document.getElementById("id_edital").value;
                var elementoOculto = document.getElementById("descedital");
                if (select === "") {
                    elementoOculto.style.display = "none";
                } else {
                    elementoOculto.style.display = "block";
                    var edital = editais.find((x) => x.id == select);
                    $('#escnome').html(edital.om.nome);
                    $('#nomeedital').html(edital.nome);
                    $('#linkedital').attr('href',edital.documento);
                }
                if(select != ""){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post('{{ route('empresa.carregarmunicipios') }}', {
                        id: select,
                    }).done(function(response) {
                        estados = response.estados;
                        municipios = response.municipios;
                        var idestado = {!! json_encode($credenciamento->id_estado ?? "0") !!};

                        let html = "<option>Selecione...</option>";
                        estados.forEach(function(e) {
                            if (e.id == idestado) {
                                html += "<option selected value='" + e.id + "'>" + e.nome + "</option>";
                            } else {
                                html += "<option value='" + e.id + "'>" + e.nome + "</option>";
                            }
                        });
                        $('#estado').html(html);
                        mudaEstado(idestado);
                        
                    });
                }      
            }
    </script>
@endsection
