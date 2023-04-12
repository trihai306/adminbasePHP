<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transactions extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = ['member_id', 'money', 'type', 'bank_id', 'status'];

    protected $searchableFields = ['*'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }
}
