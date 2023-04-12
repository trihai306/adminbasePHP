<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Topup extends Component
{
    public $money;
    public $bank_id = 0;

    public function render()
    {
        return view('livewire.topup', [
            'bank'  => Bank::where('status', 'active')->get()
        ]);
    }
    public function top_up()
    {
        if($this->money == '' || $this->bank_id == 0) {
            return false;
        }
        
        $data = [
            'member_id' => Auth::user()->id,
            'money' => $this->money,
            'type'  => 'deposit',
            'status'    => 'pending',
            'bank_id'   => $this->bank_id
        ];
        Transactions::create($data);
        return  redirect()->to('/admin/transactions');
    }
}
