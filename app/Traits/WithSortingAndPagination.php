<?php

namespace App\Traits;

use Livewire\WithPagination;

trait WithSortingAndPagination
{
    use WithPagination;

    public $search = '';
    public $page = 1;
    public $perPage = 10;
    public $sortColumn = 'id';
    public $sortDirection = 'DESC';
    public $type = '';
    public $checked = '';

    // Pour la sélection des lignes
    public $selectedRows = [];
    public $selectAll = false;
    

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function doSort($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = ($this->sortDirection === 'ASC') ? 'DESC' : 'ASC';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'ASC';
        }
    }

    public function typeSelect($type)
    {
        $this->type = $type;
        $this->resetPage();
    }

    public function getPerpage($value)
    {
        $this->perPage = $value;
        $this->resetPage();
    }

    public function toggleColumn($column)
    {
        if (in_array($column, $this->columns)) {
            $this->columns = array_diff($this->columns, [$column]);
        } else {
            $this->columns[] = $column;
        }
    }

    public function applyFilters($query)
    {
        if (!empty($this->search)) {
            $query->search($this->search); // Utilise le scopeSearch du modèle
        }


        if ($this->type === "withTrashed") {
            $query = $query->withTrashed();
            session()->flash('status', 'Avec les supprimés');
        } elseif ($this->type === "onlyTrashed") {
            $query = $query->onlyTrashed();
            session()->flash('status', 'Les supprimés seulement');
        }

        return $query->orderBy($this->sortColumn, $this->sortDirection)
                     ->paginate($this->perPage);
    }
    
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    // Méthodes pour gérer la sélection
    public function updatedSelectAll($value)
    {
        if ($value) {
            $items = $this->getData()->items();
            foreach ($items as $item) {
                $this->selectedRows[$item->id] = 1;
            }
        } else {
            $this->selectedRows = [];
        }
    }

    public function toggleSelection($value)
    {
        if (in_array($value, $this->selectedRows)) {
            $this->selectedRows = array_filter(
                $this->selectedRows,
                fn ($item) => $item != $value
            );
        } else {
            $this->selectedRows[] = $value;
        }

        // Facultatif : Réindexer pour éviter des soucis
        $this->selectedRows = array_values($this->selectedRows);
        $this->selectAll = count($this->selectedRows) === $this->getData()->count();
    }


    // Méthode pour récupérer les données actuelles 
    protected function getData()
    {
        // Retourne la collection paginée
    }

    // Actions sur les lignes sélectionnées
    public function deleteSelected()
    {
        if (empty($this->selectedRows)) {
            session()->flash('error', 'Aucune ligne sélectionnée');
            return;
        }

        $modelClass = $this->getModelClass();
        $modelClass::whereIn('id', $this->selectedRows)->delete();
        
        session()->flash('success', count($this->selectedRows) . ' ligne(s) supprimée(s)');
        $this->selectedRows = [];
        $this->selectAll = false;
    }

    // Méthode à implémenter pour obtenir la classe du modèle
    protected function getModelClass()
    {
        // Retourne la classe du modèle (ex: return User::class;)
    }
    

}
