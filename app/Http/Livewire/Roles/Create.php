<?php

namespace App\Http\Livewire\Roles;

use App\Models\Role;
use Livewire\Component;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;

    public ?Role $role = null;

    public bool $show = false;

    public $rules = [
        'role.role_name' => 'required|string|max:50',
        'role.gender' => 'required|string|max:50',
    ];

    public $messages = [
        'role.role_name.required' => 'O nome do cargo é obrigatório',
        'role.role_name.string' => 'O nome do cargo é obrigatório',
        'role.role_name.max' => 'O nome do cargo não pode ser superior a 50 caracteres',
        'role.gender.required' => 'O gênero do cargo deve ser definido',
        'role.gender.string' => 'O gênero do cargo deve ser definido',
        'role.gender.max' => 'O gênero do cargo não pode ser superior a 50 caracteres',
    ];

    public $listeners = [
        'roles::create' => 'show',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.roles.create');
    }

    public function show()
    {
        $this->show = true;
    }

    public function save()
    {
        $this->validate();
        
        $this->role->save();

        $this->notification()->success('Cargo adicionado com sucesso!');

        $this->resetForm();
        $this->show = false;
        $this->emit('roles::index::reset-table');
    }

    public function resetForm()
    {
        $this->role = new Role;

        $this->role->gender = 'Masculino';

        $this->resetErrorBag();
    }

    public function updated($field)
    {
        $this->resetErrorBag($field);
    }
}
