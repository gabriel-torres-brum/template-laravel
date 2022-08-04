<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class ModalDelete extends Component
{
    use WireToast;

    public bool $show;
    public string $model;
    
    public string $title;
    public string | array $item;

    public $listeners = [
        'modal-delete' => 'show'
    ];

    public function show(string $model, string | array $item)
    {
        $this->model = "\\App\\Models\\$model";
        
        if (is_array($item)) {
            $this->title = "Deseja realmente excluir " . count($item) . " registros do sistema?";
        } else {
            $this->title = "Deseja realmente excluir esse registro do sistema?";
        }

        $this->item = $item;
        $this->show = true;
    }

    public function hide()
    {
        $this->show = false;
        
        $this->emit('reset-table');
    }
    
    public function delete()
    {
        $this->hide();

        toast()->success('Excluído com sucesso!')->push();
        
        if (is_array($this->item)) {
            $this->model::whereIn('id', $this->item)->delete();
        } else {
            $this->model::find($this->item)->delete();
        }
    }

    public function render()
    {
        return view('livewire.modal-delete');
    }
}
