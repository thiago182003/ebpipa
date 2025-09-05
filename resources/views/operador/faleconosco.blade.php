@extends('layouts.defaultop')

@section('content')
    @include('componentes.mensagem')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Credenciamentos Pendentes
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">Credenciamentos para análise</h5>
                    <div class="card-body">
                        <div class="card-body">
                            {{-- <form id="formAccountSettings" method="post" action="{{ route('pipeiro.salvar') }}"> --}}
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="col-2">nome</th>
                                                <th class="col-2">email</th>
                                                <th>assunto</th>
                                                <th>mensagem</th>
                                                <th class="col-1">anexo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (@$faleconosco as $fale)
                                                <tr>
                                                    {{-- {{ dd($cred) }} --}}
                                                    <td>{{ $fale->nome }}</td>
                                                    <td>{{ $fale->email }}</td>
                                                    <td>{{ $fale->assunto }}</td>
                                                    <td>{{ $fale->mensagem }}</td>
                                                    <td>
                                                        <a href="{{ url($fale->imagem) }}"
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


                            {{-- </form> --}}
                        </div>
                        <!-- /Account -->
                    </div>

                </div>
            </div>





        </div>
    @endsection
