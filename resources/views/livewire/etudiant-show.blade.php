<div >
    @if($isVisible)
    <div class="modalAddStudent">
        <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg relative">
            <h2 class="text-2xl font-bold mb-4">Fiche de l'étudiant</h2>

            
            <button class="absolute top-3 right-3 hover:bg-transparent" wire:click="closeModal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#bf1a1a" height="23" width="23"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
            </button>

            <div class="flex gap-6 mb-6">
                @if ($etudiant->photo)
                    <img src="{{ asset('storage/' . $etudiant->photo) }}" class="w-40 h-40 object-cover rounded-full border" />
                @else
                    <div class="w-40 h-40 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
                        Pas de photo
                    </div>
                @endif
            </div>
    
            <div class="grid grid-cols-2 gap-4">
                <div><strong>Prénom :</strong> {{ $etudiant->prenom }}</div>
                <div><strong>Nom :</strong> {{ $etudiant->name }}</div>
                <div><strong>Téléphone :</strong> {{ $etudiant->phone }}</div>
                <div><strong>Email :</strong> {{ $etudiant->email }}</div>
                <div><strong>Date de naissance :</strong> {{ $etudiant->date_naissance }}</div>
                <div><strong>Ville :</strong> {{ $etudiant->ville }}</div>
                <div><strong>Quartier :</strong> {{ $etudiant->quartier }}</div>
                <div><strong>Option :</strong> {{ $etudiant->option ?? 'Non précisé' }}</div>
                <div><strong>Genre :</strong> {{ ucfirst($etudiant->genre) }}</div>
                <div class="col-span-2"><strong>Commentaire :</strong> {{ $etudiant->comment }}</div>
            </div>
    
        </div>
    </div>

    @endif
</div>
