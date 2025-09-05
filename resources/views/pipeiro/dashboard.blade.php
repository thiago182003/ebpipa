@extends('layouts.default')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            @if ($pendencias)
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="alert alert-danger" role="alert">
                        <i class='bx bx-error'></i>
                        Seu credenciamento não poderá ser submetido enquanto houver pendências a resolver.
                        <i class='bx bx-error'></i>
                    </div>
                </div>
            @elseif(@$credenciamento->status == 3)
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="alert alert-warning" role="alert">
                        <i class='bx bx-error'></i>
                        Seu credenciamento está sendo analisado.
                        <i class='bx bx-error'></i>
                    </div>
                </div>
            @elseif(@$credenciamento->status == 1)
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="alert alert-success" role="alert">
                        Seu credenciamento foi aprovado.
                    </div>
                </div>
            @endif
            <div class="col-lg-12 col-md-12 order-1">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
                        <div class="card">
                            <a href="{{ route('pipeiro.credenciamentos') }}">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <span></span>
                                    <h3 class="card-title text-nowrap mb-1">Credenciamento</h3>
                                    <small class="text-success fw-semibold"> </small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
                        <div class="card">
                            <a href="{{ route('pipeiro.pendencias') }}">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    </div>
                                    <h3 class="card-title text-nowrap m-0 p-0">Pendências
                                        @if ($pendencias)
                                            <span class="badge ms-1 bg-danger sr-only">{{ count($pendencias) }}</span>
                                        @endif
                                    </h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
