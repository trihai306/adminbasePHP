<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class Rent extends Component
{
    public $search;
    public function render()
    {
        return view('livewire.rent', [
            'service' => Service::where('status', 'active')->where('name', 'like', '%'.$this->search.'%')->get()
        ]);
    }
}
