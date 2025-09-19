<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Quotation extends Model
{
    use HasFactory , SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'required',
        'solar_capacity',
        'rooftop_size',
        'amount',
        'date',
        'by',
        'status',
        'deleted_at',
        'created_at',
        'updated_at',
        'channel_partner_id',
        'quotation_number'
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    protected static function booted()
    {
        static::created(function ($quotation) {
            $yearMonth = Carbon::now()->format('Ym');
            $idPadded = str_pad($quotation->id, 3, '0', STR_PAD_LEFT);

            $quotation->quotation_number = "QTN-{$yearMonth}-{$idPadded}";
            $quotation->save();
        });
    }
}
