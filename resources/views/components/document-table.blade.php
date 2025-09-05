<tr>
    <td>
        @if($titulo)
            <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-html="true" 
                title="{{ $titulo }}">
                <strong>{{ $descricao }}</strong>
                @if(@$foto==true)
                <a style="color:rgb(72, 120, 209)"
                    onclick="window.open('{{ asset('img/foto-exemplo.jpg') }}','foto-exemplo','width=600,height=400')">
                    (Foto de exemplo - clique aqui)</a>
                @endif
                <i class='bx bx-info-circle' style="color: #ff3e1d"></i>
            </span>
        @else
            <strong>{{ $descricao }}</strong>
        @endif
    </td>
    @if($anexo != "")
        <td><a id={{$anexo}} href="#" target="_blank">baixar</a></td>
    @elseif($modelo != "")
        @if($modelo == "vazio")
            <td></td>
        @else
            <td><a href={{$modelo}} target="_blank">link</a></td>
        @endif
    @endif
    <td>
        @if (!$documento)
            <input class="form-control form-control-sm" type="file" accept="application/pdf" 
                id="{{ strtolower($name) }}" name="{{ strtolower($name) }}" />
        @endif
    </td>
    <td>
        @if ($documento)
            <div class="d-flex align-items-center">
                <a target="_blank" class="btn btn-sm btn-icon btn-primary me-2" 
                    href="{{ url("storage/$documento") }}">
                    <i class="bx bx-file"></i>
                </a>
                <span class="mx-1">|</span>
                <button class="btn btn-sm btn-icon btn-outline-danger remover ms-2" 
                        data-tipo="{{$tipo}}" data-arquivo="{{ strtolower($name) }}" 
                        data-nome="{{ $descricao }}">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        @endif
    </td>
</tr>