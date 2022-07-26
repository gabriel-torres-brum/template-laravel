<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModalDelete extends Component
{
    public bool $show = false;
    public string $title;

    public string | array | null $itemsIdsToDelete;
    public string $model;

    public $listeners = [
        'modal-delete' => 'show',
    ];

    public function show($model, $itemsIdsToDelete, $modalTitle = null)
    {
        $this->title = $modalTitle ?? (is_array($itemsIdsToDelete)
            ? "Deseja realmente excluir os items selecionados?"
            : "Deseja realmente excluir este item?");
        $this->itemsIdsToDelete = $itemsIdsToDelete;
        $this->model = $model;

        $this->show = true;
    }

    public function hide()
    {
        $this->show = false;
        $this->itemsIdsToDelete = null;
    }

    public function delete()
    {
        if (is_array($this->itemsIdsToDelete)) {
            $this->model::query()
                ->whereIn('id', $this->itemsIdsToDelete)
                ->delete();
        } else {
            $this->model::find($this->itemsIdsToDelete)->delete();
        }

        $this->hide();

        $this->emit('resetTable');

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Excluído com sucesso!"
        ]);
    }

    public function render()
    {
        return view('livewire.modal-delete');
    }
}
