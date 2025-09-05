@extends('layouts.defaultemp')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Pendências</h4>

        <div class="row">
            <form id="salvar-pendencias" enctype="multipart/form-data" method="post"
            action="{{ route('empresa.sanarpendenciasempresa', ['id' => $empresa->id]) }}">
            @csrf
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-2 col-md-6">
                            <label for="id_edital" class="form-label">Edital</label>
                            <select @required(true) id="id_edital" name='id_edital'
                                class="select2 form-select form-select-sm" @disabled(@$credenciamento->id_edital)>
                                <option value="">Selecione...</option>
                                @foreach ($creds as $c)
                                    <option
                                        value={{ $c->edital->id }}>{{ $c->edital->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">Pendencias da Empresa</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-2 col-md-12">
                                <p style="color: #ff3e1d">Todos os arquivos devem estar no formato PDF. E no maximo de 5mb.</p>
                                <p style="color: #ff3e1d"> Os documentos de 01 ao 04 devem estar assinados
                                    digitalmente.</p>
                            </div>
                        </div>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <p>*Favor reenviar documentos que se encontram em pendências</p>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="col-4">Documento</th>
                                                <th class="col-3">Situação</th>
                                                <th class="col-5">Upload</th>
                                            </tr>
                                        </thead>
                                        <tbody id="t-pendencias">
                                            
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
        let pendencias = {!!json_encode($pendencias)!!};

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

        $("#id_edital").change(function(){
            html = "";
            id = $("#id_edital").val();
            pendencias.forEach(p => {
                if(p['edital'] == id){
                    html += `<tr>
                                <td>${p['nome']}</td>
                                <td>${p['obs']||''}</td>
                                <td>
                                    <input class="form-control form-control-sm" type="file"
                                        accept="application/pdf" id="${p['id']}"
                                        name="${p['id']}" value="" />
                                </td>
                            </tr>`;
                }
            });
            $("#t-pendencias").html(html);
        });
    </script>
    @endpush
@endsection
