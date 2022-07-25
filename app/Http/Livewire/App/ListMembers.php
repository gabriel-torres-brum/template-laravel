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

    public $listeners = ['resetPage'];
    
    public function render()
    {
        $query = Member::query();
        if ($this->search) {
            if (str_contains($this->search, 'dizimista')) {
                $query->orWhere('tither', true);
            }

            $query->orWhere('name', 'like', "%{$this->search}%")
                ->orWhere('gender', 'like', "%{$this->search}%")
                ->orWhereRelation('user', 'email', 'like', "%{$this->search}%")
                ->orWhereRelation('role', 'description', 'like', "%{$this->search}%")
                ->orWhereRelation('church', 'church_name', 'like', "%{$this->search}%");
        }
        $this->query = $query->paginate(5);
        return view('livewire.app.list-members', [
            'members' => $this->query
        ]);
    }

    public function updatedSelectAllRows($value)
    {
        if ($value) {
            dd($this->selectedRows);
        } else {
            $this->selectedRows = [];
        }
    }

    public function updated($property)
    {
        if ($property === 'search') {
            $this->resetPage();
        }
    }
}
