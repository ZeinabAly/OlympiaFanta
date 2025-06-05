
<div class="zoneSearchContent">
    <div class="flex justify-between items-center border-b mb-5 pb-2">
        <h1 class="md:text-[1.7rem] text-[1.3rem] font-bold p-0 m-0">Liste des étudiants</h1>
        @auth()
        <div x-data="{openModal: false}" x-cloak>
            <button type="button" @click="$dispatch('open-modal')" class="btnAjouter">
                <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                </svg>
                Ajouter <span class="hidden md:block">un Étudiant</span>
            </button>
        </div>
        @endauth
    </div>

    <!-- ZONE RECHERCHE ET AJOUTER -->
    <div class="flex justify-between items-center gap-2">

        <div class="search-box">
            <svg width="16" height="16" fill="#999" viewBox="0 0 16 16" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Rechercher un étudiant..." class="form-control">
        </div>

    <!-- LES FILTRES -->
        <div class="flexCenter gap-3">
            <!-- FILTRES -->
            <div x-data="{ open: false }" x-cloak @click.outside="open = false" class="relative  text-left">
                <button @click="open = !open" class="px-3 py-[10px] border border-[#ccc] rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#595b60" height="18" width="18"><path d="M3.9 54.9C10.5 40.9 24.5 32 40 32l432 0c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9 320 448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6l0-79.1L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"/></svg>
                </button>
            
                <div x-show="open" class="min-w-[200px] w-full min-w-[100px] py-1 bg-[#e4e5e8] absolute top-12 right-0 z-10 rounded-sm shadow-md leading-[30px] text-left">
                    <button class="w-full hover:bg-white px-4 py-1 text-left text-[14px] {{$type === '' ? 'bg-white' : ''}} " wire:click="typeSelect('')">Actifs</button> <br>
                    <button class="w-full hover:bg-white px-4 py-1 text-left text-[14px] {{$type === 'withTrashed' ? 'bg-white' : ''}} " wire:click="typeSelect('withTrashed')">Avec supprimés</button> <br>
                    <button class="w-full hover:bg-white px-4 py-1 text-left text-[14px] {{$type === 'onlyTrashed' ? 'bg-white' : ''}} " wire:click="typeSelect('onlyTrashed')">Supprimés seulement</button> <br>
                </div> 
            </div>
        
            <!-- LES COLONNES A VOIR -->
            <div x-data="{ open: false }" x-cloak class="relative  text-left">
                <button @click="open = !open" class="px-3 py-[10px] border border-[#ccc] rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" height="18" width="18" fill="#595b60"><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                </button>
            
                <div x-show="open" @click.outside="open = false" class="min-w-[200px] w-full min-w-[100px] py-1 bg-[#e4e5e8] absolute top-12 right-0 z-10 rounded-sm shadow-md leading-[30px] text-left">
                    @foreach($columnSlugs as $slug => $name)
                    <label class="flexBetween w-full hover:bg-white px-4 py-1 text-left text-[14px]">{{$name}} <input type="checkbox" wire:click="toggleColumn('{{$slug}}')" {{ in_array($slug, $columns) ? 'checked' : '' }}></label>
                    @endforeach
                    <label class="flexBetween w-full hover:bg-white px-4 py-1 text-left text-[14px]">Action <input type="checkbox" wire:click="toggleColumn('action')" {{ in_array('action', $columns) ? 'checked' : '' }}></label>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="mt-3 mx-4">
    @if(Session::has('status'))
        <p class="alert-success">{{Session::get('status')}}</p>
    @endif
</div>
