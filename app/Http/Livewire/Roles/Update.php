<?php

namespace App\Http\Livewire\Roles;

use App\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class Update extends Component
{
    use Actions;

    public Role $role;

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
        'roles::update' => 'show',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.roles.update');
    }

    public function show($id)
    {
        $this->role = Role::find($id);

        $this->show = true;
    }

    public function save()
    {
        $this->validate([
            'role.role_name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('roles', 'role_name')->ignoreModel($this->role)
            ]
        ]);

        $this->notification()->success('Cargo atualizado com sucesso!');

        $this->resetForm();
        $this->show = false;
        $this->emit('roles::index::reset-table');
    }

    public function resetForm()
    {
        $this->role = new Role;

        $this->resetErrorBag();
    }

    public function updated($field)
    {
        $this->resetErrorBag($field);
    }
}
