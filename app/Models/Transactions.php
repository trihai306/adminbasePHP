<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transactions extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = ['member_id', 'money', 'type', 'status'];

    protected $searchableFields = ['*'];

  
}
