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
    @stack('styles')
    <script src="{{ asset('/js/helpers.js') }}"></script>
</head>

<body>
    @if(View::hasSection('no_menu'))
    <div class="container my-4" style="max-width:1100px;">
        {{-- layout sem menu lateral --}}
        <div class="content-wrapper">
            @yield('content')
        </div>
    @else
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('pipeiro.dashboard') }}" class="app-brand-link">
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
                    <li class="menu-item active">
                        <a href="{{ route('pipeiro.dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Tela Inicial</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Administração</span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('pipeiro.credenciamentos') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-archive"></i>
                            <div data-i18n="Basic">Credenciamento</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('pipeiro.pendencias') }}" class="menu-link">
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
        </aside>
            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        @php
                                            $pipeiroUser = Auth::guard('pipeiro')->user();
                                            if($pipeiroUser){
                                                $userAvatar = $pipeiroUser->img ? url('storage/' . $pipeiroUser->img) : asset('/img/avatars/user.png');
                                            } else {
                                                $userAvatar = asset('/img/avatars/user.png');
                                            }
                                        @endphp
                                        <img src="{{ $userAvatar }}" alt="user-avatar" class="d-block rounded" height="100" width="100" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        @if ($pipeiroUser && $pipeiroUser->img)
                                                            <img src="{{ url('storage/' . $pipeiroUser->img) }}"
                                                                alt="user-avatar" class="d-block rounded" height="100"
                                                                width="100" />
                                                        @else
                                                            <img src="{{ asset('/img/avatars/user.png') }}"
                                                                alt="user-avatar" class="d-block rounded"
                                                                height="100" width="100" />
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ $pipeiroUser ? $pipeiroUser->nome : 'Visitante' }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('pipeiro.logout') }}">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Sair</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    @endif
    <script>var languageUrl = "{{ asset('/json/Portuguese-Brasil.json') }}";</script>
    @include('layouts.importsjs')
    @stack('scripts')
</body>
</html>