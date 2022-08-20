<?php

namespace App\Http\Livewire\Members;

use App\Models\Member;
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
        'members::index::reset-table' => 'resetTable'
    ];

    public function render()
    {
        $this->tableOptions = [
            'selectedRows' => $this->selectedRows,
            'selectAll' => $this->selectAll,
            'collection' => $this->members,
            'titles' => [
                'Nome',
                'Idade',
                'Gênero',
                'Igreja',
                'Cargo'
            ],
            'values' => [
                'name',
                'birthday->age',
                'gender',
                'church->church_name',
                'role->role_name'
            ]
        ];

        return view('livewire.members.index', [
            'tableOptions' => $this->tableOptions
        ]);
    }

    public function showCreateForm()
    {
        $this->emit('members::create');
    }
    
    public function edit($id)
    {
        $this->emit('members::update', $id);
    }

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

    public function getMembersProperty()
    {
        return $this->membersQuery->paginate(5);
    }

    public function getMembersQueryProperty()
    {
        $query = Member::query()
            ->when($this->search, function ($q) {
                if (str_contains($this->search, 'dizimista')) {
                    return $q->where('tither', true);
                }
                return $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('gender', 'like', "%{$this->search}%")
                ->orWhereRelation('user', 'email', 'like', "%{$this->search}%")
                ->orWhereRelation('role', 'role_name', 'like', "%{$this->search}%")
                ->orWhereRelation('church', 'church_name', 'like', "%{$this->search}%");
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
        $this->selectedRows = $this->membersQuery->pluck('id')
            ->map(fn ($item) => (string) $item)
            ->toArray();
    }

    public function updatedSelectAllRows($value)
    {
        $this->selectAll = false;
        if ($value) {
            $this->selectedRows = $this->members->pluck('id')
                ->map(fn ($item) => (string) $item)
                ->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function updatedSelectedRows()
    {
        if ($this->membersQuery->pluck('id')->count() === count($this->selectedRows)) {
            $this->selectAllRows = true;
            $this->selectAll = true;
        } elseif ($this->members->pluck('id')->count() === count($this->selectedRows)) {
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
