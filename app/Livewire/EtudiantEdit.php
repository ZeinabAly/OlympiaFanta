<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{Etudiant, Option};
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class EtudiantEdit extends Component
{
    use WithFileUploads;

    public $etudiantId;
    public $prenom, $name, $phone, $email, $dateNaissance, $ville, $autreVille, $quartier, $options, $option, $genre, $photo, $comment;
    public $existingPhoto;
    public $isEditing = false;

    public function mount(){
        $this->options = Option::get();
    }

    public function choiceVille($ville){
        $this->ville = $ville;
    }

    public function choiceQuartier($quartier){
        $this->quartier = $quartier;
    }

    #[On('open-edit-modal')]
    public function loadEtudiant($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $this->isEditing = true;

        $this->etudiantId = $etudiant->id;
        $this->prenom = $etudiant->prenom;
        $this->name = $etudiant->name;
        $this->phone = $etudiant->phone;
        $this->email = $etudiant->email;
        $this->dateNaissance = $etudiant->date_naissance;
        $this->ville = $etudiant->ville;
        $this->quartier = $etudiant->quartier;
        $this->option = $etudiant->option;
        $this->genre = $etudiant->genre;
        $this->comment = $etudiant->comment;
        $this->photo = $etudiant->photo;

    }

    public function update()
    {
        $this->validate([
            'prenom' => 'required|string|min:2',
            'name' => 'required|string|min:2',
            'phone' => 'required|digits:9|unique:etudiants,phone,' . $this->etudiantId,
            'email' => 'required|email|unique:etudiants,email,' . $this->etudiantId,
            'dateNaissance' => 'required|date',
            'ville' => 'required|string',
            'quartier' => 'required|string',
            'option' => 'nullable|string',
            'genre' => 'required|in:masculin,feminin',
            'photo' => 'nullable|image|max:2048',
            'comment' => 'nullable|string'
        ]);

        $etudiant = Etudiant::findOrFail($this->etudiantId);

        $filePath = $etudiant->photo;

        // Si une nouvelle photo est uploadée
        if ($this->photo) {
            // Supprimer l'ancienne photo si elle existe
            if ($etudiant->photo && \Storage::disk('public')->exists($etudiant->photo)) {
                \Storage::disk('public')->delete($etudiant->photo);
            }

            // Enregistrer la nouvelle
            $timestamp = now()->timestamp;
            $extension = $this->photo->getClientOriginalExtension();
            $fileName = "{$timestamp}.{$extension}";
            $filePath = $this->photo->storeAs('etudiants', $fileName, 'public');
        }
    

        $etudiant->update([
            'prenom' => $this->prenom,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'date_naissance' => $this->dateNaissance,
            'ville' => $this->ville,
            'quartier' => $this->quartier,
            'option' => $this->option,
            'genre' => $this->genre,
            'photo' => $filePath,
            'comment' => $this->comment,
        ]);

        session()->flash('success', 'Informations modifiée avec succès !');
        $this->dispatch('StudentUpdated');
    }

    public function closeModal(){
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.etudiant-edit');
    }
}
