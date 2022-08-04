<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ListMembers extends Component
{
    use WithPagination;
    use WireToast;

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
        return view('livewire.list-members', ['members' => $this->members]);
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

    public function getMembersProperty()
    {
        if ($this->sortField) {
            return $this->membersQuery->orderBy($this->sortField, $this->sortDirection)->paginate(5);
        }
        return $this->membersQuery->paginate(5);
    }

    public function getMembersQueryProperty()
    {
        $query = Member::query();

        if (str_contains($this->search, 'dizimista')) {
            $query->orWhere('tither', true);
        }

        $query->orWhere('name', 'like', "%{$this->search}%")
            ->orWhere('gender', 'like', "%{$this->search}%")
            ->orWhereRelation('user', 'email', 'like', "%{$this->search}%")
            ->orWhereRelation('role', 'description', 'like', "%{$this->search}%")
            ->orWhereRelation('church', 'church_name', 'like', "%{$this->search}%");
            
        return $query;
    }

    public function isChecked($memberId)
    {
        return in_array($memberId, $this->selectedRows);
    }

    public function selectAll()
    {
        $this->selectAll = true;
        $this->selectedRows = $this->membersQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function updatedSelectAllRows($value)
    {
        $this->selectAll = false;
        if ($value) {
            $this->selectedRows = $this->members->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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
        $this->showModalDelete = false;
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetTable();
    }
}
