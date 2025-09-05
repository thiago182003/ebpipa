<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DocumentTable extends Component
{
    /**
     * Create a new component instance.
     */
    public $documento;
    public $tipo;
    public $titulo;
    public $descricao;
    public $name;
    public $foto;
    public $anexo;
    public $modelo;

    public function __construct($descricao,$titulo,$name,$documento,$tipo,$foto=false,$anexo="",$modelo="")
    {
        //
        $this->documento = $documento;
        $this->tipo = $tipo;
        $this->name = $name;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->foto = $foto;
        $this->anexo = $anexo;
        $this->modelo = $modelo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.document-table');
    }
}
