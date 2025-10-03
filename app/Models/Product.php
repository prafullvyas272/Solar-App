<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\ProductCategory;
use App\Models\ProductHistory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function assignedTo()
    {
        return $this->belongsTo(Customer::class, 'assigned_to');
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function histories()
    {
        return $this->hasMany(ProductHistory::class, 'product_id');
    }
}
