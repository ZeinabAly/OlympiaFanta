<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Etudiant;
use Livewire\Attributes\On;
use App\Traits\WithSortingAndPagination;

class ListEtudiants extends Component
{
    use WithSortingAndPagination;


    public $createRoute = 'admin.user.create';
    
    // POUR LE FILTRE DE COLONNES
    public $columns = ['id','prenom', 'name', 'date_naissance', 'email', 'phone', 'ville', 'quartier', 'option', 'genre', 'action']; 
    

    // LES NOMS A AFFICHER DANS LE FILTRE DES COLONNES
    public $columnSlugs = [
                            'id' => 'Id', 
                            'prenom' => 'Prenom', 
                            'name' => 'Nom', 
                            'date_naissance' => 'Date de naissance', 
                            'email' => 'Email', 
                            'phone' => 'Phone', 
                            'ville' => 'Ville', 
                            'quartier' => 'Quartier', 
                            'option' => 'Option', 
                            'genre' => 'Genre', 
                        ]; 

    public $showDeleteModal = false;

    // SUPPRESSION



    public function delete($id)
    {
        $user = Etudiant::find($id);
        
        if($user) {
            $user->delete();
            $this->dispatch('postDeleted'); 
        }
        
        return session()->flash('status', 'Etudiant supprimé avec succès !');
    }

    // Implémentation des méthodes abstraites du trait
    protected function getData()
    {
        return $this->applyFilters(Etudiant::query());
    }

    protected function getModelClass()
    {
        return Etudiant::class;
    }

    // public function openEditModal($id)
    // {
    //     $this->dispatch('openEditModal', $id);
    // }

    // public function openShowModal($id)
    // {
    //     $this->dispatch('openShowModal', $id);
    // }

    #[On('StudentAdded')]
    #[On('StudentUpdated')]
    public function render()
    {
        $etudiants = $this->applyFilters(Etudiant::query());
        return view('livewire.list-etudiants', [
            'etudiants' => $etudiants
        ]);
    }
}
