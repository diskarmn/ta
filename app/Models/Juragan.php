<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juragan extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $keyType = 'string';
    protected $casts = ['id' => 'string'];
    protected $fillable = ['name_juragan', 'alamat', 'id'];

    // protected $guarded = ['id'];
    protected $table = 'juragans';


    // public function cs()
    // {
    //     return $this->belongsTo(Cs::class, 'cs_id');
    // }

    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class, 'cs_id', 'id');
    // }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id', 'juragan');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'id', 'juragan');
    }
}
