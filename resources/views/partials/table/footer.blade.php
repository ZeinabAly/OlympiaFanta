
<!-- PERPAGE -->
<select class="w-[80px] px-2 py-2 bg-[#f8fafb] rounded-md outline-none border border-gray-300" wire:change="getPerpage($event.target.value)">
    <option value="10" selected>10</option>
    <option value="1">1</option>
    <option value="30">20</option>
    <option value="10000">Tout</option> 
</select>