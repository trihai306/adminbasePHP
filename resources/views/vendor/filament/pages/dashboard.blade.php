<x-filament::page class="filament-dashboard-page">
    <x-filament::widgets :widgets="$this->getWidgets()" :columns="$this->getColumns()" />

    <div class="filament-dashboard-table flex flex-col gap-3">
        <h2 class="filament-header-heading pt-3 text-2xl font-bold tracking-tight">API key</h2>
        <button class="btn btn-success btn-wide ">Create new key</button>
        <div class="overflow-x-auto rounded-xl shadow border border-gray-300">
            <table class="table table-zebra w-full text-gray-800  ">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Job</th>
                        <th>Favorite Color</th>
                        <th>OPERATION</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr>
                        <th>1</th>
                        <td>Cy Ganderton</td>
                        <td>Quality Control Specialist</td>
                        <td>Blue</td>
                        <td><button class="btn btn-square btn-outline w-6 h-6 btn-error" style="min-height: 1px !important;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button></td>
                    </tr>
                    <!-- row 2 -->
                    <tr>
                        <th>2</th>
                        <td>Hart Hagerty</td>
                        <td>Desktop Support Technician</td>
                        <td>Purple</td>
                        <td><button class="btn btn-square btn-outline w-6 h-6 btn-error" style="min-height: 1px !important;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button></td>
                    </tr>
                    <!-- row 3 -->
                    <tr>
                        <th>3</th>
                        <td>Brice Swyre</td>
                        <td>Tax Accountant</td>
                        <td>Red</td>
                        <td><button class="btn btn-square btn-outline w-6 h-6 btn-error" style="min-height: 1px !important;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


</x-filament::page>