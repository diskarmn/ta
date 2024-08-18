<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class data_jasa_ekspedisi extends Model
{
    use HasFactory;

    // protected $fillable = ['uuid'];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = ['id' => 'string'];
    protected $guarded = [];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function($model)
    //     {
    //         if($model->getKey() == null) {
    //             $model->setAttribute($model->getKeyname(), Str::uuid()->toString());
    //         }
    //     });
    // }

    public static function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama_jasa_ekspedisi', 'like', '%' . $search . '%');
        });
    }
    

}
