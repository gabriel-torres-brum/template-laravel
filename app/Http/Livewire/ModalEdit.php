<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModalEdit extends Component
{
    public bool $show = false;
    public string $title;

    public string $model;
    public string | null $itemId;
    public array $itemValues;

    public $listeners = [
        'modal-edit' => 'show',
    ];

    public function show($model, $itemId, $itemValues, $modalTitle = null)
    {
        $this->show = true;
        $this->model = $model;
        $this->itemId = $itemId;
        $this->itemValues = $itemValues;
        $this->title = $modalTitle;
    }

    public function hide()
    {
        $this->show = false;
        $this->itemId = null;
        $this->itemValues = [];
    }

    public function edit()
    {
        if ($this->itemId) {
            $this->model::find($this->itemId)->update($this->itemValues)->save();
            $message = "Atualizado com sucesso!";
        } else {
            $this->model::fill($this->itemValues)->save();
            $message = "Incluído com sucesso!";
        }

        $this->hide();

        $this->emit('resetTable');

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => $message
        ]);
    }

    public function render()
    {
        return view('livewire.modal-edit');
    }


}
