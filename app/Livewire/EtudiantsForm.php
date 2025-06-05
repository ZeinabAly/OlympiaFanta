<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{Etudiant, Option};
use App\Models\Registration;
use Livewire\WithFileUploads;

class EtudiantsForm extends Component
{
    use WithFileUploads;

    public $prenom = '', $name = '', $nouvelleOption, $phone = '', $email = '', $dateNaissance = '', 
            $ville = '', $autreVille = '', $quartier = '', $autreQuartier = '', $options = [] ,$option = '', $genre = 'masculin', 
            $photo = null, $comment = '';


    protected function rules()
    {
        return [
            'prenom' => 'required|string|min:2',
            'name' => 'required|string|min:2',
            'phone' => 'required|unique:etudiants,phone|digits:9',
            'email' => 'required|email|unique:etudiants,email',
            'dateNaissance' => 'required|date',
            'ville' => 'required|string',
            'quartier' => 'required|string',
            'option' => 'nullable|string',
            'genre' => 'required|in:masculin,feminin',
            'photo' => 'nullable|image|max:2048',
            'comment' => 'nullable|string'
        ];
    }

    protected function messages()
    {
        return [
            'prenom.required' => 'Le prénom est obligatoire.',
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => "L'email est requis.",
            'ville.required' => "La ville est obligatoire.",
            'phone.required' => "Ce champ est obligatoire.",
            'dateNaissance.required' => "Ce champ est obligatoire.",
            'quartier.required' => "Ce champ est obligatoire.",
            'email.email' => 'Adresse email invalide.',
            'phone.digits' => 'Le numéro de téléphone doit comporter 9 caractères.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.unique' => 'Ce numéro est déjà utilisé.',
            'photo.image' => 'Le fichier doit être une image.',
            'photo.max' => 'La photo ne doit pas dépasser 2MB.'
        ];
    }

    #[On('optionCreated')]
    public function mount(){
        $this->options = Option::get();
    }

    public function choiceVille($ville){
        $this->ville = $ville;
    }

    public function choiceQuartier($quartier){
        $this->quartier = $quartier;
    }

    public function createOption(){
        Option::create([
            'name' => ucfirst(strtolower($this->nouvelleOption))
        ]);

        session()->flash('success', 'Option créée !');
        $this->nouvelleOption = '';
        $this->dispatch('optionCreated');
    }

    public function save()
    {

        $this->validate();

        $filePath = "";

        if ($this->photo) {

            // Enregistrer la nouvelle
            $timestamp = now()->timestamp;
            $extension = $this->photo->getClientOriginalExtension();
            $fileName = "{$timestamp}.{$extension}";
            $filePath = $this->photo->storeAs('etudiants', $fileName, 'public');
        }
 
        Etudiant::create([
            'prenom' => $this->prenom,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'date_naissance' => $this->dateNaissance,
            'ville' => $this->ville === 'autre' ? $this->autreVille : $this->ville,
            'quartier' => $this->quartier === 'autre' ? $this->autreQuartier : $this->quartier,
            'option' => $this->option,
            'genre' => $this->genre,
            'photo' => $filePath,
            'comment' => $this->comment
        ]);

        $this->reset();
        session()->flash('success', 'Etudiant enregistré avec succès !');
        $this->dispatch('StudentAdded');
    }

    public function render()
    {
        $quartiers = [
            'yimbaya' => 'Yimbaya',
            'gbessia' => 'Gbessia',
            'enta' => 'Enta',
            'coleah' => 'Coleah',
            'dixinn' => 'Dixinn',
            'hamdallaye' => 'Hamdallaye',
            'miniere' => 'Minière',
            'cosa' => 'Cosa',
        ];
        return view('livewire.etudiants-form',
        [
            'quartiers' => $quartiers
        ]);
    }
}
