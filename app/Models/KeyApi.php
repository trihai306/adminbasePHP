<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyApi extends Model
{
    use HasFactory;

    protected $table = "key_api";

    protected $fillable = ['member_id','key', 'status'];

    protected $searchableFields = ['*'];
}
