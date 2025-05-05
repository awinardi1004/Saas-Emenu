<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use softDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'icon'
    ];

    // for generate slug
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            if(Auth::user()->role === 'store') {
                $model->user_id = Auth::user()->id;
            }

            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model){
            if(Auth::user()->role === 'store') {
                $model->user_id = Auth::user()->id;
            }

            $model->slug = Str::slug($model->name);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
