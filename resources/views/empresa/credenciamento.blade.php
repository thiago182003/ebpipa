@extends('layouts.defaultemp')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Credenciamento</h4>
        @if ($mensagem != "")
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="alert alert-warning" role="alert"><i class='bx bx-error'></i>
                    {{$mensagem}}
                </div>
            </div>
        @else
            @include('componentes.mensagem')
            <form id="formAccountSettings" method="post" enctype="multipart/form-data" action="{{ route('empresa.credenciar') }}">
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
                                            class="select2 form-select form-select-sm" onchange="selecionaEdital()">
                                            <option value="">Selecione...</option>
                                            @foreach ($editais as $ed)
                                                <option {{ $ed->id == @$credenciamento->id_edital ? 'selected' : '' }} {{ $ed->credenciado == 1? "disabled" : '' }}
                                                    value={{ $ed->id }}>{{ $ed->nome }}</option>
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
                        <input type="hidden" name="id_credenciamento" id="id_credenciamento"
                        value="{{ @$credenciamento->id }}">
                        <input type="hidden" name="novo" id="novo"
                        value="{{ @$novo }}">
                        <div class="card mb-3">
                            <h5 class="card-header">Detalhes do Perfil</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-2 col-md-3">
                                        <label for="cnpj" class="form-label">CNPJ</label>
                                        <input class="form-control form-control-sm" disabled type="text" name="cnpj"
                                            id="cnpj" value="{{ $empresa->cnpj }}" />
                                    </div>
                                    <div class="mb-2 col-md-6">
                                        <label for="razaosocial" class="form-label">Razão Social</label>
                                        <input class="form-control form-control-sm" type="text" required id="razaosocial"
                                            name="razaosocial" value="{{ $empresa->razaosocial }}" />
                                        <input type="hidden" id="id" name='id' value="{{ $empresa->id }}">
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control form-control-sm" type="email" id="email" required
                                            name="email" value="{{ $empresa->email }}" placeholder="john.doe@example.com" />
                                    </div>
                                    <div class="mb-2 col-md-6">
                                        <label for="nome" class="form-label">Nome Fatasia</label>
                                        <input class="form-control form-control-sm" type="text" id="nome" name="nome"
                                            value="{{ $empresa->nome }}" />

                                    </div>

                                    <div class="mb-2 col-md-3">
                                        <label class="form-label" for="telefone">Telefone/Whatsapp</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="telefone" name="telefone"
                                                class="form-control form-control-sm telefone" required placeholder="(xx) xxxx-xxxxx"
                                                value="{{ $empresa->telefone }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
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

                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input class="form-control form-control-sm" type="text" name="cidade"
                                            id="cidade" value="{{ @$endereco->cidade }}" />

                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label class="form-label" for="estadores">Estado</label>
                                        <select id="estadores" name='estadores' class="select2 form-select form-select-sm">
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
                                                            data-bs-original-title="Comprovante de endereço da sede da empresa. Caso não possuir tal comprovante no nome
                                                            da empresa, anexar à declaração de endereço em arquivo PDF e assinado digitalmente.">
                                                            <strong>01. Comprovante de residência</strong>
                                                            <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if (!@$endereco->comprovanteresidencia)
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

                        <div class="card mb-3">
                            <h5 class="card-header">Representante Legal</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-2 col-md-6">
                                        <label for="cep" class="form-label">Nome</label>
                                        <input class="form-control form-control-sm" required type="text"
                                            id="nome_representante" name="nome_representante"
                                            value="{{ @$empresa->nome_representante }}" />
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="telefone_representante" @required(true)
                                            class="form-label">Telefone</label>
                                        <input class="form-control form-control-sm telefone" type="text"
                                            id="telefone_representante" name="telefone_representante"
                                            value="{{ @$empresa->telefone_representante }}" />
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
                                                        <label class="form-label" for="comprovanteresidencia"></label>
                                                        <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                            data-bs-placement='right' data-bs-html='true'
                                                            data-bs-original-title="Documento de identificação, admitido por lei, da pessoa habilitada, legalmente, a exercer a sua representação.">
                                                            <strong>02. Documento do representante</strong>
                                                            <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if (!@$empresa->doc_representante)
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="doc_representante"
                                                                name="doc_representante"
                                                                value="{{ @$empresa->doc_representante }}" />
                                                        @endif
                                                    </td>
                                                    @if (@$empresa->doc_representante)
                                                        <td>
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                                href="{{ url("storage/$empresa->doc_representante") }}">
                                                                <i class='bx bx-file'></i>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger remover"
                                                                data-tipo="empresa" data-arquivo="doc_representante"
                                                                data-nome="Documento do Representante"><i class='bx bx-x'></i>
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
                            <h5 class="card-header">Dados Bancários</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-2 col-md-3">
                                        <label for="banco" class="form-label">Banco</label>
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
                                        <input class="form-control form-control-sm" required type="text" id="agencia"
                                            name="agencia" value="{{ @$dadosbancarios->agencia }}" />
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="conta" class="form-label">Conta</label>
                                        <input class="form-control form-control-sm" required type="text" name="conta"
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
                                                        <span data-bs-toggle='tooltip' data-bs-offset='0,4'
                                                            data-bs-placement='right' data-bs-html='true'
                                                            data-bs-original-title="Extrato bancário contendo os dados do número de agência
                                                            e conta, devendo ser vinculado ao CNPJ da empresa Credenciante">
                                                            <strong>03. Comprovante de dados bancários</strong>
                                                            <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
                                                        </span>
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
                        </div>


                        <div class="card mb-3">
                            <h5 class="card-header">Documentos Necessários</h5>
                            <div class="card-body">

                                <div class="row">
                                    <div class="mb-2 col-md-12">
                                        <p style="color: #ff3e1d">Todos os arquivos devem estar no formato PDF.</p>
                                        <p style="color: #ff3e1d"> Os documentos de 01 ao 03 devem estar assinados
                                            digitalmente.</p>
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
                                                        <td><strong>04. Declaração de conhecimento das informações para cumprimento das obrigações</strong></td>
                                                        <td><a id="conhecimento_das_informacoes" style="display: none;" target="_blank" href="">baixar</a>
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
                                                        <td><strong>05. Declaração de trabalho de
                                                                menor</strong></td>
                                                        <td><a id="trabalho_de_menor" target="_blank" style="display: none;" href="">baixar</a>
                                                        </td>
                                                        <td>
                                                            @if (!@$empresa->doc_emp_tdm)
                                                                <input class="form-control form-control-sm" type="file"
                                                                    accept="application/pdf" id="doc_emp_tdm"
                                                                    name="doc_emp_tdm" value="" />
                                                            @endif
                                                        </td>
                                                        @if (@$empresa->doc_emp_tdm)
                                                            <td>
                                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                                    href="{{ url("storage/{$empresa->doc_emp_tdm}") }}">
                                                                    <i class='bx bx-file'></i> </a>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-danger remover"
                                                                    data-tipo="empresa" data-arquivo="doc_emp_tdm"
                                                                    data-nome='Declaração, na forma do Anexo "E", trabalho de menor'><i
                                                                        class='bx bx-x'></i>
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td><strong>06. Modelo de autorização para exposição de dados</strong></td>
                                                        <td><a id="exposicao_dados" target="_blank" style="display: none;" href="">baixar</a>
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
                                                                07. Documento de constituição da empresa
                                                            </strong>
                                                            <p>A depender do tipo jurídico da empresa, podendo ser os
                                                                seguintes:
                                                            <ul>
                                                                <li><b>Certificado de Condição de Microempreendedor
                                                                        Individual-MEI:</b>
                                                                    https://www.gov.br/empresas-e-negocios/pt-br/empreendedor/servicos-para-mei/emissao-de-comprovante-ccmei;
                                                                </li>
                                                                <li><b>Ato constitutivo, estatuto ou contrato social</b>, com
                                                                    sua
                                                                    última alteração – no caso de sociedade – devidamente
                                                                    registrado, e
                                                                    acompanhada de prova de constituição da diretoria em
                                                                    exercício;
                                                                </li>
                                                                <li><b>Inscrição no Registro Público de Empresas Mercantis</b>
                                                                    onde
                                                                    opera, com acompanhamento de cópia da averbação no Registro
                                                                    onde se situa a Matriz, no caso de a empresa ou a sociedade
                                                                    requerente ser
                                                                    filial ou sucursal;
                                                                </li>
                                                                <li>
                                                                    <b>Inscrição do ato constitutivo no Registro Civil das
                                                                        Pessoas
                                                                        Jurídicas</b>, acompanhada de prova de constituição da
                                                                    diretoria
                                                                    em exercício, no caso de sociedade sujeita àquele
                                                                    procedimento;
                                                                </li>
                                                                <li>
                                                                    <b>Decreto de autorização</b>, no caso de sociedade
                                                                    estrangeira em
                                                                    funcionamento em nosso País, e ato de registro ou
                                                                    autorização
                                                                    nesse
                                                                    sentido, expedido pelo órgão competente;
                                                                </li>
                                                            </ul>
                                                            </p>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            @if (!@$empresa->doc_emp_ccmei)
                                                                <input class="form-control form-control-sm" type="file"
                                                                    accept="application/pdf" id="doc_emp_ccmei"
                                                                    name="doc_emp_ccmei" value="" />
                                                            @endif
                                                        </td>
                                                        @if (@$empresa->doc_emp_ccmei)
                                                            <td>
                                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                                    href="{{ url("storage/{$empresa->doc_emp_ccmei}") }}">
                                                                    <i class='bx bx-file'></i> </a>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-danger remover"
                                                                    data-tipo="empresa" data-arquivo="doc_emp_ccmei"
                                                                    data-nome="Certificado de Condição de Microempreendedor Individual - MEI"><i
                                                                        class='bx bx-x'></i>
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td><strong>08. Cartão de inscrição no Cadastro Nacional de Pessoa
                                                                Juridica
                                                                - CNPJ</strong></td>
                                                        <td></td>
                                                        <td>
                                                            @if (!@$empresa->doc_emp_cicnpj)
                                                                <input class="form-control form-control-sm" type="file"
                                                                    accept="application/pdf" id="doc_emp_cicnpj"
                                                                    name="doc_emp_cicnpj" value="" />
                                                            @endif
                                                        </td>
                                                        @if (@$empresa->doc_emp_cicnpj)
                                                            <td>
                                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                                    href="{{ url("storage/{$empresa->doc_emp_cicnpj}") }}">
                                                                    <i class='bx bx-file'></i> </a>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-danger remover"
                                                                    data-tipo="empresa" data-arquivo="doc_emp_cicnpj"
                                                                    data-nome="Cartão de inscrição no Cadastro Nacional de Pessoa Juridica - CNPJ"><i
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
                                                                09. Certidão de inscrição no cadastro de contribuintes estadual ou municipal, correspondente a sede do interessado
                                                            </strong>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            @if (!@$empresa->doc_emp_ciccem)
                                                                <input class="form-control form-control-sm" type="file"
                                                                    accept="application/pdf" id="doc_emp_ciccem"
                                                                    name="doc_emp_ciccem" value="" />
                                                            @endif
                                                        </td>
                                                        @if (@$empresa->doc_emp_ciccem)
                                                            <td>
                                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                                    href="{{ url("storage/{$empresa->doc_emp_ciccem}") }}">
                                                                    <i class='bx bx-file'></i> </a>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-danger remover"
                                                                    data-tipo="empresa" data-arquivo="doc_emp_ciccem"
                                                                    data-nome="Certidão de inscrição no cadastro de contribuintes estadual ou municipal"><i
                                                                        class='bx bx-x'></i>
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td><strong>10. Certidão de regularidade com a fazenda federais</strong>
                                                        </td>
                                                        <td>
                                                            {{-- <a target="_blank"
                                                                href="https://solucoes.receita.fazenda.gov.br/Servicos/certidaointernet/PJ/Emitir">link</a> --}}
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
                                                                    data-nome="Certidão de regularidade com a Fazenda Federais"><i
                                                                        class='bx bx-x'></i>
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td><strong>11. Certidão de regularidade com a fazenda estadual</strong>
                                                        </td>
                                                        <td>
                                                            {{-- <a target="_blank"
                                                                href="https://internet-consultapublica.apps.sefaz.ce.gov.br/certidaonegativa/preparar-consultar">link</a> --}}
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
                                                                    data-nome="Certidão de regularidade com a Fazenda Estadual"><i
                                                                        class='bx bx-x'></i>
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td><strong>12. Certidão de regularidade com a fazenda municipal</strong>
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
                                                                    data-nome="Certidão de regularidade com a Fazenda Municipal"><i
                                                                        class='bx bx-x'></i>
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                    </tr>

                                                    <tr>
                                                        <td><strong>13. Certidão de regularidade relativa as contribuições para a seguridade social</strong></td>
                                                        <td></td>
                                                        <td>
                                                            @if (!@$empresa->doc_emp_crrcss)
                                                                <input class="form-control form-control-sm" type="file"
                                                                    accept="application/pdf" id="doc_emp_crrcss"
                                                                    name="doc_emp_crrcss" value="" />
                                                            @endif
                                                        </td>
                                                        @if (@$empresa->doc_emp_crrcss)
                                                            <td>
                                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                                    href="{{ url("storage/{$empresa->doc_emp_crrcss}") }}">
                                                                    <i class='bx bx-file'></i> </a>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-danger remover"
                                                                    data-tipo="empresa" data-arquivo="doc_emp_crrcss"
                                                                    data-nome="Certidão de regularidade relativa as contribuições para a Seguridade Social"><i
                                                                        class='bx bx-x'></i>
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td><strong>14. Certidão de regularidade com referência às contribuições para o FGTS</strong></td>
                                                        <td></td>
                                                        <td>
                                                            @if (!@$empresa->doc_emp_crrc)
                                                                <input class="form-control form-control-sm" type="file"
                                                                    accept="application/pdf" id="doc_emp_crrc"
                                                                    name="doc_emp_crrc" value="" />
                                                            @endif
                                                        </td>
                                                        @if (@$empresa->doc_emp_crrc)
                                                            <td>
                                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                                    href="{{ url("storage/{$empresa->doc_emp_crrc}") }}">
                                                                    <i class='bx bx-file'></i> </a>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-danger remover"
                                                                    data-tipo="empresa" data-arquivo="doc_emp_crrc"
                                                                    data-nome="Certidão de regularidade com referência às contribuições para o FGTS"><i
                                                                        class='bx bx-x'></i>
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td><strong>15. Certidão de inexistência de débitos inadimplidos perante a justiça do trabalho</strong></td>
                                                        <td></td>
                                                        <td>
                                                            @if (!@$empresa->doc_emp_cidijt)
                                                                <input class="form-control form-control-sm" type="file"
                                                                    accept="application/pdf" id="doc_emp_cidijt"
                                                                    name="doc_emp_cidijt" value="" />
                                                            @endif
                                                        </td>
                                                        @if (@$empresa->doc_emp_cidijt)
                                                            <td>
                                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                                    href="{{ url("storage/{$empresa->doc_emp_cidijt}") }}">
                                                                    <i class='bx bx-file'></i> </a>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-danger remover"
                                                                    data-tipo="empresa" data-arquivo="doc_emp_cidijt"
                                                                    data-nome="Certidão de inexistência de débitos inadimplios perante a justiça do trabalho"><i
                                                                        class='bx bx-x'></i>
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td><strong>16. Certificado de Registro no Sistema de Cadastramento
                                                                Unificado de Fornecedores (SICAF)</strong></td>
                                                        <td>
                                                            {{-- <a target="_blank"
                                                                href="https://www3.comprasnet.gov.br/sicaf-web/public/pages/consultas/consultarCRC.jsf">link</a> --}}
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
                                                    {{-- <tr>
                                                        <td><strong>14. Registro ou Inscrição junto à Agência Nacional de
                                                                Transporte
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
                                                    </tr> --}}
                                                    <tr>
                                                        <td><strong>17. Alvará de licença de funcionamento</strong></td>
                                                        <td></td>
                                                        <td>
                                                            @if (!@$empresa->doc_emp_alf)
                                                                <input class="form-control form-control-sm" type="file"
                                                                    accept="application/pdf" id="doc_emp_alf"
                                                                    name="doc_emp_alf" value="" />
                                                            @endif
                                                        </td>
                                                        @if (@$empresa->doc_emp_alf)
                                                            <td>
                                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                                    href="{{ url("storage/{$empresa->doc_emp_alf}") }}">
                                                                    <i class='bx bx-file'></i> </a>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-danger remover"
                                                                    data-tipo="empresa" data-arquivo="doc_emp_alf"
                                                                    data-nome="Alvará de licença de funcionamento"><i
                                                                        class='bx bx-x'></i>
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td><strong>18. Atestado de capacidade técnica</strong></td>
                                                        <td></td>
                                                        <td>
                                                            @if (!@$credenciamento->doc_act)
                                                                <input class="form-control form-control-sm" type="file"
                                                                    accept="application/pdf" id="doc_act" name="doc_act"
                                                                    value="" />
                                                            @endif
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
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                        Autorizo Comando Militar do Nordeste a expor meus dados como: NOME COMPLETO, CPF,
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
                                Salvar
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        @endif  
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script>


        var editais = {!! $editais !!};


        // $('#id_edital').on('change', function() {
        //     var editalId = this.value;

        //     if(editalId != ""){
        //         // var idestado = {!! @$credenciamento->id_estado??"0" !!}
        //         var edital = editais.find((x)=> x.id == editalId);
        //         // var estadoSelect = document.getElementById('estado');
        //         // Limpa as opções atuais do segundo select
        //         estadoSelect.innerHTML = '<option value="">Selecione...</option>';
        //         var estados = {!! json_encode($todosestados) !!};
        //         var filteredEstados = estados.filter(function(estado) {
        //             return estado.id_om == edital.id_om;
        //         });
        //         filteredEstados.forEach(function(estado) {
        //             var option = document.createElement('option');
        //             option.value = estado.id;
        //             option.textContent = estado.nome;
        //             estadoSelect.appendChild(option);
        //             if(estado.id == idestado){
        //                 option.selected = 'selected';
        //             }
        //         });
        //     }

        // });
        // $('#id_edital').change();
        


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
            var urlservidor = "{!! URL::to('/'); !!}" + "/storage/";
            var select = document.getElementById("id_edital").value;
            var elementoOculto = document.getElementById("descedital");
            if (select === "") {
                elementoOculto.style.display = "none";
            } else {
                elementoOculto.style.display = "block";
                var edital = editais.find((x) => x.id == select);
                $('#escnome').html(edital.om.nome);
                $('#nomeedital').html(edital.nome);
                $('#linkedital').attr('href',urlservidor + edital.documento);                
            }
            
            if(edital.om.anexos !== undefined ){
                    //anexo 1
                    // link = urlservidor + edital.anexos.requerimento_credenciamento;
                    // $("#requerimento_credenciamento").attr('href',link);

                    //anexo 2
                    link = urlservidor +  edital.om.anexos.conhecimento_das_informacoes;
                    $("#conhecimento_das_informacoes").attr('href',link);
                    $("#conhecimento_das_informacoes").show();
                    
                    //anexo 3
                    // link = urlservidor +  edital.anexos.condicao_do_veiculo;
                    // $("#condicao_do_veiculo").attr('href',link);

                    //anexo 4
                    link = urlservidor +  edital.om.anexos.exposicao_dados;
                    $("#exposicao_dados").attr('href',link);
                    $("#exposicao_dados").show();

                    //anexo 5
                    link = urlservidor +  edital.om.anexos.trabalho_de_menor;
                    $("#trabalho_de_menor").attr('href',link);
                    $("#trabalho_de_menor").show();
            }else{
                // $("#requerimento_credenciamento").hide();
                $("#conhecimento_das_informacoes").hide();
                // $("#condicao_do_veiculo").hide();
                $("#exposicao_dados").hide();
                $("#trabalho_de_menor").hide();
            }
        }
    </script>
@endsection
