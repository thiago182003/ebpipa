@extends('layouts.defaultemp')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administração /</span> Motoristas</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Motoristas</h5>
                    <div class="card-body">
                        {{-- <form id="formAccountSettings" method="post" action="{{ route('empresa.addmotorista') }}"> --}}
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="col-2">cpf</th>
                                                <th>nome</th>
                                                <th class="col-1">status</th>
                                                <th class="col-1">pendencias</th>
                                                <th class="col-1">cadastro</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($motoristas as $mot)
                                                <tr>
                                                    <td>{{ $mot->cpf }}</td>
                                                    <td>{{ $mot->nome }}</td>
                                                    <td></td>
                                                    <td><span
                                                            class="badge bg-danger ms-1">{{ count($mot->pendencias) }}</span>
                                                        <a href="{{ route('empresa.pendenciamotorista', $mot->id) }}"
                                                            class="btn btn-sm btn-icon btn-outline-danger">
                                                            <span class="tf-icons bx bx-edit"></span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('empresa.editmotorista', $mot->id) }}"
                                                            class="btn btn-sm btn-icon btn-outline-primary">
                                                            <span class="tf-icons bx bx-edit"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <a type="submit" href="{{ route('empresa.addmotorista') }}"
                                class="btn btn-success
                                me-2">Adicionar Motorista</a>
                        </div>
                        {{-- </form> --}}
                    </div>
                    <!-- /Account -->
                </div>

            </div>
        </div>
    </div>
@endsection
