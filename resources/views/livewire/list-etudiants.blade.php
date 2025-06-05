
<div class="relative">
    <div class="my-5">
       
        <div class="">
            <!-- PLACE DES FILTRES -->
            @include('partials.table.header')
        </div>

        <!-- TABLEAU -->
        <div class="table-wrapper">
            <table class="table">
                <thead class="thead">
                    @include('partials.table.thead')
                </thead>
                <tbody class="tbody">
                    @if($etudiants[0] == null)
                        <tr class="colsTbody">
                            @if($search)
                            <td colspan="11" class="colsTbody">
                                Aucun élément trouvé pour "{{$search}}"
                            </td>
                            @else
                            <td colspan="11" class="colsTbody">
                                Aucun élément trouvé
                            </td>
                            @endif
                        </tr>
                    @endif

                    @foreach($etudiants as $etudiant)
                    <tr class="">
                        @if (in_array('id', $columns))
                            <td scope="row" class="colsTbody">
                                {{ $etudiant->id }}
                            </td>
                        @endif

                        @if (in_array('prenom', $columns))
                            <td scope="row" class="col-nom-image">
                                <div class="">
                                    {{ $etudiant->prenom }}
                                </div>
                            </td>
                        @endif

                        @if (in_array('name', $columns))
                            <td scope="row" class="colsTbody">
                                {{ $etudiant->name }}
                            </td>
                        @endif

                        @if (in_array('date_naissance', $columns))
                            <td scope="row" class="colsTbody">
                                {{ $etudiant->date_naissance }}
                            </td>
                        @endif

                        @if (in_array('email', $columns))
                            <td scope="row" class="colsTbody">
                                {{ $etudiant->email }}
                            </td>
                        @endif

                        @if (in_array('phone', $columns))
                            <td scope="row" class="colsTbody">
                                {{ $etudiant->phone }}
                            </td>
                        @endif

                        @if (in_array('ville', $columns))
                            <td scope="row" class="colsTbody">
                                {{ $etudiant->ville }}
                            </td>
                        @endif

                        @if (in_array('quartier', $columns))
                            <td scope="row" class="colsTbody">
                                {{ $etudiant->quartier }}
                            </td>
                        @endif

                        @if (in_array('option', $columns))
                            <td scope="row" class="colsTbody">
                                {{ $etudiant->option }}
                            </td>
                        @endif

                        @if (in_array('genre', $columns))
                            <td scope="row" class="colsTbody">
                                {{ $etudiant->genre }}
                            </td>
                        @endif

                        @if (in_array('action', $columns))
                            <td class="colsTbody">
                                <div class="divIconsActions">
                                    <button @click="$dispatch('open-show-modal', { id: {{ $etudiant->id }} })" class="hover:bg-transparent text-blue-600 hover:text-blue-900">
                                        <div class="item view">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        </div>
                                    </button>

                                    @auth()
                                    <button @click="$dispatch('open-edit-modal', { id: {{ $etudiant->id }} })" class="hover:bg-transparent text-green-600 hover:text-green-900">
                                        <div class="item edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        </div>
                                    </button>

                                    <form action="route('admin.user.destroy', $etudiant ) }}" id="formDelete" method="POST" class="flex items-center hover:bg-transparent">
                                        @method('DELETE')
                                        @csrf
                                        <x-deleteBtn :id="$etudiant->id" />
                                    </form>
                                    @endauth
                                </div>
                            </td>
                        @endif
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">
        <div class="flexBetween mx-4">
            @include('partials.table.footer')
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{$etudiants->links(data: ['scrollTo' => false])}}
            </div>
        </div>
    </div>
    
</div>