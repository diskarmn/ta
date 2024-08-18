<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notiforder extends Model
{
    use HasFactory;

    protected $fillable = ['teks', 'audio', 'id_order'] ;

    protected $table = 'notifications';

    protected $atribbutes = [
        'teks'=>'',
        'audio'=> '',
        'id_order'=> null,
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function audioNotification()
    {
        return $this->hasOne(Notiforder::class,'id', 'audio');
    }
}
