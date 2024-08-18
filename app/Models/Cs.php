<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cs extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];
    protected $fillable = ['name', 'hp', 'email', 'password', 'toko', 'email_verified_at'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('toko', 'like', '%' . $search . '%');
        });
    }

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, 'cs_id');
    }

    public function juragans()
    {
        return $this->belonngsToMany(Juragan::class);    }
}