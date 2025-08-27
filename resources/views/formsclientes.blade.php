<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atendimento ao Cliente - EBPIPA</title>

    <meta name="description" content="Sistema de Atendimento ao Cliente para Operação Carro Pipa" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('/js/helpers.js') }}"></script>
    <script src="{{ asset('/js/config.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light mt-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}"><span
                        class="app-brand-text demo menu-text fw-bolder ms-2">EBPIPA</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Voltar ao Portal</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Atendimento ao Cliente</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <!-- Etapa 1: Pergunta sobre identificação -->
                        <div id="step1" class="step-content">
                            <h5 class="mb-4">Deseja se Identificar? *</h5>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="identificar" id="identificar_sim" value="sim">
                                    <label class="form-check-label" for="identificar_sim">
                                        Sim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="identificar" id="identificar_nao" value="nao">
                                    <label class="form-check-label" for="identificar_nao">
                                        Não
                                    </label>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary" id="btnContinuar" disabled>Continuar</button>
                            </div>
                        </div>

                        <!-- Etapa 2: Formulário para usuário autenticado -->
                        <div id="step2" class="step-content" style="display: none;">
                            @if(auth()->guard('pipeiro')->check() || auth()->guard('empresa')->check() || auth()->guard('operador')->check())
                                <h5 class="mb-4">Dados do Usuário</h5>
                                <div class="mb-3">
                                    <p><strong>Nome:</strong> 
                                        @if(auth()->guard('pipeiro')->check())
                                            {{ auth()->guard('pipeiro')->user()->nome }}
                                        @elseif(auth()->guard('empresa')->check())
                                            {{ auth()->guard('empresa')->user()->razao_social }}
                                        @elseif(auth()->guard('operador')->check())
                                            {{ auth()->guard('operador')->user()->nome }}
                                        @endif
                                    </p>
                                </div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTipoRequerente">
                                    Continuar
                                </button>
                            @else
                                <div class="alert alert-warning">
                                    <p>Você precisa estar logado para continuar. <a href="{{ route('login.redirect', ['key' => 'atendimento']) }}" class="btn btn-primary btn-sm">Fazer Login</a></p>
                                </div>
                            @endif
                        </div>
    
                        <!-- Etapa 3: Para usuário não identificado -->
                        <div id="step3" class="step-content" style="display: none;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormulario">
                                Iniciar Atendimento
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Tipo de Requerente (usuário autenticado) -->
    <div class="modal fade" id="modalTipoRequerente" tabindex="-1" aria-labelledby="modalTipoRequerenteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTipoRequerenteLabel">Tipo de Requerente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">REQUERENTE *</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo_requerente" id="pipeiro" value="PIPEIRO">
                            <label class="form-check-label" for="pipeiro">PIPEIRO</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo_requerente" id="compdec" value="COMPDEC">
                            <label class="form-check-label" for="compdec">COMPDEC</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo_requerente" id="apontador" value="APONTADOR">
                            <label class="form-check-label" for="apontador">APONTADOR</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo_requerente" id="autoridade" value="AUTORIDADE PUBLICA">
                            <label class="form-check-label" for="autoridade">AUTORIDADE PÚBLICA</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo_requerente" id="outro" value="OUTRO">
                            <label class="form-check-label" for="outro">Outro:</label>
                            <input type="text" class="form-control mt-2" id="outro_especificar" placeholder="Especificar" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnContinuarModal" disabled>Continuar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Principal do Formulário -->
    <div class="modal fade" id="modalFormulario" tabindex="-1" aria-labelledby="modalFormularioLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormularioLabel">Formulário de Atendimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAtendimento" method="POST" action="{{ route('portal.salvar-atendimento') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <p><strong>Descreva com clareza e objetividade os fatos relacionados à sua reclamação, informação ou denúncia. Inclua, sempre que possível:</strong></p>
                            <ul>
                                <li>Data e horário da ocorrência;</li>
                                <li>Nome do pipeiro envolvido (caso aplicável);</li>
                                <li>Localidade ou comunidade afetada;</li>
                                <li>Placa do caminhão-pipa (se conhecida);</li>
                                <li>Detalhes do ocorrido: atrasos, ausência de abastecimento, má conduta, desvios, irregularidades, etc.;</li>
                                <li>Consequências para a comunidade ou família;</li>
                                <li>Qualquer outro dado que possa ajudar na apuração dos fatos.</li>
                            </ul>
                            <p class="mb-0"><strong>Sua colaboração é essencial para garantir a qualidade e a integridade da Operação Carro-Pipa.</strong></p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado *</label>
                                    <select class="form-select" id="estado" name="estado" required>
                                        <option value="">Selecione o Estado</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="PE">Pernambuco</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="municipio" class="form-label">Município *</label>
                                    <select class="form-select" id="municipio" name="municipio" required disabled>
                                        <option value="">Selecione primeiro o Estado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="relato" class="form-label">Relato da Ocorrência *</label>
                            <textarea class="form-control" id="relato" name="relato" rows="8" required 
                                placeholder="Descreva detalhadamente os fatos, incluindo data, horário, localização e circunstâncias..."></textarea>
                        </div>

                        <!-- Campos ocultos para dados do usuário -->
                        <input type="hidden" name="usuario_autenticado" id="usuario_autenticado" 
                            value="{{ (auth()->guard('pipeiro')->check() || auth()->guard('empresa')->check() || auth()->guard('operador')->check()) ? 'sim' : 'nao' }}">
                        <input type="hidden" name="tipo_requerente" id="tipo_requerente_hidden">
                        <input type="hidden" name="outro_especificar" id="outro_especificar_hidden">
                        @if(auth()->guard('pipeiro')->check())
                            <input type="hidden" name="user_id" value="{{ auth()->guard('pipeiro')->user()->id }}">
                            <input type="hidden" name="user_type" value="pipeiro">
                            <input type="hidden" name="user_name" value="{{ auth()->guard('pipeiro')->user()->nome }}">
                        @elseif(auth()->guard('empresa')->check())
                            <input type="hidden" name="user_id" value="{{ auth()->guard('empresa')->user()->id }}">
                            <input type="hidden" name="user_type" value="empresa">
                            <input type="hidden" name="user_name" value="{{ auth()->guard('empresa')->user()->razao_social }}">
                        @elseif(auth()->guard('operador')->check())
                            <input type="hidden" name="user_id" value="{{ auth()->guard('operador')->user()->id }}">
                            <input type="hidden" name="user_type" value="operador">
                            <input type="hidden" name="user_name" value="{{ auth()->guard('operador')->user()->nome }}">
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Enviar Solicitação</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('/js/jquery.js') }}"></script>
    <script src="{{ asset('/js/popper.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/js/menu.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Habilitar botão continuar quando uma opção for selecionada
            $('input[name="identificar"]').change(function() {
                $('#btnContinuar').prop('disabled', false);
            });

            // Ação do botão continuar na etapa 1
            $('#btnContinuar').click(function() {
                var opcaoSelecionada = $('input[name="identificar"]:checked').val();
                
                $('#step1').hide();
                
        if (opcaoSelecionada === 'sim') {
                    // Verificar se o usuário está autenticado
                    @if(auth()->guard('pipeiro')->check() || auth()->guard('empresa')->check() || auth()->guard('operador')->check())
                        $('#step2').show();
                    @else
            // Redirecionar de forma segura para login, registrando redirect na sessão
            window.location.href = '{{ route("login.redirect", ["key" => "atendimento"]) }}';
                    @endif
                } else {
                    $('#step3').show();
                }
            });

            // Habilitar campo "Outro" quando selecionado
            $('input[name="tipo_requerente"]').change(function() {
                if (this.value === 'OUTRO') {
                    $('#outro_especificar').prop('disabled', false);
                    $('#btnContinuarModal').prop('disabled', $('#outro_especificar').val().trim() === '');
                } else {
                    $('#outro_especificar').prop('disabled', true).val('');
                    $('#btnContinuarModal').prop('disabled', false);
                }
            });

            // Validar campo "Outro"
            $('#outro_especificar').on('input', function() {
                if ($('input[name="tipo_requerente"]:checked').val() === 'OUTRO') {
                    $('#btnContinuarModal').prop('disabled', $(this).val().trim() === '');
                }
            });

            // Continuar do modal de tipo de requerente
            $('#btnContinuarModal').click(function() {
                var tipoRequerente = $('input[name="tipo_requerente"]:checked').val();
                var outroEspecificar = $('#outro_especificar').val();
                
                // Preencher campos ocultos
                $('#tipo_requerente_hidden').val(tipoRequerente);
                $('#outro_especificar_hidden').val(outroEspecificar);
                
                $('#modalTipoRequerente').modal('hide');
                $('#modalFormulario').modal('show');
            });

            // Dados dos municípios
            var municipios = {
                'AL': [
                    'Arapiraca', 'Maceió', 'Palmeira dos Índios', 'Rio Largo', 'Santana do Ipanema',
                    'São Miguel dos Campos', 'União dos Palmares', 'Penedo', 'Coruripe', 'Delmiro Gouveia'
                ],
                'PE': [
                    'Recife', 'Jaboatão dos Guararapes', 'Olinda', 'Caruaru', 'Petrolina',
                    'Paulista', 'Cabo de Santo Agostinho', 'Camaragibe', 'Garanhuns', 'Vitória de Santo Antão'
                ]
            };

            // Carregar municípios quando estado for selecionado
            $('#estado').change(function() {
                var estadoSelecionado = $(this).val();
                var municipioSelect = $('#municipio');
                
                municipioSelect.empty().append('<option value="">Selecione o Município</option>');
                
                if (estadoSelecionado && municipios[estadoSelecionado]) {
                    municipioSelect.prop('disabled', false);
                    
                    municipios[estadoSelecionado].forEach(function(municipio) {
                        municipioSelect.append('<option value="' + municipio + '">' + municipio + '</option>');
                    });
                } else {
                    municipioSelect.prop('disabled', true);
                }
            });

            // Verificar se há parâmetro de redirect na URL
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('redirect')) {
                // Se o usuário foi redirecionado após login, mostrar etapa 2
                $('#step1').hide();
                $('#step2').show();
            }
        });
    </script>
</body>

</html>
