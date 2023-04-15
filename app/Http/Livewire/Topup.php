<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Transactions;
use Filament\Notifications\Notification;
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
        if ($this->money == '' || $this->bank_id == 0) {
            return Notification::make()
                ->title('Vui lòng điền đầy đủ thông tin')
                ->danger()
                ->body('Kiểm tra ngân hàng và số tiền!')
                ->send();
        }

        $data = [
            'member_id' => Auth::user()->id,
            'money' => $this->money,
            'type'  => 'deposit',
            'status'    => 'pending',
            'bank_id'   => $this->bank_id
        ];
        Transactions::create($data);
        Notification::make()
            ->title('Cập nhập thành công')
            ->success()
            ->body('Số tiền sẽ được admin kiểm tra và cộng vào tài khoản trong 30p!')
            ->send();
        return  redirect()->to('/admin/transactions');
    }
}
