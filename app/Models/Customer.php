<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
//    protected $with = ['invoices'];

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function scopeFilter($query , array $filters)
    {
        foreach ($filters as $filterName => $filterValue){
            $query->when($filterValue ?? false , function ($query) use($filterName , $filterValue){
                $query->where($filterName , 'like' , '%'.$filterValue.'%');
            });
        }

    }
}
