<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query , array $filters)
    {
        $query->when($filters['customerId'] ?? false , function ($query , $customerId){
            $query->where('customer_id' , $customerId);
        });
        $query->when($filters['status'] ?? false , function ($query , $status){
            $query->where('status' , $status);
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
