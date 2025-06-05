
<div>

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

    <!-- CONTENU -->
    @if($isEditing)

    <div class="modalAddStudent" x-show="openEditModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200"  x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
        
        <div class="section-container">
            <!-- Reservation -->
            <div class="form-cover relative">
                <h2 class="reservation-accro">Modification</h2>
                <h2 class="reservation-title mb-10">Modifier les informations</h2>
                
                <button class="absolute top-3 right-3 hover:bg-transparent" wire:click="closeModal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#bf1a1a" height="23" width="23"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                </button>

                <form class="w-[100%] relative formInscription" wire:submit.prevent="update" enctype="multipart/form-data">
      
                    <div class="reservation-inputs">
                        
                        <div class="" style="grid-area: prenom; text-align: left">
                            <label for="prenom" class="">Prenom</label>
                            <input type="text" wire:model="prenom" id="prenom" placeholder="Mariame" value="{{old('prenom')}}" class="champInput">
                            @error('prenom')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
                        
                        <div class="" style="grid-area: nom; text-align: left;">
                            <label for="nom" class="">Nom</label>
                            <input type="text" wire:model="name" id="name"  placeholder="Camara" value="{{old('name')}}" class="champInput">
                            @error('name')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
            
                        <div class="" style="grid-area: phone; text-align: left;">
                            <label for="phone" class="">Téléphone</label>
                            <input type="number" wire:model="phone" id="phone"  placeholder="623479759" value="{{old('phone')}}" class="champInput">
                            @error('phone')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
            
                        <div class="" style="grid-area: email; text-align: left; ">
                            <label for="email" class="">Email</label>
                            <input type="email" wire:model="email" id="email" placeholder="mariame@gmail.com" value="{{old('email')}}" class="champInput">
                            @error('email')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
            
                        <div class="" style="grid-area: dateN; text-align: left;">
                            <label for="dateNaissance" class="">Date de naissance</label>
                            <input type="date" wire:model="dateNaissance" id="dateNaissance" placeholder="Date de naissance" value="{{old('dateNaissance')}}" class="champInput">
                            @error('dateNaissance')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
            
                        <div class="" style="grid-area: ville; text-align: left; text-align: left">
                            <label for="ville" class="">Ville</label>
                            <input type="text" wire:model="ville" id="ville" placeholder="Ville" value="{{old('ville')}}" class="champInput">
                            @error('ville')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
            
                        <div class="" style="grid-area: quartier; text-align: left;">
                            <label for="quartier" class="">Quartier</label>
                            <input type="text" wire:model="quartier" id="quartier" placeholder="Quartier" value="{{old('quartier')}}" class="champInput">
                            @error('quartier')<span class="alert-message">{{$message}}</span>@enderror
                        </div>
                        
                        <div class="" style="grid-area: option; text-align: left; text-align: left">
                            <label for="option" class="">Option</label>
                            
                            <select wire:model="option" class="champInput">
                                <option value="">Choisir une option</option>
                                @foreach($options as $opt)
                                    <option value="{{ $opt->name }}" {{$opt->name === $option ? 'selected' : '' }}>{{ ucwords(strtolower($opt->name)) }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div style="grid-area: genre; text-align: left;">
                            <label class="">Genre</label>
                            <div class="flex gap-4 mt-2">
                                <!-- Masculin -->
                                <input 
                                    type="radio" 
                                    id="male" 
                                    wire:model="genre" 
                                    value="masculin" 
                                    class="hidden peer/male"
                                />
                                <label for="male"
                                    class="px-6 py-2 shadow-md rounded-md font-semibold cursor-pointer transition-all 
                                        bg-[#f2f2f2] text-gray-700 
                                        peer-checked/male:bg-[--color1-green] peer-checked/male:text-white">
                                    Masculin
                                </label>

                                <!-- Féminin -->
                                <input 
                                    type="radio" 
                                    id="female" 
                                    wire:model="genre" 
                                    value="feminin" 
                                    class="hidden peer/female"
                                />
                                <label for="female"
                                    class="px-6 py-2 shadow-md rounded-md font-semibold cursor-pointer transition-all 
                                        bg-[#f2f2f2] text-gray-700 
                                        peer-checked/female:bg-[--color1-green] peer-checked/female:text-white">
                                    Féminin
                                </label>
                            </div>
                        </div>

            
                        <div class="space-y-4" style="grid-area: photo">
                            <!-- Input file -->
                            <label class="">Photo</label>
                            <div class="flex items-end gap-4">
                                <!-- Preview box -->
                                <div id="previewContainer" class="mt-2 w-40 h-40 min-w-40 border border-dashed border-gray-400 rounded-lg flex items-center justify-center overflow-hidden bg-gray-50">
                                    
                                    @if($photo)
                                        <img src="{{ asset('storage/' . $photo) }}" class="w-40 h-40 object-cover rounded-full border" />
                                    @else
                                        <span class="text-gray-400 text-sm">Aperçu</span>
                                    @endif
                                </div>
            
                                <input wire:model="photo"
                                    type="file" 
                                    id="photoInput" 
                                    class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200"
                                >
                            </div>
                        </div>
            
                        <div class="" style="grid-area: comment; text-align: left">
                            <label for="comment" class="">Commentaire</label>
                            <textarea wire:model="comment" value="{{old('comment')}}" id="comment" value="{{ old('comment') }}" placeholder="Je suis ..." class="champInput"></textarea>
                            @error('comment')<span class="text-red-500">{{$message}}</span>@enderror
                        </div>
                    </div>
            
                    <button type="submit" class="btnPageRersever">Modifier</button>
                </form>
            </div>
        </div>
    </div>

    @endif
</div>

