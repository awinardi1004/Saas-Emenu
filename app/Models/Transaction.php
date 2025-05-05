<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use softDeletes;

    protected $fillable = [
        'user_id',
        'code',
        'name',
        'phone_number',
        'table_number',
        'payment_method',
        'total_price',
        'status'
    ];

    public static function boot()
    {
        parent::boot();
    
        static::creating(function ($model) {
            if (Auth::check() && Auth::user()->role === 'store') {
                $model->user_id = Auth::user()->id;
            }
        });
    
        static::updating(function ($model) {
            if (Auth::check() && Auth::user()->role === 'store') {
                $model->user_id = Auth::user()->id;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionDetails()
    {
         return $this->hasMany(TransactionDetail::class);
    }
}
