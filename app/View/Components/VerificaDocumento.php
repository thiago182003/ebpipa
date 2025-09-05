<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VerificaDocumento extends Component
{

    public $objeto;
    public $numero;
    public $documento;
    public $tipo;
    public $descricao;
    /**
     * Create a new component instance.
     */
    public function __construct($objeto,$numero,$documento,$tipo,$descricao)
    {
        //
        $this->objeto = $objeto;
        $this->numero = $numero;
        $this->documento = $documento;
        $this->tipo = $tipo;
        $this->descricao = $descricao;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.verifica-documento');
    }
}
