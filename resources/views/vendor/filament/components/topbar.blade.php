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
<header {{ $attributes->class([
    'filament-main-topbar sticky top-0 z-10 flex flex-col shrink-0 items-center border-b bg-white ',
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

            <select class="select select-warning w-13 dark:bg-gray-800">

                <option>VN</option>
                <option>EN</option>

            </select>

            @livewire('filament.core.global-search')

            @livewire('filament.core.notifications')

            <x-filament::layouts.app.topbar.user-menu />
        </div>
    </div>
    <div class="container--custom--header w-full flex flex-row gap-8 items-center justify-center py-3 px-2 sm:px-4 md:px-6 lg:px-8 bg-white dark:bg-gray-800 dark:border-gray-700">
        <marquee class="uppercase" style="color: #ffc30e">Chúc quý khách hàng một ngày vui vẻ</marquee>

        <a href="#" class="btn btn-primary">support 24/7</a>
        <!-- The button to open modal -->
        <label for="my-modal" class="btn text-white">topup wallet</label>

        <!-- Put this part before </body> tag -->
        <input type="checkbox" id="my-modal" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box dark:bg-gray-800">
                <h3 class="font-bold text-lg">Congratulations random Internet user!</h3>
                <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!</p>
                <div class="modal-action">
                    <label for="my-modal" class="btn">Yay!</label>
                </div>
            </div>
        </div>

        <form action="{{$logoutItem?->getUrl() ?? route('filament.auth.logout')}}" method="post">
            @csrf
            <button type="submit" class="btn btn-outline btn-warning bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="white" stroke-width="2" stroke="currentColor" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                </svg>
            </button>
        </form>


    </div>
</header>