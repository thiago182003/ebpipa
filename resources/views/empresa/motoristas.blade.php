@extends('layouts.defaultemp')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Motoristas</h4>
        <div class="row">
            
            <div class="col-md-12">
                @if(session('mensagem'))
                           <h1><span>{{session('mensagem')}}</span></h1>
                @endif
                <div class="card mb-3">
                    <h5 class="card-header">Motoristas</h5>
                    
                    <div class="card-body">
                        {{-- <form id="formAccountSettings" method="post" action="{{ route('empresa.addmotorista') }}"> --}}
                        @csrf
                        
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <div class="">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="col-2">cpf</th>
                                                <th>nome</th>
                                                <th class="col-2">edital</th>
                                                <th class="col-1">status</th>
                                                <th class="col-1">pendencias</th>
                                                <th class="col-1">cadastro</th>
                                                <th class="col-1">enviar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($motoristas as $mot)
                                                
                                                    <tr>
                                                        <td>{{ @$mot->pipeiro->cpf }}</td>
                                                        <td>{{ @$mot->pipeiro->nome }}</td>
                                                        <td>{{ @$mot->edital->nome }}</td>
                                                
                                                        @if(@$mot->status == "Corrigido")
                                                            <td ><span class="badge bg-label-primary me-2">{{ @$mot->status }}</span></td>
                                                        @elseif(@$mot->status == "Aguardando Envio")
                                                            <td ><span class="badge bg-label-warning me-2">{{ @$mot->status }}</span></td>
                                                        @elseif(@$mot->status == "Em Correção")
                                                            <td ><span class="badge bg-label-danger me-2">{{ @$mot->status }}</span></td>
                                                        @elseif(@$mot->status == "Documentação Aprovada")
                                                            <td ><span class="badge bg-label-success me-2">{{ @$mot->status }}</span></td>
                                                        @else
                                                            <td><span class="badge bg-label-secondary me-2">{{ @$mot->status }}</span></td>
                                                        @endif
                                                        <td>
                                                            <a href="{{ route('empresa.pendenciamotorista', ['mot'=>$mot->pipeiro->id,'cred'=>$mot->id]) }}"
                                                                class="btn btn-sm btn-icon btn-outline-danger">
                                                                <span class="tf-icons bx bx-edit"></span>
                                                            </a>
                                                            @if(count($mot->pendencias) > 0 )
                                                            <span class="badge bg-danger ms-1">{{ count($mot->pendencias) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('empresa.addmotorista', ['pipeiro'=>@$mot->pipeiro->id,'credenciamento'=>@$mot->id]) }}"
                                                                class="btn btn-sm btn-icon btn-outline-primary">
                                                                <span class="tf-icons bx bx-edit"></span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <button data-status="{{$mot->status}}" data-id="{{$mot->id}}" data-mot={{$mot->pipeiro->id}} data-nome="{{$mot->pipeiro->nome}}"
                                                                class="btn btn-sm btn-icon btn-outline-success enviar">
                                                                <span class="tf-icons bx bx-send"></span>
                                                            </button>
                                                            {{-- <a href="{{ route('empresa.enviarmotorista', ['pipeiro'=>@$mot->id,'credenciamento'=>@$cred->id]) }}"
                                                                class="btn btn-sm btn-icon btn-outline-success">
                                                                <span class="tf-icons bx bx-send"></span>
                                                            </a> --}}
                                                        </td>
                                                    </tr>
                                                
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            @if (!is_null($credenciamentos))
                                <a type="submit" href="{{ route('empresa.addmotorista') }}"
                                    class="btn btn-success
                                me-2">Adicionar Motorista</a>
                            @else
                                <p>Realize seu Credenciamento antes de adicionar um motorista.</p>
                            @endif
                        </div>
                        {{-- </form> --}}
                    </div>
                    <!-- /Account -->
                </div>

            </div>
        </div>
    </div>
    @push('scripts')
    <script>

        $(".enviar").on("click", function(e) {
            e.preventDefault();
            let id = $(this).data("id");
            let mot = $(this).data("mot");
            let status = $(this).data("status");
            if (["Para Análise", "Em correção", "Corrigido", "Documentação Aprovada"].includes(status)) {
                alert(`A documentação está com status: ${status}.`);
                return false;
            }
            if (confirm('Deseja enviar o credenciamento para análise?')) {
                $('#overlay').show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post('{{ route('empresa.enviarmotorista') }}', {
                    id: mot,
                    credenciamento: id,
                }).done(function(response) {
                    resposta = "Precisa preencher os campos:";
                    if(response !== ""){
                        response.forEach(e => {
                            resposta += "\n" + e;
                        });
                        alert(resposta);
                    }else{
                        location.reload();
                    }
                }).always(function () {
                    $('#overlay').hide();
                });
            }
        });
    </script>
    @endpush
@endsection
