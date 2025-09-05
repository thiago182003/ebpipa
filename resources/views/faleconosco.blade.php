@extends($layout)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Administração /</span> Fale Conosco</h4>
        <div class="card mb-3">
            <h5 class="card-header">Detalhes do Perfil</h5>
            <div class="card-body">
                <form id="formAccountSettings" method="post" enctype="multipart/form-data"
                    action="{{ route('faleconosco.enviar') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label for="assunto" class="form-label">assunto</label>
                            <input class="form-control form-control-sm" type="text" name="assunto" autofocus
                                id="assunto" value="" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label for="firstName" class="form-label">Mensagem</label>
                            <textarea class="form-control form-control-sm" @required(true) type="text" id="mensagem" name="mensagem"
                                value="" style="height: 200px"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label for="firstName" class="form-label">Anexo</label>
                            <input class="form-control form-control-sm" type="file" accept="application/pdf"
                                id="anexo" name="anexo" value="" />
                        </div>
                        <div class="mt-2 save-now">
                            <button type="submit" class="btn btn-primary btn-save-now"><i class='bx bx-save'></i>
                                Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
