<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class CustomerHistory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
