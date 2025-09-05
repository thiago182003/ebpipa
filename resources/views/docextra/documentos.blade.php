@extends($menu);

@section('content')
    @include('componentes.mensagem')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">    Cadastro /</span> Documentos
        </h4>
        <form id="formAccountSettings" enctype="multipart/form-data" method="post" action="{{ route('documentacoes.salvar') }}">
            @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-2 col-md-6">
                            <label for="id_edital" class="form-label">Edital</label>
                            <select onchange="buscar()" required id="id_edital" name='id_edital'
                                class="select2 form-select form-select-sm">
                                <option value="">Selecione...</option>
                                @foreach ($creds as $c)
                                    <option
                                        value={{ $c->edital->id }}>{{ $c->edital->nome }}</option>
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
                                                <th class="col">Documento</th>
                                                <th class="col-1">modelo</th>
                                                <th class="col-4">upload</th>
                                                <th class="col-1">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-doc">
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
            // function buscar(){
            //     let id = $('#id_edital').val();
            //     if(id != ""){
            //         $.ajaxSetup({
            //             headers: {
            //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
            //             }
            //         });
            //         $.post('{{ route('documentacoes.buscar') }}', {
            //             id: id,
            //         }).done(function(response) {
            //             $("#table-doc").html("");
            //             response.forEach(r => {
            //                 linha = "<tr>";
                            
            //                 linha +="<td>";
            //                 linha +=r.documento.nome;
            //                 if(r.documento.descricao != ""){
            //                     linha+= ' <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-html="true" title="' + r.documento.descricao + '">';
            //                     linha += '<i class="bx bx-info-circle" style="color: #ff3e1d"></i></span>'
            //                 }
            //                 linha +="</td>";
                            
            //                 linha +="<td>";
            //                 if(r.documento.link != ""){
            //                     linha +="<a id='" + r.documento.id + "'' href='"+ r.documento.link +"' target='_blank'>baixar</a>";
            //                 }
            //                 linha +="</td>";
                            
            //                 if(r.doccandidato){
            //                     console.log(r.doccandidato);
            //                     linha +="<td></td>";
            //                     linha +="<td>";
            //                     linha +='<div class="d-flex align-items-center">';
            //                     linha +='<a target="_blank" class="btn btn-sm btn-icon btn-primary me-2"';
            //                     linha +='href="{{ url("storage/'+ r.doccandidato.arquivo+'") }}">';
            //                     linha +='<i class="bx bx-file"></i>';
            //                     linha +='</a>';
            //                     linha +='<span class="mx-1">|</span>'
            //                     linha +='<button class="btn btn-sm btn-icon btn-outline-danger remover ms-2"';
            //                     linha +='data-tipo="documentoextra" data-arquivo="'+ r.doccandidato.id +'"'; 
            //                     linha +='data-nome="'+r.doccandidato.id+'">';
            //                     linha +='<i class="bx bx-x"></i>';
            //                     linha +='</button>';
            //                     linha +='</div>';
            //                     linha +="</td>";
            //                 }else{
            //                     linha +="<td>";
            //                     linha += '<input class="form-control form-control-sm" type="file" accept="application/pdf"';
            //                     linha += 'id="'+r.documento.id+'" name="'+r.documento.id+'"';
            //                     linha +="</td>";
                                    
                                    
            //                     linha +="<td></td>";
            //                 }
                            
            //                 $("#table-doc").append(linha);
            //             });
            //             console.log(response);
            //         });
            //     }
            // }
    function buscar() {
        let id = $('#id_edital').val();

        if (id !== "") {
            // Configura os cabeçalhos CSRF para requisições Ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            // Faz a requisição AJAX
            $.post('{{ route('documentacoes.buscar') }}', { id: id })
                .done(function (response) {
                    // Limpa a tabela antes de preencher
                    $("#table-doc").html("");

                    // Itera sobre cada item retornado na resposta
                    response.forEach(r => {
                        let linha = "<tr>";

                        // Coluna do Nome do Documento
                        linha += "<td>";
                        linha += r.documento.nome;

                        if (r.documento.descricao) {
                            linha += `
                                <span 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="right" 
                                    data-bs-html="true" 
                                    title="${r.documento.descricao}">
                                    <i class="bx bx-info-circle" style="color: #ff3e1d"></i>
                                </span>`;
                        }

                        linha += "</td>";

                        // Coluna do Link para Baixar Documento
                        linha += "<td>";
                        if (r.documento.link) {
                            linha += `<a id="${r.documento.id}" href="{{ url('storage/${r.documento.link}') }}" target="_blank">baixar</a>`;
                        }
                        linha += "</td>";

                        // Verifica se há "doccandidato"
                        if (r.doccandidato) {
                            linha += "<td></td>";
                            linha += `
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a target="_blank" class="btn btn-sm btn-icon btn-primary me-2" 
                                           href="{{ url('storage/${r.doccandidato.arquivo}') }}">
                                            <i class="bx bx-file"></i>
                                        </a>
                                        <span class="mx-1">|</span>
                                        <button class="btn btn-sm btn-icon btn-outline-danger remover ms-2"
                                                data-tipo="documentoextra" 
                                                data-arquivo="${r.doccandidato.id}" 
                                                data-nome="${r.doccandidato.id}">
                                            <i class="bx bx-x"></i>
                                        </button>
                                    </div>
                                </td>`;
                        } else {
                            // Caso não tenha "doccandidato", mostra o campo de upload
                            linha += `
                                <td>
                                    <input class="form-control form-control-sm" type="file" accept="application/pdf" 
                                           id="${r.documento.id}" name="${r.documento.id}">
                                </td>
                                <td></td>`;
                        }

                        linha += "</tr>";

                        // Adiciona a linha criada à tabela
                        $("#table-doc").append(linha);
                    });

                    console.log(response);
                })
                .fail(function (error) {
                    console.error("Erro na requisição:", error);
                });
        }
    }



        </script>
        @endpush
    @endsection
