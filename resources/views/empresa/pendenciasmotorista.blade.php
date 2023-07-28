@extends('layouts.defaultemp')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administração /</span> Pendências do Motorista</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Pendencias da Empresa</h5>
                    <div class="card-body">
                        <form id="formAccountSettings" enctype="multipart/form-data" method="post"
                            action="{{ route('empresa.sanarpendenciasmotorista', ['id' => $pipeiro->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <p>*Favor reenviar documentos que se encontram em pendências</p>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="col-4">Documento</th>
                                                    <th class="col-3">Situação</th>
                                                    <th class="col-5">Upload</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pendenciasmotorista as $pendencia)
                                                    <tr>
                                                        <td>{{ $pendencia['nome'] }}</td>
                                                        <td>{{ $pendencia['obs'] }}</td>
                                                        <td>
                                                            <input class="form-control form-control-sm" type="file"
                                                                accept="application/pdf" id="{{ $pendencia['id'] }}"
                                                                name="{{ $pendencia['id'] }}" value="" />
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Salvar Mudanças</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- @if ($pendenciasMotoristas)
                    @foreach ($pendenciasMotoristas as $motoristas)
                        <div class="card mb-4">
                            <h5 class="card-header">Pendencias de {{ $motoristas[0]['dono'] }}</h5>
                            <div class="card-body">
                                <form id="formAccountSettings" enctype="multipart/form-data" method="post"
                                    action="{{ route('pipeiro.sanarpendencias') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <p>*Favor reenviar documentos que se encontram em pendências</p>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table table-sm table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-3"></th>
                                                            <th class="col-4">Documento</th>
                                                            <th class="col-3">Situação</th>
                                                            <th class="col-2">Upload</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($motoristas as $pendencia)
                                                            <tr>
                                                                <td>{{ $pendencia['dono'] }}</td>
                                                                <td>{{ $pendencia['nome'] }}</td>
                                                                <td>{{ $pendencia['obs'] }}</td>
                                                                <td>
                                                                    <input class="form-control form-control-sm"
                                                                        type="file" accept="application/pdf"
                                                                        id="{{ $pendencia['id'] }}"
                                                                        name="{{ $pendencia['id'] }}" value="" />
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Salvar Mudanças</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif --}}
            </div>
        </div>
    </div>
@endsection
