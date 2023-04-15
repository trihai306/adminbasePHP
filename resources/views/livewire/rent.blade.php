<div>
    <h2 class="filament-tables-header-heading text-xl font-bold tracking-tight pb-3">
        <b>SERVICE: </b> <span class="font-medium text-sm " style="color: #2929e9f5">Press for renting</span>
    </h2>
    <label for="simple-search" class="sr-only">Search</label>
    <div class="relative w-full py-3">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <input type="text" wire:model="search" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
    </div>
    <div class="container-grid-service pt-3">
        @foreach($service as $s)
        <div class="item-service" wire:click="rent({{$s->id}})">
            <img src="{{asset('storage/'. $s->image)}}" alt="">
            <h2>{{$s->name}}</h2> :
            <h3><span>{{number_format($s->money)}}</span> VND</h3>
        </div>
        @endforeach
    </div>


    <div class="filament-widget col-span-1 filament-widgets-table-widget" style="margin-top: 50px;">
        <div class="filament-tables-component">
            <div class="border border-gray-300 shadow-sm bg-white rounded-xl filament-tables-container dark:bg-gray-800 dark:border-gray-700">
                <div class="filament-tables-header-container">
                    <div class="px-2 pt-2">
                        <div class="filament-tables-header px-4 py-2 mb-2">
                            <div class="flex flex-col gap-4 md:justify-between md:items-start md:flex-row md:-mr-2">
                                <div>
                                    <h2 class="filament-tables-header-heading text-xl font-bold tracking-tight">Api Key</h2>
                                    <p class="filament-tables-header-description"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="filament-tables-table-container overflow-x-auto relative dark:border-gray-700 border-t">
                    <table class="filament-tables-table w-full text-start divide-y table-auto dark:divide-gray-700">
                        <thead>
                            <tr class="bg-gray-500/5">
                                <td class="filament-tables-checkbox-cell w-4 px-4 whitespace-nowrap">
                                    <label>
                                        <input class="block border-gray-300 rounded shadow-sm text-primary-600 outline-none focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:checked:bg-primary-600 dark:checked:border-primary-600" type="checkbox">
                                    </label>
                                </td>
                                <th class="filament-tables-header-cell p-0 filament-table-header-cell-id">
                                    <button type="button" class="flex items-center gap-x-1 w-full px-4 py-2 whitespace-nowrap font-medium text-sm text-gray-600 dark:text-gray-300 cursor-default ">
                                        <span>
                                            Id
                                        </span>
                                    </button>
                                </th>
                                <th class="filament-tables-header-cell p-0 filament-table-header-cell-name">
                                    <button type="button" class="flex items-center gap-x-1 w-full px-4 py-2 whitespace-nowrap font-medium text-sm text-gray-600 dark:text-gray-300 cursor-default ">
                                        <span>
                                            Name
                                        </span>
                                    </button>
                                </th>
                                <th class="w-5"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y whitespace-nowrap dark:divide-gray-700">
                            <tr class="filament-tables-row transition">
                                <td class="filament-tables-reorder-cell w-4 px-4 whitespace-nowrap hidden"></td>
                                <td class="filament-tables-checkbox-cell w-4 px-4 whitespace-nowrap">
                                    <label>
                                        <input class="block border-gray-300 rounded shadow-sm text-primary-600 outline-none focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:checked:bg-primary-600 dark:checked:border-primary-600 filament-tables-record-checkbox" type="checkbox">
                                    </label>
                                </td>
                                <td class="filament-tables-cell dark:text-white filament-table-cell-id">
                                    <div class="filament-tables-column-wrapper">
                                        <div class="flex w-full justify-start text-start">
                                            <div class="filament-tables-text-column px-4 py-3">
                                                <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                                                    <span class="">
                                                        2
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="filament-tables-cell dark:text-white filament-table-cell-name">
                                    <div class="filament-tables-column-wrapper">
                                        <div class="flex w-full justify-start text-start">
                                            <div class="filament-tables-text-column px-4 py-3">
                                                <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                                                    <span class="">
                                                        check
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="filament-tables-actions-cell px-4 py-3 whitespace-nowrap">
                                    <div class="filament-tables-actions-container flex items-center gap-4 justify-end">
                                        <button type="button" class="filament-button filament-button-size-sm inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2rem] px-3 text-sm text-white shadow focus:ring-white border-transparent bg-success-600 hover:bg-success-500 focus:bg-success-700 focus:ring-offset-success-700 filament-tables-button-action">
                                            <svg class="filament-button-icon w-4 h-4 mr-1 -ml-1.5 rtl:ml-1 rtl:-mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                           

                                            <span class="flex items-center gap-1">
                                                <span class="">
                                                    Delete api
                                                </span>
                                            </span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>