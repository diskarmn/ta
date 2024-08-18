<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    // ...
    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = ['id' => 'string'];
    protected $fillable = ['name', 'email', 'register_date', 'phone', 'address', 'phone2', 'kabupaten', 'kecamatan', 'provinsi', 'kodepos', 'cs_id', ];
    protected $hidden = [
        'password',
    ];
    protected $table = 'customers';

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
        });
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'cs_id');
    }
}
