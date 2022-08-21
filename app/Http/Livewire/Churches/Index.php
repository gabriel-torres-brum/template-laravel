<?php

namespace App\Http\Livewire\Churches;

use App\Models\Church;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;
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
        'churches::index::refresh' => '$refresh',
        'churches::index::reset-table' => 'resetTable'
    ];

    public function render()
    {
        $this->tableOptions = [
            'selectedRows' => $this->selectedRows,
            'selectAll' => $this->selectAll,
            'collection' => $this->churches,
            'titles' => [
                'Igreja',
                'Qtd Membros'
            ],
            'values' => [
                'church_name',
                'members->count()',
            ]
        ];

        return view('livewire.churches.index', [
            'tableOptions' => $this->tableOptions
        ]);
    }

    public function showCreateForm()
    {
        $this->emit('churches::create');
    }
    
    public function edit($id)
    {
        $this->emit('churches::update', $id);
    }

    public function delete($id = null)
    {
        if ($id) {
            Church::find($id)->delete();
        } else {
            Church::whereIn('id', $this->selectedRows)->delete();
        }

        $this->resetTable();

        $this->notification()->success(
            $title = 'Igreja excluída com sucesso!',
        );
    }

    public function getChurchesProperty()
    {
        return $this->churchesQuery->paginate(5);
    }

    public function getChurchesQueryProperty()
    {
        $query = Church::query()
            ->latest()
            ->when($this->search, function ($q) {
                return $q->where('church_name', 'like', "%{$this->search}%");
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
        $this->selectedRows = $this->churchesQuery->pluck('id')
            ->map(fn ($item) => (string) $item)
            ->toArray();
    }

    public function updatedSelectAllRows($value)
    {
        $this->selectAll = false;
        if ($value) {
            $this->selectedRows = $this->churches->pluck('id')
                ->map(fn ($item) => (string) $item)
                ->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function updatedSelectedRows()
    {
        if ($this->churchesQuery->pluck('id')->count() === count($this->selectedRows)) {
            $this->selectAllRows = true;
            $this->selectAll = true;
        } elseif ($this->churches->pluck('id')->count() === count($this->selectedRows)) {
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
        $this->emitSelf('churches::index::refresh');
    }

    public function updatedSearch()
    {
        $this->resetTable();
    }
}
