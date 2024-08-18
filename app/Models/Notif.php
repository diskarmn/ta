<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\File;

class Notif extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = ['id' => 'string'];
    // Definisikan atribut dan metode sesuai kebutuhan Anda
    protected $fillable = ['teks', 'audio', 'status', 'id_order', 'id_employee'];
    protected $table = "notifs";


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('teks', 'like', '%' . $search . '%')
                ->orWhere('audio', 'like', '%' . $search . '%');
        });
        $query->when($filters['status'] ?? false, function ($query, $status) {
            return $query->where('status', $status);
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'id_employee');
    }

    public function getAudioBasenameAttribute()
    {
        return basename($this->audio);
    }
}
