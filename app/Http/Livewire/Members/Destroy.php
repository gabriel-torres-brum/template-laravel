<?php

namespace App\Http\Livewire\Members;

use Livewire\Component;

class Destroy extends Component
{
    public $listeners = [
        "members::destroy" => 'destroy'
    ];

    public function delete($id = null)
    {
        if ($id) {
            Member::find($id)->delete();
        } else {
            Member::whereIn('id', $this->selectedRows)->delete();
        }

        $this->resetTable();

        $this->notification()->success(
            $title = 'Excluído com sucesso!',
        );
    }
}
