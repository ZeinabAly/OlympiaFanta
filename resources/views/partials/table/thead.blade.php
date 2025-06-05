<tr>
    @foreach($columnSlugs as $slug => $name)


        @if (in_array($slug, $columns))
            <th wire:click="doSort('{{$slug}}')">
                <x-datatable-item :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="{{$slug}}" name="{{$name}}" />
            </th>
        @endif

    @endforeach


    @if (in_array('action', $columns))
        <th scope="col" class="">Action</th>
    @endif

</tr>