<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class smsHistory extends Model
{
    use HasFactory;

    protected $table = "sms_histories";
    
    protected $fillable = ['service_id', 'phone', 'code', 'status', 'sms'];

    protected $searchableFields = ['*'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
