<?php

namespace App\Http\Livewire\Roles;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use PowerComponents\LivewirePowerGrid\Traits\WithSorting;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;
    use WithSorting;
    use WithPagination;

    // Search
    public string $search = '';
    protected $queryString = ['search'];

    // Select Rows
    public $selectedRows = [];
    public $selectAllRows = false;
    public $selectAll = false;

    // Options to render table
    public array $tableOptions;

    // Listeners
    public $listeners = [
        'roles::index::refresh' => '$refresh',
        'roles::index::reset-table' => 'resetTable'
    ];

    public function render()
    {
        $this->tableOptions = [
            'selectedRows' => $this->selectedRows,
            'selectAll' => $this->selectAll,
            'collection' => $this->roles,
            'titles' => [
                'Cargo',
                'Gênero',
            ],
            'values' => [
                'role_name',
                'gender',
            ]
        ];

        return view('livewire.roles.index', [
            'tableOptions' => $this->tableOptions
        ]);
    }

    public function showCreateForm()
    {
        $this->emit('roles::create');
    }
    
    public function edit($id)
    {
        $this->emit('roles::update', $id);
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

    public function getRolesProperty()
    {
        return $this->rolesQuery->paginate(5);
    }

    public function getRolesQueryProperty()
    {
        $query = Role::query()
            ->when($this->search, function ($q) {
                return $q->where('role_name', 'like', "%{$this->search}%")
                ->orWhere('gender', 'like', "%{$this->search}%");
            });

        return $query;
    }

    public function isChecked($id)
    {
        return in_array($id, $this->selectedRows);
    }

    public function selectAll()
    {
        $this->selectAll = true;
        $this->selectedRows = $this->rolesQuery->pluck('id')
            ->map(fn ($item) => (string) $item)
            ->toArray();
    }

    public function updatedSelectAllRows($value)
    {
        $this->selectAll = false;
        if ($value) {
            $this->selectedRows = $this->roles->pluck('id')
                ->map(fn ($item) => (string) $item)
                ->toArray();
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
        $this->emitSelf('roles::index::refresh');
    }

    public function updatedSearch()
    {
        $this->resetTable();
    }
}
