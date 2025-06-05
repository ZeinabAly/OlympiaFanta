@props(['icon' => true, 'id'])
<div>
    <!-- Bouton de suppression amélioré qui gère tout avec Alpine.js -->
    <button
        type="button"
        class="item text-danger delete btn-danger"
        x-data="{ showModal: false }"
        x-on:click="showModal = true"
    >
        
        @if($icon)
        
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-red-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
         @else 
        <p>Supprimer</p>
        @endif
        
        <!-- Modal intégrée dans le bouton -->
        <template x-teleport="body">
            <div x-show="showModal" 
                x-transition
                class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center">
                <!-- Overlay -->
                <div class="fixed inset-0 bg-black opacity-50" x-on:click="showModal = false"></div>
                
                <!-- Boîte de dialogue -->
                <div class="relative bg-white rounded-lg shadow-lg p-5 max-w-md w-full mx-4">
                    <div class="text-center">
                        <!-- Icône -->
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        
                        <h3 class="text-lg font-medium mb-2">Êtes-vous sûr ?</h3>
                        <p class="text-gray-600 mb-5">Cette action est irréversible !</p>
                        
                        <div class="flex justify-center space-x-3">
                            <button x-on:click="showModal = false" 
                                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg">
                                Annuler
                            </button>
                            <button x-on:click="showModal = false; $wire.delete({{ $id }})" 
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                                Oui, supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </button>
</div>