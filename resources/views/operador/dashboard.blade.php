@extends('layouts.defaultop')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 col-md-12 order-1">
                <div class="row">
                    <div class="col-lg-2 col-md-12 col-sm-12 mb-4">
                        <h2 class="card-title text-nowrap mb-1">Pessoa Fisica</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            {{-- <a href="{{ route('operador.credenciamentos') }}"> --}}
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h6 class="card-title text-nowrap mb-1">Iniciados</h6>
                                    <h1> {{ $fisica['iniciados'] }}</h1>
                                    <small class="text-success fw-semibold">  </small>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            {{-- <a href="{{ route('operador.credenciamentos') }}"> --}}
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h6 class="card-title text-nowrap mb-1">Aguardando Envio</h6>
                                    <h1> {{ $fisica['aguardando'] }}</h1>
                                    <small class="text-success fw-semibold">  </small>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            {{-- <a href="{{ route('operador.credenciamentos') }}"> --}}
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h6 class="card-title text-nowrap mb-1">Para Analise</h6>
                                    <h1> {{ $fisica['analise'] }}</h1>
                                    <small class="text-success fw-semibold">  </small>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            {{-- <a href="{{ route('operador.credenciamentos') }}"> --}}
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h6 class="card-title text-nowrap mb-1">Em Correção</h6>
                                    <h1> {{ $fisica['correcao'] }}</h1>
                                    <small class="text-success fw-semibold">  </small>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            {{-- <a href="{{ route('operador.credenciamentos') }}"> --}}
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h6 class="card-title text-nowrap mb-1">Corrigidos</h6>
                                    <h1> {{ $fisica['corrigido'] }}</h1>
                                    <small class="text-success fw-semibold">  </small>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            {{-- <a href="{{ route('operador.credenciamentos') }}"> --}}
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h6 class="card-title text-nowrap mb-1">Aprovados</h6>
                                    <h1> {{ $fisica['aprovados'] }}</h1>
                                    <small class="text-success fw-semibold">  </small>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <h2 class="card-title text-nowrap mb-1">Pessoa Juridica</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            {{-- <a href="{{ route('operador.credenciamentos') }}"> --}}
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h6 class="card-title text-nowrap mb-1">Iniciados</h6>
                                    <h1> {{ $juridica['iniciados'] }}</h1>
                                    <small class="text-success fw-semibold">  </small>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            {{-- <a href="{{ route('operador.credenciamentos') }}"> --}}
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h6 class="card-title text-nowrap mb-1">Aguardando Envio</h6>
                                    <h1> {{ $juridica['aguardando'] }}</h1>
                                    <small class="text-success fw-semibold">  </small>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            {{-- <a href="{{ route('operador.credenciamentos') }}"> --}}
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h6 class="card-title text-nowrap mb-1">Para Analise</h6>
                                    <h1> {{ $juridica['analise'] }}</h1>
                                    <small class="text-success fw-semibold">  </small>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            {{-- <a href="{{ route('operador.credenciamentos') }}"> --}}
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h6 class="card-title text-nowrap mb-1">Em Correção</h6>
                                    <h1> {{ $juridica['correcao'] }}</h1>
                                    <small class="text-success fw-semibold">  </small>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            {{-- <a href="{{ route('operador.credenciamentos') }}"> --}}
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h6 class="card-title text-nowrap mb-1">Corrigidos</h6>
                                    <h1> {{ $juridica['corrigido'] }}</h1>
                                    <small class="text-success fw-semibold">  </small>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            {{-- <a href="{{ route('operador.credenciamentos') }}"> --}}
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h6 class="card-title text-nowrap mb-1">Aprovados</h6>
                                    <h1> {{ $juridica['aprovados'] }}</h1>
                                    <small class="text-success fw-semibold">  </small>
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
