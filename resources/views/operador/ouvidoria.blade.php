@extends('layouts.defaultop')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Resposta Ouvidoria</h4>

    <div class="card">
        <div class="table-responsive text-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Protocolo</th>
                        <th>Data</th>
                        <th>Solicitante</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Município</th>
                        <th>Anexos</th>
                           <th>Tipo Requerente</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $it)
                        <tr>
                            <td>{{ $it['protocolo'] ?? '-' }}</td>
                            <td>{{ $it['created_at_br'] ?? ($it['created_at'] ?? '-') }}</td>
                            <td>{{ $it['nome'] ?? '-' }}</td>
                            <td>{{ $it['tipo_solicitacao'] ?? '-' }}</td>
                            <td>{{ $it['estado_nome'] ?? ($it['estado'] ?? '-') }}</td>
                            <td>{{ $it['municipio_nome'] ?? ($it['municipio'] ?? '-') }}</td>
                            <td>
                                @if(!empty($it['anexos']))
                                    @foreach($it['anexos'] as $index => $a)
                                        @php
                                            // rótulo padronizado: Anexo 01, 02, 03
                                            $label = 'Anexo '.str_pad($index+1, 2, '0', STR_PAD_LEFT);
                                            $parts = explode('/', $a);
                                            $fname = end($parts);
                                        @endphp
                                        <div><a href="{{ route('operador.ouvidoria.download', ['file' => $fname]) }}" target="_blank">{{ $label }}</a></div>
                                    @endforeach
                                @endif
                            </td>
                               <td>{{ $it['tipo_requerente'] ?? '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btnResponder" data-protocolo="{{ $it['protocolo'] ?? '' }}">Responder</button>
                                <button class="btn btn-sm btn-outline-info btnVerSolicitacao ms-1" data-protocolo="{{ $it['protocolo'] ?? '' }}">Ver Solicitação</button>
                                <div class="relato-text d-none">{{ $it['relato'] ?? '' }}</div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7">Nenhuma resposta encontrada.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    var currentProtocol = null;
    document.querySelectorAll('.btnResponder').forEach(function(btn){
        btn.addEventListener('click', function(){
            currentProtocol = this.getAttribute('data-protocolo');
            var modalHtml = `
            <div class="modal fade" id="respModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Responder Protocolo `+currentProtocol+`</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <form id="respForm" method="POST" enctype="multipart/form-data" action="{{ route('operador.ouvidoria.respond') }}">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="protocolo" value="`+currentProtocol+`" />
                            <div class="mb-3">
                                <label class="form-label">Resposta</label>
                                <textarea name="resposta" class="form-control" rows="6" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Anexos (JPG, PNG, JPEG, PDF) - até 3 arquivos de 5MB cada</label>
                                <input id="respAnexos" name="anexos[]" type="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                <div id="respAnexosList" class="mt-2"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Enviar resposta</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>`;
            // inserir no body e mostrar
            var wrapper = document.createElement('div'); wrapper.innerHTML = modalHtml;
            document.body.appendChild(wrapper);
            var modalEl = document.getElementById('respModal');
            var bsModal = new bootstrap.Modal(modalEl);
            bsModal.show();

            // lógica de listagem/removal simples similar ao forms
            var selected = [];
            var input = document.getElementById('respAnexos');
            var list = document.getElementById('respAnexosList');
            if(!input) return;
            input.addEventListener('change', function(e){
                var files = Array.from(e.target.files);
                files.forEach(function(f){
                    if(selected.length >= 3) return;
                    if(selected.some(sf => sf.name===f.name && sf.size===f.size)) return;
                    if(f.size > 5*1024*1024){ alert(f.name+' maior que 5MB'); return; }
                    selected.push(f);
                });
                renderRespList();
                input.value = '';
            });
            function renderRespList(){
                list.innerHTML='';
                selected.forEach(function(f,idx){
                    var div = document.createElement('div'); div.className='d-flex align-items-center mb-1'; div.textContent = f.name + ' ('+Math.round(f.size/1024)+' KB)';
                    var btn = document.createElement('button'); btn.type='button'; btn.className='btn btn-sm btn-link text-danger ms-2'; btn.textContent='Remover';
                    btn.addEventListener('click', function(){ selected.splice(idx,1); renderRespList(); });
                    div.appendChild(btn); list.appendChild(div);
                });
            }

            // antes do submit, reconstruir input.files via DataTransfer
            document.getElementById('respForm').addEventListener('submit', function(){
                var dt = new DataTransfer();
                selected.forEach(function(f){ dt.items.add(f); });
                document.getElementById('respAnexos').files = dt.files;
            });
            // remover modal do DOM ao fechar
            modalEl.addEventListener('hidden.bs.modal', function(){ wrapper.remove(); });
        });
    });
    // Ver Solicitação
    document.querySelectorAll('.btnVerSolicitacao').forEach(function(btn){
        btn.addEventListener('click', function(){
            var row = this.closest('tr');
            var relato = row.querySelector('.relato-text').textContent || '-';
            var modalHtml = `
            <div class="modal fade" id="verSolicModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Relato do Solicitante</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <pre style="white-space:pre-wrap;">`+relato+`</pre>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>`;
            var wrapper = document.createElement('div'); wrapper.innerHTML = modalHtml; document.body.appendChild(wrapper);
            var modalEl = document.getElementById('verSolicModal'); var bs = new bootstrap.Modal(modalEl); bs.show();
            modalEl.addEventListener('hidden.bs.modal', function(){ wrapper.remove(); });
        });
    });
});
</script>
@endpush
