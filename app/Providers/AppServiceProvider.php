<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Placeholder;
use Filament\Support\Actions\BaseAction;
use Filament\Tables\Columns\Column;
use Filament\Tables\Filters\BaseFilter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Filament::registerStyles([
            'https://cdn.jsdelivr.net/npm/daisyui@2.51.5/dist/full.css',
            asset('css/my-styles.css'),
        ]);
//        Filament::registerScripts([
//            'https://cdn.tailwindcss.com',
//        ], true);
//        $this->autoTranslateLabels();
    }
    private function autoTranslateLabels()
    {
        $this->translateLabels([
            Field::class,
            BaseFilter::class,
            Placeholder::class,
            Column::class,
            // or even `BaseAction::class`,
            BaseFilter::class,
            BaseAction::class
        ]);
    }

    private function translateLabels(array $components = [])
    {
        foreach($components as $component) {
            $component::configureUsing(function ($c): void {
                $c->translateLabel();
            });
        }
    }
}
