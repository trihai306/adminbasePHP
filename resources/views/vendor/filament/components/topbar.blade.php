@props([
'breadcrumbs' => [],
])
@php
$user = \Filament\Facades\Filament::auth()->user();
$items = \Filament\Facades\Filament::getUserMenuItems();

$accountItem = $items['account'] ?? null;
$accountItemUrl = $accountItem?->getUrl();

$logoutItem = $items['logout'] ?? null;
@endphp
<div class="w-full px-4 mx-auto md:px-6 lg:px-8">
    <header {{ $attributes->class([
    'filament-main-topbar sticky z-10 flex flex-col shrink-0 items-center border-b bg-white ',
    'dark:bg-gray-800 dark:border-gray-700' => config('filament.dark_mode'),
]) }}>
        <div class="flex items-center w-full px-2 pt-3 sm:px-4 md:px-6 lg:px-8">
            <button x-cloak x-data="{}" x-bind:aria-label="$store.sidebar.isOpen ? '{{ __('filament::layout.buttons.sidebar.collapse.label') }}' : '{{ __('filament::layout.buttons.sidebar.expand.label') }}'" x-on:click="$store.sidebar.isOpen ? $store.sidebar.close() : $store.sidebar.open()" @class([ 'filament-sidebar-open-button shrink-0 flex items-center justify-center w-10 h-10 text-primary-500 rounded-full outline-none hover:bg-gray-500/5 focus:bg-primary-500/10' , 'lg:mr-4 rtl:lg:mr-0 rtl:lg:ml-4'=> config('filament.layout.sidebar.is_collapsible_on_desktop'),
                'lg:hidden' => ! (config('filament.layout.sidebar.is_collapsible_on_desktop') && (config('filament.layout.sidebar.collapsed_width') === 0)),
                ])
                >
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <div class="flex items-center justify-between flex-1">
                <x-filament::layouts.app.topbar.breadcrumbs :breadcrumbs="$breadcrumbs" />

                <select class="text-gray-900 block w-15 transition duration-75 rounded-lg shadow-sm outline-none focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 border-gray-300 dark:border-gray-600">

                    <option>VN</option>
                    <option>EN</option>

                </select>


                @livewire('filament.core.global-search')

                @livewire('filament.core.notifications')

                <x-filament::layouts.app.topbar.user-menu />
            </div>
        </div>
        <div class="container--custom--header w-full flex flex-row gap-8 items-center justify-center py-3 px-2 sm:px-4 md:px-6 lg:px-8 bg-white dark:bg-gray-800 dark:border-gray-700">
            <marquee class="uppercase w-full " style="color: #ffc30e; margin-right: 50px">Chúc quý khách hàng một ngày vui vẻ</marquee>
            <div class="flex gap-3 justify-end">
                <a href="#" class="btn btn-primary">support 24/7</a>
                <!-- The button to open modal -->
                <label for="my-modal" class="btn text-white">topup wallet</label>

                <!-- Put this part before </body> tag -->
                <input type="checkbox" id="my-modal" class="modal-toggle" />
                <div class="modal">
                    <div class="modal-box dark:bg-gray-800">
                        <h3 class="font-bold text-lg">Congratulations random Internet user!</h3>

                        <livewire:topup />
                    </div>
                </div>
            </div>




        </div>
    </header>
</div>