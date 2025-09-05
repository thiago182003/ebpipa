@extends('layouts.defaultop')

@section('content')
    @include('componentes.mensagem')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">    Cadastro /</span> Oms
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-2 col-md-3">
                    <input  id="pesquisa" name='pesquisa' class="form-control form-control-sm"
                        value="" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">Organizações Militares</h5>
                    <div class="card-body">
                        <div class="card-body">
                            {{-- <form id="formAccountSettings" method="post" action="{{ route('pipeiro.salvar') }}"> --}}
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <table id="tb-analise" class="table table-sm table-striped table-bordered">
                                        <thead>
                                            <tr> 
                                                <th class="col-1">Cred.</th>
                                                <th class="col-2">CPF</th>
                                                <th class="col">NOME</th>
                                                <th class="col">PF/PJ</th>
                                                <th class="col">placa</th>
                                                <th class="col">Municipio</th>
                                                <th class="col-2">STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($creds as $c)
                                                @if(!is_null($c->pipeiro))
                                                <tr>
                                                    <td>{{ $c->pipeiro->id }}</td>
                                                    <td>{{ $c->pipeiro->cpf }}</td>
                                                    <td>{{ $c->pipeiro->nome }}</td>
                                                    <td>{{ $c->empresa ? $c->empresa->razaosocial : "" }}</td>
                                                    <td>{{ $c->veiculo->placa }}</td>
                                                    <td>{{ $c->municipio->nome }}</td>
                                                    <td>{{ $c->status}}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>


        </div>
        
    @endsection
