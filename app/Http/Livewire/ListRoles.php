<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ListRoles extends Component
{
    use WithPagination;
    use WireToast;

    public string $search = '';
    protected $queryString = ['search'];

    public $selectedRows = [];
    public $selectAllRows = false;
    public $selectAll = false;

    public $listeners = [
        'resetTable' => 'resetTable'
    ];

    public function render()
    {
        return view('livewire.list-roles', ['roles' => $this->roles]);
    }

    public function getRolesProperty()
    {
        return $this->rolesQuery->paginate(5);
    }

    public function getRolesQueryProperty()
    {
        $query = Role::query();

        $query->orWhere('description', 'like', "%{$this->search}%")
            ->orWhere('gender', 'like', "%{$this->search}%")
            ->orWhere('role_name', 'like', "%{$this->search}%");

        return $query;
    }

    public function isChecked($roleId)
    {
        return in_array($roleId, $this->selectedRows);
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
        $this->showModalDelete = false;
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetTable();
    }
}
