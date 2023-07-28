@extends('layouts.defaultop');

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 col-md-12 order-1">
                <div class="row">

                    <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                        <div class="card">
                            <a href="{{ route('operador.credenciamentos') }}">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">

                                    </div>
                                    <span></span>
                                    <h3 class="card-title text-nowrap mb-1">Credenciamentos</h3>
                                    <small class="text-success fw-semibold"> </small>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
            <div class="card">
              <a href="">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    
                  </div>
                  <span></span>
                  <h3 class="card-title text-nowrap mb-1">Agendamentos</h3>
                  <small class="text-success fw-semibold"> </small>
                </div>
              </a>
            </div>
          </div> --}}


                </div>
            </div>

        </div>
    </div>
@endsection
