<?php

namespace App\Http\Livewire\App;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class ListMembers extends Component
{
    use WithPagination;

    public string $search = '';
    protected $queryString = ['search'];

    public $selectedRows = [];
    public $selectAllRows = false;
    public $selectAll = false;

    public $listeners = ['resetTable'];
    
    public function render()
    {
        return view('livewire.app.list-members', [
            'members' => $this->members
        ]);
    }
    
    public function selectAll()
    {
        $this->selectedRows = $this->membersQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        $this->selectAll = true;
    }

    public function updatedSelectAllRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->members->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function updatedSelectedRows($value)
    {
        if (count($this->membersQuery->pluck('id')) === count($value)) {
            $this->selectAllRows = true;
            $this->selectAll();
        } else if (count($this->members->pluck('id')) === count($value)) {
            $this->selectAllRows = true;
            $this->selectAll = false;
        } else {
            $this->selectAllRows = false;
            $this->selectAll = false;
        }
    }

    public function getMembersProperty()
    {
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

    public function isChecked($member_id)
    {
        return in_array($member_id, $this->selectedRows);
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
