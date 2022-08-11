<?php

namespace App\Http\Livewire;

use Livewire\Component;
use WireUi\Traits\Actions;

class ModalEdit extends Component
{
    use Actions;
    public int | string | null $itemId;
    public $item;
    public string $modelName;

    public bool $show = false;

    public $listeners = [
        'modal-edit' => 'show',
    ];

    public $rules;

    public function show($modelName, $id, $relationships)
    {
        $this->item = "\\App\\Models\\$modelName"::find($id)->loadMissing(...$relationships);
        $this->rules = $this->item->rules();
        $this->modelName = $modelName;
        $this->show = true;
    }
    
    public function save()
    {
        $this->validate();
        
        $this->show = false;
        
        if ($this->item->push()) {
            $this->emit('reset-table');
            return $this->notification()->success(
                $title = 'Salvo com sucesso!',
            );
        }
        $this->notification()->error(
            $title = 'Erro ao salvar, tente novamente mais tarde.',
        );
    }

    public function render()
    {
        return view('livewire.modal-edit');
    }
}
