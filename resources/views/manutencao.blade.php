@extends('layouts.defaultemp')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Motoristas</h4>

        <div class="row">
            
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">Motoristas</h5>
                    <div class="card-body">
                        {{-- <form id="formAccountSettings" method="post" action="{{ route('empresa.addmotorista') }}"> --}}
                        @csrf
                            EM MANUTENÇÃO                      
                    </div>
                    <!-- /Account -->
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script>
@endsection
