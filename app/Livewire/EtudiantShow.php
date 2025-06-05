<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Etudiant;
use Livewire\Attributes\On;

class EtudiantShow extends Component
{
    public $etudiant;
    public $isVisible;

    // #[On('openShowModal')]
    #[On('open-show-modal')]
    public function loadEtudiant($id)
    {
        $this->etudiant = Etudiant::findOrFail($id);
        $this->isVisible = true;
    }

    public function closeModal(){
        $this->isVisible = false;
    }

    public function render()
    {
        return view('livewire.etudiant-show', [
            'etudiant' => $this->etudiant
        ]);
    }
}
