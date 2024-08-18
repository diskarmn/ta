<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;



class Employee extends Model implements Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable, AuthenticableTrait;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = ['id' => 'string'];
    protected $fillable = [

        'name', 'email', 'password', 'profile_image', 'gender', 'phone_number', 'role','juragan_id'


    ];
    protected $table = 'employees';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function scopeFilter($query, array $filters)
    {

        $query->when(isset($filters['search']), function ($query) use ($filters) {
            $query->where('role', 'LIKE', '%' . $filters['role'] . '%')->where(function ($query) use ($filters) {
                $query->where('name', 'LIKE', '%' . $filters['search'] . '%')
                      ->orWhereHas('juragans', function ($query) use ($filters) {
                          $query->where('name_juragan', 'LIKE', '%' . $filters['search'] . '%');
                      });
            });
        });

        $query->when(isset($filters['role']) && $filters['role'] === 'cs', function ($query) {
            return $query->where('role', 'cs');
        });
        $query->when(isset($filters['role']) && $filters['role'] === 'admin', function ($query) {
            return $query->where('role', 'admin');
        });
        $query->when(isset($filters['role']) && $filters['role'] === 'superAdmin', function ($query) {
            return $query->where('role', 'superAdmin');
        });

    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'served_by');
    }
    public function juragan()
{
    return $this->belongsTo(Juragan::class, 'juragan_id');
}

    // public function juragans()
    // {
    //     return $this->hasMany(Juragan::class, 'cs_id', 'id');
    // }

    public function hasAnyRole($roles)
    {
        return in_array($this->role, $roles);
    }

    public function isCs()
    {
        return $this->role === 'cs';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'employee_id', 'id');
    }

}
