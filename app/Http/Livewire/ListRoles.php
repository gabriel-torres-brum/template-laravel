<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ListRoles extends Component
{
    use WithPagination;
    use Actions;

    // Search
    public string $search = '';
    protected $queryString = ['search'];

    // Select Rows
    public $selectedRows = [];
    public $selectAllRows = false;
    public $selectAll = false;

    // Sorting
    public $sortField;
    public $sortDirection = 'asc';

    // Listeners
    public $listeners = [
        'reset-table' => 'resetTable'
    ];

    public function render()
    {
        return view('livewire.list-roles', ['roles' => $this->roles]);
    }

    public function edit($id)
    {
        $this->emit('modal-edit', 'Role', $id, ['members']);
    }

    public function delete($id = null)
    {
        if ($id) {
            Role::find($id)->delete();
        } else {
            Role::whereIn('id', $this->selectedRows)->delete();
        }

        $this->resetTable();

        $this->notification()->success(
            $title = 'Excluído com sucesso!',
        );
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function getRolesProperty()
    {
        if ($this->sortField) {
            return $this->rolesQuery->orderBy($this->sortField, $this->sortDirection)->paginate(5);
        }
        return $this->rolesQuery->paginate(5);
    }

    public function getRolesQueryProperty()
    {
        $query = Role::query();

        $query->orWhere('role_name', 'like', "%{$this->search}%")
            ->orWhere('description', 'like', "%{$this->search}%")
            ->orWhere('gender', 'like', "%{$this->search}%");

        return $query;
    }

    public function isChecked($id)
    {
        return in_array($id, $this->selectedRows);
    }

    public function selectAll()
    {
        $this->selectAll = true;
        $this->selectedRows = $this->rolesQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function updatedSelectAllRows($value)
    {
        $this->selectAll = false;
        if ($value) {
            $this->selectedRows = $this->roles->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function updatedSelectedRows()
    {
        if ($this->rolesQuery->pluck('id')->count() === count($this->selectedRows)) {
            $this->selectAllRows = true;
            $this->selectAll = true;
        } elseif ($this->roles->pluck('id')->count() === count($this->selectedRows)) {
            $this->selectAllRows = true;
            $this->selectAll = false;
        } else {
            $this->selectAllRows = false;
            $this->selectAll = false;
        }
    }

    public function resetTable()
    {
        $this->selectedRows = [];
        $this->selectAllRows = false;
        $this->selectAll = false;
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetTable();
    }
}
