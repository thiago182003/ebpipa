@extends('layouts.default')

@section('no_menu')@endsection

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Formulário de Reclamação/Informação ao Cliente</h2>
        @if(session('protocolo'))
            <div class="alert alert-success text-center mt-3">
                <h5>Recebemos sua resposta com sucesso.</h5>
                <p>Seu número de protocolo é: <strong>{{ session('protocolo') }}</strong></p>
                <p class="mb-0">Atenciosamente,<br>Equipe EROCP</p>
            </div>
        @endif

    <div style="position:relative;">
        <a href="{{ url('/') }}" class="btn btn-secondary" id="btnVoltarPortal" style="position:fixed; left:12px; top:12px; z-index:1055;">Voltar ao Portal</a>
        <div class="card mt-4 p-4" id="identArea">
            <div class="text-center mb-3">
                <h5>Deseja se Identificar?</h5>
                <p class="small text-muted">Caso escolha "Não", você não receberá nenhuma informação de retorno da sua solicitação</p>
            </div>

            <div class="text-center">
                <button id="btnSim" class="btn btn-primary me-2">Sim</button>
                <button id="btnNao" class="btn btn-secondary">Não</button>
            </div>
        </div>
    </div>

    <!-- Modal de Identificação -->
    <div class="modal fade" id="identModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Identificação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form id="identForm">
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Apenas números">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone para contato</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(DDD) 9 9999-9999">
                        </div>
                        <div id="identAlert" class="alert d-none" role="alert"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" id="identContinuar" class="btn btn-primary">Continuar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tipo Requerente (aparece se CPF não for encontrado) -->
    <div class="modal fade" id="tipoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tipo de Requerente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form id="tipoForm">
                        <div class="mb-3">
                            <select id="tipo_requerente" name="tipo_requerente" class="form-select">
                                <option value="">-- Selecione --</option>
                                <option value="PIPEIRO">PIPEIRO</option>
                                <option value="COMPDEC">COMPDEC</option>
                                <option value="APONTADOR">APONTADOR</option>
                                <option value="AUTORIDADE PUBLICA">AUTORIDADE PUBLICA</option>
                                <option value="OUTRO">Outro</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" id="tipoContinuar" class="btn btn-primary">Continuar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulário principal (oculto até identificação) -->
    <div class="card mt-4 p-4" id="mainCard" style="display:none;">
        <div id="relatoArea" style="display:none;">
            <p>Descreva com clareza e objetividade os fatos relacionados à sua reclamação, informação ou denúncia. Inclua, sempre que possível:</p>
            <ul>
                <li>Data e horário da ocorrência;</li>
                <li>Nome do pipeiro envolvido (caso aplicável);</li>
                <li>Localidade ou comunidade afetada;</li>
                <li>Placa do caminhão-pipa (se conhecida);</li>
                <li>Detalhes do ocorrido: atrasos, ausência de abastecimento, má conduta, desvios, irregularidades, etc.;</li>
                <li>Consequências para a comunidade ou família;</li>
                <li>Qualquer outro dado que possa ajudar na apuração dos fatos.</li>
            </ul>
            <p>Sua colaboração é essencial para garantir a qualidade e a integridade da Operação Carro-Pipa.</p>
    </div>

    <form id="mainForm" enctype="multipart/form-data" method="POST" action="{{ route('forms.submit') }}">
            @csrf
            <!-- campos de identificação serão copiados aqui antes do submit -->
            <input type="hidden" id="hf_cpf" name="cpf" />
            <input type="hidden" id="hf_email" name="email" />
            <input type="hidden" id="hf_nome" name="nome" />
            <input type="hidden" id="hf_telefone" name="telefone" />
            <input type="hidden" id="hf_tipo_requerente" name="tipo_requerente" />
            <div class="row mb-3" id="locationRow" style="display:none;">
                <div class="col-md-4">
                    <label for="estado" class="form-label">Estado</label>
                    <select id="estado" name="estado" class="form-select" disabled>
                        <option value="">-- Selecione Estado --</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="municipio" class="form-label">Município</label>
                    <select id="municipio" name="municipio" class="form-select" disabled>
                        <option value="">-- Selecione Município --</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="tipo_solicitacao" class="form-label">Tipo da Solicitação</label>
                    <select id="tipo_solicitacao" name="tipo_solicitacao" class="form-select" disabled>
                        <option value="RECLAMACAO">Reclamação</option>
                        <option value="INFORMACAO">Informação</option>
                        <option value="DENUNCIA">Denúncia</option>
                    </select>
                </div>
            </div>

            <div class="mb-3" id="relatoWrapper" style="display:none;">
                <label for="relato" class="form-label">Relato (máx 1500 caracteres)</label>
                <textarea id="relato" name="relato" class="form-control" rows="6" maxlength="1500" disabled></textarea>
            </div>

            <div class="mb-3" id="anexosWrapper" style="display:none;">
                <label class="form-label">Anexos (JPG, PNG, JPEG, PDF) - até 3 arquivos de 5MB cada</label>
                <input id="anexos" name="anexos[]" type="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf" multiple disabled>
                <div id="anexosList" class="mt-2"></div>
            </div>

            <button type="submit" class="btn btn-success" disabled>Enviar</button>
        </form>
    </div>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('/js/cleave.js') }}"></script>
    <script>
