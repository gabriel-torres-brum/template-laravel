<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    public string $modelName;
    public $selectedRows;
    public $selectAll;
    public $itens;
    public array $itemNames;
    public array $itemValues;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modelName, $selectedRows, $selectAll, $itens, $itemNames, $itemValues)
    {
        $this->modelName = $modelName;
        $this->selectedRows = $selectedRows;
        $this->selectAll = $selectAll;
        $this->itens = $itens;
        $this->itemNames = $itemNames;
        $this->itemValues = $itemValues;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table');
    }
}
