<?php

namespace App\Http\Livewire;

use App\Models\Api;
use App\Models\Service;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Rent extends Component
{
    public $search;
    public function render()
    {
        return view('livewire.rent', [
            'service' => Service::where('status', 'active')->where('name', 'like', '%' . $this->search . '%')->get()
        ]);
    }
    public function rent($id)
    {
        $service = Service::find($id);
        if ($service->money > Auth::user()->money) {
            return  Notification::make()
                ->title('Lỗi')
                ->danger()
                ->body('Không đủ số dư vui lòng kiểm tra lại!')
                ->send();
        }
        $config = $this->get_token();
        if ($config == false) {
            return  Notification::make()
                ->title('Lỗi')
                ->danger()
                ->body('Hệ thống đang lỗi! vui lòng quay lại sau!')
                ->send();
        } else {
            $phone = $this->get_phone($config, $service->name);

        }


        return  Notification::make()
            ->title('Click vào')
            ->success()
            ->body($id)
            ->send();
    }
    public function get_token()
    {
        $token = Api::limit(1)->first();
        if (Carbon::now()->diffInHours($token->updated_at) > 23) {
            $data = ['email' => $token->email, 'password' => $token->password];
            $data_string = json_encode($data);

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, "https://smsgatewayprod.vdtsecurity.vn/v2/auth/login");
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-type: application/json',
                    'Accept: application/json',
                    'Accept-Encoding: gzip, deflate, br'
                )
            );

            $result = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($result);

            if ($result == "") {
                return false;
            } else {
                $token->token = $result->tokens->access->token;
                $token->save();
                return $token->token;
            }
        } else {
            return $token->token;
        }
    }
    public function get_phone($token, $service)
    {
        $data = [
            'brandType' => $service,
            'limit' => 10,
            'page' => 1,
            'msisdn' => '8459803001',
            'phoneRegex' => '845980',
            'cts' => '803001',
            'status' => 1
        ];
        $data_string = http_build_query($data);
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "https://smsgatewayprod.vdtsecurity.vn/v2/sims?".$data_string);
        curl_setopt($curl, CURLOPT_TIMEOUT, 80);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                'Content-type: application/json',
                'Accept: application/json',
                'Accept-Encoding: gzip, deflate, br',
                'Authorization: Bearer '. $token
            )
        );

        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result);
        
        if(curl_error($curl)){
            return 'Request Error:' . curl_error($curl);
        }else{
            return $result;
        }
        
    }
}
