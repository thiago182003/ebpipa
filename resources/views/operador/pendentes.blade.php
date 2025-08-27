@extends('layouts.defaultop');

@section('content')
    @include('componentes.mensagem')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administração /</span> Credenciamentos Pendentes
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
                                                    <th class="col-2">CPF/CNPJ</th>
                                                    <th>Nome</th>
                                                    <th class="col-1">Ver</th>
                                                    {{-- <th class="col-1">Aprovar</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($creds as $cred)
                                                    <tr>
                                                        {{-- {{ dd($cred) }} --}}
                                                        @if (!is_null($cred->id_pipeiro))
                                                            <td>{{ @$cred->pipeiro->id }}</td>
                                                            <td>{{ @$cred->pipeiro->cpf }}</td>
                                                            <td>{{ @$cred->pipeiro->nome }}</td>
                                                        @else
                                                            <td>{{ @$cred->empresa->id }}</td>
                                                            <td>{{ @$cred->empresa->cnpj }}</td>
                                                            <td>{{ @$cred->empresa->razaosocial }}</td>
                                                        @endif
                                                        <td>
                                                            <a href="{{ route('operador.cred', @$cred->id) }}"
                                                                class="btn btn-sm btn-icon btn-outline-primary">
                                                                <span class="tf-icons bx bx-edit"></span>
                                                            </a>
                                                        </td>
                                                        {{-- <td>
                                                            <a href="{{ route('operador.aprovar', @$cred->id) }}"
                                                                class="btn btn-sm btn-icon btn-outline-success">
                                                                <span class="tf-icons bx bx-check"></span>
                                                            </a>
                                                        </td> --}}
                                                    </tr>
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
