@extends('layouts.defaultop');

@section('content')
    @include('componentes.mensagem')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">    Cadastro /</span> Documentos
        </h4>
        <form id="formAccountSettings" method="post" action="{{ route('documento.salvarassocia') }}">
            @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-2 col-md-6">
                            <label for="id_edital" class="form-label">Edital</label>
                            <select required id="id_edital" onchange="buscar()" name='id_edital'
                                class="select2 form-select form-select-sm">
                                <option value="">Selecione...</option>
                                @foreach ($editais as $ed)
                                    <option
                                        value={{ @$ed->id }}>{{ $ed->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <h5 class="card-header">Documentos</h5>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <table id="tb-analise" class="table table-sm table-bordered">
                                        <thead>
                                            <tr> 
                                                <th class="col-3">Nome</th>
                                                <th class="col">Descrição</th>
                                                <th class="col-1">Modelo</th>
                                                <th class="col-1">Adicionar</th>
                                                <th class="col-1">Obrigatório</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($docs as $documento)
                                                
                                                <tr>
                                            
                                                    <td>{{ @$documento->nome }}</td>
                                                    <td>{{ @$documento->descricao }}</td>
                                                    <td>
                                                        @if($documento->link)
                                                            <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                                                                href="{{ url("storage/$documento->link") }}">
                                                                <i class='bx bx-file'></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="adicionar_{{ $documento->id }}" name="adicionar[]" value="{{@$documento->id}}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="obrigatorio_{{ $documento->id }}" name="obrigatorio[]" value="{{@$documento->id}}">
                                                        </div>
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
                    <div class="mt-2 save-now">
                        <button type="submit" class="btn btn-primary btn-save-now"><i class='bx bx-save'></i>
                            Salvar</button>
                    </div>
                </div>
            </div>


        </div>
        @push('scripts')
        <script>
            function buscar(){
                let id = $('#id_edital').val();
                if(id != ""){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.post('{{ route('documento.buscaassociacao') }}', {
                        id: id,
                    }).done(function(response) {
                        response.forEach(r => {
                            $('#adicionar_' + r.documentacao_id).prop('checked', true);
                            r.is_obrigatorio ? $('#obrigatorio_' + r.documentacao_id).prop('checked', true) : $('#obrigatorio_' + r.documentacao_id).prop('checked', false);
                        });
                        console.log(response);
                    });
                }else{
                    //limpa os campos
                    var inputs = $('input[type=checkbox]');
                    inputs.attr('checked', false);
                    inputs.prop('checked', false);
                }
            }
            

        </script>
        @endpush
    @endsection
