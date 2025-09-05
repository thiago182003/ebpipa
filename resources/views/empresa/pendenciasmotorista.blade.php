@extends('layouts.defaultemp')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Pendências do Motorista</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">Pendencias do Motorista</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-2 col-md-12">
                                <p style="color: #ff3e1d">Todos os arquivos devem estar no formato PDF. E no maximo de 5mb.</p>
                                {{-- <p style="color: #ff3e1d"> Os documentos de 01 ao 04 devem estar assinados --}}
                                    {{-- digitalmente.</p> --}}
                            </div>
                        </div>
                        <form id="salvar-pendencias" enctype="multipart/form-data" method="post"
                            action="{{ route('empresa.sanarpendenciasmotorista', ['id' => $pipeiro->id]) }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" value="{{$credenciamento->id}}" id="id_credenciamento" name="id_credenciamento">
                                <input type="hidden" value="{{$credenciamento->id_edital}}" id="id_edital" name="id_edital">
                                <div class="mb-3 col-md-12">
                                    <p>*Favor reenviar documentos que se encontram em pendências</p>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="col-6">Documento</th>
                                                <th class="col-2">Situação</th>
                                                <th class="col-4">Upload</th>
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
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Salvar Mudanças</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $("#salvar-pendencias").submit(function(){
            const form = document.getElementById('salvar-pendencias');
            const fileInputs = form.querySelectorAll('input[type="file"]');

            let arquivosEncontrados = false;

            fileInputs.forEach(input => {
                if (input.files.length > 0) {
                    arquivosEncontrados = true;
                }
            });

            if (!arquivosEncontrados) {
                alert("Nenhum arquivo encontrado no formulário");
                return false;
            }    
            $('#overlay').show();
        });
    </script>
    @endpush
@endsection
