<div x-data="{ openModalAdd: false }" x-cloak @open-modal.window="openModalAdd = true">

    <!-- MESSAGGE D'ERREUR -->
    @if (session()->has('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 8000)"
            class="fixed top-4 right-4 bg-green-800 flexCenter gap-2 text-white font-semibold px-4 py-2 rounded-lg shadow-lg z-[500] animate-fade-in">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#fff" height="16" width="16"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
            {{session('success')}}
        </div>
    @endif

    <div class="modalAddStudent" x-show="openModalAdd" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200"  x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
        
        <div class="section-container">
            <!-- Reservation -->
            <div class="form-cover relative">
                <h2 class="reservation-accro">Enregistrement</h2>
                <h2 class="reservation-title mb-10">Formulaire d'inscription</h2>
                
                <button class="absolute top-3 right-3 hover:bg-transparent" @click="openModalAdd = false">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#bf1a1a" height="23" width="23"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                </button>

                <form class="w-[100%] relative formInscription" wire:submit.prevent="save" enctype="multipart/form-data">
      
                    <div class="reservation-inputs">
                        
                        <!-- PRENOM -->
                        <div class="" style="grid-area: prenom; text-align: left">
                            <label for="prenom" class="">Prenom</label>
                            <input type="text" wire:model="prenom" id="prenom" placeholder="Mariame" value="{{old('prenom')}}" class="champInput">
                            @error('prenom')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
                        
                        <!-- NOM -->
                        <div class="" style="grid-area: nom; text-align: left;">
                            <label for="nom" class="">Nom</label>
                            <input type="text" wire:model="name" id="name"  placeholder="Camara" value="{{old('name')}}" class="champInput">
                            @error('name')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
            
                        <!-- TELEPHONE -->
                        <div class="" style="grid-area: phone; text-align: left;">
                            <label for="phone" class="">Téléphone</label>
                            <input type="number" wire:model="phone" id="phone" placeholder="623479759" value="{{old('phone')}}" class="champInput">
                            @error('phone')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
            
                        <!-- EMAIL -->
                        <div class="" style="grid-area: email; text-align: left; ">
                            <label for="email" class="">Email</label>
                            <input type="email" wire:model="email" id="email" placeholder="mariame@gmail.com" value="{{old('email')}}" class="champInput">
                            @error('email')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
            
                        <!-- DATE DE NAISSANCE -->
                        <div class="" style="grid-area: dateN; text-align: left;">
                            <label for="dateNaissance" class="">Date de naissance</label>
                            <input type="date" wire:model="dateNaissance" id="dateNaissance" placeholder="Date de naissance" value="{{old('dateNaissance')}}" class="champInput">
                            @error('dateNaissance')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
            
                        <!-- VILLE -->
                        <div class="" style="grid-area: ville; text-align: left;">
                            <label for="ville" class="">Ville</label>
                            <select wire:change="choiceVille($event.target.value)" id="ville" class="champInput">
                                <option value="">Choisir une ville</option>
                                <option value="Conakry">Conakry</option>
                                <option value="Kankan">Kankan</option>
                                <option value="autre">Autre...</option>
                            </select>

                            @if($ville === 'autre')
                                <input type="text" wire:model="autreVille" placeholder="Entrez une ville" class="champInput mt-2">
                            @endif
                            @error('ville')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
            
                        <!-- QUARTIER -->
                        <div class="" style="grid-area: quartier; text-align: left;">
                            <label for="quartier" class="">Quartier</label>
                            <select wire:change="choiceQuartier($event.target.value)" id="quartier" class="champInput">
                                <option value="">Choisir un quartier</option>
                                <option value="yimbaya">Yimbaya</option>
                                <option value="gbessia">Gbessia</option>
                                <option value="hamdallaye">Hamdallaye</option>
                                <option value="cosa">Cosa</option>
                                <option value="dixinn">Dixinn</option>
                                <option value="autre">Autre...</option>
                            </select>

                            @if($quartier === 'autre')
                                <input type="text" wire:model="autreQuartier" placeholder="Entrez un quartier" class="champInput mt-2">
                            @endif
                            @error('quartier')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
                        
                        <!-- OPTIO -->
                        <div class="" style="grid-area: option; text-align: left;">
                            <label for="option" class="">Option</label>
                            <div class="flexCenter gap-2">
                                <select wire:model="option" class="champInput">
                                    <option value="" selected>Choisir une option</option>
                                    @foreach($options as $opt)
                                        <option value="{{ $opt->name }}">{{ ucwords(strtolower($opt->name)) }}</option>
                                    @endforeach
                                </select>

                                <!-- Bouton plus pour ajouter une nouvelle option -->
                                <div x-data="{ option: false }" x-cloak @click.outside="option = false" class="relative  text-left">
                                    <p @click="option = !option" class="btnOptionPlus">
                                        <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                                        </svg>                                    
                                    </p>
                                
                                    <div x-show="option" class="absolute top-12 right-0 z-10 bg-[#d8d8d8] shadow-sm p-3 min-w-[250px]">
                                        <div class="flex gap-3">
                                            <input type="text" wire:model="nouvelleOption" placeholder="Nouvelle option" class="champInput min-w-[200px]" />
                                            <button type="button" wire:click="createOption" class="bg-white text-xs font-semibold px-3 rounded-sm">Ajouter</button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    
                        <!-- GENRE -->
                        <div style="grid-area: genre; text-align: left; text-align: left">
                            <label class="">Genre</label>
                            <div class="flex gap-4">
                                <input type="radio" id="male" wire:model="genre" value="masculin" class="hidden peer/male" checked />
                                <label for="male"
                                    class="px-6 py-2 bg-[#f2f2f2] shadow-md text-gray-700 rounded-md font-semibold cursor-pointer peer-checked/male:bg-[--color1-green] peer-checked/male:text-white transition-all">
                                    Masculin
                                </label>
            
                                <input type="radio" id="female" wire:model="genre" value="feminin" class="hidden peer/female" />
                                <label for="female"
                                    class="px-6 py-2 bg-[#f2f2f2] shadow-md text-gray-700 rounded-md font-semibold cursor-pointer peer-checked/female:bg-[--color1-green] peer-checked/female:text-white transition-all">
                                    Féminin
                                </label>
                            </div>
                        </div>
            
                        <!-- IMAGE -->
                        <div class="space-y-4" style="grid-area: photo">
                            <!-- Input file -->
                            <label class="">Photo</label>
                            <div class="flex items-end gap-4">
                                <!-- Preview box -->
                                <div id="previewContainer" class="mt-2 w-40 h-40 min-w-40 border border-dashed border-gray-400 rounded-lg flex items-center justify-center overflow-hidden bg-gray-50">
                                    <span class="text-gray-400 text-sm">Aperçu</span>
                                </div>
            
                                <input 
                                    type="file" 
                                    id="photoInput" 
                                    class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200"
                                >
                            </div>
                        </div>
            
                        <!-- COMMENTAIRE -->
                        <div class="" style="grid-area: comment; text-align: left">
                            <label for="comment" class="">Commentaire</label>
                            <textarea wire:model="comment" value="{{old('comment')}}" id="comment" value="{{ old('comment') }}" placeholder="Je suis ..." class="champInput"></textarea>
                            @error('comment')<span class="text-red-500">{{$message}}</span>@enderror
                        </div>
                    </div>
            
                    <button type="submit" class="btnPageRersever">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
