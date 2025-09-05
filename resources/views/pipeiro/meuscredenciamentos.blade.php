@extends('layouts.default')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span>Meus Credenciamentos
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        {{-- <h5 class="card-header">Pendencias</h5> --}}
                        <div class="card-body">
                            <form id="formAccountSettings" method="post" action="">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Motivo</label>
                                        <select id="edital" name='edital' class="select2 form-select">
                                            <option value="">Selecione...</option>
                                            <option value="">Realizar Credenciamento</option>
                                            <option value="">Contestação de Carrada</option>
                                            <option value="">Recisão de contrato</option>
                                            <option value="">Descredenciamento</option>
                                            <option value="">Outros</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Local</label>
                                        <select id="edital" name='edital' class="select2 form-select">
                                            <option value="">Selecione...</option>
                                            <option value="">7ªRM</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Dia</label>
                                        <input class="form-control" type="date" id="nome" name="nome"
                                            value="" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Horario</label>
                                        <select id="edital" name='edital' class="select2 form-select">
                                            <option value="">Selecione...</option>
                                            <option value="">09:00</option>
                                            <option value="">10:00</option>
                                            <option value="">11:00</option>
                                            <option value="">13:00</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Solicitar Agendamento</button>
                                    {{-- <button type="reset" class="btn btn-outline-secondary">Cancelar</button> --}}
                                </div>
                            </form>
                        </div>
                        <!-- /Account -->
                    </div>

                    <div class="card mb-3">
                        <h5 class="card-header">Meus Agendamentos</h5>
                        {{-- <hr class="my-0" /> --}}
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Motivo</th>
                                                <th>Local</th>
                                                <th>Dia</th>
                                                <th>Hora</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Descredenciamento</strong></td>
                                                <td>7ªRM</td>
                                                <td>05/06/2023</td>
                                                <td>09:00</td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-outline-primary">
                                                        <span class="tf-icons bx bx-edit"></span>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-outline-danger">
                                                        <span class="tf-icons bx bx-x"></span>
                                                    </button>

                                                </td>
                                            </tr>
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
