<tr>
    <td><strong>{{$numero . '. ' . $descricao}}</strong></td>
    @if (@$objeto[$documento])
        <td>
            <a target="_blank" class="btn btn-sm btn-icon btn-primary"
                href="{{ url("storage/$objeto[$documento]") }}">
                <i class='bx bx-file'></i>
            </a>
        </td>
        <td>
            <button class="btn btn-sm btn-icon btn-success aceitar"
                data-tipo="{{$tipo}}" data-arquivo="{{$documento}}"
                data-nome="{{$descricao}}"><i
                    class='bx bx-check'></i>
            </button>
        </td>
    @else
        <td></td>
        <td></td>
    @endif
    <td>
        <button class="btn btn-sm btn-icon btn-danger negar" data-tipo="{{$tipo}}"
            data-arquivo="{{$documento}}"
            data-nome="{{$descricao}}"><i
                class='bx bx-x'></i>
        </button>
    </td>
    <td>
        <script>
            document.write(carregarStatus('{{ $objeto[$documento . "_status"] }}'));
        </script>
    </td>
</tr>