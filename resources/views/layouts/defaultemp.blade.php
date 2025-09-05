<!DOCTYPE html>
<html lang="pt-Br" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="..assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <title>Dashboard - Ebpipa</title>
    <meta name="description" content="Sistema de Gerenciamento para Operação Carro Pipa" />

    <meta name="description" content="" />
    <link rel="shortcut icon" href="{{ asset('/img/logo-pipa.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('/css/css2.css') }}" />
    <link rel="stylesheet" href="{{ asset('/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" class="template-customizer-theme-css" />
    @stack('styles')
    <script src="{{ asset('/js/helpers.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('empresa.dashboard') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('/img/logo-pipa.png') }}" width="50" />
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">Ebpipa</span>
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
                        <a href="{{ route('empresa.dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Tela Inicial</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Administração</span>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('empresa.credenciamentos') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Basic">Credenciamentos</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('empresa.motoristas') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-group"></i>
                            <div data-i18n="Basic">Motoristas</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('empresa.pendencias') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-alarm-exclamation"></i>
                            <div data-i18n="Basic">Pendências</div>
                            @if (@$pendencias)
                                <span class="badge bg-danger ms-1">{{ count($pendencias) }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('documentacoes.extra') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-alarm-exclamation"></i>
                            <div data-i18n="Basic">Documentações extras</div>
                        </a>
                    </li>

                    {{-- <li class="menu-item">
                        <a href="{{ route('empresa.agendamento') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Basic">Agendamentos</div>
                        </a>
                    </li> --}}

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
                                        @if (@$empresa->img)
                                            <img src="{{ url('storage/' . @$empresa->img) }}" alt="user-avatar"
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
                                                        @if (@$empresa->img)
                                                            <img src="{{ url('storage/' . @$empresa->img) }}"
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
                                                    <span
                                                        class="fw-semibold d-block">{{ Auth::guard('empresa')->user()->razaosocial }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    {{-- <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                <span class="flex-grow-1 align-middle">Billing</span>
                                                <span
                                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li> --}}
                                    <li>
                                        <a class="dropdown-item" href="{{ route('empresa.logout') }}">
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
    <!-- / Layout wrapper -->
    <script>var languageUrl = "{{ asset('/json/Portuguese-Brasil.json') }}";</script>
    @include('layouts.importsjs')
    @stack('scripts')
</body>

</html>
