@extends('layouts.defaultop');

@section('content')
    @include('componentes.mensagem')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administração /</span> Credenciamentos PJ
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Credenciamentos para análise</h5>
                    <div class="card-body">
                        <div class="card-body">
                            {{-- <form id="formAccountSettings" method="post" action="{{ route('pipeiro.salvar') }}"> --}}
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">Inscrição</th>
                                                    <th>Nome</th>
                                                    <th class="col-1">Analisar</th>
                                                    <th class="col-1">Aprovar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($creds as $cred)
                                                    @if ($cred->status == 3)
                                                        <tr>
                                                            <td>{{ @$cred->pipeiro->id }}</td>
                                                            <td>{{ @$cred->pipeiro->nome }}</td>
                                                            <td>
                                                                <a href="{{ route('operador.cred', @$cred->id) }}"
                                                                    class="btn btn-sm btn-icon btn-outline-primary">
                                                                    <span class="tf-icons bx bx-edit"></span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('operador.aprovar', @$cred->id) }}"
                                                                    class="btn btn-sm btn-icon btn-outline-success">
                                                                    <span class="tf-icons bx bx-check"></span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            {{-- </form> --}}
                        </div>
                        <!-- /Account -->
                    </div>

                </div>
            </div>


            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Em correção</h5>
                    <div class="card-body">
                        <div class="card-body">
                            {{-- <form id="formAccountSettings" method="post" action="{{ route('pipeiro.salvar') }}"> --}}
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">Inscrição</th>
                                                    <th>Nome</th>
                                                    <th class="col-1">Ver</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($creds as $cred)
                                                    @if ($cred->status == 2)
                                                        <tr>
                                                            <td>{{ @$cred->pipeiro->id }}</td>
                                                            <td>{{ @$cred->pipeiro->nome }}</td>
                                                            <td>
                                                                <a href="{{ route('operador.cred', @$cred->id) }}"
                                                                    class="btn btn-sm btn-icon btn-outline-primary">
                                                                    <span class="tf-icons bx bx-edit"></span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            {{-- </form> --}}
                        </div>
                        <!-- /Account -->
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Credenciamentos Aprovados</h5>
                    <div class="card-body">
                        <div class="card-body">
                            {{-- <form id="formAccountSettings" method="post" action="{{ route('pipeiro.salvar') }}"> --}}
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">Inscrição</th>
                                                    <th>Nome</th>
                                                    <th class="col-1">ver</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($creds as $cred)
                                                    @if ($cred->status == 1)
                                                        <tr>
                                                            <td>{{ @$cred->pipeiro->id }}</td>
                                                            <td>{{ @$cred->pipeiro->nome }}</td>
                                                            <td>
                                                                <a href="{{ route('operador.cred', @$cred->id) }}"
                                                                    class="btn btn-sm btn-icon btn-outline-primary">
                                                                    <span class="tf-icons bx bx-edit"></span>
                                                                </a>
                                                            </td>

                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            {{-- </form> --}}
                        </div>
                        <!-- /Account -->
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Credenciamentos com pendências</h5>
                    <div class="card-body">
                        <div class="card-body">
                            {{-- <form id="formAccountSettings" method="post" action="{{ route('pipeiro.salvar') }}"> --}}
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Situação</th>
                                                    <th>ver</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($creds as $cred)
                                                    @if ($cred->status == 99)
                                                        <tr>
                                                            <td>{{ @$cred->pipeiro->nome }}</td>
                                                            <td>{{ @$cred->situacao }}</td>
                                                            <td>
                                                                <a href="{{ route('operador.cred', @$cred->id) }}"
                                                                    class="btn btn-sm btn-icon btn-outline-primary">
                                                                    <span class="tf-icons bx bx-edit"></span>
                                                                </a>
                                                            </td>

                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            {{-- </form> --}}
                        </div>
                        <!-- /Account -->
                    </div>

                </div>
            </div>
        </div>
    @endsection
