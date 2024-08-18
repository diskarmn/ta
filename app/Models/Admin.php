<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Admin extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    // ...
    protected $fillable = [
        'name', 'email', 'password', 'profile_image', 'role', 'gender', 'phone_number', 'address', 'email_verified_at',
    ];
    protected $table = 'admin';

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('toko', 'like', '%' . $search . '%');
        });
    }

    public function hasAnyRole($roles)
    {
        return in_array($this->role, $roles);
    }

    public function isSuperadmin()
    {
        return $this->role === 'superadmin';
    }
}
