<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = ['id' => 'string'];

    protected $fillable = [
        'order_number',
        'order_date',
        'juragan',
        'id_customer',
        'payment_method',
        'source',
        'served_by',
        'tgl_bayar',
        'tujuan_bayar',
        'total_amount',
        'paid_amount',
        'remaining_amount',
        'resi_id',
        'notes',
        'status',
        'deadline',
        'ongkir',
        'biaya_lain',
        'dana_ongkir',
        'dana_biaya_lain',
        'total_quantity',
        

    ];

    public static function createNewOrder($data)
    {
        $data['status'] = 'belum_proses';
        return self::created($data);
    }

    public function scopeWithPaymentMethod($query, $paymentMethod)
    {
        return $query->when($paymentMethod, function ($query) use ($paymentMethod) {
            $query->where('payment_method', 'like', "%" . $paymentMethod . "%");
        });
    }

    public function scopeWithStatus($query, $status)
    {
        return $query->when($status, function ($query) use ($status) {
            $query->where('status', 'like', "%" . $status . "%");
        });
    }

    public function scopeWithShippingOption($query, $shippingOption)
    {
        return $query->when($shippingOption, function ($query) use ($shippingOption) {
            $query->where('status', 'like', "%" . $shippingOption . "%");
        });
    }

    public function scopeWithCustomerName($query, $customerName)
    {
        if (!empty($customerName)) {
            return $query->whereHas('customer', function ($query) use ($customerName) {
                $query->where('name', 'like', "%" . $customerName . "%");
            });
        }
    }

    public function scopeWithOrderDate($query, $orderDate)
    {
        return $query->when($orderDate, function ($query) use ($orderDate) {
            $query->whereDate('order_date', '=', $orderDate);
        });
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'served_by');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_produk');
    }

    public function juragan()
    {
        return $this->belongsTo(Juragan::class, 'id_juragan');
    }

    public function requests()
    {
        return $this->hasMany(EditRequest::class, 'id_order', 'id');
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'order_id', 'id');
    }

    public function scopeOrderanSelesai($query)
    {
        // Your scope implementation
        return $query->where('status', '=', 'orderan_selesai');
    }

    public function scopeExcludeStatusGagal($query)
    {
        return $query->where(function ($query) {
            $excludedStatuses = ['gagal', 'baru', 'belum', 'diproses', 'cek', 'dikirim'];
            foreach ($excludedStatuses as $status) {
                $query->where('keterangan_status', 'NOT LIKE', '%' . $status . '%');
            }
        });
    }
    public function barangOrders()
    {
        return $this->hasMany(BarangOrder::class, 'id_order');
    }

}
