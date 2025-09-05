@extends('layouts.default')

@php
    $estadocivil = [
        'Solteiro' => '1',
        'Casado' => '2',
        'União Estável' => '3',
        'Outro' => '4',
    ];
    
    $raca = [
        'Amarelo' => '1',
        'Branco' => '2',
        'Indio' => '3',
        'Pardo' => '4',
        'Negro' => '5',
        'Outros' => '6',
    ];
    
    $escolaridade = [
        'Ensino Fundamental' => '1',
        'Ensino Fundamental Incomleto' => '2',
        'Ensino Médio' => '3',
        'Ensino Médio Incompleto' => '4',
        'Ensino Superior' => '5',
        'Ensino Superior Incompleto' => '6',
        'Outro' => '7',
    ];
@endphp

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Meu Perfil</h4>

        <div class="row">
            <div class="col-md-12">
                @include('componentes.mensagem')
                <form id="formAccountSettings" method="post" action="{{ route('pipeiro.salvar') }}">
                    @csrf

                    <div class="card mb-3">
                        <h5 class="card-header">Detalhes do Perfil</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                @if ($pipeiro->img)
                                    <img src="{{ url("storage/{$pipeiro->img}") }}" alt="user-avatar"
                                        class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                @else
                                    <img src="/img/avatars/user.png" alt="user-avatar" class="d-block rounded"
                                        height="100" width="100" id="uploadedAvatar" />
                                @endif
                                <div class="button-wrapper">
                                    <label for="imagem_pipeiro" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Carregar nova Foto</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="imagem_pipeiro" name="imagem_pipeiro"
                                            class="account-file-input" hidden accept="image/png, image/jpeg" />
                                    </label>
                                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">resetar foto</span>
                                    </button>

                                    <p class="text-muted mb-0">Permitido formatos JPG, GIF or PNG.</p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Nome Completo</label>
                                    <input class="form-control" type="text" id="nome" name="nome"
                                        value="{{ $pipeiro->nome }}" />
                                    <input type="hidden" id="id" name='id' value="{{ $pipeiro->id }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input class="form-control" type="text" name="cpf" id="cpf"
                                        value="{{ $pipeiro->cpf }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ $pipeiro->email }}" placeholder="john.doe@example.com" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Estado Civil</label>
                                    <select id="estadocivil" name='estadocivil' class="select2 form-select">
                                        <option value="">Selecione...</option>
                                        @foreach ($estadocivil as $estado => $x)
                                            @if ($x == $pipeiro->estadocivil)
                                                <option value={{ $x }} selected>{{ $estado }}</option>
                                            @else
                                                <option value={{ $x }}>{{ $estado }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Telefone/Whatsapp</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">BR (+55)</span>
                                        <input type="text" id="telefone" name="telefone" class="form-control"
                                            placeholder="(xx) xxxx-xxxxx" value="{{ $pipeiro->telefone }}" />
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="raca" class="form-label">Raça</label>
                                    <select id="raca" name='raca' class="select2 form-select">
                                        <option value="">Selecione...</option>
                                        @foreach ($raca as $r => $x)
                                            @if ($x == $pipeiro->raca)
                                                <option value={{ $x }} selected>{{ $r }}</option>
                                            @else
                                                <option value={{ $x }}>{{ $r }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="escolaridade" class="form-label">Escolaridade</label>
                                    <select id="escolaridade" name='escolaridade' class="select2 form-select">
                                        <option value="">Selecione...</option>
                                        @foreach ($escolaridade as $esc => $x)
                                            @if ($x == $pipeiro->escolaridade)
                                                <option value={{ $x }} selected>{{ $esc }}</option>
                                            @else
                                                <option value={{ $x }}>{{ $esc }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="genero" class="form-label">Genero</label>
                                    <select id="genero" name='genero' class="select2 form-select">
                                        <option value="">Selecione...</option>
                                        @foreach ($genero as $gen => $x)
                                            @if ($x == $pipeiro->genero)
                                                <option value={{ $x }} selected>{{ $gen }}</option>
                                            @else
                                                <option value={{ $x }}>{{ $gen }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /Account -->
                    </div>

                    <div class="card mb-3">
                        <h5 class="card-header">Endereço</h5>
                        <div class="card-body">
                            <div class="row">
                                <input class="form-control" type="hidden" name="id_endereco" id="id_endereco"
                                    value="{{ @$endereco->id }}" />
                                <div class="mb-3 col-md-4">
                                    <label for="cep" class="form-label">Cep</label>
                                    <input class="form-control" type="text" id="cep" name="cep"
                                        value="{{ @$endereco->cep }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="logradouro" class="form-label">Logradouro</label>
                                    <input class="form-control" type="text" id="logradouro" name="logradouro"
                                        value="{{ @$endereco->logradouro }}" />
                                </div>
                                <div class="mb-3 col-md-2">
                                    <label for="numero" class="form-label">N°</label>
                                    <input class="form-control" type="text" name="numero" id="numero"
                                        value="{{ @$endereco->numero }}" />
                                </div>
                                <div class="mb- 3 col-md-4">
                                    <label for="bairro" class="form-label">Bairro</label>
                                    <input class="form-control" type="text" name="bairro" id="bairro"
                                        value="{{ @$endereco->bairro }}" />
                                    {{-- <select id="bairro" name='bairro' class="select2 form-select">
                      <option value="">Selecione...</option>
                    </select> --}}
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input class="form-control" type="text" name="cidade" id="cidade"
                                        value="{{ @$endereco->cidade }}" />
                                    {{-- <select id="cidade" name='cidade' class="select2 form-select">
                      <option value="">Selecione...</option>
                    </select> --}}
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="estadores">Estado</label>
                                    <input class="form-control" type="text" name="estadores" id="estadores"
                                        value="{{ @$endereco->estado }}" />
                                    {{-- <select id="estadores" name='estadores' class="select2 form-select">
                      <option value="">Selecione...</option>
                    </select> --}}
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="comprovanteresidencia">Comprovante de
                                        residência</label>
                                    <input class="form-control" type="file" accept="application/pdf"
                                        id="comprovanteresidencia" name="comprovanteresidencia" value="" />
                                </div>
                                @if (@$endereco->comprovanteresidencia)
                                    <div class="mb-1 col-md-1">
                                        <label class="form-label" for="estadores">Ver</label>
                                        <a target="_blank" class="btn btn-primary"
                                            href="{{ url("storage/{$endereco->comprovanteresidencia}") }}">
                                            <i class='bx bx-file'></i>
                                        </a>
                                    </div>
                                    <div class="mb-1 col-md-1">
                                        <label class="form-label" for="estadores">Excluir</label>
                                        <button class="btn btn-outline-danger remover" data-tipo="endereco"
                                            data-arquivo="comprovanteresidencia" data-nome="Comprovate de Residência"><i
                                                class='bx bx-x'></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- /Account -->
                    </div>
                    <div class="mt-2 save-now">
                        <button type="submit" class="btn btn-primary btn-save-now"><i class='bx bx-save'></i>
                            Salvar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
