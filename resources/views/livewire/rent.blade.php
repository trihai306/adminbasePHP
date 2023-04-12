<div>
    <h2 class="filament-tables-header-heading text-xl font-bold tracking-tight pb-3">
        <b>SERVICE: </b> <span class="font-medium text-sm " style="color: #2929e9f5">Press for renting</span>
    </h2>
    <label for="simple-search" class="sr-only">Search</label>
    <div class="relative w-full py-3">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
        </div>
        <input type="text" wire:model="search" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
    </div>
    <div class="container-grid-service pt-3">
        @foreach($service as $s)
        <div class="item-service">
            <img src="{{asset('storage/'. $s->image)}}" alt="">
            <h2>{{$s->name}}</h2> :
            <h3><span>{{number_format($s->money)}}</span> VND</h3>
        </div>
        @endforeach
    </div>

</div>