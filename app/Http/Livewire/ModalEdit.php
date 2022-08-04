<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModalEdit extends Component
{
    public int | string | null $itemId;
    public $item;
    public string $modelName;

    public bool $show;

    public $listeners = [
        'modal-edit' => 'show',
    ];

    public $rules;

    public function show($modelName, $itemId = null)
    {
        $this->item = "\\App\\Models\\$modelName"::find($itemId);
        $this->rules = $this->item->rules();
        $this->modelName = $modelName;
        $this->show = true;
    }
    
    public function update()
    {
        $this->show = false;
        
        $this->item->save();

        toast()->success("Atualizado com sucesso!")->push();
    }

    public function render()
    {
        return view('livewire.modal-edit');
    }
}
