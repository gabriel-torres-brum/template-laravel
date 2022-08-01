<?php

namespace App\Http\Livewire\Modals;

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

    public function show(string $model, string $title, string | array $item)
    {
        $this->model = "\\App\\Models\\$model";
        $this->title = $title;
        $this->item = $item;
        $this->show = true;
    }

    public function hide()
    {
        $this->show = false;
        
        $this->emit('resetTable');
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
        return view('livewire.modals.modal-delete');
    }
}
