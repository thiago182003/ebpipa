<!DOCTYPE html>
<html lang="pt-Br" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="..assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Ebpipa</title>

    <meta name="description" content="Sistema de Gerenciamento para Operação Carro Pipa" />

    <link rel="shortcut icon" href="{{ asset('/img/logo-pipa.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('/css/css2.css') }}" />
    <link rel="stylesheet" href="{{ asset('/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" class="template-customizer-theme-css" />
    {{-- <link rel="stylesheet" href="{{ asset('/css/perfect-scro.css') }}" class="template-customizer-theme-css" /> --}}
    @stack('styles')
    <script src="{{ asset('/js/helpers.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside  id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('pipeiro.dashboard') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('/img/logo-pipa.png') }}" width="50" />
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">EBPIPA</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item active">
                        <a href="{{ route('operador.dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Tela Inicial </div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Administração</span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('operador.credenciamentos') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Basic">Pessoa Fisica</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('operador.empresas') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-briefcase-alt-2"></i>
                            <div data-i18n="Basic">Pessoa Juridica</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('operador.pendentes') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Basic">Inscrições Iniciadas</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('operador.buscapipeiro') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Basic">Buscar pipeiro</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Cadastros</span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('op.operadores') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-group"></i>
                            <div data-i18n="Basic">Operadores</div>
                        </a>
                    </li>
                    @if(Auth::guard('operador')->user()->nivel <= 1)
                    <li class="menu-item">
                        <a href="{{ route('om.oms') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-city"></i>
                            <div data-i18n="Basic">Oms</div>
                        </a>
                    </li>
                    @endif
                    <li class="menu-item">
                        <a href="{{ route('op.municipios') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-map-alt"></i>
                            <div data-i18n="Basic">Municipios</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('op.editais') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                            <div data-i18n="Basic">Editais</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('op.anexos') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                            <div data-i18n="Basic">Anexos</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('op.documentos') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                            <div data-i18n="Basic">Documentos</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('op.associardoc') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                            <div data-i18n="Basic">Associar Documentos</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Relatórios</span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('relatorio.credenciamentos') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                            <div data-i18n="Basic">Credenciamentos</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('operador.ouvidoria') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-mail-send"></i>
                            <div data-i18n="Basic">Resposta Ouvidoria</div>
                        </a>
                    </li>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        @if (false)
                                            <img src="{{ url('storage/' . @$pipeiro->img) }}" alt="user-avatar"
                                                class="d-block rounded" height="100" width="100" />
                                        @else
                                            <img src="{{ asset('/img/avatars/user.png') }}" alt="user-avatar"
                                                class="d-block rounded" height="100" width="100" />
                                        @endif
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        @if (false)
                                                            <img src="{{ url('storage/' . @$pipeiro->img) }}"
                                                                alt="user-avatar" class="d-block rounded"
                                                                height="100" width="100" />
                                                        @else
                                                            <img src="{{ asset('/img/avatars/user.png') }}"
                                                                alt="user-avatar" class="d-block rounded"
                                                                height="100" width="100" />
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{Auth::guard('operador')->user()->pg->sigla}} {{Auth::guard('operador')->user()->nomeguerra}}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('op.alterasenha') }}">
                                            <i class="bx bx-password me-2"></i>
                                            <span class="align-middle">Alterar Senha</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('operador.logout') }}">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    @yield('content')

                </div>
                <!-- / Content -->

                <!-- Footer -->
                {{-- <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , made by 3°Sgt Lins
                        </div>
                    </div>
                </footer> --}}
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script>var languageUrl = "{{ asset('/json/Portuguese-Brasil.json') }}";</script>
    @include('layouts.importsjs')
    @stack('scripts')
</body>

</html>
