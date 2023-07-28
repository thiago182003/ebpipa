@extends('layouts.default');

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administração /</span> Pendências</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Pendencias</h5>
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
                                                    <th class="col-5">Documento</th>
                                                    <th class="col-4">Situação</th>
                                                    <th class="col-3">Upload</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <input class="form-control form-control-sm" type="file"
                                                    accept="application/pdf" id="comprovanteresidencia"
                                                    name="comprovanteresidencia"
                                                    value="{{ @$endereco->comprovanteresidencia }}" />
                                                <button class="btn btn-sm btn-outline-danger remover" data-tipo="endereco"
                                                    data-arquivo="comprovanteresidencia"
                                                    data-nome="Comprovante de residência"><i class='bx bx-x'></i>
                                                </button> --}}
                                                @foreach ($pendencias as $pendencia)
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
                                                {{-- <tr>
                                                    <td><strong>Requerimento de Credenciamento</strong></td>
                                                    <td>Preenchimento errado</td>
                                                    <td><input class="form-control" type="file" id="nome"
                                                            name="nome" value="" /></td>

                                                </tr>
                                                <tr>
                                                    <td><strong>Foto da CNH Verso</td>
                                                    <td>Documento ilegível</td>
                                                    <td><input class="form-control" type="file" id="nome"
                                                            name="nome" value="" /></td>

                                                </tr>
                                                <tr>
                                                    <td><strong>Comprovante de Inscrição como Contribuinte Individual da
                                                            Previdência Social</strong></td>
                                                    <td>Documento Corrompido</td>
                                                    <td><input class="form-control" type="file" id="nome"
                                                            name="nome" value="" /></td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Salvar Mudanças</button>
                                {{-- <button type="reset" class="btn btn-outline-secondary">Cancelar</button> --}}
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>

            </div>
        </div>
    </div>
@endsection
