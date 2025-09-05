@extends('layouts.default')

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
            <form id="form-credenciar" method="post" enctype="multipart/form-data"
                action="{{ route('pipeiro.credenciar') }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="mb-2 col-md-6">
                                        <label for="id_edital" class="form-label">Edital</label>
                                        <input type="hidden" name="input_id_edital" id="input_id_edital" value="{{@$credenciamento->id_edital}}">
                                        <select required id="id_edital" name='id_edital'
                                            class="select2 form-select form-select-sm" onchange="selecionaEdital()">
                                            <option value="">Selecione...</option>
                                            @foreach ($editais as $ed)
                                                <option value="{{ $ed->id }}" @selected($ed->id == @$credenciamento->id_edital)>
                                                    {{ $ed->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div id="descedital" class="card mb-3" @if(empty($credenciamento->id_edital)) style="display: none;" @endif>
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
                                            <input required class="form-check-input" type="checkbox" id="ciente"
                                                name="ciente" />
                                            <label class="form-check-label" required for="ciente"> <b>Declaro estar
                                                    ciente</b>
                                            </label>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        {{-- estou aqui --}}
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="id_credenciamento" id="id_credenciamento" value="{{ @$credenciamento->id }}">
                                    <input type="hidden" name="novo" id="novo" value="{{ @$novo }}">
                                    <div class="mb-2 col-md-6">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select required id="estado" name='estado'
                                            class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                        </select>
                                    </div>
                                    <div class="mb-2 col-md-6">
                                        <label for="municipio" class="form-label">Municipio Desejado</label>
                                        {{-- <select @required(true) id="municipio" name='municipio' class="select2 form-select"> --}}
                                        <select required id="municipio" name='municipio'
                                            class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
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
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input class="form-control form-control-sm" type="text" name="cpf" id="cpf" 
                                            value="{{ $pipeiro->cpf }}" disabled />
                                    </div>
                                    <div class="mb-2 col-md-6">
                                        <label for="nome" class="form-label">Nome Completo</label>
                                        <input class="form-control form-control-sm" required type="text" id="nome" name="nome" 
                                            value="{{ $pipeiro->nome }}" />
                                        <input type="hidden" id="id" name="id" value="{{ $pipeiro->id }}">
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control form-control-sm" required type="email" id="email" 
                                            name="email" value="{{ $pipeiro->email }}" placeholder="john.doe@example.com" />
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="estadocivil" class="form-label">Estado Civil</label>
                                        <select id="estadocivil" name="estadocivil" class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($estadocivil as $estado => $x)
                                                <option value="{{ $x }}" {{ $x == $pipeiro->estadocivil ? 'selected' : '' }}>
                                                    {{ $estado }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="telefone" class="form-label">Telefone/Whatsapp</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="telefone" name="telefone" class="form-control form-control-sm telefone"
                                                placeholder="(xx) xxxx-xxxxx" required value="{{ $pipeiro->telefone }}" />
                                        </div>
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="raca" class="form-label">Etnia</label>
                                        <select id="raca" name="raca" class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($raca as $r => $x)
                                                <option value="{{ $x }}" {{ $x == $pipeiro->raca ? 'selected' : '' }}>
                                                    {{ $r }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="escolaridade" class="form-label">Escolaridade</label>
                                        <select id="escolaridade" name="escolaridade" class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($escolaridade as $esc => $x)
                                                <option value="{{ $x }}" {{ $x == $pipeiro->escolaridade ? 'selected' : '' }}>
                                                    {{ $esc }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="genero" class="form-label">Gênero</label>
                                        <select id="genero" name="genero" class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($genero as $gen => $x)
                                                <option value="{{ $x }}" {{ $x == $pipeiro->genero ? 'selected' : '' }}>
                                                    {{ $gen }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="dtnascimento" class="form-label">Data Nascimento</label>
                                        <div class="input-group input-group-merge">
                                            <input type="date" id="dtnascimento" name="dtnascimento" 
                                                class="form-control form-control-sm" value="{{ $pipeiro->dtnascimento }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <h5 class="card-header">Endereço</h5>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="id_endereco" id="id_endereco" value="{{ @$credenciamento->endereco->id }}" />
                                    <div class="mb-2 col-md-3">
                                        <label for="cep" class="form-label">Cep</label>
                                        <input class="form-control form-control-sm" type="text" id="cep" name="cep" 
                                            value="{{ @$credenciamento->endereco->cep }}" />
                                    </div>
                                    <div class="mb-2 col-md-6">
                                        <label for="logradouro" class="form-label">Logradouro</label>
                                        <input class="form-control form-control-sm" type="text" id="logradouro" 
                                            name="logradouro" value="{{ @$credenciamento->endereco->logradouro }}" />
                                    </div>
                                    <div class="mb-2 col-md-2">
                                        <label for="numero" class="form-label">N°</label>
                                        <input class="form-control form-control-sm" type="text" name="numero" 
                                            id="numero" value="{{ @$credenciamento->endereco->numero }}" />
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="bairro" class="form-label">Bairro</label>
                                        <input class="form-control form-control-sm" type="text" name="bairro" 
                                            id="bairro" value="{{ @$credenciamento->endereco->bairro }}" />
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input class="form-control form-control-sm" type="text" name="cidade" 
                                            id="cidade" value="{{ @$credenciamento->endereco->cidade }}" />
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label class="form-label" for="estadores">Estado</label>
                                        <select id="estadores" name="estadores" class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($todosestados as $estado)
                                                <option value="{{ $estado->id }}" {{ $estado->id == @$credenciamento->endereco->estado ? 'selected' : '' }}>
                                                    {{ $estado->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2 col-md-12">
                                        <table class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th class="col-4">Upload</th>
                                                    <th class="col-1">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <x-document-table :documento="@$credenciamento->endereco->comprovanteresidencia" descricao="01. Comprovante de residência" titulo="Comprovante de residência de titularidade do requerente. Caso não possuir tal comprovante no nome do requerente, anexar à declaração de residência em arquivo PDF e assinado digitalmente." tipo="endereco" name="comprovanteresidencia" />
                                            </tbody>
                                        </table>
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
                                                    <th class="col-1">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <x-document-table :documento="@$pipeiro->cnhfrente" descricao="02. Carteira Nacional de Habilitação (CNH)" titulo="A CNH deverá constar no campo observações: EAR (Exerce Atividade Remunerada)." tipo="pipeiro" name="cnhfrente"/>
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
                                <input type="hidden" id="id_veiculo" name="id_veiculo" value="{{ @$credenciamento->veiculo->id }}" />
                                <div class="row">
                                    <div class="mb-2 col-md-3">
                                        <label for="placa" class="form-label">Placa</label>
                                        <input class="form-control form-control-sm" type="text" id="placa"
                                            name="placa" value="{{ @$credenciamento->veiculo->placa }}" />
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="marca" class="form-label">Marca/Modelo</label>
                                        <input class="form-control form-control-sm" type="text" id="marca"
                                            name="marca" value="{{ @$credenciamento->veiculo->marca }}" />
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="ano" class="form-label">Ano de Fabricação</label>
                                        <input class="form-control form-control-sm" type="text" name="ano"
                                            id="ano" value="{{ @$credenciamento->veiculo->ano }}" />
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="chassi" class="form-label">Chassi</label>
                                        <input class="form-control form-control-sm" type="text" name="chassi"
                                            id="chassi" value="{{ @$credenciamento->veiculo->chassi }}" minlength="12"
                                            maxlength="17" />
                                    </div>
                                    <div class="mb-2 col-md-12">
                                        <table class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th class="col-4">Upload</th>
                                                    <th class="col-1">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="4">O CRLV está no nome do motorista?
                                                        <div class="form-check form-check-inline">
                                                            <input name="proprio"
                                                                class="form-check-input form-check-input-sm"
                                                                type="radio" value="1" id="rd-sim"
                                                                @if (@$credenciamento->veiculo) @checked($credenciamento->veiculo->proprio == 1) /> @endif
                                                                <label class="form-check-label " for="rd-sim"> Sim
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="proprio" class="form-check-input" type="radio"
                                                                value="0"
                                                                id="rd-nao"@if (@$credenciamento->veiculo) @checked($credenciamento->veiculo->proprio == 0) @endif />
                                                            <label class="form-check-label" for="rd-nao"> Não </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <x-document-table :documento="@$credenciamento->veiculo->doc_crlv" descricao="03. Certificado de Registro e Licenciamento Veicular (CRLV)" titulo="Deverá constar, nos campos CATEGORIA e CARROCERIA, as modalidades “aluguel” e “tanque” respectivamente." tipo="veiculo" name="doc_crlv" />
                                                <x-document-table :documento="@$credenciamento->veiculo->doc_lav" descricao="04. Laudo de aferição de volume do tanque" titulo="O laudo de capacidade volumétrica do tanque do caminhão deverá ser expedido por órgão público ou por empresa por este credenciada e deverá possuir QR Code ou outro meio eficaz de averiguar a autenticidade, bem como deve constar o número de um lacre posicionado pela instituição que fez a aferição." tipo="veiculo" name="doc_lav" />
                                                <x-document-table :documento="@$credenciamento->veiculo->veiculo_img" descricao="05. Foto do caminhão" titulo="Comprovante de residência de titularidade do requerente. Caso não possuir tal comprovante no nome do requerente, anexar à declaração de residência em arquivo PDF e assinado digitalmente." tipo="veiculo" name="veiculo_img" foto="true"/>
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
                                    value="{{ @$credenciamento->dadosbancarios->id }}" />
                                <div class="row">
                                    <div class="mb-2 col-md-3">
                                        <label for="banco" class="form-label">Banco</label>
                                        <select id="banco" name='banco'
                                            class="select2 form-select form-select-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($bancos as $banco)
                                                <option {{ $banco->id == @$credenciamento->dadosbancarios->banco ? 'selected' : '' }}
                                                    value={{ $banco->id }}>{{ $banco->nome }}
                                                    ({{ str_pad($banco->codigo, 3, '0', STR_PAD_LEFT) }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="agencia" class="form-label">Agencia</label>
                                        <input class="form-control form-control-sm" type="text" id="agencia"
                                            name="agencia" value="{{ @$credenciamento->dadosbancarios->agencia }}" />
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="conta" class="form-label">Conta</label>
                                        <input class="form-control form-control-sm" type="text" name="conta"
                                            id="conta" value="{{ @$credenciamento->dadosbancarios->conta }}" />
                                    </div>
                                    <div class="mb-2 col-md-12">
                                        <table class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th class="col-4">Upload</th>
                                                    <th class="col-1">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <x-document-table :documento="@$credenciamento->dadosbancarios->doc_comprovante" descricao="06. Comprovante de dados bancários" titulo="Será necessário fornecer apenas o extrato da conta corrente do requerente, que deve conter as informações do Banco, Agência e número da conta. Não serão aceitas Contas Salário, Contas Poupança ou contas com limite de movimentação para o recebimento dos créditos relacionados à prestação dos serviços. Não enviar foto do cartão, nem do CVV" tipo="dadosbancarios" name="doc_comprovante" />
                                            </tbody>
                                        </table>
                                    </div>

                                </div>


                            </div>
                            <!-- /Account -->
                        </div>

                        <div class="card mb-3">
                            <h5 class="card-header">Documentos Necessários</h5>
                            <div class="card-body">

                                <div class="row">
                                    <div class="mb-2 col-md-12">
                                        <p style="color: #ff3e1d">Todos os arquivos devem estar no formato PDF. E no maximo de 5mb.</p>
                                        <p style="color: #ff3e1d"> Os documentos de 01 ao 04 devem estar assinados
                                            digitalmente.</p>
                                    </div>
                                </div>
                                <div class="mb-2 col-md-12">
                                    <div class="">
                                        <table class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th class="col-1">Modelo</th>
                                                    <th class="col-4">Upload</th>
                                                    <th class="col-1">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <x-document-table :documento="@$credenciamento->doc_reqcred"
                                                    descricao="07. Requerimento de credenciamento" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_reqcred"
                                                    anexo="requerimento_credenciamento" />
                                                <x-document-table :documento="@$credenciamento->doc_cico"
                                                    descricao="08. Declaração de conhecimento das informações para cumprimento das obrigações" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_cico"
                                                    anexo="conhecimento_das_informacoes" />
                                                <x-document-table :documento="@$credenciamento->doc_drctvc"
                                                    descricao="09. Termo de declaração e responsabilidade das condições de trafegabilidade do veículo a ser credenciado" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_drctvc"
                                                    anexo="condicao_do_veiculo" />
                                                <x-document-table :documento="@$credenciamento->doc_maed"
                                                    descricao="10. Modelo de autorização para exposição de dados" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_maed"
                                                    anexo="exposicao_dados" />
                                                <x-document-table :documento="@$credenciamento->doc_cicips"
                                                    descricao="11. Comprovante de Inscrição como Contribuinte Individual da Previdência Social (CNIS)" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_cicips"
                                                    modelo="https://cnisnet.inss.gov.br/cnisinternet/faces/pages/perfil.xhtml" />
                                                <x-document-table :documento="@$credenciamento->doc_cqe"
                                                    descricao="12. Certidão de quitação eleitoral" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_cqe"
                                                    modelo="https://www.tse.jus.br/servicos-eleitorais/certidoes/certidao-de-quitacao-eleitoral" />
                                                <x-document-table :documento="@$credenciamento->doc_cqsm"
                                                    descricao="13. Certidão de quitação com o serviço militar (para o sexo masculino)" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_cqsm"
                                                    modelo="https://alistamento.eb.mil.br/lista-servicos" />
                                                <x-document-table :documento="@$credenciamento->doc_sicaf"
                                                    descricao="14. Certificado de Registro no Sistema de Cadastramento Unificado de Fornecedores (SICAF)" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_sicaf"
                                                    modelo="https://www3.comprasnet.gov.br/sicaf-web/public/pages/consultas/consultarCRC.jsf" />
                                                <x-document-table :documento="@$credenciamento->doc_ciscc"
                                                    descricao="15. Comprovante de situação cadastral no CPF" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_ciscc"
                                                    modelo="https://servicos.receita.fazenda.gov.br/servicos/cpf/consultasituacao/consultapublica.asp" />
                                                <x-document-table :documento="@$credenciamento->doc_cndf"
                                                    descricao="16. Certidão de regularidade para com a fazenda federal" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_cndf"
                                                    modelo="https://solucoes.receita.fazenda.gov.br/servicos/certidaointernet/pj/emitir" />
                                                <x-document-table :documento="@$credenciamento->doc_cnde"
                                                    descricao="17. Certidão de regularidade para com a fazenda estadual" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_cnde"
                                                    modelo="vazio" />
                                                <x-document-table :documento="@$credenciamento->doc_cndm"
                                                    descricao="18. Certidão de regularidade para com a fazenda municipal" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_cndm"
                                                    modelo="vazio" />
                                                <x-document-table :documento="@$credenciamento->doc_cidt"
                                                    descricao="19. Certidão de inexistência de débitos trabalhistas" 
                                                    titulo="" 
                                                    tipo="credenciamento" 
                                                    name="doc_cidt"
                                                    modelo="https://www.tst.jus.br/certidao1" />
                                                <x-document-table :documento="@$credenciamento->doc_antt"
                                                    descricao="20. Registro ou Inscrição junto à Agência Nacional de Transporte Terrestre (ANTT)" 
                                                    titulo="Em caso de caminhão alugado deverá constar no campo TACs AUXILIARES o nome do requerente." 
                                                    tipo="credenciamento" 
                                                    name="doc_antt"
                                                    modelo="https://rntrcdigital.antt.gov.br/" />
                                                <x-document-table :documento="@$credenciamento->doc_lvs"
                                                    descricao="21. Laudo da vigilância sanitária" 
                                                    titulo="O laudo da Vigilância Sanitária deverá ser expedido pelo Município pleiteado ao credenciamento
                                                                para transportar água potável. Em caso de credenciamento para os municípios do Estado de
                                                                Alagoas, o laudo deverá ser expedido pela Gerência de Vigilância Sanitária do Estado de Alagoas –
                                                                GVISA/AL." 
                                                    tipo="credenciamento" 
                                                    name="doc_lvs"
                                                    modelo="vazio" />
                                                <x-document-table :documento="@$credenciamento->doc_cl"
                                                    descricao="22. Contrato de locação do veículo" 
                                                    titulo="Em caso do interessado não ser o proprietário do caminhão, deverá ser apresentado Contrato de locação do veículo do veículo, a depender da relação jurídica que exista entre as partes, registrado em cartório entre o proprietário e possuidor temporário do veículo.
                                                                O prazo de vigência do Contrato de locação do veículo do veículo deverá ser no mínimo entre a data do Requerimento de Credenciamento até o dia 31 de dezembro de 2024.   
                                                                O Contrato de locação do veículo do veículo deverá ser digitalizado e anexado em arquivo PDF." 
                                                    tipo="credenciamento" 
                                                    name="doc_cl"
                                                    modelo="vazio" />
                                                <x-document-table :documento="@$credenciamento->doc_act"
                                                    descricao="23. Atestado de capacidade técnica" 
                                                    titulo="Obrigatório apenas para quem nunca trabalhou na Operação Carro-pipa" 
                                                    tipo="credenciamento" 
                                                    name="doc_act"
                                                    modelo="vazio" />
                                            </tbody>
                                        </table>
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
                        <!-- /Account -->
                    </div>
                    <div class="mt-2 save-now">
                        <button type="submit" class="btn btn-primary btn-save-now"><i class='bx bx-save'></i>
                            Salvar</button>
                    </div>
                    <div id="overlay"  style="display: none;">
                        <div class="spinner"></div>
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

            function mudaEstado(id){
                var municipioSelect = document.getElementById('municipio');
                var estadoId = id;
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
            }

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
                    link = urlservidor + edital.om.anexos.requerimento_credenciamento;
                    $("#requerimento_credenciamento").attr('href',link);
                    $("#requerimento_credenciamento").show();

                    //anexo 2
                    link = urlservidor +  edital.om.anexos.conhecimento_das_informacoes;
                    $("#conhecimento_das_informacoes").attr('href',link);
                    $("#conhecimento_das_informacoes").show();
                    
                    //anexo 3
                    link = urlservidor +  edital.om.anexos.condicao_do_veiculo;
                    $("#condicao_do_veiculo").attr('href',link);
                    $("#condicao_do_veiculo").show();

                    //anexo 4
                    link = urlservidor +  edital.om.anexos.exposicao_dados;
                    $("#exposicao_dados").attr('href',link);
                    $("#exposicao_dados").show();

                    //anexo 5
                    // link = urlservidor +  edital.om.anexos.trabalho_de_menor;
                    // $("#trabalho_de_menor").attr('href',link);
                    // $("#trabalho_de_menor").show();
                }else{
                    $("#requerimento_credenciamento").hide();
                    $("#conhecimento_das_informacoes").hide();
                    $("#condicao_do_veiculo").hide();
                    $("#exposicao_dados").hide();
                    // $("#trabalho_de_menor").hide();
                }


                if(select != ""){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post('{{ route('pipeiro.carregarmunicipios') }}', {
                        id: select,
                    }).done(function(response) {
                        estados = response.estados;
                        municipios = response.municipios;
                        var idestado = {!! json_encode($credenciamento->id_estado ?? "0") !!};

                        let html = "<option>Selecione...</option>";
                        estados.forEach(function(e) {
                            // $("#estado").append("<option value='" + e.id + "'>" + e.nome + "</option>");
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
                        option.disabled = edital && edital.credenciado == 1;
                    }
                });

                
            });

            $('#id_edital').change();
            
            $(".remover").on("click", function(e) {
                e.preventDefault();
                let tipo = $(this).data("tipo");
                let id = 0;
                if (tipo == "credenciamento") {
                    id = {{ @$credenciamento->id ?? '0' }};
                } else if (tipo == "endereco") {
                    id = {{ @$credenciamento->endereco->id ?? '0' }};
                } else if (tipo == "dadosbancarios") {
                    id = {{ @$credenciamento->dadosbancarios->id ?? '0' }};
                } else if (tipo == "veiculo") {
                    id = {{ @$credenciamento->veiculo->id ?? '0' }};
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

            $('#form-credenciar').submit(function(e){
                $('#overlay').show();
                var count = 0;
                var inputsFile = this.querySelectorAll('input[type="file"]');
                inputsFile.forEach(function(input) {
                    if (input.files.length > 0) {
                        for (var i = 0; i < input.files.length; i++) {
                            var arquivo = input.files[i];
                            if(arquivo.size > 1024 * 1014 * 5){
                                count++;
                                var texto = input.parentNode.innerHTML.trim();
                                var msg = '<span class="msgarquivo">O arquivo é maior que 5mb</span>';
                                texto = texto.replace(msg,"");
                                input.parentNode.innerHTML = texto + msg;
                            }
                        }
                        if(count > 0){
                            e.preventDefault();
                            $('#overlay').hide();
                            return false;
                        }
                    }
                });
            });

            
    </script>
    
@endsection