$(function(){
    // carregar estados
    $.getJSON('/forms/estados', function(data){
        data.forEach(function(e){
            $('#estado').append(new Option(e.nome, e.id));
        });
    });

    $('#estado').on('change', function(){
        var id = $(this).val();
        $('#municipio').html('<option>Carregando...</option>');
        if(!id){ $('#municipio').html('<option value="">-- Selecione Município --</option>'); return; }
        $.getJSON('/forms/municipios/'+id, function(data){
            $('#municipio').html('<option value="">-- Selecione Município --</option>');
            data.forEach(function(m){ $('#municipio').append(new Option(m.nome, m.id)); });
        });
    });

    var identModal = new bootstrap.Modal(document.getElementById('identModal'));
    var tipoModal = new bootstrap.Modal(document.getElementById('tipoModal'));

    function enableMainForm(){
    // não desabilitar inputs hidden (mantém valores de identificação)
    $('#mainForm').find('select,textarea,input:not([type=hidden]),button[type=submit]').prop('disabled', false);
        // ensure file input keeps multiple attribute
        $('#anexos').prop('disabled', false);
    }

    function finishIdentification(){
        // esconder área de identificação
        $('#identArea').remove();
    // mostrar card principal, relato/anexos e selects de estado/municipio
    $('#mainCard').show();
    $('#relatoArea, #relatoWrapper, #anexosWrapper').show();
    $('#locationRow').show();
    // copiar dados de identificação para inputs hidden do mainForm
    $('#hf_cpf').val($('#cpf').val());
    $('#hf_email').val($('#email').val());
    $('#hf_nome').val($('#nome').val());
    $('#hf_telefone').val($('#telefone').val());
    $('#hf_tipo_requerente').val($('#tipo_requerente').val());
        // carregar estados agora
        $.getJSON('/forms/estados', function(data){
            var sel = $('#estado'); sel.empty().append(new Option('-- Selecione Estado --',''));
            data.forEach(function(e){ sel.append(new Option(e.nome, e.id)); });
            sel.prop('disabled', false);
        });
        enableMainForm();
        // scroll to form
        $('html,body').animate({scrollTop: $('#mainForm').offset().top - 20}, 400);
    }

    $('#btnSim').on('click', function(){ identModal.show(); });
    $('#btnNao').on('click', function(){
        // marca como anonimo e abre tipo requerente direto
        $('#tipo_requerente').val('');
        tipoModal.show();
    });

    $('#identContinuar').on('click', function(){
        var cpf = $('#cpf').val().replace(/\D/g,'');
        if(!cpf){ $('#identAlert').removeClass('d-none alert-success').addClass('alert-danger').text('Informe um CPF válido'); return; }

        // consulta backend
    $.post('{{ route('forms.checkCpf') }}', { cpf: cpf, _token: '{{ csrf_token() }}' }, function(resp){
            if(resp.found){
                // CPF encontrado: atribui PIPEIRO automaticamente e fecha modal
                $('#identAlert').removeClass('d-none alert-danger').addClass('alert-success').text('CPF encontrado. Tipo PIPEIRO atribuído.');
                setTimeout(function(){ identModal.hide(); $('#tipo_requerente').val('PIPEIRO'); finishIdentification(); }, 800);
            } else {
                // não encontrado: fechar ident e abrir escolha de tipo
                identModal.hide();
                tipoModal.show();
            }
        });
    });

    // validação antes do envio
    $('#mainForm').on('submit', function(e){
        if(!$('#relato').val().trim()){
            alert('O campo relato é obrigatório'); e.preventDefault(); return false;
        }
        if(!$('#estado').val() || !$('#municipio').val()){
            alert('Selecione Estado e Município'); e.preventDefault(); return false;
        }
        // anexos já validados no change
    });

    // Tipo continuar
    $('#tipoContinuar').on('click', function(){
        tipoModal.hide();
        finishIdentification();
    });

    // anexos: gerenciar seleção, mostrar lista e permitir remoção antes do submit
    var selectedFiles = [];

    function renderAnexosList(){
        var list = $('#anexosList').empty();
        selectedFiles.forEach(function(f, idx){
            var item = $('<div class="d-flex align-items-center mb-1" data-idx="'+idx+'">').text(f.name + ' ('+Math.round(f.size/1024)+' KB)');
            var rm = $('<button type="button" class="btn btn-sm btn-link text-danger ms-2">Remover</button>').on('click', function(){
                selectedFiles.splice(idx,1);
                renderAnexosList();
                rebuildFileInput();
            });
            item.append(rm);
            list.append(item);
        });
    }

    function rebuildFileInput(){
        var dt = new DataTransfer();
        selectedFiles.forEach(function(f){ dt.items.add(f); });
        document.getElementById('anexos').files = dt.files;
    }

    $('#anexos').on('change', function(e){
        var files = Array.from(e.target.files);
        // concat sem duplicatas por name+size
        files.forEach(function(f){
            if(selectedFiles.length >= 3) return; // não aceita mais
            var exists = selectedFiles.some(function(sf){ return sf.name === f.name && sf.size === f.size; });
            if(exists) return;
            if(f.size > 5 * 1024 * 1024){ alert(f.name + ' maior que 5MB'); return; }
            selectedFiles.push(f);
        });
        if(selectedFiles.length > 3){ alert('Máximo 3 arquivos'); selectedFiles = selectedFiles.slice(0,3); }
        renderAnexosList();
        rebuildFileInput();
        // limpar input original para permitir reescolha do mesmo arquivo se removido
        $(this).val('');
    });

    // garantir que antes do submit o input contenha os files selecionados
    $('#mainForm').on('submit', function(){
        rebuildFileInput();
    });
});
</script>
@endpush
